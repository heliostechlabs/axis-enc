<?php

$p12File = 'dab-axis.p12';
$p12Password = '1234';

$p12 = file_get_contents($p12File);

$dataToEncrypt = '{
    "Data": {
            "userName": "alwebuser",
            "password": "acid_qa"
        },

        "Risks": {}

}';


if (openssl_pkcs12_read($p12, $certs, $p12Password)) {
    $privateKey = $certs['pkey'];
} else {
    die('Failed to load P12 file or incorrect password.');
}

if (openssl_private_encrypt($dataToEncrypt, $encryptedData, $privateKey)) {
    echo "ENCODED DATA ".base64_encode($encryptedData);
} else {
    die('Encryption failed.');
}
