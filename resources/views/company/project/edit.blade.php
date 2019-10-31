@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/project/edit.css') }}">
@endsection

@section('content')
<div class="main__contadiner">
    <form class="main__container__wrapper" action="{{ route('company.project.update', ['projct_id' => $project->id]) }}" method='POST' enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- ページタイトル エリア -->
        <div class="top">
            <div class="page-title-container">
                <div class="page-title-container__page-title">{{ $project->name }} 詳細</div>
            </div>
            <div class="button-wrapper">
                <button type="button" onclick="submit()" class="button-wrapper__btn button">保存</button>
            </div>
        </div>

        <div class="main-container">
            <div class="main-container__wrapper">
                <div class="item-container">
                    <div class="item-name-wrapper">
                        <div class="item-name">タスク名</div>
                    </div>
                    <div class="inputarea">
                        <div class="input-control">
                            <input 
                                class="project-create__container__list__item__input input form-control{{ $errors->has('project_name') ? ' is-invalid' : '' }}"
                                name="project_name"
                                type="text"
                                value="{{ old('project_name', $project->name ) }}"
                            >
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
                        <div class="item-name">プロジェクト詳細</div>
                    </div>
                    <div class="textarea-wrp">
                        <textarea class="textarea form-control{{ $errors->has('detail') ? ' is-invalid' : '' }}" name="project_detail">{{ old('project_detail', $project->detail) }}</textarea>
                        @if ($errors->has('project_detail'))
                            <div class="invalid-feedback error-msg" role="alert">
                                <strong>{{ $errors->first('project_detail') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="item-container">
                    <div class="item-name-wrapper">
                        <div class="item-name">担当者</div>
                    </div>
                    <div class="select-error-wrp">
                        <div class="select-area control staff">
                            <div class="select-wrp select is-info">
                                <select name='company_user_id' class="plusicon form-control{{ $errors->has('company_user_id') ? ' is-invalid' : '' }}">
                                    <option disabled selected></option>
                                    @foreach( $project->projectCompanies as $projectCompany )
                                        @foreach( $company_users as $company_user )
                                        <option value="{{ $company_user->id }}" {{ (old('company_user_id', $projectCompany->companyUser->id) === $company_user->id)? 'selected' : '' }}>{{ $company_user->name }}</option>
                                        @endforeach
                                    @endforeach
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
                        <div class="item-name">プロジェクト期間</div>
                    </div>
                    <div class="calendar-wrp">
                        <!-- 開始日カレンダー -->
                        <div class="calendar-item">                               
                            
                            <div class="calendar-name start">
                                開始日<i class="fas fa-calendar-alt"></i>
                            </div>
                            <input
                                type="date"
                                name="started_at"
                                class="input form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }}"
                                value="{{ old('started_at', explode(' ', $project->started_at)[0]) }}"
                            >
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
                            <input
                                type="date"
                                class="input form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                name='ended_at'
                                value="{{ old('ended_at', explode(' ', $project->ended_at)[0]) }}"
                            >
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
                        <div class="item-name">予算</div>
                    </div>
                    <div class="inputarea">
                        <div class="input-control budget">
                            <input class="input form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name='budget' type="text" value="{{ old('budget', $project->budget) }}">
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
    </form>
</div>
@endsection
