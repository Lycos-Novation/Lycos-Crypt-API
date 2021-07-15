<?php
function chiffrer($texte){ //Fonction servant à chiffrer un texte
    //On fait atteindre au texte une longueur exacte de 128 caractères, quitte à le tronquer s'il dépasse.
    $texte_plein = $texte;
    while(strlen($texte) <= 128){
        $texte = $texte.$texte;
    }
    if(strlen($texte)>128){
        $texte = strrev(substr(strrev($texte), (strlen($texte)-128)));
    }
    $c = 0;
    //On fait ça propre : la clé de chiffrement est elle même... chiffrée. en md5, 6969 tours (LOL) c'est jamais de trop.
    while($c<6969){
        $texte = md5($texte);
        $c++;
    }
    //Chiffrement du texte avec le texte répété
    $methode = "AES-256-CBC";
    $ivlen = openssl_cipher_iv_length($methode); 
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($texte_plein, $methode, $texte, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $texte, $as_binary=true);
    $chiffre = base64_encode( $iv.$hmac.$ciphertext_raw ); //Texte chiffré
    return $chiffre;
};

function compare($hash, $texte){ //Fonction déterminant si le hash déchiffré = au texte
    $texte_plein = $texte;
    while(strlen($texte) <= 128){
        $texte = $texte.$texte;
    }
    if(strlen($texte)>128){
        $texte = strrev(substr(strrev($texte), (strlen($texte)-128)));
    }
    $c = 0;
    //du coup on le refait ici, btw.
    while($c<6969){
        $texte = md5($texte);
        $c++;
    }
    $clechiffrement = $texte;
    $c = base64_decode($hash);
    $ivlen = openssl_cipher_iv_length($cipher="AES-256-CBC"); //méthode
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len=32);
    $ciphertext_raw = substr($c, $ivlen+$sha2len);
    $dechiffre = openssl_decrypt($ciphertext_raw, $cipher, $clechiffrement, $options=OPENSSL_RAW_DATA, $iv);
    $texte_plein == $dechiffre?$return=true:$return=false;
    return $return;
};
?>
