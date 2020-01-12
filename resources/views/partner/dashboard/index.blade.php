@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/dashboard/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="page-title-container">
        <h3 class="page-title-container__text">ダッシュボード</h3>
    </div>

    @include('partner.dashboard.components.status')
    @include('partner.dashboard.components.todo')
    @include('partner.dashboard.components.task')

</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/pages/partner/dashboard/index/index.js') }}" defer></script>
@endsection
