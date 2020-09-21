<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Regular Expression</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php
        /*
        #min = 4, max =12
        #only lowercase letter, number and underscore allowed
        */
        $regex = "/^(?=.{4,12}$)[a-z0-9_]*$/";
        if(isset($_POST['submit-user-name'])) {
            $user_name = $_POST['user-name'];
            if(preg_match($regex, $user_name)) {
                $message = "<p class='notification'>User name validation successfull</p>";
            } else {
                $error = "<span class='error'>Only lowecase letter, number & underscore allowed and min 4, max 12</span>";
            }
        }
    ?>
    
    <div class="form">
        <h1 class="sign-up">USER NAME VALIDATION</h1>
        <?php echo isset($message) ? $message : ""; ?>
        <!--<p class='notification'>User name validation successfull</p>-->
        <form action="index.php" method="POST">
            <input class="input" type="text" placeholder="Username" name="user-name">
            <!--<span class='error'>Only letter, number & underscore allowed and min 4, max 12</span>-->
            <?php echo isset($error) ? $error : ""; ?>
            <input class="input btn" type="submit" value="SUBMIT" name="submit-user-name">
        </form>
    </div>

</body>
</html>