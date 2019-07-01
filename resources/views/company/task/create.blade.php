@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/create.css') }}">
@endsection

@section('sidebar')

<h1>ポスト作成</h1>



<div class="sidebar__container">
        <div class="sidebar__container__wrapper">
            <aside class="menu menu__container">
                <div class="menu__container--label">
                    <div class="menu-label">
                        fms
                    </div>
                </div>
                <ul class="menu-list menu menu__container__menu-list">
                    <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="/"><i class="fas fa-chart-bar"></i>Dashboard</a></li>
                    <li><a href="/company/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                    <li><a href="/company/task"><i class="fas fa-tasks"></i>タスク</a></li>
                    <li><a href="/company/document"><i class="fas fa-newspaper"></i>書類</a></li>
                    <li><a href="/company/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
                    <li><a href="#"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
                    <li><a href="#"><i class="fas fa-question"></i>Heip Center</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i>設定</a></li>
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
                <div class="seblect-container__wrapper__textarea">
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
                                    タスク名：
                                </div>
                            </div>
                            <div class="main-container__wrapper__item-container__inputarea">
                                <div class="main-container__wrapper__item-container__inputarea__field">
                                    <div class="main-container__wrapper__item-container__inputarea__field__control">
                                        <input class="input form-control{{ $errors->has('task_name') ? ' is-invalid' : '' }}" name='task_name' type="text" placeholder="タスク名">
                                        @if ($errors->has('task_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style='color: #e3342f'>{{ $errors->first('task_name') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 項目：タスク内容 -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    タスク内容：
                                </div>
                            </div>
                            <div class="main-container__wrapper__item-container__textarea">
                                <!-- <textarea class="textarea" placeholder="タスク内容" v-model="taskInfo.taskContent"></textarea> -->
                                <textarea class="textarea form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='task_content' placeholder="タスク内容"></textarea>
                                @if ($errors->has('task_content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong style='color: #e3342f'>{{ $errors->first('task_content') }}</strong>
                                        </span>
                                @endif
                                
                            </div>
                        </div>
                        <!-- 項目：締め切り -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    締め切り：
                                </div>
                            </div>
                            <div class="main-container__wrapper__item-container__calendar-content">
                                <!-- 開始日カレンダー -->
                                <div class="main-container__wrapper__item-container__calendar-content__content">                               
                                    <div>
                                        <div class="item-name-wrapper__item-name main-container__wrapper__item-container__calendar-content__content__item-name-wrapper__item-name">
                                            開始日
                                        </div>
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
                                    <div>
                                        <div class="item-name-wrapper__item-name main-container__wrapper__item-container__calendar-content__content__item-name-wrapper__item-name">
                                            終了日
                                        </div>
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
                        <!-- 項目：資料 -->
                        <div class="main-container__wrapper__item-container">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    資料：
                                </div>
                            </div>
                            <div class="item-name-wrapper main-container__wrapper__item-container__uploadnamearea">
                                <div class="item-name-wrapper__item-name main-container__wrapper__item-container__uploadarea__uploadname">
                                    Upload
                                </div>
                            </div>
                            <div class="file is-boxed item-name-wrapper main-container__wrapper__item-container__filearea">
                                <label class="file-label main-container__wrapper__item-container__filearea__label">
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
                                </label>
                            </div>
                        </div>
                    </div>      
                </div>
                <!-- side -->
                <div class="side-container">
                    <div class="side-container__wrapper">
                        <!-- テンプレート -->
                        <div class="side-container__wrapper__template-container">
                            <div class="side-container__wrapper__template-container__wrapper">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                        テンプレート：
                                    </div>
                                </div>
                                <div class="select-container__wrapper__select-area control">
                                    <div class="select-container__wrapper__select-area__field field">
                                        <div class="select-container__wrapper__select-area__field__control control">
                                            <div class="select-container__wrapper__select-area__field__control__select select is-info">
                                            <!-- <select v-model="taskInfo.template">  -->
                                            <select> 
                                                <option></option>
                                                @foreach($tasks as $task)
                                                    <option>{{ $task->task_name }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 担当者・パートナー -->
                        <div class="side-container__wrapper__tanpa-container">
                            <div class="side-container__wrapper__tanpa-container__wrapper">
                                <!-- 担当者 -->
                                <div class="side-container__wrapper__tanpa-content__wrapper__incharge-container">
                                    <div class="side-container__wrapper__tanpa-content__wrapper__incharge-container__wrapper">
                                        <div class="item-name-wrapper">
                                            <div class="item-name-wrapper__item-name">
                                                担当者：
                                            </div>
                                        </div>
                                        <div class="select-container__wrapper__select-area control staff">
                                            <div class="select-container__wrapper__select-area__field field">
                                                <div class="select-container__wrapper__select-area__field__control control">
                                                    <div class="select-container__wrapper__select-area__field__control__select select is-info">
                                                    <!-- <select v-model="taskInfo.staff"> -->
                                                    
                                                    <select name='company_user_id' class="form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
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
                                </div>
                                <!-- パートナー -->
                                <div class="side-container__wrapper__tanpa-content__partner-container">
                                    <div class="side-container__wrapper__tanpa-content__wrapper__partner-container__wrapper">
                                        <div class="item-name-wrapper">
                                            <div class="item-name-wrapper__item-name">
                                                パートナー：
                                            </div>
                                        </div>
                                        <div class="select-container__wrapper__select-area control">
                                            <div class="select-container__wrapper__select-area__field field">
                                                <div class="select-container__wrapper__select-area__field__control control">
                                                    <div class="select-container__wrapper__select-area__field__control__select select is-info">
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
                                </div>
                            </div>
                        </div>
                        <!-- 契約内容 -->
                        <div class="side-container__wrapper__agreement-container">
                            <div class="side-container__wrapper__agreement-container__wrapper">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                        パートナー契約内容：
                                    </div>
                                </div>
                                <div class="side-container__wrapper__agreement-container__wrapper__fee-container">
                                    <div  class="side-container__wrapper__agreement-container__wrapper__fee-container__name">
                                        報酬形式
                                    </div>
                                    <div class="side-container__wrapper__agreement-container__wrapper__fee-container__control">
                                        <label class="radio">
                                            <!-- <input type="radio" value="固定" name="foobar" v-model="taskInfo.fee"> -->
                                            <input type="radio" value="固定" name="fee_format" checked>
                                            固定
                                        </label>
                                        <label class="radio">
                                            <input type="radio" value="時間" name="fee_format">
                                            <!-- <input type="radio" value="時間" name="foobar" checked v-model="taskInfo.fee"> -->
                                            時間
                                        </label>
                                        <label class="radio">
                                            <!-- <input type="radio" value="日" name="foobar" checked v-model="taskInfo.fee"> -->
                                            <input type="radio" value="日" name="fee_format">
                                            日
                                        </label>
                                    </div>
                                </div>
                                <div class="side-container__wrapper__agreement-container__wrapper__order-container">
                                    <div class="side-container__wrapper__agreement-container__wrapper__order-container__name">
                                        発注額
                                    </div>
                                    <div class="side-container__wrapper__agreement-container__wrapper__order-container__content">
                                        <!-- 発注単価 -->
                                        <div class="side-container__wrapper__agreement-container__wrapper__order-container__name">
                                            発注単価(税抜)
                                        </div>
                                        <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__inputitem">
                                            <input class="input form-control{{ $errors->has('task_content') ? ' is-invalid' : '' }}" name='price' type="text" placeholder="Text input">
                                            @if ($errors->has('price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style='color: #e3342f'>{{ $errors->first('price') }}</strong>
                                                </span>
                                            @endif
                                            <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__inputitem__class">
                                                円
                                            </div>
                                        </div>
                                        <!-- 作業件数 -->
                                        <div class="side-container__wrapper__agreement-container__wrapper__order-container__name">
                                            作業件数
                                        </div>
                                        <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__inputitem">
                                            <!-- <input class="input" type="text" placeholder="Text input" v-model="taskInfo.orderNumber" > -->
                                            <input class="input" type="text" placeholder="Text input">
                                            <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__inputitem__class">
                                                件
                                            </div>
                                        </div>
                                        <!-- 水平線 -->
                                        <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__hr"></div>
                                        <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__item-wrapper">
                                            <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__item-wrapper__item">
                                                <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__item-wrapper__item__item-name">
                                                    発注額(税抜)
                                                </div>
                                                <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__item-wrapper__item__item-amount">
                                                    円
                                                </div>
                                            </div>
                                            <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__item-wrapper__item">
                                                <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__item-wrapper__item__item-name">
                                                    発注額(税込)
                                                </div>
                                                <div class="side-container__wrapper__agreement-container__wrapper__order-container__content__item-wrapper__item__item-amount">
                                                    円
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                                <div class="side-container__wrapper__agreement-container__wrapper__fee-container">
                                    <div  class="side-container__wrapper__agreement-container__wrapper__fee-container__name">
                                        備考
                                    </div>
                                    <div class="side-container__wrapper__agreement-container__wrapper__fee-container__name">
                                        発注書の備考欄に記載されます。
                                    </div>
                                    <div class="side-container__wrapper__agreement-container__wrapper__fee-container__control">
                                        <textarea class="textarea side-container__wrapper__agreement-container__wrapper__fee-container__control__textarea" placeholder="備考"></textarea>
                                    </div>
                                </div>
                            <div class="button-wrapper">
                                <button type='submit' class="button-wrapper__btn button">依頼</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
