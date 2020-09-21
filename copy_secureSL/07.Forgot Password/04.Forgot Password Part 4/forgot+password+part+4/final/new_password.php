<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
                    
                    date_default_timezone_set("asia/dhaka");
                    $current_date = date("Y-m-d H:i:s");

                    if($expire_date <= $current_date) {
                        echo "<div class='notification'>Sorry This link was expired</div>";
                    } else {
                        if(isset($_POST['submit'])) {
                            $user_pass = escape($_POST['new-password']);
                            $user_con_pass = escape($_POST['confirm-new-password']);

                            if($user_pass == $user_con_pass) {
                                //password validation
                                $pattern_up = "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
                                if(!preg_match($pattern_up, $user_pass)) {
                                    $errPass = "Must be at lest 4 character long, 1 upper case, 1 lower case letter and 1 number exist";
                                }
                            } else {
                                $errPass = "Password dosen't matched";
                            }

                        }
                        

                    }
                    

                } else {
                    echo "<div class='notification'>Somethings went wrong</div>";
                }

                if(isset($errPass)) {
                    echo "<div class='notification'>{$errPass}</div";
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