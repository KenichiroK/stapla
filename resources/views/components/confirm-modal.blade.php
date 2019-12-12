@extends('company')

@section()
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header border border-0">
                <h5 class="center-block" id="exampleModalLabel">確認</h5>
            </div>
            <div class="modal-body">
                <!-- <p class="text-center">タスクを新規作成し 、 {{ $task->superior->name }} さんに上長確認を依頼します。</p> -->
                <p class="text-center">{{ $slot }}</p>
                <p class="text-center">よろしいですか？</p>
            </div>
            <div class="modal-footer center-block  border border-0">
                <button type="button" class="undone confirm-btn confirm-undone" data-dismiss="modal">キャンセル</button>
                <!-- <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >依頼</button> -->
                <button type="submit" class="done confirm-btn confirm-done" name="confirm-btn" >{{ $confirm }}</button>
            </div>
        </div>
    </div>
</div>
@endsection