@component('mail::message')
<h1>{{ $receiver }}さん</h1>

<p>
    {{ $task }} に {{ Config::get('consts.taskRole.TASK_ROLE')[$role] }} としてアサインされました。
    下記よりタスクの詳細をご確認いただけます。
</p>

<a href="{{ $url }}">{{ $url }}</a>
@endcomponent
