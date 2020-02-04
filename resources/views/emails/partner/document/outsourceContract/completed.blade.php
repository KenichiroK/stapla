
<html>
    <head>
        <title>パートナーより契約書が承認されました</title>
    </head>
    <body>
        <div>
            <p>
                {{ $companyName }}<br>
                {{ $companyUserName }} 様<br>
                フリーランス管理システムimproです。
            </p>
            <p>
                パートナーの {{ $partnerName }} 様より、契約内容が承認されました。<br>
                下記よりフリーランス管理システムimproにログインし、ご確認をお願い致します。<br>
            </p>
            <p>
                <a href="{{ $url }}">{{ $url }}</a><br>
                よろしくお願い致します。
            </p>
            <p>※このメールに心当たりの無い方は、恐れ入りますがこのメールを破棄して下さい。</p>
            <p>
                フリーランス管理システムimpro<br/>
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