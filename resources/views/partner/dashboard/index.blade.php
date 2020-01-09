@extends('partner.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/dashboard/style.css') }}">
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
<script src="{{ asset('js/pages/partner/dashboard/index/index.js') }}" defer></script>
@endsection
