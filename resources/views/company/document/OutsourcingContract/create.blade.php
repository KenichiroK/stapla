@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/document/outsourcingContract/create.css') }}">
@endsection

@section('content')
<div class="main__container">
    <div class="main__container__wrapper">
        <!--main__container__wrapperに記述していく-->
        <div class="page-title-container">
            <div class="page-title-container__page-title">業務委託契約書作成画面</div>
        </div>
        <div class="main-container">
            <form action="" method="post">
            
                <div class="main-container__wrapper">
                    <!-- タスク -->
                    <dl>
                        <dt>
                            タスク
                        </dt>
                        <dd>
                        <div class="select-container">
                            <div class="select-container__wrapper select-arrow">
                                <select class="select-container__wrapper__select" name="task_id">
                                    <option disabled selected></option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        </dd>
                    </dl>
                    <!-- 作成日 -->
                    <dl>
                        <dt>
                            作成日
                        </dt>
                        <dd>
                        <div class="date-container">
                            <div class="date-container__wrapper">
                                <div class="text">作成日</div>
                                <div class="icon-imgbox">
                                    <img src="{{ asset('images/icon_calendar.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        </dd>
                    </dl>
                    <!-- 担当者 -->
                    <dl>
                        <dt>
                            担当者
                        </dt>
                        <dd>
                        <div class="select-container">
                            <div class="select-container__wrapper select-plusicon">
                                <select class="select-container__wrapper__select" name='companyUser_id'>
                                    <option disabled selected></option>
                                    <option value=""></option>                           
                                </select>
                            </div>
                        </div>
                        </dd>
                    </dl>
                    <!-- パートナー -->
                    <dl>
                        <dt>
                            パートナー
                        </dt>
                        <dd>
                        <div class="select-container">
                            <div class="select-container__wrapper select-plusicon">
                                <select class="select-container__wrapper__select" name='partner_id'>
                                    <option disabled selected></option>
                                    <option value=""></option>                            
                                </select>
                            </div>
                        </div>
                        </dd>
                    </dl>
                    <!-- 委託内容 -->
                    <dl class="last">
                        <dt>
                            委託内容
                        </dt>
                        <dd>
                        <div class="input-container">
                            <div class="input-container__wrapper">
                                <input name="" type="text" class="input form-control">
                            </div>
                        </div>
                        </dd>
                    </dl>
                </div>
                <!-- 作成ボタン -->
                <div class="btn02-container">
                    <button type="button" onclick="submit();">作成</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
