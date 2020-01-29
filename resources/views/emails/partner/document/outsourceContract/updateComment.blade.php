
<html>
    <head>
        <title>契約書の提出が差し戻しされました</title>
    </head>
    <body>
        <div>
            <p>
                {{ $companyName }}<br>
                {{ $companyUserName }} 様<br>
                フリーランス管理システムimproです。
            </p>
            <p>
                パートナーの {{ $partnerName }} 様より、提出した契約内容に関しまして差し戻しがございました。<br>
                下記のURLからimproにログインして、内容を修正して再度提出してください。
            </p>
            <p>
                <a href="{{ $url }}">{{ $url }}</a><br>
            </p>
            <p style="white-space: pre-line;">
                （パートナーからのメッセージ)
                xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

                {{ $comment }}

                xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            </p>
            <p>
                お忙しいとは存じますが、確認をどうぞよろしくお願いします。<br>
                ※このメールに心当たりの無い方は、恐れ入りますがこのメールを破棄して下さい。
            </p>
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