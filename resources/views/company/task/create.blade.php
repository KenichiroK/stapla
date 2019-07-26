@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/create.css') }}">
@endsection

@section('header-profile')
<div class="navbar-item">
    {{ $company_user->name }}
</div>
<div class="navbar-item">
    <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
</div>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    <img src="../../../images/logo.png" alt="">
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="/company/dashboard"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/company/task" class="isActive"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                <li><a href="/company/setting/general"><i class="fas fa-cog"></i>設定</a></li>
                <li>
                    <form method="POST" action="{{ route('company.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </aside>
    </div>
</div>
@endsection

@section('content')
<div class="main__container">
    <form aciton="{{ url('/company/task/create') }}" method='POST'  class="main__container__wrapper">
    {{ csrf_field() }}
        <!-- ページタイトル エリア -->
        <div class="page-title-container">
            <div class="page-title-container__page-title">タスク作成</div>
        </div>
        <!-- プロジェクトを選択する エリア -->
        <div class="select-container">
            <div class="select-container__wrapper">
                <!-- プロジェクトを選択する -->
                <div class="select-container__wrapper__textarea">
                    <div class="select-container__wrapper__textarea__text">
                        プロジェクトを選択する
                    </div>
                </div>
                <!-- セレクトエリア -->
                <div class="select-container__wrapper__select-area control">
                    <div class="select-container__wrapper__select-area__field field">
                        <div class="select-container__wrapper__select-area__field__control control">
                            <div class="select-container__wrapper__select-area__field__control__select select is-info">
                                <select name="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}">
                                    <option></option>
                                    @foreach($tasks as $task)
                                        <option value="{{ $task->project->id }}">{{ $task->project->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('project_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style='color: #e3342f'>{{ $errors->first('project_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container">
            <div class="content-container__wrapper">
                <!-- main -->
                <div class="main-container">
                    <div class="main-container__wrapper">
                        <!-- 項目：タスク名 -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    タスク名
                                </div>
                            </div>
                            <div class="main-container__wrapper__item-container__inputarea">
                                <div class="main-container__wrapper__item-container__inputarea__field">
                                    <div class="main-container__wrapper__item-container__inputarea__field__control">
                                        <input class="input form-control{{ $errors->has('task_name') ? ' is-invalid' : '' }}" name='task_name' type="text">
                                        @if ($errors->has('task_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong style='color: #e3342f'>{{ $errors->first('task_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 項目：タスク作成日 -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    タスク作成日
                                </div>
                            </div>
                            <div class="main-container__wrapper__item-container__datewrapper">
                                <div class="main-container__wrapper__item-container__datewrapper__date">
                                       本日 2019年7月3日<i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                        <!-- 項目：タスク内容 -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper contentsname">
                                <div class="item-name-wrapper__item-name">
                                    タスク内容
                                </div>
                            </div>
                            <div class="main-container__wrapper__item-container__textarea">
                                <!-- <textarea class="textarea" placeholder="タスク内容" v-model="taskInfo.taskContent"></textarea> -->
                                <textarea class="textarea form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='task_content'></textarea>
                                @if ($errors->has('task_content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style='color: #e3342f'>{{ $errors->first('task_content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- 担当者 -->
                        <div class="main-container__wrapper__item-container">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                        担当者
                                    </div>
                                </div>
                                <div class="select-container__wrapper__select-area control staff">
                                    <div class="select-container__wrapper__select-area__field field">
                                        <div class="select-container__wrapper__select-area__field__control control">
                                            <div class="select-container__wrapper__select-area__field__control__select select-plusicon is-info">
                                            <!-- <select v-model="taskInfo.staff"> -->
                                            <select name='company_user_id' class="plusicon form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
                                                <option></option>
                                                @foreach($companyUsers as $companyUser)
                                                    <option value="{{ $companyUser->id }}" class=''>
                                                        {{ $companyUser->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('company_user_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style='color: #e3342f'>{{ $errors->first('company_user_id') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                        </div>                        

                        <!-- 上長 -->
                        <div class="main-container__wrapper__item-container">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                        上長
                                    </div>
                                </div>
                                <div class="select-container__wrapper__select-area control staff">
                                    <div class="select-container__wrapper__select-area__field field">
                                        <div class="select-container__wrapper__select-area__field__control control">
                                            <div class="select-container__wrapper__select-area__field__control__select select-plusicon is-info">
                                                <!-- <select v-model="taskInfo.partner"> -->
                                                <select name='partner_id' class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}">
                                                    <option></option>
                                                    @foreach($partners as $partner)
                                                        <option value={{ $partner->id }} >
                                                            {{ $partner->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('partner_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong style='color: #e3342f'>{{ $errors->first('partner_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- 項目：締め切り -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    プロジェクト期間
                                </div>
                            </div>
                            <div class="main-container__wrapper__item-container__calendar-content">
                                <!-- 開始日カレンダー -->
                                <div class="main-container__wrapper__item-container__calendar-content__content">                               
                                    
                                        <div class="main-container__wrapper__item-container__calendar-content__content__item-name-wrapper__item-name start">
                                            開始日<i class="fas fa-calendar-alt"></i>
                                        </div>
                                    
                                    <!-- <datepicker
                                        class="start_date"
                                        :format="DatePickerFormat"
                                        :language="ja"
                                        :inline="true"   
                                    >
                                    </datepicker> -->
                                </div>
                                <!-- 終了日カレンダー -->
                                <div class="main-container__wrapper__item-container__calendar-content__content">                               
                                    
                                        <div class="main-container__wrapper__item-container__calendar-content__content__item-name-wrapper__item-name">
                                            終了日<i class="fas fa-calendar-alt"></i>
                                        </div>
                                    
                                    <!-- <datepicker class="datepicker"
                                        v-model="taskInfo.deadlineDate"
                                        :format="DatePickerFormat"
                                        :language="ja"
                                        :inline="true"   
                                    ></datepicker> -->
                                </div>
                            </div>
                        </div>
                        <!-- 予算 -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    予算
                                </div>
                            </div>
                            <div class="main-container__wrapper__item-container__inputarea">
                                <div class="main-container__wrapper__item-container__inputarea__field">
                                    <div class="main-container__wrapper__item-container__inputarea__field__control budget">
                                        <!-- <input class="input" type="text" placeholder="Text input" v-model="taskInfo.orderNumber" > -->
                                        <input class="input" type="text">
                                        <div class="main-container__wrapper__item-container__inputarea__field__control-yen">
                                            円
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 項目：資料 -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name document">
                                    資料
                                </div>
                            </div>
                            <div class="is-boxed main-container__wrapper__item-container__filearea">
                                <p class="uplaod">アップロード</p>
                                <!-- <label class="file-label main-container__wrapper__item-container__filearea__label">
                                    <input class="file-input file-label main-container__wrapper__item-container__filearea__label" type="file" name="resume" >
                                    <span class="file-cta main-container__wrapper__item-container__filearea__label__file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        <input type="file" name="">
                                        Choose a file…
                                    </span>
                                    </span>
                                </label> -->
                                <img src="../../../images/dragdrop.png" alt="">
                            </div>
                        </div>
                    </div>      
                </div>

                <!-- パートナー契約内容 -->
                <div class="partner-container">
                    <p class="partner-container__title">パートナー契約内容</p>
                    <div class="partner-container__wrpper">
                        <!-- パートナー -->
                        <div class="partner-container__wrpper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    パートナー
                                </div>
                            </div>
                            <div class="select-container__wrapper__select-area control">
                                <div class="select-container__wrapper__select-area__field field">
                                    <div class="select-container__wrapper__select-area__field__control control">
                                        <div class="select-container__wrapper__select-area__field__control__select select-plusicon is-info">
                                            <!-- <select v-model="taskInfo.partner"> -->
                                            <select name='partner_id' class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}">
                                                <option></option>
                                                @foreach($partners as $partner)
                                                    <option value={{ $partner->id }} >
                                                        {{ $partner->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('partner_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style='color: #e3342f'>{{ $errors->first('partner_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 報酬形式 -->
                        <div class="partner-container__wrpper__item-container fee">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    報酬形式
                                </div>
                            </div>
                            

                            <div class="fee-container__control">
                                <label>
                                    <span class="title">固定</span>
                                    <input class="radio01-input" value="固定" name="fee_format" type="radio" checked>
                                    <span class="radio01-parts"></span>
                                </label>
                                <label>
                                    <span class="title">時間</span>
                                    <input class="radio01-input" value="時間" name="fee_format" type="radio">
                                    <span class="radio01-parts"></span>
                                </label>
                                <label>
                                    <span class="title">日</span>
                                    <input class="radio01-input" value="日" name="fee_format" type="radio">
                                    <span class="radio01-parts date"></span>
                                </label>
                            </div>
                            


                            
                        </div>
                        
                        <!-- 発注単価・件数 -->
                        <div class="partner-container__wrpper__item-container order__unit-number">
                            <div class="partner-container__wrpper__item-container__order">
                                
                                    <!-- 発注単価　タイトル -->
                                    <div class="item-name-wrapper unitname">
                                        <div class="item-name-wrapper__item-name">
                                            発注単価<span class="tax">（税抜）</span>
                                        </div>
                                    </div>
                                    
        
                                <div class="partner-container__wrpper__item-container__order-uninum">
                                    <!-- 発注単位 input -->
                                    <div class="partner-container__wrpper__item-container__order-uninum__unit__contents">
                                        <input class="input form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='price' type="text">
                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong style='color: #e3342f'>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                        <div class="partner-container__wrpper__item-container__order-uninum__unit__contents__class">
                                            円
                                        </div>
                                    </div>  
                                    <!-- 件数 -->
                                    <div class="item-name-wrapper numbername">
                                        <div class="item-name-wrapper__item-name">
                                            件数
                                        </div>
                                    </div>
                                    <div class="partner-container__wrpper__item-container__order-uninum__number__contents">
                                        <!-- <input class="input" type="text" placeholder="Text input" v-model="taskInfo.orderNumber" > -->
                                        <input class="input" type="text">
                                        <div class="partner-container__wrpper__item-container__order-uninum__number__contents__class">
                                            件
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 発注額 -->
                        <div class="partner-container__wrpper__item-container price">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    発注額
                                </div>
                            </div>
                            <div class="price-item">
                                <p><span class="tax">税抜</span><span class="yen">￥</span>200,000</p>
                                <p><span class="tax">税込</span><span class="yen">￥</span>216,000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-wrapper">
                    <button type='submit' class="button-wrapper__btn button">作成</button>
                </div>
                
            </div>
        </div>
    </form>
</div>
@endsection
