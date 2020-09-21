<?php $currentPage = "Passowrd Recovery"; ?>
<?php require_once("includes/header.php"); ?>

    <div class="container">
        <div class="content">
            <h2 class="heading">Password Recovery</h2>

            <?php

                if(isset($_POST['password_recovery'])) {
                    $user_name = escape($_POST['user_name']);
                    $user_email = escape($_POST['user_email']);

                    $query = "SELECT * FROM users WHERE user_name = '$user_name' AND user_email = '$user_email' AND is_active = 1";
                    $query_con = mysqli_query($connection, $query);
                    if(!$query_con) {
                        di("Query Failed" . mysqli_error($connection));
                    }

                    if(mysqli_num_rows($query_con) == 1) {
                        echo "<div class='notification'>User found</div>";
                    } else {
                        echo "<div class='notification'>User not found</div>";
                    }

                }

            ?>

            <!--<div class='notification'>You need to wait at lest 20 minutes for another request</div>-->
            <form action="" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" name="user_name" required>
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" name="user_email" required>
                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="RECOVER PASSWORD" name="password_recovery">
                </div>
            </form>
        </div>
    </div>

<?php require_once("includes/footer.php"); ?>