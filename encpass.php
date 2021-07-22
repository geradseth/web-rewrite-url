<?php
#This is onetime run file-- It will be omitted after indexpage loaded.
#

$PASS = "G@Mt3ule\$Me";
$CIPHER = "aes-128-cbc";

if(in_array($CIPHER, openssl_get_cipher_methods())){

    #---Open the file to write the Credencial to connect to the database
    $passfile = fopen("enc.conf",'a');

    #generating the the Iv length
    $ivl = openssl_cipher_iv_length($CIPHER);

    #_ Creating innitialization vector by random generator for more sucurity
    ## Using openssl_random_pseudo_bytes it 
    ## genarate the strong encryption depend upon the algoriyhm you use
    $iv = openssl_random_pseudo_bytes($ivl);
    ##
      #--  Key for encryption
    ##
    $key = openssl_random_pseudo_bytes($ivl);

    $encryptedpass = openssl_encrypt($PASS,$CIPHER,$key,$opt=0,$iv);

    try{
        $p = fwrite($passfile,$encryptedpass);
        $k = fwrite($passfile, "\n".$key);
        $i = fwrite($passfile, "\n".$iv);
    }
    catch(Exception $e){
        $e->getMessage("Unable To write the required Data the file provided");
    }

    if($p && $k && $i){
        if(file_exists("encpass.php"))
        unlink("encpass.php");
    }
    
}