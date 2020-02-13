@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/task/index/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="page-title-container">
        <h3 class="page-title-container__text">タスク</h3>
    </div>

    @include('partner.task.index.components.status')

    <div class="tab-container">
        @if ($shown_task_status !== null && $shown_task_status !== config('const.COMPLETE_STAFF'))
        <a
            class="tab-container__btn is-active"
            href="{{ route('partner.task.status',  ['task_status' => $shown_task_status ]) }}"
        >
            {{ config('const.TASK_STATUS_LIST')[$shown_task_status] }}のタスク
        </a>
        @endif
        <a
            class="{{ $shown_task_status === null ? 'tab-container__btn is-active' : 'tab-container__btn' }}"
            href="{{ route('partner.task.index') }}"
        >
            全タスク
        </a>
        <a
            class="{{ $shown_task_status === config('const.COMPLETE_STAFF') ? 'tab-container__btn is-active' : 'tab-container__btn' }}"
            href="{{ route('partner.task.status',  ['task_status' => config('const.COMPLETE_STAFF') ]) }}"
        >
            完了したタスク
        </a>
    </div>
    @include('partner.task.index.components.task-table')
</div>
@endsection

@section("asset-js")
<script src="{{ asset('js/pages/partner/task/index/index.js') }}" defer></script>
@endsection