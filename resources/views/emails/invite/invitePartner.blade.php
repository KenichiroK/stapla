
<html>
    <head>
        <title>improにようこそ</title>
    </head>
    <body>
        test 様よりimproに招待されました
        以下のリンクよりimproへのご登録をお願いいたします。
        企業ID：{{ $company_id }}
        Email：{{ $email }}
        <!-- <a href="{{ url('/partner/register') }}">improへの登録はこちらから</a> -->
        <a href="http://localhost:8888/partner/register/{{ $company_id }}/{{ $email }}">improへの登録はこちらから</a>
    </body>
</html>