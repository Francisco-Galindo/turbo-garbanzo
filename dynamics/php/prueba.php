<?php

define("PASSWORD", "popo");
define("HASH", "sha256");
define("METHOD", "aes-128-cbc");

echo "<h1>Cifrado>:|</h1>";

$key = openssl_digest(PASSWORD, HASH);
// echo $key . "<br>";
$iv_len = openssl_cipher_iv_length(METHOD);
$iv = openssl_random_pseudo_bytes($iv_len);
// echo $iv_len . "<br>";
// echo $iv . "<br>";

$cifrado = openssl_encrypt(
        "curso web 2021:)",
        METHOD,
        'popo',
        OPENSSL_RAW_DATA,
        $iv
);
$cifrado = base64_encode($cifrado);
echo 'cifrado: ' . $cifrado . "<br>";
// //!cast5.cbc
$cifrado = 'c0l3LaVbKTjO1MuFZZq3BhWxACSp+zEc6t+J4JPOQHk=';
echo 'cifrado loleado: ' . $cifrado . "<br>";
$decifrado = openssl_decrypt(
        $cifrado,
        METHOD,
        'popo',
        OPENSSL_RAW_DATA,
        $iv
);
echo $decifrado;
echo '<br>';
// $pass = "supremacyKiki1_";
// $hasheo = password_hash($pass, PASSWORD_BCRYPT);
// echo $hasheo;
// echo '<br>';
// echo strlen($hasheo);
// echo '<br>';