<boby>
     <?php 

            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $goiken = $_POST['goiken'];

            $dsn = 'mysql:dbname=phpkiso;host=localhost';
            $user = 'root';
            $password = '';

        try
        {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->query('SET NAMES utf8');

            $nickname = htmlspecialchars($nickname);
            $email = htmlspecialchars($email);
            $goiken = htmlspecialchars($goiken);

            print $nickname;
            print '様<br>';
            print 'ご意見ありがとうございました。<br>';
            print '頂いたご意見「';
            print $goiken;
            print '」<br>';
            print $email;
            print 'にメールを送りましたのでご確認ください。';

            $mail_sub = 'アンケート受け付けました。';
            $mail_body = $nickname."様へ\nアンケートご協力ありがとうございました。";
            $mail_body= html_entity_decode($mail_body, ENT_QUOTES, "UTF-8");
            $mail_head = 'From: xxx@xxx.co.jp';
            mb_language('Japanese');
            mb_internal_encoding("UTF-8");
            mb_send_mail($email, $mail_sub, $mail_body, $mail_head);

            $sql = 'INSERT INTO anketo (nickname, email, goiken) VALUES(" '.$nickname.' "," '.$email.' "," '.$goiken.' ")';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;
        }

        catch(Exception $e)
        {
            print 'ただいま障害により大変ご迷惑をおかけしております。';
            print $e;
        }
    ?>

</body>