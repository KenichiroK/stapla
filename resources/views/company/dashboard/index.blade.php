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
<script src="{{ asset('js/pages/company/dashboard/index/index.js') }}" defer></script>
@endsection
