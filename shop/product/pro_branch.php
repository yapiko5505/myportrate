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

        session_start();
        session_regenerate_id(true);
        if(isset($_SESSION['login'])==false)
        {
            print 'ログインされていません。<br>';
            print '<a href = "../staff_login/staff_login.html">ログイン画面へ</a>';  
            exit();
        } 
        
        if(isset($_POST['disp'])==true)
        {
            if(isset($_POST['procode'])==false)
            {
                header('Location:pro_ng.php');
                exit();
            }
            $pro_code=$_POST['procode'];
            header('Location:pro_disp.php?procode='.$pro_code);
            exit();
        }

        if(isset($_POST['add'])==true)
        {
            header('Location:pro_add.php');
            exit();
        }

        if(isset($_POST['edit'])==true)
        {
            if(isset($_POST['procode'])==false)
            {
                header('Location:pro_ng.php');
                exit();
            }
            $pro_code=$_POST['procode'];
            header('Location:pro_edit.php?procode='.$pro_code);
            exit();
        }

        
        if(isset($_POST['delete'])==true)
        {
                if(isset($_POST['procode'])==false)
                {
                    header('Location:pro_ng.php');
                    exit();
                }
            $pro_code=$_POST['procode'];
            header('Location:pro_delete.php?procode='.$pro_code);
            exit();
        }
    ?>
</body>
</html>