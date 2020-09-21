<?php $currentPage = "Sign UP"; ?>
<?php require_once("includes/header.php"); ?>

    <div class="container">
        <div class="content">
            <h2 class="heading">Sign Up</h2>

            <?php

                $errPass = false;
                if(isset($_POST['sign-up'])) {
                    
                    $first_name     = $_POST['first_name'];
                    $last_name      = $_POST['last_name'];
                    $user_name      = $_POST['user_name'];
                    $user_email     = $_POST['user_email'];
                    $user_pass      = $_POST['user_password'];
                    $user_con_pass  = $_POST['user_confirm_password'];

                    echo "First Name: " . $first_name . "<br>";
                    echo "Last Name: " . $last_name . "<br>";
                    echo "User Name: " . $user_name . "<br>";
                    echo "User Email: " . $user_email . "<br>";
                    echo "user pass: " . $user_pass . "<br>";
                    echo "user confirm password: " . $user_con_pass . "<br>";

                    if($user_pass == $user_con_pass) {
                        echo "Password matched";
                    } else {
                        echo "Password dosen't matched";
                    }
                    
                }

            ?>

            <div class='notification'>Sign up successful. Check your email for activation link</div>
            <form action="sign_up.php" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="First name" name="first_name" autocomplete="off" required>
                    
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Last name" name="last_name" autocomplete="off" required>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" name="user_name" autocomplete="off" required>
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" name="user_email" autocomplete="off" required>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Enter password" name="user_password" autocomplete="off" required>
                    <?php echo ($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Confirm password" name="user_confirm_password" autocomplete="off" required>
                    <?php echo ($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="SIGN UP" name="sign-up">
                </div>
                <div class="sign-up-cta"><span>Already have an account?</span> <a href="login.php">Login here</a></div>
            </form>

        </div>
    </div>

<?php require_once("includes/footer.php"); ?>