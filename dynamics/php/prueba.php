<?php

define("PASSWORD", "12345678");
define("HASH", "sha256");
define("METHOD", "aes-128-cbc");

echo "<h1>Cifrado>:|</h1>";

$key = openssl_digest(PASSWORD, HASH);
echo $key . "<br>";
$iv_len = openssl_cipher_iv_length(METHOD);
$iv = openssl_random_pseudo_bytes($iv_len);
echo $iv_len . "<br>";
echo $iv . "<br>";
$cifrado = openssl_encrypt(
        "curso web 2021:)",
        METHOD,
        $key,
        OPENSSL_RAW_DATA,
        $iv
);

echo $cifrado . "<br>";
//!cast5.cbc
$decifrado = openssl_decrypt(
        $cifrado,
        METHOD,
        $key,
        OPENSSL_RAW_DATA,
        $iv
);
echo $decifrado;
echo '<br>';
$pass = "supremacyKiki1_";
$hasheo = password_hash($pass, PASSWORD_BCRYPT);
echo $hasheo;
echo '<br>';
echo strlen($hasheo);
echo '<br>';