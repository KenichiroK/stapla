@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/dashboard/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="page-title-container">
        <h3 class="page-title-container__text">ダッシュボード</h3>
    </div>

    @include('company.dashboard.components.status')
    @include('company.dashboard.components.todo')
    @include('company.dashboard.components.project')
    @include('company.dashboard.components.task')

</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/pages/company/dashboard/index/index.js') }}" defer></script>
@endsection
