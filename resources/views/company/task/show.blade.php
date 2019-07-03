@extends('company.index')

@section('assets')
<link rel="stylesheet" href="{{ mix('css/company/common/index.css') }}">
<link rel="stylesheet" href="{{ mix('css/company/task/show.css') }}">
@endsection

@section('sidebar')

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
                <li><a href="/project"><i class="fas fa-envelope"></i>プロジェクト</a></li>
                <li><a href="/task"><i class="fas fa-tasks"></i>タスク</a></li>
                <li><a href="/document"><i class="fas fa-newspaper"></i>書類</a></li>
                <li><a href="/partner"><i class="fas fa-user-circle"></i>パートナー</a></li>
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
    <div class="main__container__wrapper">
        <div class="header">
            <div class="header__wrapper">
                <div class="header__wrapper__main">
                    <div class="page-title-container">
                        <div class="page-title-container__page-title">{{ $task->name }}</div>
                    </div>
                    <div class="header__wrapper__main__project-name">【{{ $task->project->name }}】</div>
                </div>
                <div class="header__wrapper__edited-date">タスク作成日：{{ explode(' ', $task->created_at)[0] }}</div>
            </div>
        </div>
        <div class="middle">
            <div class="middle__main">
                <div class="middle__main__wrapper">
                    <div class="middle__main__wrapper__table-container">
                        <table class="middle__main__wrapper__table-container__table">
                            <tr class="middle__main__wrapper__table-container__table__table-row">
                                <th class="middle__main__wrapper__table-container__table__table-row__table-header">ステータス</th>
                                <th class="middle__main__wrapper__table-container__table__table-row__table-header">締め切り</th>
                                <th class="middle__main__wrapper__table-container__table__table-row__table-header">検収日</th>
                                <th class="middle__main__wrapper__table-container__table__table-row__table-header">提出日</th>
                                <th class="middle__main__wrapper__table-container__table__table-row__table-header">納品形式</th>
                            </tr>
                            <tr class="middle__main__table-container__table__table-row">
                                <td class="middle__main__wrapper__table-container__table__table-row__table-data">
                                    <div id="state" class="middle__main__wrapper__table-container__table__table-row__table-data__status-icon">
                                        @if(($task->status) === 0)
                                            下書き
                                        @elseif(($task->status) === 1)
                                            提案中
                                        @elseif(($task->status) === 2)
                                            依頼前
                                        @elseif(($task->status) === 3)
                                            依頼中
                                        @elseif(($task->status) === 4)
                                            開始前
                                        @elseif(($task->status) === 5)
                                            作業中
                                        @elseif(($task->status) === 6)
                                            提出前
                                        @elseif(($task->status) === 7)
                                            修正中
                                        @elseif(($task->status) === 8)
                                            完了
                                        @elseif(($task->status) === 9)
                                            キャンセル
                                        @endif
                                    </div>
                                </td>
                                <td class="middle__main__wrapper__table-container__table__table-row__table-data">{{ explode(' ', $task->ended_at)[0] }}</td>
                                <td class="middle__main__wrapper__table-container__table__table-row__table-data">{{ explode(' ', $task->inspection_date)[0] }}</td>
                                <td class="middle__main__wrapper__table-container__table__table-row__table-data">{{ explode(' ', $task->inspection_date)[0] }}</td>
                                <td class="middle__main__wrapper__table-container__table__table-row__table-data">{{ $task->delivery_format }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="middle__main__wrapper__task-content">
                        <div class="middle__main__wrapper__task-content__wrapper">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    タスク内容：
                                </div>
                            </div>
                        </div>
                        <div class="middle__main__wrapper__task-content__textarea-wrapper">
                            <textarea class="textarea" placeholder="Placeholder"></textarea>
                        </div>
                        <div class="middle__main__wrapper__task-content__detail-container">
                            <div class="middle__main__wrapper__task-content__detail-container__item-name-wrapper">
                                <div class="middle__main__wrapper__task-content__detail-container__item-name-wrappre__item-name">
                                    アクティビティログ
                                </div>
                            </div>
                            <div class="middle__main__wrapper__task-content__detail-container__item">
                                <div class="middle__main__wrapper__task-content__detail-container__item__icon"><img src="https://image.freepik.com/free-icon/no-translate-detected_318-37825.jpg" alt=""></div>
                                <div class="middle__main__wrapper__task-content__detail-container__item__name">
                                    <div class="">{{ explode(' ', $task->updated_at)[0] }}</div>
                                    <div class="">永瀬 達也</div>
                                </div>
                                <div class="middle__main__wrapper__task-content__detail-container__item__comment">担当者へ依頼しました。</div>
                            </div>
                        </div>
                    </div>
                    <div class="middle__main__wrapper__task-comment">
                        <div class="middle__main__wrapper__task-comment__wrapper">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    タスクに関するコメント：
                                </div>
                            </div>
                            <div class="middle__main__wrapper__task-content__textarea-wrapper">
                                <textarea class="textarea" placeholder="Placeholder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="middle__main__wrapper__document-container">
                        <div class="middle__main__wrapper__document-container__wrapper">
                            <div class="item-name-wrapper">
                                <div class="item-name-wrapper__item-name">
                                    資料：
                                </div>
                            </div>
                            <div class="middle__main__wrapper__document-container__wrapper__update-container">
                                <div class="file has-name is-boxed">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="resume">
                                        <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Choose a file…
                                        </span>
                                        </span>
                                        <span class="file-name">
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="middle__side">
                <div class="middle__side__wrapper">
                    <div class="middle__side__wrapper__1">
                        <div class="middle__side__wrapper__1__input-container">
                            <div class="middle__side__wrapper__1__input-container__wrapper">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                        担当者：
                                    </div>
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__select select">
                                    <select>
                                        <option></option>
                                        @foreach($companyUsers as $companyUser)
                                            <option value="{{ $companyUser->id }}">{{ $companyUser->name }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__btn-wrapper">
                                    <div class="middle__side__wrapper__1__input-container__wrapper__btn-wrapper__btn">追加</div>
                                </div>
                            </div>
                        </div >
                        <div class="middle__side__wrapper__1__input-container">
                            <div class="middle__side__wrapper__1__input-container__wrapper">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                    パートナー：
                                    </div>
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__select select">
                                    <select>
                                        <option></option>
                                        @foreach($partners as $partner)
                                            <option value="{{ $partner->id }}">
                                                {{ $partner->name }}
                                            </option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__btn-wrapper">
                                    <div class="middle__side__wrapper__1__input-container__wrapper__btn-wrapper__btn">追加</div>
                                </div>
                            </div>
                        </div >

                        <div class="middle__side__wrapper__1__input-container">
                            <div class="middle__side__wrapper__1__input-container__wrapper">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                    パートナー契約内容：
                                    </div>
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__detail-container">
                                    <div class="middle__side__wrapper__1__input-container__wrapper__detail-container__item-wrapper top">
                                        <div class="middle__side__wrapper__1__input-container__wrapper__detail-container__item-wrapper__item-name">報酬形式</div>
                                        <div class="middle__side__wrapper__1__input-container__wrapper__detail-container__item-wrapper__item-content">時間</div>
                                    </div>  
                                    <div class="middle__side__wrapper__1__input-container__wrapper__detail-container__item-wrapper">
                                        <div class="middle__side__wrapper__1__input-container__wrapper__detail-container__item-wrapper__item-name">発注額(税込)</div>
                                        <div class="middle__side__wrapper__1__input-container__wrapper__detail-container__item-wrapper__item-content">¥100,000</div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="middle__side__wrapper__1">
                        <div class="middle__side__wrapper__1__input-container">
                            <div class="middle__side__wrapper__1__input-container__wrapper">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                        上長に承認を取る：
                                    </div>
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__select select">
                                    <select>
                                        <option></option>
                                        @foreach($companyUsers as $companyUser)
                                            <option value="{{ $companyUser->id }}">{{ $companyUser->name }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__btn-wrapper">
                                    <div class="middle__side__wrapper__1__input-container__wrapper__btn-wrapper__btn">承認</div>
                                </div>
                            </div>
                        </div >
                        <div class="middle__side__wrapper__1__input-container">
                            <div class="middle__side__wrapper__1__input-container__wrapper">
                                <div class="item-name-wrapper">
                                    <div class="item-name-wrapper__item-name">
                                    パートナーに依頼を取る：
                                    </div>
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__select select">
                                    <select>
                                        <option></option>
                                        @foreach($partners as $partner)
                                            <option value="{{ $partner->id }}">
                                                {{ $partner->name }}
                                            </option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="middle__side__wrapper__1__input-container__wrapper__btn-wrapper">
                                    <div class="middle__side__wrapper__1__input-container__wrapper__btn-wrapper__btn">承認</div>
                                </div>
                            </div>
                        </div >
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="bottom__wrapper">
                <div class="item-name-wrapper">
                    <div class="item-name-wrapper__item-name">
                        タスク内容：
                    </div>
                </div>
                <div class="bottom__wrapper__table-container">
                    <table class="bottom__wrapper__table-wrapper__table">
                        <tr class="bottom__wrapper__table-wrapper__table__headerrow">
                            <th class="bottom__wrapper__table-wrapper__table__headerrow__tableheader">プロジェクト<i class="task-container__table__headerrow__tableheader__arrow fas fa-angle-down"></i></th>
                            <th class="bottom__wrapper__table-wrapper__table__headerrow__tableheader">担当者</th>
                            <th class="bottom__wrapper__table-wrapper__table__headerrow__tableheader">パートナー</th>
                            <th class="bottom__wrapper__table-wrapper__table__headerrow__tableheader">タスク</th>
                            <th class="bottom__wrapper__table-wrapper__table__headerrow__tableheader">期限</th>
                            <th class="bottom__wrapper__table-wrapper__table__headerrow__tableheader">予算</th>
                            <th class="bottom__wrapper__table-wrapper__table__headerrow__tableheader">請求額</th>
                        </tr>
                        <tr class="bottom__wrapper__table-wrapper__table__datarow">
                            <td class="bottom__wrapper__table-wrapper__table__datarow__tabledata">{{ $task->project->name }}</td>
                            <td class="bottom__wrapper__table-wrapper__table__datarow__tabledata">
                            @foreach($task->taskCompanies as $taskCompany)
                                {{ $taskCompany->companyUser->name }}
                            @endforeach
                            <td class="bottom__wrapper__table-wrapper__table__datarow__tabledata">
                            @foreach($task->taskPartners as $taskPartner)
                                {{ $taskPartner->partner->name }}
                            @endforeach
                            </td>
                            <td class="bottom__wrapper__table-wrapper__table__datarow__tabledata">{{ $task->project->tasks->count() }}件</td>
                            <td class="bottom__wrapper__table-wrapper__table__datarow__tabledata">{{ explode(' ', $task->ended_at)[0] }}</td>
                            <td class="bottom__wrapper__table-wrapper__table__datarow__tabledata">¥{{ $task->budget }}</td>
                            <td class="bottom__wrapper__table-wrapper__table__datarow__tabledata">¥{{ $task->price }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
