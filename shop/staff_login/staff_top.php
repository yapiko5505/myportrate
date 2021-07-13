<?php
    session_start();
    if(isset($_SESSION['login'])==false)
    {
        print 'ログインされていません。<br>';
        print '<a href = "../staff_login/staff_login.html">ログイン画面へ</a>';  
        exit();
    } 
    else {
        print $_SESSION['staff_name'];
        print 'さんログイン中<br>';
        print '<br>';
    }

?>





<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園</title>
</head>
<body>
    <p>ショップ管理トップメニュー<br></P>
    <br><a href="../phpouyou/staff_list.php">スタッフ管理</a><br>
    <br><a href="../product/pro_list.php">商品管理</a><br>
    <br><a href="../order/order_download.php">注文ダウンロード</a><br>
    <br><a href="staff_logout.php">ログアウト</a><br>
</body>
</html>