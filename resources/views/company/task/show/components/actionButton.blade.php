<div class="action-button-container">
    @if($task->status === config('const.TASK_CREATE'))
    <form action="{{ route('company.task.status.change') }}" method="POST">
        @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="status" value="{{ config('const.TASK_SUBMIT_SUPERIOR') }}">
        <button type="button" class="action-button-container__done confirm" data-toggle="modal" data-target="#confirm">上長に確認を依頼する</button>
        <!-- Modal -->
        @component('components.confirm-modal')
            @slot('modalID')
                confirm
            @endslot
            @slot('confirmBtnLabel')
                依頼
            @endslot
            タスクを {{ $task->superior->name }} さんに上長確認を依頼します。
        @endcomponent
    </form>
    @elseif($task->status === config('const.TASK_SUBMIT_SUPERIOR') && $task->superior->id === Auth::user()->id)
    <form action="{{ route('company.task.status.change') }}" method="POST">
        @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="status" value="{{ config('const.TASK_CREATE') }}">
        <button type="submit" class="action-button-container__undone">タスクを承認しない</button>
    </form>
    <a href="{{ route('company.document.purchaseOrder.show', ['purchaseOrder_id' => $purchaseOrder->id]) }}" class="action-button-container__done">発注書を確認する</a>
    @elseif($task->status === config('const.TASK_APPROVAL_SUPERIOR') && in_array(Auth::user()->id, $company_user_ids))
    <form action="{{ route('company.task.status.change') }}" method="POST">
        @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="status" value="{{ config('const.TASK_SUBMIT_PARTNER') }}">
        <button type="button" class="action-button-container__done confirm" data-toggle="modal" data-target="#confirm">パートナーに依頼する</button>
        <!-- Modal -->
        @component('components.confirm-modal')
            @slot('modalID')
                confirm
            @endslot
            @slot('confirmBtnLabel')
                依頼
            @endslot
            パートナーの {{ $task->partner->name }} さんに確認依頼します。
        @endcomponent
    </form>
    @elseif($task->status === config('const.TASK_APPROVAL_PARTNER') && in_array(Auth::user()->id, $company_user_ids))
    <a href="{{ route('company.document.purchaseOrder.create', ['id' => $task->id]) }}" class="action-button-container__done">発注書を作成する</a>
    @elseif($task->status === config('const.ORDER_SUBMIT_SUPERIOR') && $task->superior->id === Auth::user()->id)
    <a class="action-button-container__done" href="{{ route('company.document.purchaseOrder.show', ['purchaseOrder_id' => $purchaseOrder->id]) }}">発注書を確認する</a>
    @elseif($task->status === config('const.ORDER_APPROVAL_SUPERIOR') && in_array(Auth::user()->id, $company_user_ids))
    <form action="{{ route('company.task.status.change') }}" method="POST">
    @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="status" value="{{ config('const.ORDER_SUBMIT_PARTNER') }}">
        <button type="button" class="action-button-container__done confirm" data-toggle="modal" data-target="#confirm">発注書をパートナーに依頼する</button>
        <!-- Modal -->
        @component('components.confirm-modal')
            @slot('modalID')
                confirm
            @endslot
            @slot('confirmBtnLabel')
                依頼
            @endslot
            パートナーの {{ $task->partner->name }} さんに確認依頼します。
        @endcomponent
    </form>
    @elseif($task->status === config('const.DELIVERY_PARTNER') && in_array(Auth::user()->id, $company_user_ids))
    <form action="{{ route('company.task.status.change') }}" method="POST">
    @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="status" value="{{ config('const.WORKING') }}">
        <button type="button" class="action-button-container__undone confirm" data-toggle="modal" data-target="#not">再納品を依頼</button>
        <!-- Modal -->
        @component('components.confirm-modal')
            @slot('modalID')
                not
            @endslot
            @slot('confirmBtnLabel')
                依頼
            @endslot
            修正を依頼します。
        @endcomponent
    </form>
    <form action="{{ route('company.task.status.change') }}" method="POST">
    @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="status" value="{{ config('const.ACCEPTANCE') }}">
        <button type="button" class="action-button-container__done confirm" data-toggle="modal" data-target="#confirm">検収</button>
        <!-- Modal -->
        @component('components.confirm-modal')
            @slot('modalID')
                confirm
            @endslot
            @slot('confirmBtnLabel')
                完了
            @endslot
            検品完了します。
        @endcomponent
    </form>
    @elseif($task->status === config('const.INVOICE_CREATE') && in_array(Auth::user()->id, $company_user_ids))
    <a href="{{ route('company.document.invoice.show', ['id' => $invoice->id]) }}" class="action-button-container__done">請求書を確認する</a>
    @elseif($task->status === config('const.SUBMIT_ACCOUNTING') && $task->accounting->id === Auth::user()->id)
    <a href="{{ route('company.document.invoice.show', ['id' => $invoice->id]) }}" class="action-button-container__done">請求書を確認する</a>
    @elseif($task->status === config('const.APPROVAL_ACCOUNTING') && in_array(Auth::user()->id, $company_user_ids))
    <form action="{{ route('company.task.status.change') }}" method="POST">
    @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="status" value="{{ config('const.COMPLETE_STAFF') }}">
        <button type="button" class="action-button-container__done confirm" data-toggle="modal" data-target="#confirm">タスクを完了にする</button>
        <!-- Modal -->
        @component('components.confirm-modal')
            @slot('modalID')
                confirm
            @endslot
            @slot('confirmBtnLabel')
                完了
            @endslot
            タスクを完了します。
        @endcomponent
    </form>
    @elseif($task->status === config('const.COMPLETE_STAFF'))
    <p class="action-button-container__non_action">このタスクは完了しています</p>
    @elseif($task->status === config('const.TASK_CANCELED'))
    <p class="action-button-container__non_action">このタスクはキャンセルされています</p>
    @else
    <p class="action-button-container__non_action">必要なアクションはありません</p>
    @endif
</div>

<div class="error-message-container">
    @if ($errors->has('task_id'))
    <p class="error-message-container__text" role="alert">
        {{ $errors->first('task_id') }}
    </p>
    @endif
    @if ($errors->has('status') && !$errors->has('task_id'))
    <p class="error-message-container__text" role="alert">
        {{ $errors->first('status') }}
    </p>
    @endif
</div>
