<div>
    @if (count(getNotifications()) === 0)
    <div class="non-notification">
        <p>通知はありません</p>
    </div>
    @else
        @foreach (getNotifications() as $notification)
            @if (explode("\\", $notification->type)[count(explode("\\", $notification->type)) - 1] === 'AssignedTask')
                <a
                    class="notification-btn"
                    href="{{ $notification->data['role'] === 'PARTNER'
                                                            ? route('partner.task.show', ['id' => $notification->data['task_id']])
                                                            : route('company.task.show', ['id' => $notification->data['task_id']]) }}"
                >
                    <div class="card">
                        <div class="card-body  {{ $notification->read_at === NULL ? 'unreaded' : '' }}">
                            <p class="card-text">
                                <span class="font-weight-bold">{{ $notification->data['sender'] }}</span>さんがあなたを<span class="font-weight-bold">{{ Config::get('consts.taskRole.TASK_ROLE')[$notification->data['role']] }}</span>として<span class="font-weight-bold">{{ $notification->data['task'] }}</span>にアサインしました。
                            </p>
                        </div>
                    </div>
                </a>
            @elseif (explode("\\", $notification->type)[count(explode("\\", $notification->type)) - 1] === 'UpdatedTaskStatus')
                 <a
                    class="notification-btn"
                    href="{{ $notification->data['receiverIsPartner']
                                                    ? route('partner.task.show', ['id' => $notification->data['task_id']])
                                                    : route('company.task.show', ['id' => $notification->data['task_id']]) }}"
                >
                    <div class="card">
                        <div class="card-body  {{ $notification->read_at === NULL ? 'unreaded' : '' }}">
                            <p class="card-text">
                                <span class="font-weight-bold"> {{ $notification->data['task'] }} </span>が<span class="font-weight-bold"> {{ config('const.TASK_STATUS_LIST')[$notification->data['status']] }} </span>に変更されました。
                            </p>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    @endif
</div>
