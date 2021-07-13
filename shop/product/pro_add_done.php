<?php
    session_start();
    session_regenerate_id(true);
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
        
        
            $pro_name=$_POST['name'];
            $pro_price=$_POST['price'];
            $pro_gazou_name=$_POST['gazou_name'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';

        try
        {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'INSERT INTO mst_product(name, price, gazou) VALUES(?, ?, ?)';
            $stmt = $dbh->prepare($sql);
            $data[] = $pro_name;
            $data[] = $pro_price;
            $data[] = $pro_gazou_name;
            $stmt->execute($data);

            $dbh = null;

            print htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
            print 'を追加しました。<br>';

        }
        catch (Exception $e)
        {
            print 'ただいま障害により大変ご迷惑をおかけしております。';
            print $e;
            exit();
        }
        
    ?>

    <a href = "pro_list.php">戻る</a>  

</body>
</html>