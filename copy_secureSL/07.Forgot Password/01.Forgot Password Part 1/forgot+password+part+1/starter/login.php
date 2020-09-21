<?php session_start(); ?>
<?php $currentPage = "Login"; ?>
<?php require_once("includes/header.php"); ?>

    <div class="container">
        <div class="content">
            <h2 class="heading">Login</h2>

            <?php

                //google recaptcha
                $public_key = "6LfD244UAAAAAI6ot-UBtAxvy9bzBwuX8-ZyX0fl";
                $private_key = "6LfD244UAAAAAIPYM-neiOvPsRNTKxXoKJOqZOUd";
                $url = "https://www.google.com/recaptcha/api/siteverify";

                if(isset($_POST['resend'])) {
                    if(!isset($_COOKIE['_utt_'])) {
                        $user_name = escape($_POST['user_name']);
                        $user_email = escape($_POST['user_email']);
                        
                        date_default_timezone_set("asia/dhaka");

                        $mail->addAddress($_POST['user_email']);
                        $token = getToken(32);
                        $email = base64_encode(urlencode($_POST['user_email']));
                        $expire_date = date("Y-m-d H:i:s", time() + 60 * 20);
                        $expire_date = base64_encode(urlencode($expire_date));     
                        
                        $query = "UPDATE users SET validation_key = '$token' WHERE user_name = '$user_name' AND user_email = '$user_email' AND is_active = 0";
                        $query_con = mysqli_query($connection, $query);
                        if(!$query_con) {
                            die("Query Failed" . mysqli_error($connection));
                        } else {
                            $mail->Subject = "Verify your email";
                            $mail->Body = "
                                        <h2>Follow the link to verify</h2>
                                        <a href='localhost/registration/activation.php?eid={$email}&token={$token}&&exd={$expire_date}'>Click here to verify</a>
                                        <p>This link is valid for 20 minutes</p>
                                        ";
        
                            if($mail->send()) {
                                setcookie('_utt_', getToken(16), time() + 60 * 20, '', '', '', true);
                                echo "<div class='notification'>Check your email for activation link</div>";
                            }
                        }
                    } else {
                        echo "<div class='notification'>You must be wait at lest 20 minutes for another request</div>";
                    }                   
                    

                        
                }

                if(isset($_POST['login'])) {
                    
                    //Google recaptcha
                    $response_key = $_POST['g-recaptcha-response'];

                    //https://www.google.com/recaptcha/api/siteverify?secret=$private_key&response=$response_key&remoteip=currentScriptIpAddress
                    $response = file_get_contents($url . "?secret=" . $private_key . "&response=" . $response_key . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                    $response = json_decode($response);
                    
                    if(!($response->success == 1)) {
                        $errCaptcha = "Wrong captcha";
                    }

                    $user_name = escape($_POST['user_name']);
                    $user_email = escape($_POST['user_email']);
                    $user_password = escape($_POST['user_password']);

                    $query = "SELECT * FROM users WHERE user_name = '$user_name' AND user_email = '$user_email'";
                    $query_con = mysqli_query($connection, $query);
                    if(!$query_con) {
                        die("Query Failed" . mysqli_error($connection));
                    }
                    
                    $result = mysqli_fetch_assoc($query_con);
                    //verify password
                    if(password_verify($user_password, $result['user_password'])) {
                        if($result['is_active'] == 1) {
                            if(!isset($errCaptcha)) {
                                echo "<div class='notification'>Log In Successfull</div>";
                                $_SESSION['login'] = 'success';
                                header("Refresh:2;url=index.php");
                            }
                        } else {
                            if(!isset($errCaptcha)) {
                                echo "<div class='notification'>You are not verified user <form method='POST'><input type='text' value={$user_name} name='user_name' hidden><input text='email' value={$user_email} name='user_email' hidden><input class='resend' class type='submit' value='click here to verify' name='resend'></form></div>";
                            }
                        }
                    } else {
                        echo "<div class='notification'>Invalid username or email or password</div>";
                    }
                }

            ?>

            <!--<div class='notification'>Logged In Successfull</div>-->
            <form action="login.php" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" name="user_name" required>
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" name="user_email" required>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Enter password" name="user_password" required>
                </div>
                <div class="input-box rm-box">
                    <div>
                        <input type="checkbox" id="remember-me" class="remember-me" name="remember-me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <a href="forgot_password.php" class="forgot-password">Forgot password?</a>
                </div>
                <div class="g-recaptcha" data-sitekey="<?php echo $public_key; ?>"></div>
                <?php echo isset($errCaptcha)?"<span class='error'>{$errCaptcha}</span>":""; ?>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="LOGIN" name="login">
                </div>
                <div class="login-cta"><span>Don't have an account?</span> <a href="sign_up.php">Sign up here</a></div>
            </form>

        </div>
    </div>

<?php require_once("includes/footer.php"); ?>