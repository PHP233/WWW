@extends('common.admin_layout')

@section('td')
    <th> ID </th>
    <th> 工号 </th>
    <th> 姓名 </th>
    <th> 邮箱 </th>
    <th> 电话 </th>
    <th> 性别 </th>
    <th> 创建日期 </th>
    <th> 修改 </th>
    <th> 删除 </th>
@endsection

@section('add_button_name')
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <button id="sample_editable_1_new" class="btn sbold green" data-toggle="modal" data-target="#add_reviewer_form">添加审议人
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@stop

@section('table_title','审议人管理')

@section('modal')
    @include('common.reviewer.modal')
@endsection

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/time.js') }}"></script>
    <script>
        var add_modal;
        var edit_modal;

        var Table1 = "";
        var TableDatatablesManage = function () {
        var table = $('#data_table');
        var initTable1 = function () {
        // begin first table
        Table1 = table.DataTable({
            rowId: 'id',
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
            url: "{{ route('get_all_reviewers') }}",
                dataSrc: 'data'
            },
            columns: [
                { "data": "id"},
                { "data": "number"},
                { "data": "name"},
                { "data": "email"},
                { "data": "phone"},
                { "data": "sex",render: function (data) {
                        return data == '1' ? '男':'女';
                }},
                { "data": "created_at",render: function (data) {
                    return formatDate(data);
                }
            },
                { "data": "id",render: function(data, type, row, meta) {
                return '<a id="edit" class="btn yellow btn-xs">修改</a> ';
                }},
                {"data": "id",render: function(data, type, row, meta) {
                return '<a id="delete" class="btn red btn-xs">删除</a>'
                }}
            ],
            buttons: [
                { extend: 'print', className: 'btn dark btn-outline' , text: '打印'},
                { extend: 'copy', className: 'btn red btn-outline', text: '复制' },
                { extend: 'excel', className: 'btn yellow btn-outline' , text: '导出Excel' },
                { extend: 'colvis', className: 'btn dark btn-outline', text: '显示列'},
            ],

            "bStateSave": true,

            "dom": "<'row' <'col-md-12'B><hr>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal

            "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
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
    initTable1();
    // 隐藏职工id
    Table1.column(0).visible(false);
    },
    reload: function() {
    Table1.ajax.reload();
    }
    };

    }();
        $().ready(function () {
            var sign = $('span#sign');      // 提示信息
            edit_modal = $('#edit_reviewer_form');
            add_modal = $('#add_reviewer_form');
        });

    if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
    TableDatatablesManage.init();
    });
    }

    // 删除审议人按钮点击事件
    $('#data_table tbody').on( 'click', '#delete', function () {
        if (confirm("你确认要删除这位审议人吗 ?") == false) {
            return;
        }
        var th = $(this).parents('tr');
        var id = Table1.row(th).data().id;
        $.ajax({
            url: "{{ url('reviewer/delete_reviewer') }}",
            data: {
            id: id
            },
            success: function (res) {
                console.log(res);
                if(res.code == 1) {
                    Table1.row( th).remove().draw();
                    toast(res.msg);
                } else {
                    alert(res.msg);
                }
            },
            error: function () {
                alert("sorry,Something is wrong...")
            }
        })
    } );

    // 修改按钮点击事件处理函数
    $('#data_table tbody').on('click','#edit',function () {
        var data = Table1.row($(this).parents('tr')).data();
        console.log(data);
        edit_modal.find('input#number').val(data.number);
        edit_modal.find('input#name').val(data.name);
        edit_modal.find('input#id').val(data.id);
        edit_modal.find('select#sex').val(data.sex);
        edit_modal.modal('toggle');
    })

    function add() {
        var error = add_modal.find('#form_error');
        var number = add_modal.find('input#number').val();
        var name = add_modal.find('input#name').val();
        var sex = add_modal.find(':checked').val();
        console.log(number);
        console.log(name);
        console.log(sex);
        if(number == '') {
            error.addClass('text-danger');
            error.text('请输入工号');
            return;
        }
        if(name == '') {
            error.addClass('text-danger');
            error.text('请输入姓名');
            return;
        }
        if(sex == undefined) {
            error.addClass('text-danger');
            error.text('请选择性别');
            return;
        }
        $.ajax({
            url: "{{ route('add_reviewer') }}",
            data: {
                name: name,
                number: number,
                sex: sex
            },
            success: function (res) {
                if(res.code == 1) {
                    var reply = res.reply;
                    toast(res.msg, add_modal);
                    Table1.row.add(reply).column('0').order().draw();
                } else {
                    error.text(res.msg);
                }
            },
            error: function () {
                alert('抱歉，创建审议人失败...')
            }
        })
    }

    function edit() {
        var error = edit_modal.find('#form_error');
        var id = edit_modal.find('input#id').val();
        var number = edit_modal.find('input#number').val();
        var name = edit_modal.find('input#name').val();
        var sex = edit_modal.find(':checked').val();
        console.log(id);
        console.log(number);
        console.log(name);
        console.log(sex);
        if(number == '') {
            error.addClass('text-danger');
            error.text('请输入工号');
            return;
        }
        if(name == '') {
            error.addClass('text-danger');
            error.text('请输入姓名');
            return;
        }
        if(sex == undefined) {
            error.addClass('text-danger');
            error.text('请选择性别');
            return;
        }
        $.ajax({
            url: "{{ route('edit_reviewer') }}",
            data: {
                id: id,
                name: name,
                number: number,
                sex: sex
            },
            success: function (res) {
                if(res.code == 1) {
                    toast(res.msg, edit_modal);
                    var reply = res.reply;
                    // 修改表格信息
                    Table1.ajax.reload();
                } else {
                    error.text(res.msg);
                }
            },
            error: function () {
                alert('抱歉，更新审议人失败...')
            }
        })
    }

    </script>
@endsection