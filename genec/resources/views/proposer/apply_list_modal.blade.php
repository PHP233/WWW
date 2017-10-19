<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="history_apply">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <table class="table table-hover">
                    <caption>历史申报列表——点击题目切换申请</caption>
                    <thead>
                    <tr>
                        <th>题目</th>
                        <th>状态</th>
                        <th>修改次数</th>
                        <th>申报时间</th>
                        <th>下载</th>
                    </tr>
                    <tbody>
                    @foreach($applies as $apply)
                    <tr>
                        <td><a href="{{ url('proposer/'.$apply->id) }}">{{ $apply->title }}</a></td>
                        @if ($apply->state == 0)
                            <td class="text-default">{{ $apply->state($apply->state) }}</td>
                        @elseif ($apply->state == 1)
                            <td class="text-info">{{ $apply->state($apply->state) }}</td>
                        @elseif ($apply->state == 2)
                            <td class="text-warning">{{ $apply->state($apply->state) }}</td>
                        @elseif ($apply->state == 3)
                            <td class="text-danger">{{ $apply->state($apply->state) }}</td>
                        @elseif ($apply->state == 4)
                            <td class="text-success">{{ $apply->state($apply->state) }}</td>
                        @elseif ($apply->state == 5)
                            <td class="text-danger">{{ $apply->state($apply->state) }}</td>
                        @elseif($apply->state == 6)
                            <td class="text-success">{{ $apply->state($apply->state) }}</td>
                        @elseif($apply->state == 7)
                            <td class="text-success">{{ $apply->state($apply->state) }}</td>
                        @elseif($apply->state == 8)
                            <td class="text-success">{{ $apply->state($apply->state) }}</td>
                        @else
                            <td class="text-danger">-</td>
                        @endif
                        <td>{{ $apply->modify_time }}</td>
                        <td>{{ date('Y/m/d',$apply->created_at) }}</td>
                        <td><a href="{{ route('proposer_download',['apply_id' => $apply->id]) }}"><span class="glyphicon glyphicon-cloud-download"></span></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

