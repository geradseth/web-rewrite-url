<?php

## Decrypting the Kept credential
# Formed the time you are installing the password

$credential = "enc.conf";
$lines = file($credential);

$p = $lines[0];
$k = $lines[1];
$i = $lines[2];
$m = "aes-128-cbc";
$o = 0;
$PASSWORD = openssl_decrypt($p,$m,$k,$o,$i);

#Now You can include this file on any connection file.
# And use $PASSWORD as Password to your connection object