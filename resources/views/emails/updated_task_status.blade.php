@component('mail::message')
<h1>{{ $receiver }}さん</h1>

<p>
    [ {{ $task }} ] の確認依頼が来ています。
    以下のリンクから内容を確認の上、対応をお願いします。
</p>

<a href="{{ $url }}">{{ $url }}</a>
@endcomponent
