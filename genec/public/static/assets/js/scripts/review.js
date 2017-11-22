var to_select;
var selected;
var assignTaskModal;
var document_id;
var document_title;
var tr;
var toast_modal;
var review_list_modal;
var review_list;
var review_time;
var review_list_title;
var suggest;
var approve_content;
var approve_sign;
var review_results;

$(function() {
    to_select = $('#to_select_list');
    selected = $('#selected_list');
    assignTaskModal = $('#assignTaskModal');
    toast_modal = $('#toast');
    review_list_modal = $('#review_list_modal');
    review_list = review_list_modal.find('ul.list-group');
    review_time = review_list_modal.find('ul.pagination');
    review_list_title = review_list_modal.find('small');
    suggest = review_list_modal.find('textarea#reviewContent');
    approve_content = $('textarea#approve_content');
    approve_sign = review_list_modal.find('span.text-danger');
    selected.on('click','button', function() {
        this.remove();
        addChecker($(this), 0);
    });

    $('#to_select_list').on('click','button', function() {
        this.remove();
        addChecker($(this), 1);
    });

    review_time.on('click','li', function () {
        review_time.find('li').removeClass('active');
        $(this).addClass('active');
    })

    Table.order([0,'desc']).draw();
});

function openAssignTaskModal(id,title) {
    tr = document.activeElement.parentNode.parentNode;
    document_id = id;
    document_title = title;
    assignTaskModal.modal('show');
}

function addChecker(item, direction) {
    var id = item.data('id');
    var name = item.text();
    var title = item.attr('title');
    var button = '<button type="button" class="btn btn-default" data-id="'+id+'" title="'+ title +'">'+name+'</button>';
    if(direction) {
        $(selected).prepend(button);
    } else {
        $(to_select).prepend(button);
    }
}

// 全选或清空
function setAll(type) {
    if(type) {
        var buttons = $(to_select).find('button');
    } else {
        buttons = $(selected).find('button');
    }
    for(var button of buttons) {
        button.remove();
        addChecker($(button), type);
    }
}

// 分配审议任务
function assignChecker() {
    var buttons = $(selected).find('button');
    if(buttons.length == 0) {
        return;
    }
    var checkers = [];
    var checkerIds = [];
    for(var button of buttons) {
        var checker = {};
        checker.id = $(button).data('id');
        checker.name = $(button).text();
        checker.number = $(buttons).attr('title');
        checkers.push(checker);
        checkerIds.push(checker.id);
    }
    var r = confirm('确定要将审议任务分配给——'+ document_title +'：' + showSelectedCheckerList(checkers));
    if(r) {
        // 发送 ajax 请求，新增审议信息
        ajaxForAssignReview(checkerIds);
    }
}

function showSelectedCheckerList(checkers) {
    var str = '\r\n';
    for(checker of checkers) {
        str += checker.number + ', ' + checker.name + '\r\n';
    }
    return str;
}

var review_arr = [];
var temp_documentId;

// 切换右侧意见内容
function showContent(i, btn) {
    review_list.find('button').removeClass('active');
    $(btn).addClass('active');
    if(review_arr[i] == null)
        suggest.val($(btn).text() + '——该审议人还没有审议...');
    else
        suggest.val($(btn).text() + ':  \n' + review_arr[i]);
}

// 审议列表 和 审批页面进行切换
function turn(dir) {
    if(dir) {
        $('#reviewListBlock').hide();
        $('#approveBlock').show();
    } else {
        $('#approveBlock').hide();
        $('#reviewListBlock').show();
    }
}

// 数字转性别
function sex(sex) {
    if(sex == "1")
        return '男';
    return '女';
}

// 将相应结果渲染在页面上
function showReviewDetail(time) {
    var str = '';
    review_arr = [];
    for(var i=0;i<review_results[time].length;i++) {
        review_arr.push(review_results[time][i].content);
        var item = '<button onclick="showContent('+ i +',this)" type="button" class="list-group-item" title="'+ sex(review_results[time][i].reviewer.sex) + ',' + review_results[time][i].reviewer.number +'">'+ review_results[time][i].reviewer.name +'</button>';
        str += item;
    }
    review_list.html(str);
    showContent(0,review_list.find('button')[0]);
    review_list_modal.modal('show');
}

/*
   打开审议列表，左侧是审议人，右侧是审议内容 different
*/
function reviewList(id, modify_time, name) {
    // 先展示的是审议列表，隐藏审批栏
    $('#approveBlock').hide();
    $('#reviewListBlock').show();
    // 清空上次审批留下的内容
    approve_content.val('');
    approve_sign.text('');
    tr = document.activeElement.parentNode.parentNode;
    review_list_title.text(name);
    temp_documentId = id;
    review_arr = [];
    var str = '';
    for(var i=0;i<modify_time;i++) {
        str += '<li><a href="javascript:showReviewDetail('+ i +');">'+ i +'</a></li>';
    }
    str += '<li class="active"><a href="javascript:showReviewDetail('+ modify_time +');">'+ modify_time +'</a></li>';
    review_time.html(str);
    // 以上作为审议情况模态框的初始化过程
    // 请求审议情况
    ajaxForReviewDetail(id,modify_time);
}

// 不通过 different
function fail() {
    var content = approve_content.val().trim();
    if(content == '') {
        approve_sign.text('请输入理由和修改意见');
        return;
    }
    ajaxForFail(content);
}

// 审议通过 different
function pass() {
    var content = approve_content.val().trim();
    // 如果通过没有给出理由就填写默认的
    if(content == '') {
        content = '恭喜您，您的申请书通过了审批';
        approve_content.val(content);
    }
    ajaxForPass(content);
}