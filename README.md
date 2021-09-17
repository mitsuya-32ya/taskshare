# taskshare

## セットアップ

こちらの手順に従ってローカル上で構築できます


```
$ git clone git@github.com:Mitsuya-Sora/taskshare.git
$ cd taskshare
$ docker-compose up -d --build
$ docker-compose exec app bash
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate
```
[http://127.0.0.1:10080](http://127.0.0.1:10080)にアクセスします。

## 概要

課題を共有できるサービス。受験生などが、モチベーション向上のため、みんなで課題を共有しあって、高め合えるようなサービスを想定しました。

## 使用技術

開発環境 Docker

言語/フレームワーク PHP/Laravel

データベース MySQL

## 機能一覧

課題登録機能

投稿一覧表示機能

投稿編集機能

投稿にいいねをする機能

投稿にコメントをつける機能

ユーザー一覧表示機能

ユーザーごとの投稿一覧表示機能

課題の期限を設定する機能

課題の状態を、未完了、完了で変更する機能
