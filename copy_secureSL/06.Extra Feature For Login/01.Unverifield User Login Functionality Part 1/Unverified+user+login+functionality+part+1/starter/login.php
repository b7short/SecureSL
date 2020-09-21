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
                        $user_name = escape($_POST['user_name']);
                        $user_email = escape($_POST['user_email']);               
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

                    $query = "SELECT * FROM users WHERE user_name = '$user_name' AND user_email = '$user_email' AND is_active = 1";
                    $query_con = mysqli_query($connection, $query);
                    if(!$query_con) {
                        die("Query Failed" . mysqli_error($connection));
                    }
                    
                    $result = mysqli_fetch_assoc($query_con);
                    //verify password
                    if(password_verify($user_password, $result['user_password'])) {
                        
                        if(!isset($errCaptcha)) {
                            echo "<div class='notification'>Log In Successfull</div>";
                            $_SESSION['login'] = 'success';
                            header("Refresh:2;url=index.php");
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