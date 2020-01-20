@component('mail::message')
<h1>{{ $receiver }}さん</h1>

<p>
    {{ $projectName }}_{{ $task }}_に {{ Config::get('consts.taskRole.TASK_ROLE')[$role] }} としてアサインされました。
    <br>
    <br>
    下記よりご確認ください。
</p>

<a href="{{ $url }}">{{ $url }}</a>
@endcomponent
