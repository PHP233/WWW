@extends('common.admin_layout')

@section('td')
    <th> 文件编号 </th>
    <th> 题目 </th>
    <th> 申请时间 </th>
    <th> 修改次数 </th>
    <th> 审议 </th>
    <th> 下载 </th>
@endsection

@section('table_title','审议申请书')

@section('modal')
    @include('common.toast')
    @include('common.reviewer.suggest_modal')
@stop

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/toast.js') }}"></script>
    <script>
        var suggest_modal;
        var textarea;
        var modal_title;
        var contents = [];
        $(document).ready(function(){
           suggest_modal = $('#suggest_modal');
           textarea = suggest_modal.find('textarea');
           modal_title = suggest_modal.find('h4');
        });
        var Table = "";
        var TableDatatablesManage = function () {
            var table = $('#data_table');
            var initTable = function () {
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
                        url: "{{ route('checker::get_my_apply') }}",
                        dataSrc: 'data'
                    },
                    rowId: 'id',
                    columns: [
                        { "data": "id"},
                        { "data": "title"},
                        { "data": "pivot.created_at"},
                        { "data": "modify_time"},
                        { "data": "pivot.content",render: function (data) {
                            if(data == null)
                                return '<a href="#" onclick="suggest(this)" class="btn btn-xs btn-info">审议</a>';
                            contents.push(data);
                            var len = contents.length - 1;
                            return '<a onclick="showMySuggest(this,'+ len +');" class="btn btn-xs btn-success">已审议 - 查看</a>';
                        }},
                        { "data": "id",render: function (data) {
                            var url = './apply/download/' + data;
                            return '<a href=' + url + '>下载</a>';
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
                    initTable();
                    // 隐藏职工id
                    Table.column(0).visible(false);
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

        var apply_id;
        function suggest(val) {
            setRowId(val);
            textarea.val('');
            modal_title.text('请填写您的审议意见');
            suggest_modal.modal('show');
        }

        function send() {
            // 没有输入或输入的是空格不予提交
            if(textarea.val() == null || textarea.val().trim() == '')
                return;
            $.post('{{ route('checker::suggest') }}',
                {
                    apply_id: apply_id,
                    suggest: textarea.val()
                },
                function (res) {
                    Table.ajax.reload();
                    toast(res.msg, suggest_modal);
                }
            );
        }

        function showMySuggest(val, index) {
            setRowId(val);
            textarea.val(contents[index]);
            modal_title.text('更改我的审议意见');
            suggest_modal.modal('show');
        }

        function setRowId(a) {
            var tr = $(a.parentNode.parentNode);
            apply_id = Table.row(tr).id();
        }
    </script>
@stop