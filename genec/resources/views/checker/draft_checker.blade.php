@extends('common.admin_layout')

@section('td')
    <th> 文件编号 </th>
    <th> 题目 </th>
    <th> 申请时间 </th>
    <th> 修改次数 </th>
    <th> 审议 </th>
    <th> 下载 </th>
@endsection

@section('table_title','审议送审表')

@section('modal')
    @include('common.reviewer.suggest_modal')
@stop

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/time.js') }}"></script>
    <script>
        var suggest_modal;
        var textarea;
        var modal_title;
        var content_arr;
        $(document).ready(function(){
            suggest_modal = $('#suggest_modal');
            textarea = suggest_modal.find('textarea');
            modal_title = suggest_modal.find('h4');
        });
        var Table = "";
        var TableDatatablesManage = function () {
            var table = $('#data_table');
            var initTable = function () {
                var index = -1;
                content_arr = [];
                // begin first table
                Table = table.DataTable({
                    "bProcessing": true,
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "表格中无可用数据",
                        "info": "展示 _TOTAL_ 条记录中的 第 _START_ 到 第 _END_ 条",
                        "infoEmpty": "找不到记录",
                        "infoFiltered": "(在共  _MAX_ 条数据中)",
                        "lengthMenu": "每页展示 _MENU_ 行数据",
                        "search": "搜索:",
                        "zeroRecords": "无匹配数据",
                        "paginate": {
                            "previous":"上一页",
                            "next": "下一页",
                            "last": "末页",
                            "first": "首页"
                        }
                    },
                    ajax: {
                        url: "{{ route('checker::get_my_apply',['type' => 1]) }}",
                        dataSrc: 'data'
                    },
                    rowId: 'id',
                    columns: [
                        { "data": "id"},
                        { "data": "title"},
                        { "data": "pivot.created_at"},
                        { "data": "modify_time"},
                        { "data": "pivot.content",render: function (data, type, row, meta) {
                            let str;
                            if(data == null) {
                                str =  '<a href="#" onclick="suggest('+ row.id + ','+ row.modify_time +')" class="btn btn-xs btn-info">未审议</a>';
                            } else {
                                content_arr.push(data);
                                index = index + 1;
                                str= '<a onclick="showMySuggest('+ row.id +','+ row.modify_time +','+ index + ');" class="btn btn-xs btn-success">已审议 - 查看</a>';
                            }
                            // 可能存在对该文件的审议记录，点击该按钮显示历史记录
                            if(row.modify_time != 0) {
                                str += '<a href="#" onclick="record('+ row.id + ','+ row.modify_time +')" class="btn btn-xs btn-info">审议记录</a>';
                            }
                            return str;
                        }},
                        { "data": "id",render: function (data) {
                            var url = '{{ route('') }}';
                            return '<a href=' + url + '><span class="glyphicon glyphicon-cloud-download"></span></a>';
                        }}
                    ],
                    buttons: [
                        { extend: 'print', className: 'btn dark btn-outline' , text: '打印'},
                        { extend: 'copy', className: 'btn red btn-outline', text: '复制' },
                        { extend: 'excel', className: 'btn yellow btn-outline' , text: '导出Excel' },
                    ],

                    "bStateSave": true,

                    "dom": "<'row' <'col-md-12'B><hr>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal

                    "lengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "全部"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 5,
                    "pagingType": "bootstrap_full_number",
                    colReorder: true,
                    responsive: false,
                    "scrollX": false,
                    "order": [
                        [0]
                    ] // set first column as a default sort by asc
                });
            };

            return {
                // main function to initiate the module
                init: function () {
                    if (!jQuery().dataTable) {
                        return;
                    }
                    initTable();
                    // 隐藏id
                    Table.column(0).visible(false);
                    var type = location.search[location.search.lastIndexOf('=') + 1];
                    if(type == '1' || type == '2') {
                        Table.search(typeArr[type]).draw();
                    } else {
                        Table.search('').draw();
                    }
                },
                reload: function() {
                    Table.ajax.reload();
                }
            };

        }();

        if (App.isAngularJsApp() === false) {
            jQuery(document).ready(function() {
                TableDatatablesManage.init();
            });
        }

        let apply_id;
        let modify_time;
        // 弹出审议框
        function suggest(id, time) {
            apply_id = id;
            modify_time = time;
            textarea.val('');
            modal_title.text('请填写您的审议意见');
            suggest_modal.modal('show');
        }

        // 发送审议或更新审议结果
        function send() {
            // 没有输入或输入的是空格不予提交
            if(textarea.val() == null || textarea.val().trim() == '')
                return;
            $.post('{{ route('checker::suggest') }}',
                {
                    draft_id: apply_id,
                    modify_time: modify_time,
                    suggest: textarea.val()
                },
                function (res) {
                    Table.ajax.reload();
                    toast(res.msg, suggest_modal);
                }
            );
        }

        // 显示最新一次审议结果
        function showMySuggest(id,time, index) {
            apply_id = id;
            modify_time = time;
            modal_title.text('更改我的审议意见');
            textarea.val(content_arr[index]);
            suggest_modal.modal('show');
        }

        // 显示可能出现的审议记录
        function record(id,time) {
            $.get('{{ route('checker::record') }}',{
                draft_id: id,
                modify_time: time
            },function (res) {
                if(res.reply.length == 0) {
                    toast(res.msg);
                } else {
                    $('#record_modal h4').text(res.msg);
                    let str = '';
                    for(var item of res.reply) {
                        str += timeStamp2String(item.updated_at) + ':\n';
                        if (item.content == null)
                            item.content = '';
                        str += item.content + '\n\n';
                    }
                    $('#record_list').val(str);
                    $('#record_modal').modal('show');
                }
            })
        }

    </script>
@stop