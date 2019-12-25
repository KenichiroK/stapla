{{-- NOTE: parterと担当者では見せる内容を変更するかもしれないので別ファイルにした --}}

@component('mail::message')
<h1>{{ $companyUserName }}さん</h1>

<p>
    {{ $invitationUser->name }} さんが担当者として登録を完了しました。
    <br>
    <br>
    下記よりご確認ください
    <br>
</p>

<a href="{{ $url }}">{{ $url }}</a>
@endcomponent
