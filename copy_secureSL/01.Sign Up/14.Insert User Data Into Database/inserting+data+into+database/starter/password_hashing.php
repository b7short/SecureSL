<?php
    $pass = "secret";
    $hash = password_hash($pass, PASSWORD_BCRYPT, ['cost'=>10]);

    if(password_verify($pass, $hash)) {
        echo "Password matched";
    } else {
        echo "Sorry wrong password";
    }