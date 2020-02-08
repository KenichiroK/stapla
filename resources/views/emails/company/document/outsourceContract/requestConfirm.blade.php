
<html>
    <head>
        <title>企業より契約書の確認依頼がありました</title>
    </head>
    <body>
        <div>
            <p>
                フリーランス管理システムimproです。<br>
                {{ $partnerName }} 様
            </p>
            <p>
                {{ $companyName }}より、契約内容の確認依頼が届きました。<br>
                下記よりフリーランス管理システムimproにログインし、契約内容のご確認をお願い致します。
            </p>
            <p>
                <a href="{{ $url }}">{{ $url }}</a>
            </p>
            <p>※このメールに心当たりの無い方は、恐れ入りますがこのメールを破棄して下さい。</p>
            <p>
                フリーランス管理システムimpro<br/>¡
                ------------------------------------------------------<br/>
                impro サポートデスク<br>
                {{-- HACK: メールアドレスは定数化 --}}
                お問い合わせ:impro_salse@humo.jp<br>
                <a href="https://humo.work/impro/">https://humo.work/impro/</a><br/>
                ------------------------------------------------------
            </p>
        </div>
   </body>
</html>
