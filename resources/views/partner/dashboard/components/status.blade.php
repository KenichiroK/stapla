<div class="status-container">
    <div class="table-title-container">
        <h4 class="table-title-container__text">ステータス</h4>
    </div>

    <ul class="navbar-container">
        <li id="task_status_btn" class="navbar-container__text">タスク・発注書
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.TASK_SUBMIT_SUPERIOR'), config('const.TASK_APPROVAL_PARTNER')) }})</span>
        </li>
        <li id="working_status_btn" class="navbar-container__text">作業中
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.WORKING'), config('const.ACCEPTANCE')) }})</span>
        </li>
        <li id="invoice_status_btn" class="navbar-container__text">請求書
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.INVOICE_DRAFT_CREATE'), config('const.APPROVAL_ACCOUNTING')) }})</span>
        </li>
        <li id="complete_status_btn" class="navbar-container__text">完了
            <span class="navbar-container__num">({{ countTaskStatus($status_arr, config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')) }})</span>
        </li>
    </ul>

    <ul id="task_status_table" class="detail-container">
        <li class="detail-container__content">
            <span class="detail-container__content--title">アサイン済み</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_SUBMIT_SUPERIOR')] + $status_arr[config('const.TASK_APPROVAL_SUPERIOR')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">パートナー確認中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.TASK_SUBMIT_PARTNER')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">作業前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.ORDER_APPROVAL_PARTNER')] }}</span>
        </li>
    </ul>
    <ul id="working_status_table" class="detail-container">
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
    <ul id="invoice_status_table" class="detail-container">
        <li class="detail-container__content">
            <span class="detail-container__content--title">下書き</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.INVOICE_DRAFT_CREATE')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">提出前</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.INVOICE_CREATE')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">提出中</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.SUBMIT_STAFF')] + $status_arr[config('const.SUBMIT_ACCOUNTING')] }}</span>
        </li>
        <li class="detail-container__content">
            <span class="detail-container__content--title">受理済</span>
            <span class="detail-container__content--num">{{ $status_arr[config('const.APPROVAL_ACCOUNTING')] }}</span>
        </li>
    </ul>
    <ul id="complete_status_table" class="detail-container">
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
