
<html>
    <head>
        <title>improにようこそ</title>
    </head>
    <body>
        <div>
        
            <p>
                こんにちは。<br/>
                impro 運営事務局でございます。
            </p>
        
            <p>下記URLより本登録のお手続きをお願いいたします。</p>
            <br/>

            <p>
                URL：<a href="{{ $url }}">{{ $url }}</a><br/>
                有効期限：{{ $limit->format('Y年m月d日 H時i分') }}
            </p>
            <br/>

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