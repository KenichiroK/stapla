<div class="status-container">
    <div class="title-container">
        <h4 class="title-container__text">ステータス</h4>
    </div>

    <ul class="navbar-container">
        <li id="task-status-btn" class="navbar-container__text navbar-btn is-active">タスク
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.TASK_CREATE'), config('const.TASK_APPROVAL_PARTNER')) }})</span>
        </li>
        <li id="order-status-btn" class="navbar-container__text navbar-btn">発注書
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.ORDER_SUBMIT_SUPERIOR'), config('const.ORDER_APPROVAL_PARTNER')) }})</span>
        </li>
        <li id="working-status-btn" class="navbar-container__text navbar-btn">作業中
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.WORKING'), config('const.ACCEPTANCE')) }})</span>
        </li>
        <li id="invoice-status-btn" class="navbar-container__text navbar-btn">請求書
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.INVOICE_DRAFT_CREATE'), config('const.APPROVAL_ACCOUNTING')) }})</span>
        </li>
        <li id="complete-status-btn" class="navbar-container__text navbar-btn">完了
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')) }})</span>
        </li>
    </ul>

    <ul id="task-status-table" class="detail-container">
        <li class="detail-container__content">
            <span class="detail-container__content--title">下書き</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_CREATE')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">上長確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_SUBMIT_SUPERIOR')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">パートナー依頼前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_APPROVAL_SUPERIOR')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">パートナー確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_SUBMIT_PARTNER')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">発注書作成前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_APPROVAL_PARTNER')] }}</span>
        </li>
    </ul>
    <ul id="order-status-table" class="detail-container">
        <li class="detail-container__content">
            <span class="detail-container__content--title">上長確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.ORDER_SUBMIT_SUPERIOR')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">パートナー依頼前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.ORDER_APPROVAL_SUPERIOR')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">パートナー確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.ORDER_SUBMIT_PARTNER')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">作業前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.ORDER_APPROVAL_PARTNER')] }}</span>
        </li>
    </ul>
    <ul id="working-status-table" class="detail-container">
        <li class="detail-container__content">
            <span class="detail-container__content--title">作業中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.WORKING')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">検品中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.DELIVERY_PARTNER')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">請求書作成前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.ACCEPTANCE')] }}</span>
        </li>
    </ul>
    <ul id="invoice-status-table" class="detail-container">
        <li class="detail-container__content">
            <span class="detail-container__content--title">下書き</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.INVOICE_DRAFT_CREATE')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">担当者確認前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.INVOICE_CREATE')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">担当者確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.SUBMIT_STAFF')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">経理確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.SUBMIT_ACCOUNTING')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">経理承認済み</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.APPROVAL_ACCOUNTING')] }}</span>
        </li>
    </ul>
    <ul id="complete-status-table" class="detail-container">
        <li class="detail-container__content">
            <span class="detail-container__content--title">完了</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.COMPLETE_STAFF')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">キャンセル</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_CANCELED')] }}</span>
        </li>
    </ul>
</div>
