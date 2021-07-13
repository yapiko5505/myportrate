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
    <?php
        require_once('../kansu/common.php');
    ?>
    <p>ダウンロードしたい注文日を選んでください。<br></p>
    <form method="post" action="order_download_done.php">
        <?php pulldown_year(); ?>
        年
        <?php pulldown_month(); ?>
        月
        <?Php pulldown_day(); ?>
        日<br><br>  
        <input type="submit" value="ダウンロードへ">
    </form>
</body>
</html>