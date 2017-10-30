<div id="assignModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">分配审批负责人 <small>点击要分配的审批人</small></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <div id="to_select_list" style="padding: 15px">
                            @foreach($reviewers as $reviewer )
                                <button type="button" class="btn btn-default" data-id="{{ $reviewer->id }}"
                                        title="{{ $reviewer->sex() }}, 工号：{{ $reviewer->number }}"
                                onclick="assign({{$reviewer->id}},'{{$reviewer->name}}')">{{ $reviewer->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>