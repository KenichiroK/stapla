# impro

## プログラムのセットアップ方法

```
mkdir impro
cd impro
git clone https://github.com/laradock/laradock.git
cd laradock
cp env-example .env
cd nginx/sites
cp default.conf default.conf.bak
cp laravel.conf.example default.conf
vim default.conf
以下の箇所変更
root /var/www/laravel/public -> root /var/www/src/public
cd ../../
docker-compose up -d nginx
cd ..
git clone https://github.com/tatsuya-nagase/impro.git src
cd src
cp .env.example .env
cd ../laradock
docker-compose exec workspace bash
cd src
composer install
http://localhost

```

## データやプログラム設計の内容

### db 設計

https://cacoo.com/diagrams/gwBCX5nPPOZJ6prG/01DD1

### front

以下を参考にしています

http://tsudoi.org/guide/detail/8.html

eslint ( 予定 ) https://github.com/tatsuya-nagase/impro/issues/459

Prettier を使ってオートフォーマット

### server

## 開発の仕方

### タスク管理

#### trello

https://trello.com/b/1z4tKbpn/impro%E9%96%8B%E7%99%BA

`Icebox` に開発タスクが降りてくるのでそこから今週自分が作業したいものに自分をアサインして `今週完了予定分` にカードを移す

作業中のものを `今週完了予定分` から `working` に移す

開発が完了して PR を出したら `working` から `PR` に移す

PR が完了して develop ブランチに merge したら `PR` から `dev反映済み(旧:テスト)` に移す

### github

#### branch

master branch -> 本番環境

staging branch -> 次回リリース環境

develop branch -> 開発環境

staging branch から各々が作業ブランチを切って作業する ( 1-5 リリース以降 )

#### PR

挙動確認 -> 小松さん

code 確認 -> 羽田さん

小松さんと羽田さんの approve で staging branch と develop branch に作業者が自分でそれぞれ merge ( 1-5 リリース以降 )

## Tips
