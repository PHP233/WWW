@extends('common.admin_layout')

@section('css')
    <style>
        .talbe-span {
            padding: 5px
        }
    </style>
@stop

@section('td')
    <th> 编号 </th>
    <th> 题目 </th>
    <th> 申请人 </th>
    <th> 申请时间 </th>
    <th> 申请状态 </th>
    <th> 修改次数 </th>
    <th> 审议意见 </th>
    <th> 下载 </th>
@endsection

@section('table_content')
    @foreach($applies as $apply)
        <tr class="odd gradeX">
            <td> {{ $apply->id }} </td>
            <td> {{ $apply->title }} </td>
            <td> {{ $apply->proposer->name }} </td>
            <td> {{ $apply->created_at }} </td>
            <td> <span class="talbe-span {{ $apply->getStateClass($apply->state) }}">{{ $apply->state($apply->state) }}</span> </td>
            <td> {{ $apply->modify_time }} </td>
            <td><a href="#">意见</a> </td>
            <td><a href="{{ url('reviewer/apply/download/'.$apply->id) }}">下载</a> </td>
        </tr>
    @endforeach
@endsection

@section('table_title','申请表管理')

@section('javascript')
    <script>
        var Table = "";
        var TableDatatablesManage = function () {
            var table = $('#reviewer_table');
            var initTable1 = function () {
                // begin first table
                Table = table.DataTable({
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
                        [2]
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
                }
            };
        }();
        if (App.isAngularJsApp() === false) {
            jQuery(document).ready(function() {
                TableDatatablesManage.init();
            });
        }
    </script>
@endsection