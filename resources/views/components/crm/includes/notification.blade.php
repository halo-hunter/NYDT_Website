<li class="nav-item dropdown dropdown-large">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> @if($unseen_todo_tasks > 0) <span class="alert-count">{{ $unseen_todo_tasks }}</span> @endif
        <i class='bx bx-bell'></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <a href="javascript:;">
            <div class="msg-header">
                <p class="msg-header-title">Notifications</p>
{{--                <p class="msg-header-clear ms-auto">Marks all as read</p>--}}
            </div>
        </a>
        <div class="header-notifications-list">

            @forelse($notifications as $notification)

                <a class="dropdown-item notification_block_class" data-id="{{ $notification['record_id'] }}" href="{{ $notification['object_type'] == 'case' ? route('cases->edit', $notification['object_id']) : '#' }}" data-url="{{ $notification['object_type'] == 'case' ? route('cases->edit', $notification['object_id']) : '#' }}">
                    <div class="d-flex align-items-center">
                        <div class="notify bg-light-info text-info"><i class='bx bx-check-square'></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="msg-name">Todo Task @if($notification['object_seen_status'] == 0) <small class="small text-info"> - Unread</small> @endif
                                <span class="msg-time float-end">{{ $notification['object_time'] }}</span>
                            </h6>
                            <p class="msg-info">Case ID: {{ $notification['object_id'] }}</p>
                        </div>
                    </div>
                </a>

            @empty
                <div class="text-center mt-5">
                    Not found
                </div>
            @endforelse



        </div>
        {{--                        <a href="javascript:;">--}}
        {{--                            <div class="text-center msg-footer">View All Notifications</div>--}}
        {{--                        </a>--}}
    </div>
</li>

