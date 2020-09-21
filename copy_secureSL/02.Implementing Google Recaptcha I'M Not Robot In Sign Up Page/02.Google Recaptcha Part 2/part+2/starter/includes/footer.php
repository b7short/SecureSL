    <script src="https://www.google.com/recaptcha/api.js"></script>
</body>
</html>


//Google recaptcha
                    $response_key = $_POST['g-recaptcha-response'];

                    //https://www.google.com/recaptcha/api/siteverify?secret=$private_key&response=$response_key&remoteip=currentScriptIpAddress
                    $response = file_get_contents($url . "?secret=" . $private_key . "&response=" . $response_key . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                    $response = json_decode($response);