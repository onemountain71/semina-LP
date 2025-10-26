<?php

    //////////////////
    // 設定必須の項目 //
    //////////////////
    // ドメイン（リファラチェックが不要の場合は空にする）
//    $q['domain'] = "mailform-local.com";
    $q['domain'] = "shounisikajuku.com";
    // 通知先メアド
    $q['to'] = "support@mori-store.com";
    // 送信元メアド（サイトと同一ドメインのメアド推奨。未入力の時はdomain@form-mail.netから送信）
    $q['from'] = "contactform@shounisikajuku.com";
    // トップページURL
    $q['site_top'] = "https://shounisikajuku.com/omatome02/";
    // 入力必須項目
    $q['require'] = array('医院名','Email','参加者名','参加方法','住所','連絡先','決済方法','アンケート');
    // メアド入力欄のname属性の値
    $q['name_of_email'] = "Email";

    ///////////////////////
    // 自動返信メールの設定 //
    ///////////////////////
    // 自動返信メールを送る（1=送る、0=送らない）
    $q['remail'] = 1;
    // 自動返信メールの送信者名（HPタイトルあるいは運営者名を記載）
    $q['refrom_name'] = "";
    // 自動返信メールのタイトル
    $q['re_subject'] = "小児歯科が上手くなる！知識おまとめセミナーへのお申込確認";
    // 自動返信メール本文内の宛名（「○○様」の部分）に使用する項目のname属性
    $q['dsp_name'] = 'お名前';
    //自動返信メールの冒頭の文言（TEXTの間に記載）
    $q['remail_text'] = <<< TEXT
このたびは「小児歯科が上手くなる！知識おまとめセミナー」に
お申込いただき、ありがとうございます。

メールでのお申込を受付致しました。※まだお申込は完了しておりません
セミナー参加費の入金確認をもってお申込の完了となります。
入金を確認出来次第、【入金完了メール】をお送り致します。
宜しくお願い致します。

「小児歯科が上手くなる！知識おまとめセミナー」　参加費￥41,800（税込）
お支払いは「クレジット支払」と「銀行振込」がご利用可能です。

※お申込後5日以内のお支払完了をお願い致します。

※ご入金後、3日を過ぎても「入金完了メール」が届かない場合は、
お手数ですが、㈱森商店（セミナー担当 森）までお問い合わせください。
　メールアドレス：support@mori-store.com

【クレジット支払】又は【PAYPAL支払】の方は下記のURLからお支払ください。　

【クレジット支払URL】　https://univa.cc/oafoPJ

【PAYPAL支払URL】　https://www.paypal.com/ncp/payment/LPH5U8Z9NV8XS

銀行振込の方は下記の【お支払い先銀行口座】へお振込をお願いします。

【お支払い先銀行口座情報】
-------------------------------------------------
■金融機関名	：阿波銀行
-------------------------------------------------
■支店名	：阿南支店
-------------------------------------------------
■口座種別	：普通
-------------------------------------------------
■口座番号	：１３６０２６７
-------------------------------------------------
■口座名義	：株式会社森商店
-------------------------------------------------
■名義カナ	：カ）モリショウテン
-------------------------------------------------
※恐れ入りますが、振込手数料は貴医院にてご負担ください。

======================================================
発信元：株式会社森商店　森　和也（Mori Kazuya）
E-mail：support@mori-store.com
　URL：https://shounisikajuku.com/ （小児歯科実践会HP）
　住所：〒774-0049　徳島県阿南市上大野町久留米田５番地
　電話：050-3545-2266（代表）、携帯電話090-9550-2121、FAX：0884-22-5516
======================================================





TEXT;
    // 自動返信メールの署名欄（FOOTERの間に記載）
    $q['mailSignature'] = <<< FOOTER
FOOTER;

    /////////////
    // 詳細設定 //
    /////////////
    // 管理者宛に送信されるメールの件名
    $q['subject'] = "小児歯科が上手くなる！知識おまとめセミナー";
    // BCCで送るメアド。（例：array('アドレス1','アドレス2')）
    $q['BccMail'] = array();
    // 送信確認画面の表示(する=1, しない=0)
    $q['confirmDsp'] = 1;
    // 自前のサンクスページ（空の場合はデフォルトのサンクスページを表示）
    $q['thanksPage'] = "https://shounisikajuku.com/omatome02/thanks.html";
    // 管理者宛のメールで差出人を送信者のメールアドレスにする(する=1, しない=0)
    $q['userMail'] = 0;
    // 全角英数字→半角変換をする項目のname属性（例：array('電話番号','金額')）
    $q['hankaku_array'] = array('aa', 'bb');
    // Return-Pathの設定(する=1, しない=0)
    $q['use_envelope'] = 0;
    /* 〜〜〜設定はここまで〜〜〜*/


    header("Content-Type:text/html;charset=utf-8");
    session_start();
    $q['POSTED_DATA'] = $_POST;
    $q['CLIENT_SCRIPT_NAME'] = $_SERVER['REQUEST_URI'];
    $q['CLIENT_HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
    if (!isset($_SESSION['_token'])) {
        $q['SESSION_TOKEN'] = sha1(uniqid(mt_rand(), true));
        $_SESSION['_token'] = $q['SESSION_TOKEN'];
    }
    else {
        $q['SESSION_TOKEN'] = $_SESSION['_token'];
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://form-mail.net/server.php');
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($q, "", "&") );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //<-PHP5.1.3以降は意味なし
    echo curl_exec($ch);
