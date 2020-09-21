<?php
    require_once("includes/db.php");
    require_once("includes/functions.php");

    if(isset($_GET['eid']) && isset($_GET['token'])) {
        $validation_key = $_GET['token'];
        $email = urldecode(base64_decode($_GET['eid']));

        $query1 = "SELECT * FROM users WHERE user_email = '$email' AND validation_key = '$validation_key' AND is_active = 1";
        $query_con1 = mysqli_query($connection, $query1);
        if(!$query_con1) {
            die("Query Failed" . mysqli_error($connection));
        }

        $count = mysqli_num_rows($query_con1);

        if($count == 1) {
            echo "Email already verified";
        } else {
            //Query
            $query = "UPDATE users SET is_active = 1 WHERE user_email = '$email' AND validation_key = '$validation_key'";
            $query_con = mysqli_query($connection, $query);
            if(!$query_con) {
                die("Query failed" . mysqli_error($connection));
            }

            if($query_con) {
                echo "Email has been successfully verified";
            }
        }
        
        
    }

?>