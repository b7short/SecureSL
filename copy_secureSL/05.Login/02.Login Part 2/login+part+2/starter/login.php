<?php $currentPage = "Login"; ?>
<?php require_once("includes/header.php"); ?>

    <div class="container">
        <div class="content">
            <h2 class="heading">Login</h2>

            <?php



                if(isset($_POST['login'])) {

                    $user_name = escape($_POST['user_name']);
                    $user_email = escape($_POST['user_email']);
                    $user_password = escape($_POST['user_password']);

                    $query = "SELECT * FROM users WHERE user_name = '$user_name' AND user_email = '$user_email' AND is_active = 1";
                    $query_con = mysqli_query($connection, $query);
                    if(!$query_con) {
                        die("Query Failed" . mysqli_error($connection));
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
                <div class="input-box">
                    <input type="submit" class="input-submit" value="LOGIN" name="login">
                </div>
                <div class="login-cta"><span>Don't have an account?</span> <a href="sign_up.php">Sign up here</a></div>
            </form>

        </div>
    </div>

<?php require_once("includes/footer.php"); ?>