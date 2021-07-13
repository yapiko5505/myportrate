<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
    print 'ログインされていません。<br>';
    print '<a href="shop_list.php">商品一覧へ</a>';
    exit();
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

        $code=$_SESSION['member_code'];

        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT name, email, postal1, postal2, address, tel FROM dat_member WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh=null;

        $onamae=$rec['name'];
        $email=$rec['email'];
        $postal1=$rec['postal1'];
        $postal2=$rec['postal2'];
        $tel=$rec['tel'];

        print 'お名前<br>';
        print $onamae;
        print '<br><br>';

        print 'メールアドレス<br>';
        print $email;
        print '<br><br>';

        print '郵便番号<br>';
        print $postal1;
        print '-';
        print $postal2;
        print '<br><br>';

        print '住所<br>';
        print $address;
        print '<br><br>';

        print '電話番号<br>';
        print $tel;
        print '<br><br>';

        print '<form method="post" action="shop_kantan_done.php">';
        print '<form method="hidden" name="onamae" value="'.$onamae.'">';
        print '<form method="hidden" name="email" value="'.$email.'">';
        print '<form method="hidden" name="postal1" value="'.$postal1.'">';
        print '<form method="hidden" name="postal2" value="'.$postal2.'">';
        print '<form method="hidden" name="address" value="'.$address.'">';
        print '<form method="hidden" name="tel" value="'.$tel.'">';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print ' <input type="submit" value="OK"><br>';  

        ?>
        
</body>
</html>