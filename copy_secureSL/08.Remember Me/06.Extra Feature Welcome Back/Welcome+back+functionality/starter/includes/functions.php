<?php
    

    function escape($string) {
        global $connection;
        return mysqli_real_escape_string($connection, $string);
    }

    function getToken($len) {

        $rand_str = md5(uniqid(mt_rand(), true));
        $base64_encode = base64_encode($rand_str);
        $modified_base64_encode = str_replace(array('+', '='), array('', ''), $base64_encode);
        $token = substr($modified_base64_encode, 0, $len);
        return $token;

    }

    function isAlreadyLoggedIn() {
        global $connection;
        date_default_timezone_set("asia/dhaka");
        $current_date = date("Y-m-d H:i:s");
        if(isset($_COOKIE['_ucv_'])) {
            $selector = escape(base64_decode($_COOKIE['_ucv_']));


            $query = "SELECT * FROM remember_me WHERE selector = '$selector' AND is_expired = 0";
            $query_con = mysqli_query($connection, $query);
            if(!$query_con) {
                die("Query Failed" . mysqli_error($connection));
            }
            $result = mysqli_fetch_assoc($query_con);
            if(mysqli_num_rows($query_con) == 1) {
                $expire_date = $result['expire_date'];

                if($expire_date >= $current_date) {
                    return true;
                }
            }
        }




        
    }