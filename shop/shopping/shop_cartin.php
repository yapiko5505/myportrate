<?php
     session_start();
     session_regenerate_id(true);
     if(isset($_SESSION['member_login'])==false)
     {
        print 'ようこそゲスト様　';
        print '<a href = "member_login.html">会員ログイン</a><br>';
        print '<br>';  
         
     } 
     else {
        print 'ようこそ';
        print $_SESSION['member_name'];
        print '様<br>';
        print '<a href = "member_logout.php">ログアウト</a><br>';  
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
            $pro_code = $_GET['procode'];

            if(isset($_SESSION['cart'])==true)
            {
                $cart=$_SESSION['cart'];
                $kazu=$_SESSION['kazu'];
            }

            $cart[]=$pro_code;
            $_SESSION['cart']=$cart;
          
        try
        {
            if(isset($_SESSION['cart'])==true)
            {
                $cart=$_SESSION['cart'];
                $kazu=$_SESSION['kazu'];
                if(in_array($pro_code,$cart)==true)
                {
                    print 'その商品はすでにカートに入っています。<br>';
                    print '<a href="shop_list.php">商品一覧に戻る</a>';
                    exit();
                }
            }
            $cart[]=$pro_code;
            $kazu[]=1;
            $_SESSION['cart']=$cart;
            $_SESSION['kazu']=$kazu;
        }
        catch (Exception $e)
        {
            print 'ただいま障害により大変ご迷惑をおかけしております。';
            exit();
        }
    ?>

    <p>カートに追加しました。</p>
    <a href="shop_list.php">商品一覧に戻る</a>

</body>

</html>