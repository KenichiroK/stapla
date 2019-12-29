@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/dashboard/index.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="title-container">
        <h3 class="title-container__text">ダッシュボード</h3>
    </div>

    @include('partner.dashboard.status')
    @include('partner.dashboard.todo')
    @include('partner.dashboard.task')

</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/moreBtn/all-todo.js') }}" defer></script>
<script src="{{ asset('js/moreBtn/passed-3days-todo.js') }}" defer></script>
<script src="{{ asset('js/moreBtn/task.js') }}" defer></script>
<script src="{{ asset('js/dashboard/toggle-todo.js') }}" defer></script>
<script src="{{ asset('js/status/task/change-shown-status-table.js') }}" defer></script>
@endsection
