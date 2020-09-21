<?php

    $pass = "secret";

    $hash = password_hash($pass, PASSWORD_BCRYPT, ['cost'=>10]);

    

    if(password_verify('secret', $hash)) {
        echo "Password matched";
    } else {
        echo "Password dosen't matched";
    }

