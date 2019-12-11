@component('mail::message')
<p>
    {{ $partner->name }} さんがパートナーとして登録を完了しました。
    <br>
    下記よりご確認ください
    <br>
</p>

<a href="{{ $url }}">{{ $url }}</a>
@endcomponent
