@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/create.css') }}">
@endsection

@section('content')
<div class="main__contadiner">
    @isset($project)
        <form class="main__container__wrapper" action="{{ route('company.project.update', ['projct_id' => $project->id]) }}" method='POST' enctype="multipart/form-data">
        
        @method('PATCH')
    @else
        <form class="main__container__wrapper" action="{{ route('company.project.store') }}" method='POST' enctype="multipart/form-data">
    @endisset
    @csrf
    @if(count($errors) > 0)
            <div class="error-container">
                <p>入力に問題があります。再入力して下さい。</p>
            </div>
        @endif

        <!-- ページタイトル エリア -->
        <div class="top">
            <div class="page-title-container">
                @isset($project)
                    <div class="page-title-container__page-title">{{ $project->name }} 詳細</div>
                @else
                    <div class="page-title-container__page-title">プロジェクト作成</div>
                @endisset
                
            </div>
            @isset($project)
            <div class="button-wrapper">
                <button type="button" onclick="submit()" class="button-wrapper__btn button">保存</button>
            </div>
            @endisset
            
        </div>

        <div class="main-container">
            <div class="main-container__wrapper">
                <div class="item-container">
                    <div class="item-name-wrapper">
                        <div class="item-name">
                            プロジェクト名
                            <span class="required-label">( 必須 )</span>
                        </div>
                    </div>
                    <div class="inputarea">
                        <div class="input-control">
                            @isset($project)
                                <input 
                                    class="project-create__container__list__item__input input form-control{{ $errors->has('project_name') ? ' is-invalid' : '' }}"
                                    name="project_name"
                                    type="text"
                                    value="{{ old('project_name', $project->name ) }}"
                                >
                            @else
                                <input class="project-create__container__list__item__input input form-control{{ $errors->has('project_name') ? ' is-invalid' : '' }}" name="project_name"  type="text" value="{{ old('project_name')}}">
                            @endisset
                            @if ($errors->has('project_name'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('project_name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="item-container">
                    <div class="item-name-wrapper contentsname">
                        <div class="item-name">
                            プロジェクト詳細
                            <span class="required-label">( 必須 )</span>
                        </div>
                    </div>
                    <div class="textarea-wrp">
                        @isset($project)
                            <textarea class="textarea form-control{{ $errors->has('detail') ? ' is-invalid' : '' }}" name="project_detail">{{ old('project_detail', $project->detail) }}</textarea>
                        @else
                            <textarea class="textarea form-control{{ $errors->has('detail') ? ' is-invalid' : '' }}" name="project_detail">{{ old('project_detail') }}</textarea>
                        @endisset
                        @if ($errors->has('project_detail'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('project_detail') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="item-container">
                    <div class="item-name-wrapper">
                        <div class="item-name">
                            担当者
                            <span class="required-label">( 必須 )</span>
                        </div>
                    </div>
                    <div class="select-error-wrp">
                        <div class="select-area control staff">
                            <div class="select-wrp select is-info">
                                <select name='company_user_id' class="plusicon form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
                                    <option disabled selected></option>
                                    @isset($project)
                                        @foreach( $project->projectCompanies as $projectCompany )
                                            @foreach( $company_users as $company_user )
                                            <option value="{{ $company_user->id }}" {{ (old('company_user_id', $projectCompany->companyUser->id) === $company_user->id)? 'selected' : '' }}>{{ $company_user->name }}</option>
                                            @endforeach
                                        @endforeach
                                    @else
                                    @foreach( $company_users as $company_user )
                                    <option value="{{ $company_user->id }}" {{ (old('company_user_id') === $company_user->id)? 'selected' : '' }}>{{ $company_user->name }}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div> 
                        @if ($errors->has('company_user_id'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('company_user_id') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="item-container">
                    <div class="item-name-wrapper period">
                        <div class="item-name">
                            プロジェクト期間
                            <span class="required-label">( 必須 )</span>
                        </div>
                    </div>
                    <div class="calendar-wrp">
                        <!-- 開始日カレンダー -->
                        <div class="calendar-item">                               
                            
                            <div class="calendar-name start">
                                開始日<i class="fas fa-calendar-alt"></i>
                            </div>
                            @isset($project)
                                <input
                                    type="date"
                                    name="started_at"
                                    class="input form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }}"
                                    value="{{ old('started_at', explode(' ', $project->started_at)[0]) }}"
                                >
                            @else
                                <input
                                    type="date"
                                    class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                    name="started_at"
                                    value="{{ old('started_at', date('Y-m-d')) }}"
                                >
                            @endisset
                            @if($errors->has('started_at'))
                                <div class="error-mes-wrp">
                                    <strong style='color: #e3342f;'>{{ $errors->first('started_at') }}</strong>
                                </div>
                            @endif
                            
                        </div>
                        <!-- 終了日カレンダー -->
                        <div class="calendar-item end">                               
                            
                            <div class="calendar-name">
                                終了日<i class="fas fa-calendar-alt"></i>
                            </div>
                            @isset($project)
                                <input
                                    type="date"
                                    class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                    name='ended_at'
                                    value="{{ old('ended_at', explode(' ', $project->ended_at)[0]) }}"
                                >
                            @else
                                <input
                                    type="date"
                                    class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                    name="ended_at"
                                    value="{{ old('ended_at', date('Y-m-d')) }}"
                                >
                            @endisset
                            
                            @if ($errors->has('ended_at'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('ended_at') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="item-container">
                    <div class="item-name-wrapper">
                        <div class="item-name">
                            予算
                            <span class="required-label">( 必須 )</span>
                        </div>
                    </div>
                    <div class="inputarea">
                        <div class="input-control budget">
                            @isset($project)
                                <input class="input form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name='budget' type="text" value="{{ old('budget', $project->budget) }}">
                            @else
                                <input class="input form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name='budget' type="text" value="{{ old('budget') }}">
                            @endisset
                            @if ($errors->has('budget'))
                                <div class="invalid-feedback error-msg" role="alert">
                                    <strong>{{ $errors->first('budget') }}</strong>
                                </div>
                            @endif
                
                            <div class="input-yen">
                                円
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        @isset($project)
        @else
            <div class="btn01-container">
                <button type="button" onclick="submit();">作成</button>
            </div>
        @endisset
             
    </form>
</div>
@endsection
