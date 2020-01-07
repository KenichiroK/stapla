@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/dashboard/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="title-container">
        <h3 class="title-container__text">ダッシュボード</h3>
    </div>

    @include('company.dashboard.status')
    @include('company.dashboard.todo')
    @include('company.dashboard.project')
    @include('company.dashboard.task')

</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/moreBtn/all-todo.js') }}" defer></script>
<script src="{{ asset('js/moreBtn/passed-3days-todo.js') }}" defer></script>
<script src="{{ asset('js/moreBtn/project.js') }}" defer></script>
<script src="{{ asset('js/moreBtn/task.js') }}" defer></script>
<script src="{{ asset('js/dashboard/toggle-todo.js') }}" defer></script>
<script src="{{ asset('js/status/task/change-shown-status-table.js') }}" defer></script>
@endsection
