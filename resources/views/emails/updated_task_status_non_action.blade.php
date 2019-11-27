@component('mail::message')
<h1>{{ $receiver }}さん</h1>

<p>[ {{ $task }} ] のステータスが変更されました。</p>
<p> ステータス :</p>
<p>  　{{ config('const.TASK_STATUS_LIST')[$prev_status] }} → {{ config('const.TASK_STATUS_LIST')[$next_status] }}</p>
<p> タスク詳細 :</p>
<a href="{{ $url }}">{{ $url }}</a>
<p> アクションが必要な人 :</p>
<p>  　{{ $next_action_user }}</p>

@endcomponent
