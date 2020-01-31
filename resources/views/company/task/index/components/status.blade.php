<div class="status-container">
    <div class="table-title-container status-table-title-container">
        <h4 class="table-title-container__text">ステータス</h4>
    </div>

    <ul class="navbar-container">
        <li id="task_status_btn" class="navbar-container__text">タスク・発注書
            <span id="task_status_num" class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.TASK_CREATE'), config('const.ORDER_APPROVAL_PARTNER')) }})</span>
        </li>
        <li id="working_status_btn" class="navbar-container__text">作業中
            <span id="working_status_num" class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.WORKING'), config('const.ACCEPTANCE')) }})</span>
        </li>
        <li id="invoice_status_btn" class="navbar-container__text">請求書
            <span id="invoice_status_num" class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.INVOICE_DRAFT_CREATE'), config('const.APPROVAL_ACCOUNTING')) }})</span>
        </li>
        <li id="complete_status_btn" class="navbar-container__text">完了
            <span id="complete_status_num" class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')) }})</span>
        </li>
    </ul>

    <div id="task_status_table" class="detail-container">
        <a
            class="{{ $shown_task_status === config('const.TASK_CREATE') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.TASK_CREATE')]) }}"
        >
            <span class="detail-container__content--title">下書き</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_CREATE')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.TASK_SUBMIT_SUPERIOR') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.TASK_SUBMIT_SUPERIOR')]) }}"
        >
            <span class="detail-container__content--title">上長確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_SUBMIT_SUPERIOR')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.TASK_APPROVAL_SUPERIOR') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.TASK_APPROVAL_SUPERIOR')]) }}"
        >
            <span class="detail-container__content--title">パートナー依頼前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_APPROVAL_SUPERIOR')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.TASK_SUBMIT_PARTNER') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.TASK_SUBMIT_PARTNER')]) }}"
        >
            <span class="detail-container__content--title">パートナー確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_SUBMIT_PARTNER')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.ORDER_APPROVAL_PARTNER') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.ORDER_APPROVAL_PARTNER')]) }}"
        >
            <span class="detail-container__content--title">作業前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.ORDER_APPROVAL_PARTNER')] }}</span>
        </a>
    </div>

    <div id="working_status_table" class="detail-container">
        <a
            class="{{ $shown_task_status === config('const.WORKING') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.WORKING')]) }}"
        >
            <span class="detail-container__content--title">作業中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.WORKING')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.DELIVERY_PARTNER') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.DELIVERY_PARTNER')]) }}"
        >
            <span class="detail-container__content--title">検品中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.DELIVERY_PARTNER')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.ACCEPTANCE') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.ACCEPTANCE')]) }}"
        >
            <span class="detail-container__content--title">請求書作成前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.ACCEPTANCE')] }}</span>
        </a>
    </div>

    <div id="invoice_status_table" class="detail-container">
        <a
            class="{{ $shown_task_status === config('const.INVOICE_DRAFT_CREATE') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.INVOICE_DRAFT_CREATE')]) }}"
        >
            <span class="detail-container__content--title">下書き</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.INVOICE_DRAFT_CREATE')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.INVOICE_CREATE') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.INVOICE_CREATE')]) }}"
        >
            <span class="detail-container__content--title">担当者確認前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.INVOICE_CREATE')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.SUBMIT_STAFF') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.SUBMIT_STAFF')]) }}"
        >
            <span class="detail-container__content--title">担当者確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.SUBMIT_STAFF')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.SUBMIT_ACCOUNTING') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.SUBMIT_ACCOUNTING')]) }}"
        >
            <span class="detail-container__content--title">経理確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.SUBMIT_ACCOUNTING')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.APPROVAL_ACCOUNTING') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.APPROVAL_ACCOUNTING')]) }}"
        >
            <span class="detail-container__content--title">経理承認済み</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.APPROVAL_ACCOUNTING')] }}</span>
        </a>
    </div>

    <div id="complete_status_table" class="detail-container">
        <a
            class="{{ $shown_task_status === config('const.COMPLETE_STAFF') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.COMPLETE_STAFF')]) }}"
        >
            <span class="detail-container__content--title">完了</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.COMPLETE_STAFF')] }}</span>
        </a>
        <a
            class="{{ $shown_task_status === config('const.TASK_CANCELED') ? 'detail-container__content is-active' : 'detail-container__content' }}"
            href="{{ route('company.task.status.statusIndex', ['task_status' => config('const.TASK_CANCELED')]) }}"
        >
            <span class="detail-container__content--title">キャンセル</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_CANCELED')] }}</span>
        </a>
    </div>
</div>
