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

        $post=sanitize($_POST);

        $onamae=$post['onamae'];
        $email=$post['email'];
        $postal1=$post['postal1'];
        $postal2=$post['postal2'];
        $address=$post['address'];
        $tel=$post['tel'];
        $chumon=$post['chumon'];
        $pass=$post['pass'];
        $pass2=$post['pass2'];
        $danjo=$post['danjo'];
        $birth=$post['birth'];


        $okflg=true;

        if($onamae=='')
        {
            print 'お名前が入力されていません。<br><br>';
            $okflg=false;
        } else {
            print 'お名前<br>';
            print $onamae;
            print '<br><br>';
        }

        if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email)==0)
        {
            print 'メールアドレスを正確に入力してください。<br><br>';
            $okflg=false;
        } else {
            print 'メールアドレス';
            print $email;
            print '<br><br>';
        }

        if(preg_match('/\A[0-9]+\z/',$postal1)==0)
        {
            print '郵便番号は半角数字で入力してください。<br><br>';
            $okflg=false;
        } else {
            print '郵便番号<br>';
            print $postal1;
            print '-';
            print $postal2;
            print '<br><br>';
        }

        if(preg_match('/\A[0-9]+\z/',$postal2)==0)
        {
            print '郵便番号は半角数字で入力してください。<br><br>';
            $okflg=false;
        }

        if($address=='')
        {
            print '住所が入力されていません。<br><br>';
            $okflg=false;
        } else {
            print '住所<br>';
            print $address;
            print '<br><br>';
        }

        if(preg_match('/\A\d{2,5}-?\d{2,5}-\d{4,5}\z/', $tel)==0)
        {
            print '電話番号を正確に入力してください。<br><br>';
            $okflg=false;
        } else {
            print '電話番号<br>';
            print $tel;
            print '<br><br>';
        }

        if($chumon=='chumontouroku')
        {
            if($pass=='')
            {
                print 'パスワードが入力されていません。<br><br>';
                $okflg=false;
            }
            if($pass!==$pass2)
            {
                print 'パスワードが一致しません。<br><br>';
                $okflg=false;
            }
            print '性別<br>';
            if($danjo=='dan')
            {
                print '男性';
            } else {
                print '女性';
            }
            print '<br><br>';
            print $birth;
            print '年代';
            print '<br><br>';
        }

        if($okflg==true)
        {
        print '<form method="post" action="shop_form_done.php">';
        print '<form method="hidden" name="onamae" value="'.$onamae.'">';
        print '<form method="hidden" name="email" value="'.$email.'">';
        print '<form method="hidden" name="postal1" value="'.$postal1.'">';
        print '<form method="hidden" name="postal2" value="'.$postal2.'">';
        print '<form method="hidden" name="address" value="'.$address.'">';
        print '<form method="hidden" name="tel" value="'.$tel.'">';
        print '<form method="hidden" name="chumon" value="'.$chumon.'">';
        print '<form method="hidden" name="pass" value="'.$pass.'">';
        print '<form method="hidden" name="danjo" value="'.$danjo.'">';
        print '<form method="hidden" name="birth" value="'.$birth.'">';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print ' <input type="submit" value="OK"><br>';  
        print '</form>';
        }
        else
        {
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</form>';
        }

        ?>
        
</body>
</html>