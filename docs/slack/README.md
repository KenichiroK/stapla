# Slack Web API

間違ってる点があればご指摘ください！

調べてみた結果、特定のチャンネルでしかやりとりしない場合は webhook の方が良さそうで  
複数チャンネルでいろんなことしたい場合は token のが良さそうかと

## 概要

Slack Web API を使用して特定のチャンネルにメッセージを送るには下記二つの方法がある

1. Incomming webhook
2. OAuth Access Token

ハダの主観の比較表

| 機能                             | webhook                               | token                             |
| -------------------------------- | ------------------------------------- | --------------------------------- |
| チャンネル送信                   | webhookURL が発行されたチャンネルのみ | どのチャンネルでも OK             |
| ユーザとして送信                 | Bot としてのみ                        | ○(チャネルに属してるユーザとして) |
| token・webhookurl が漏洩した場合 | 対象チャンネルにメッセージを送られる  | スコープによっては好き勝手される  |
| 設定のしやすさ                   | webhookURL 発行するだけ               | わかりづらいスコープの設定が必要  |
| ユーザへのメンション             | ○                                     | ○                                 |

## 共通項目

最近 webhook の方式も新しくなったらしいので  
webhook 使うにしろ token を使うにしろ
**Slack アプリの作成**はしといた方が良さそうです

**フリープランの場合、アプリは 10 個までインストール可能**

[新方式の参考記事](https://qiita.com/kshibata101/items/0e13c420080a993c5d16#%E6%96%B0%E6%96%B9%E5%BC%8F)

メンションする場合もメッセージ内でメンション用の[記法](https://qiita.com/ryo-yamaoka/items/7677ee4486cf395ce9bc#%E8%A8%98%E6%B3%95)を使用すればよし

| 記法       | メンション |
| ---------- | ---------- |
| <!here>    | @here      |
| <!channel> | @channel   |
| <@user_id> | @yota      |

メッセージの表現方法は attachments が非推奨で blocks が[推奨されてる](https://api.slack.com/messaging/attachments-to-blocks)ので blocks で書いた方良さそうで、Laravel の Notification ヘルパでは blocks の対応はされてないので今回は自前で実装しました

ユーザへ個別にメンションを飛ばす場合はユーザー ID が必要なのでユーザー ID を登録してもらう必要があります。

<p align="center"><img src="./image/user_id.png" style="width: 500px;"></p>

## webhook

特定のチャネルに対してメッセージを送信することができる URL を発行してくれる

<p align="center"><img src="./image/webhook.png" style="width: 500px;"></p>

### webhook で送信を行うためにユーザがやること

1. slack app の作成
2. ワークスペースに app をインストール
3. incoming webhooks のアクティベート
4. 通知先用(チャンネル or ユーザ)の webhookURL を追加する
5. 発行した webhook url を impro で登録
6. メンションを飛ばしたいユーザの ID を取得し impro で登録

### 実装例

今回は HTTP リクエスト生成するのに Guzzle 使ってます

```php
$client = new \GuzzleHttp\Client();

$response = $client->request('POST', '{発行されたwebhookURL}',
    [
        'json' => [
            'text' => 'text',
            'blocks' => [
                [
                    'type' => 'section',
                    'text' => [
                        "type" => "mrkdwn",
                        "text" => "<@ユーザID>テストテスト"
                    ]
                ],
                [
                    'type' => 'context',
                    'elements' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => 'コンテキスト'
                        ]
                    ]
                ],
            ],
        ]
    ]
);
```

## OAuth Access Token

API でできる権限(スコープ)を設定し、そのトークンを発行。  
発行されたトークンを使用し Slack の Web API エンドポイントへ直接リクエストを送ることでメッセージを送信する

ドキュメントしっかりとは読んでないので間違いあるかもしれませんが  
API でできる権限とは

-   ユーザー情報の取得・追加・削除
-   メッセージの取得・送信・削除
-   チャンネルの取得・登録・削除

など強い権限になればなるほどなんでも API 経由でできるかと
おそらく token を使う場合は token をうちの DB に保存することになるので  
漏洩のことも考えるとあんまり権限つよいトークンは保存したくない・・・

<p align="center"><img src="./image/token.png" style="width: 500px;"></p>

### token で送信を行うためにユーザがやること

1. slack app の作成
2. ワークスペースに app をインストール
3. メッセージ送信用の scope 付与
4. 発行されたアクセストークンを impro に登録
5. メンションを飛ばしたいユーザーの ID を impro に登録

### 実装例

```php
$headers = [
    'Authorization' => 'Bearer {アクセストークン}',
    'Content-Type'  => 'application/json; charset=utf-8',
];

$url = 'https://slack.com/api/chat.postMessage';

$response = $client->request('POST', $url,
    [
        'headers' => $headers,
        'json' => [
            'channel' => '{チャネル名}',
            'text' => 'aaaaaaa',
            'blocks' => [
                [
                    'type' => 'section',
                    'text' => [
                        "type" => "mrkdwn",
                        "text" => "<@ユーザーID>テストテキスト"
                    ]
                ],
                [
                    'type' => 'context',
                    'elements' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => 'コンテキスト'
                        ]
                    ]
                ],
            ],

            // NOTE: ユーザとして送信する場合は下記プロパティも追加
            // 'as_user' => 'true',
            // 'username' => '{ユーザ名}',
        ]
    ]
);

```
