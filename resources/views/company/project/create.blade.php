@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/create.css') }}">
<script>
const set_started_at = () => {
  const started_at_year = document.getElementById('started_at_year').value;
  const started_at_month = document.getElementById('started_at_month').value;
  const started_at_day = document.getElementById('started_at_day').value;
  const started_at = document.getElementById('started_at');
  started_at.value = Number(started_at_year + started_at_month + started_at_day);
  console.log(started_at.value);
}

const set_ended_at = () => {
  const ended_at_year = document.getElementById('ended_at_year').value;
  const ended_at_month = document.getElementById('ended_at_month').value;
  const ended_at_day = document.getElementById('ended_at_day').value;
  const ended_at = document.getElementById('ended_at');
  ended_at.value = Number(ended_at_year + ended_at_month + ended_at_day);
  console.log(ended_at.value);
}
window.onload = () => {
  const started_at_year = document.getElementById('started_at_year').value;
  const started_at_month = document.getElementById('started_at_month').value;
  const started_at_day = document.getElementById('started_at_day').value;
  const started_at = document.getElementById('started_at');
  started_at.value = Number(started_at_year + started_at_month + started_at_day);

  const ended_at_year = document.getElementById('ended_at_year').value;
  const ended_at_month = document.getElementById('ended_at_month').value;
  const ended_at_day = document.getElementById('ended_at_day').value;
  const ended_at = document.getElementById('ended_at');
  ended_at.value = Number(ended_at_year + ended_at_month + ended_at_day);
}


</script>
@endsection

@section('header-profile')
<div class="header-proflie">
    <div class="option">
        <div class="user-name">
            {{ $company_user->name }}
        </div>

        <div class="icon-imgbox">
            <img src="../../../images/icon_small-down.png" alt="">
        </div>
    </div>
    
    <div class="optionBox">
        <div class="balloon">
            <ul>
                <li><a href="">プロフィール設定</a></li>
                <li>
                    <form method="POST" action="{{ route('company.logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>

    <div class="user-imgbox">
        <img src="/{{ str_replace('public/', 'storage/', $company_user->picture) }}" alt="プロフィール画像">
    </div>
</div>
@endsection

@section('sidebar')
<div class="sidebar__container">
    <div class="sidebar__container__wrapper">
        <aside class="menu menu__container">
            <div class="menu__container--label">
                <div class="menu-label">
                    <img src="../../../images/logo.png" alt="logo">
                </div>
            </div>
            <ul class="menu-list menu menu__container__menu-list">
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_home.png" alt="">
                        </div>
                        <div class="textbox">
                            ホーム
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/dashboard">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_dashboard.png" alt="">
                        </div>
                        <div class="textbox">
                            ダッシュボード
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/project" class="isActive">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_inbox.png" alt="">
                        </div>
                        <div class="textbox">
                            プロジェクト
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/task">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_products.png" alt="">
                        </div>
                        <div class="textbox">
                            タスク
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/document">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_invoices.png" alt="">
                        </div>
                        <div class="textbox">
                            書類
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/partner">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_customers.png" alt="">
                        </div>
                        <div class="textbox">
                            パートナー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_calendar.png" alt="">
                        </div>
                        <div class="textbox">
                            カレンダー
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_help-center.png" alt="">
                        </div>
                        <div class="textbox">
                            ヘルプセンター
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/company/setting/general">
                        <div class="icon-imgbox">
                            <img src="../../../images/icon_setting.png" alt="">
                        </div>
                        <div class="textbox">
                            設定
                        </div>
                    </a>
                </li>
            </ul>
            
        </aside>
    </div>
</div>
@endsection

@section('content')
<div class="main__container">
    <form action="{{ url('/company/project') }}" method='POST' enctype="multipart/form-data">
        @csrf
        <div class="main__container__wrapper">
            <div class="top-container">
                <h1 class="top-container__title">プロジェクト作成</h1>
            </div>
            <div class="project-create__container">
                <ul class="project-create__container__list">
                    <li class="project-create__container__list__item margin--none">
                        <div class="project-create__container__list__item__name">プロジェクト名</div>
                        <div class="input-container">
                            <input name="project_name" class="project-create__container__list__item__input" type="text" value="{{ old('project_name')}}">
                            @if($errors->has('project_name'))
                                <div class="error-mes-wrp">
                                    <strong style='color: #e3342f;'>{{ $errors->first('project_name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">プロジェクト詳細</div>
                        <div class="textarea-container">
                            <textarea class="project-create__container__list__item__textarea" name="project_detail" placeholder="">{{ old('project_detail') }}</textarea>
                            @if($errors->has('project_detail'))
                                <div class="error-mes-wrp">
                                    <strong style='color: #e3342f;'>{{ $errors->first('project_detail') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">担当者</div>
                        <div class="select-wrp">
                            <div class="select-container select id-normal select-plusicon is-multiple"> 
                                <select name="company_user_id" class="select-box" id="company-staff-name-list">
                                    <option></option>
                                    @foreach( $company_users as $company_user )
                                    <option value="{{ $company_user->id }}">{{ $company_user->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            @if($errors->has('company_user_id'))
                                <div class="error-mes-wrp">
                                    <strong style='color: #e3342f;'>{{ $errors->first('company_user_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">上長</div>
                        <div class="select-wrp">
                            <div class="select-container select id-normal select-plusicon is-multiple">
                                <select name="superior_id" class="select-box" id="company-staff-name-list">
                                    <option></option>
                                    @foreach( $company_users as $company_user )
                                    <option value="{{ $company_user->id }}">{{ $company_user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('company_user_id'))
                                <div class="error-mes-wrp">
                                    <strong style='color: #e3342f;'>{{ $errors->first('company_user_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">経理</div>
                        <div class="select-wrp">
                            <div class="select-container select id-normal select-plusicon is-multiple">
                                <select name="accounting_id" class="select-box" id="company-staff-name-list">
                                    <option></option>
                                    @foreach( $company_users as $company_user )
                                    <option value="{{ $company_user->id }}">{{ $company_user->name }}</option>
                                    @endforeach
                                </select>  
                            </div>
                            @if($errors->has('company_user_id'))
                                <div class="error-mes-wrp">
                                    <strong style='color: #e3342f;'>{{ $errors->first('company_user_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">パートナー</div>
                        <div class="select-wrp">
                            <div class="select id-normal select-plusicon is-multiple">
                                <select name="partner_id" class="select-box" id="partner-name-list">
                                    <option value=""></option>
                                    @foreach( $partner_users as $partner_user )
                                    <option value="{{ $partner_user->id }}">{{ $partner_user->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>  
                            @if($errors->has('partner_id'))
                                <div class="error-mes-wrp">
                                    <strong style='color: #e3342f;'>{{ $errors->first('partner_id') }}</strong>
                                </div>
                            @endif
                        </div> 
                    </li>

                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">プロジェクト期間</div>
                        <div class="calendars">
                            <div class="calendars__wrapper">
                                <div class="calendars__wrapper__title start">開始日<i class="fas fa-calendar-alt"></i></div>
                                <select class="select-box" id="started_at_year" name="started_at_year" onChange="set_started_at()">
                                @for($y=date('Y'); $y<=date('Y')+20; $y++)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                                </select>
                                年

                                <select class="select-box" id="started_at_month" name="started_at_month" onChange="set_started_at()">
                                @for($m=1; $m<=12; $m++)
                                    @if($m < 10)
                                        @if($m == date('m'))
                                            <option value='0{{ $m }}' selected>{{ $m }}</option>
                                        @else
                                            <option value='0{{ $m }}'>{{ $m }}</option>
                                        @endif
                                    @else
                                        @if($m == date('m'))
                                            <option value='{{ $m }}' selected>{{ $m }}</option>
                                        @else
                                            <option value='{{ $m }}'>{{ $m }}</option>
                                        @endif
                                    @endif
                                @endfor
                                </select>
                                月

                                <select class="select-box" id="started_at_day" name="started_at_day" onChange="set_started_at()">
                                @for($d=1; $d<=31; $d++)
                                    @if($d < 10)
                                        @if($d == date('d'))
                                            <option value='0{{ $d }}' selected>{{ $d }}</option>
                                        @else
                                            <option value='0{{ $d }}'>{{ $d }}</option>
                                        @endif
                                    @else
                                        @if($d == date('d'))
                                            <option value='{{ $d }}' selected>{{ $d }}</option>
                                        @else
                                            <option value='{{ $d }}'>{{ $d }}</option>
                                        @endif
                                    @endif
                                @endfor
                                </select>
                                日
                                <input name="started_at" id="started_at" type="hidden" value="{{ old('started_at')}}">
                                @if($errors->has('started_at'))
                                    <div class="error-mes-wrp">
                                        <strong style='color: #e3342f;'>{{ $errors->first('started_at') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="calendars__wrapper right">
                                <div class="calendars__wrapper__title">終了日<i class="fas fa-calendar-alt"></i></div>
                                <select class="select-box" id="ended_at_year" name="ended_at_year" onChange="set_ended_at()">
                                @for($y=date('Y'); $y<=date('Y')+20; $y++)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                                </select>
                                年

                                <select class="select-box" id="ended_at_month" name="ended_at_month" onChange="set_ended_at()">
                                @for($m=1; $m<=12; $m++)
                                    @if($m < 10)
                                        @if($m == date('m'))
                                            <option value='0{{ $m }}' selected>{{ $m }}</option>
                                        @else
                                            <option value='0{{ $m }}'>{{ $m }}</option>
                                        @endif
                                    @else
                                        @if($m == date('m'))
                                            <option value='{{ $m }}' selected>{{ $m }}</option>
                                        @else
                                            <option value='{{ $m }}'>{{ $m }}</option>
                                        @endif
                                    @endif
                                @endfor
                                </select>
                                月

                                <select class="select-box" id="ended_at_day" name="ended_at_day" onChange="set_ended_at()">
                                @for($d=1; $d<=31; $d++)
                                    @if($d < 10)
                                        @if($d == date('d'))
                                            <option value='0{{ $d }}' selected>{{ $d }}</option>
                                        @else
                                            <option value='0{{ $d }}'>{{ $d }}</option>
                                        @endif
                                    @else
                                        @if($d == date('d')+1)
                                            <option value='{{ $d }}' selected>{{ $d }}</option>
                                        @else
                                            <option value='{{ $d }}'>{{ $d }}</option>
                                        @endif
                                    @endif
                                @endfor
                                </select>
                                日
                                <input id="ended_at" name="ended_at" type="hidden" value="{{ old('ended_at')}}">
                                @if($errors->has('ended_at'))
                                    <div class="error-mes-wrp">
                                        <strong style='color: #e3342f;'>{{ $errors->first('ended_at') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="project-create__container__list__item">
                        <div class="project-create__container__list__item__name">予算</div>
                        <div class="budget-container input-container">
                            <input name="budget" type="text" placeholder="" value="{{ old('budget')}}"><span class="budget-container__yen">円</span>
                            @if($errors->has('budget'))
                                <div class="error-mes-wrp">
                                    <strong style='color: #e3342f;'>{{ $errors->first('budget') }}</strong>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="project-create__container__list__item document">
                        <div class="project-create__container__list__item__name">資料</div>
                        <div class="project-create__container__list__item__wrapper document-item">
                            <div class="project-create__container__list__item__wrapper__description upload">アップロード</div>
                            <!-- <div class="file has-name is-boxed">
                            <label class="file-label">
                                <input id="inputFile" class="file-input" type="file" name="file">
                                <span id="upload-btn" class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
                                </span>
                                <span id="fileName" class="file-name">
                                </span>
                            </label>
                            </div> -->
                            <img src="../../../images/dragdrop.png" alt="">
                        </div>
                    </li>
                </ul>
            </div>
            <div class="button-container">
                <div class="preview-button-wrapper">
                    <button type="submit" class="preview-button-wrapper__btn button">プレビュー</button>
                </div>
                <div class="button-wrapper">
                    <button type="submit" class="button-wrapper__btn button">作成</button>
                </div>
            </div>
        
        </div>
    </form>
</div>
@endsection
