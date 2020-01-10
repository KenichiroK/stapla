@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/style.css') }}">
<link rel="stylesheet" href="{{ mix('css/page/project/index/style.css') }}">
@endsection

@section('content')
<div class="main-wrapper">
    <div class="title-container">
        <div class="page-title-container">
            <h3 class="page-title-container__text">プロジェクト</h3>
        </div>

        <div class="btn-container">
            <a class="btn-container__text" href="{{ route('company.project.create') }}">プロジェクト作成</a>
        </div>
    </div>

    <div class="tab-container">
        <a class="{{ $is_done_project ? 'tab-container__btn' : 'tab-container__btn is-active' }}" href="{{ route('company.project.index') }}">プロジェクト</a>
        <a class="{{ $is_done_project ? 'tab-container__btn is-active' : 'tab-container__btn' }}" href="{{ route('company.project.done.index') }}">完了したプロジェクト</a>
    </div>

    @include('company.project.components.table')

</div>
@endsection

@section('asset-js')
<script src="{{ asset('js/pages/company/project/index/index.js') }}" defer></script>
@endsection
