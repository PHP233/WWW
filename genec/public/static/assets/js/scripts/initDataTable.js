const typeArr = ['','未审议','未审议','已审议待审批','已审批未通过','已批准'];
var Table = "";
var TableDatatablesManage = function () {
    var table = $('#data_table');
    var initTable = function () {
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
            initTable();
            var type = location.search[location.search.lastIndexOf('=') + 1];
            if(type == '1' || type == '2' || type =='3' || type == '4' || type == '5') {
                Table.search(typeArr[type]).draw();
            } else {
                Table.search('').draw();
            }
        }
    };
}();
if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        TableDatatablesManage.init();
    });
}

function showAssignCheckerModal() {
    $('#assignTaskModal').modal('show');
}