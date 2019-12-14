@component('mail::message')
<h1>{{ $companyUserName }}さん</h1>

<p>
    {{ $partner->name }} さんがパートナーとして登録を完了しました。
    <br>
    <br>
    下記よりご確認ください
    <br>
</p>

<a href="{{ $url }}">{{ $url }}</a>
@endcomponent
