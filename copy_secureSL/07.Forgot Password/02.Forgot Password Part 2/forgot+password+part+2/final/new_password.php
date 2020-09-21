<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h2 class="heading">New Password</h2>


            <?php

                if(isset($_GET['eid']) && isset($_GET['token']) && isset($_GET['exd'])) {

                    $user_email = urldecode(base64_decode($_GET['eid']));
                    $validation_key = urldecode(base64_decode($_GET['token']));
                    $expire_date = urldecode(base64_decode($_GET['exd']));

                    echo $user_email;
                    echo "<br>";
                    echo $validation_key;
                    echo "<br>";
                    echo $expire_date;

                }

            ?>

            <!--<div class='notification'>Password updated successfully. <a href='login.php'>login now</a></div>-->
            <form action="" method="POST">
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="New password" name="new-password" required>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Confirm new password" name="confirm-new-password" required>
                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="SUBMIT" name="submit" >
                </div>
            </form>

        </div> 
    </div>
</body>
</html>
