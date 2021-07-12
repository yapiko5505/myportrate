<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//  require_once( dirname( __FILE__ ).'/PHPMailer/src/PHPMailer.php' );
//  require_once( dirname( __FILE__ ).'/PHPMailer/src/Exception.php' );
//  require_once( dirname( __FILE__ ).'/PHPMailer/src/SMTP.php' );
//  var_dump($_POST);

// 変数の初期化 
$page_flag = 0;
$clean = array();
$error = array();
$body = "";

// サニタイズ
if( !empty($_POST) ) {
    var_dump($_POST);
    foreach( $_POST as $key => $value ) {
        $clean[$key] = htmlspecialchars($value , ENT_QUOTES);
    }

    var_dump($_POST);
}

if( !empty($_POST['btn_confirm']) ) {

    $error = validation($clean);

    if( empty($error) ) {
        $page_flag = 1;
    }
    
} elseif( !empty($_POST['btn_submit']) ) {
    // データベースに接続
    $mysqli = new mysqli('localhost', 'root', '', 'phpkiso');

    // 接続エラーの確認
    if( $mysqli->connect_errno) {
        $error_message[] = '書き込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
    } else {

        // 文字コード設定
        $mysqli->set_charset('utf8');

        // 書き込み日時を取得
        $now_date = date("Y-m-d H:i:s");

        // データを登録するSQL作成
        $sql = "INSERT INTO anketo (nickname, email, goiken)
                VALUES('".$clean['nickname']."', '".$clean['email']."', '".$clean['goiken']."')";

        // データを登録
        $res = $mysqli->query($sql);

        if($res) {
            $success_message = 'メッセージを書き込みました。';
        } else {
            $error_message[] = '書き込みに失敗しました。';
        }

        // データベースの接続を閉じる
        $mysqli->close();
    }

    var_dump($res);

    $mail = new PHPMailer(true);

    try {
            //送信先情報
            $to         = "yasuko0981@yahoo.co.jp";//送信先アドレス
            $toname    = "テスト 太郎";
            //smtp設定情報
            $username  = "yapiko7725@gmail.com"; //取得した捨てGmail
            $useralias = "techis-Gmail";
            $password  = "rmsasdfgrpkkuvlb"; //取得したアプリパスワード
            $subject = "送信完了のお知らせ"; 
            $body .= "アンケート受付しました。" ;
            $body .= "ニックネーム" . $_POST['nickname'] . "\n";
            $body .= "メールアドレス" . $_POST['email'] . "\n";
            $body .= "ご意見" . $_POST['goiken'] . "\n";
            $body .= "------------------------------\r\n";
     
             //メール送信
            // $mail->SMTPDebug = 2; //デバッグ用
             $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = "smtp.gmail.com";
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = "utf-8";
            $mail->Encoding = "base64";
            $mail->setFrom($username , $useralias);
            $mail->addAddress($to, $toname);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            //送信開始
            $mail->send();
             echo '成功';
            } catch (Exception $e) {
            echo '失敗: ', $mail->ErrorInfo;
            }
        
    }

//  $page_flag = 2;

function validation($data) {
    $error = array();

    // ニックネームのバリデーション
    if( empty($data['nickname']) ) {
        $error[] = "「ニックネーム」は入力してください。";
    } 

     // メールアドレスのバリデーション
    if( empty($data['email']) ) {
        $error[] = "「メールアドレス」は入力してください。";
    } 

     // ご意見のバリデーション
    if( empty($data['goiken']) ) {
        $error[] = "「ご意見」は入力してください。";
    } 

    return $error;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フオーム基礎</title>
    <style>
        .error_list {
	    padding: 10px 30px;
	    color: #ff2e5a;
	    font-size: 86%;
	    text-align: left;
	    border: 1px solid #ff2e5a;
	    border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php if( $page_flag === 1): ?>

    <!-- 確認ページ -->
    <form method="post" action="">
        <div class="element_wrap">
            <p>ニックネームを入力してください。</p><br>
            <p><?php echo $_POST['nickname']; ?></P>
            <p>メールアドレスを入力してください。</p><br>
            <p><?php echo $_POST['email']; ?></P>
            <p>ご意見をひと言でお聞かせください。</p><br>
            <p><?php echo $_POST['goiken']; ?></P>
        </div>
        <input type="submit" name="btn_submit" value="送信">
        <input type="hidden" name="nickname" value="<?php echo $_POST['nickname']; ?>">
        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
        <input type="hidden" name="goiken" value="<?php echo $_POST['goiken']; ?>">
    </form>
    <!-- 完了ページ -->

    <?php elseif( $page_flag === 2): ?>

        <p>送信が完了しました。</p>

    <?php else: ?>

    <!-- バリエーション -->
    <?php if ( !empty($error) ): ?>
        <ul class="error_list">
            <?php foreach ( $error as $value): ?>
                <li><?php echo $value; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- 入力ページ -->
    <form method="post" action="">
        <p>ニックネームを入力してください。</p><br>
        <input type="text" name="nickname" style="width:100px" value=""><br><br>
        <p>メールアドレスを入力してください。</p><br>
        <input type="text" name="email" style="width:200px" value=""><br><br>
        <p>ご意見をひと言でお聞かせください。</p><br>
        <input type="text" name="goiken" style="width:300px" value=""><br><br>
        <input type="submit" name="btn_confirm" value="次へ">
    </form>

    <?php endif; ?>
</body>
</html>