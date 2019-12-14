
<html>
    <head>
        <title>impro メールアドレス変更</title>
    </head>
    <body>
        <div>
        
            <p>
                こんにちは。<br/>
                impro 運営事務局でございます。
            </p>
        
            <p>
                メールアドレスの変更を受け付けました。<br/>
                以下のURLよりログインしていただくと変更が完了いたします。<br/>
                有効期限：{{ $limit->format('Y年m月d日 H時i分') }}
            </p>
            
            <p>
                URL：<a href="{{ $url }}">{{ $url }}</a><br/>
            </p>
            
            <p>もしこのメールに覚えがない場合は、破棄してください。</p>

            <p>
                ※improは、株式会社HUMOが運営するサービスです<br/>
                ==========================================<br/>
                株式会社HUMO<br/>
                <a href="http://humo.jp">http://humo.jp</a><br/>
                ==========================================<br/>
            </p>
        </div>
   </body>
</html>