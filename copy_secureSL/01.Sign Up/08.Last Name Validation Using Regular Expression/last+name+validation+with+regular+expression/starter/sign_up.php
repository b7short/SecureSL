<?php $currentPage = "Sign UP"; ?>
<?php require_once("includes/header.php"); ?>

    <div class="container">
        <div class="content">
            <h2 class="heading">Sign Up</h2>

            <?php

                $errPass = false;
                if(isset($_POST['sign-up'])) {
                    
                    $first_name     = escape($_POST['first_name']);
                    $last_name      = escape($_POST['last_name']);
                    $user_name      = escape($_POST['user_name']);
                    $user_email     = escape($_POST['user_email']);
                    $user_pass      = escape($_POST['user_password']);
                    $user_con_pass  = escape($_POST['user_confirm_password']);

                    //first name validation
                    $pattern_fn = "/^[a-zA-Z ]{3,12}$/";
                    if(!preg_match($pattern_fn, $first_name)) {
                        $errFn = "Must be at lest 3 character long, letter and space allowed";
                    }

                    if($user_pass == $user_con_pass) {
                        $errPass = false;
                    } else {
                        $errPass = "Password dosen't matched";
                    }
                    
                }

            ?>

            <!-- <div class='notification'>Sign up successful. Check your email for activation link</div> -->
            <form action="sign_up.php" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="First name" name="first_name" autocomplete="off">
                    <?php echo isset($errFn)?"<span class='error'>{$errFn}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Last name" name="last_name" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" name="user_name" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" name="user_email" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Enter password" name="user_password" autocomplete="off">
                    <?php echo ($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Confirm password" name="user_confirm_password" autocomplete="off">
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