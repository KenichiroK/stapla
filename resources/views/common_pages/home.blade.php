<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impro</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ env('AWS_URL') }}/common/impro_favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
    .wrapper {
        /* margin: 500px; */
        vertical-align: middle;
        display: flex;
        justify-content: center;
    }
    .partner {
        background-color: pink;
        height: 140px;
        line-height:140px;
        text-align: center;
        width: 280px;
        margin: 100px 40px;
    }
    .company {
        background-color: skyblue;
        height: 140px;
        line-height:140px;
        text-align: center;
        width: 280px;
        margin: 100px 40px;
    }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="partner">
            <a href="{{ route('partner.login') }}">パートナーの方用 ログイン画面</a>
        </div>
        <div class="company">
            <a href="{{ route('company.login') }}">企業の方用 ログイン画面</a>
        </div>
    </div>
</body>
</html>