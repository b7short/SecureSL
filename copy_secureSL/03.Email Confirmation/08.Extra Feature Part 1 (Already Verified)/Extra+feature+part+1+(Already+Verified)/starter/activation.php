<?php
    require_once("includes/db.php");

    if(isset($_GET['eid']) && isset($_GET['token'])) {
        $validation_key = $_GET['token'];
        $email = urldecode(base64_decode($_GET['eid']));
        
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

?>