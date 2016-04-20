<?php
 const METHOD = 'aes-256-cbc';
function strtohex($x) 
    {
        $s='';
        foreach (str_split($x) as $c) $s.=sprintf("%02X",ord($c));
        return($s);
    } 
$textToEncrypt = <<<EOD
My super secret information.
hello this is abhishek yadav.
software sucks.
EOD;
echo $textToEncrypt."<br>";
$encryptionMethod = "AES-256-CBC";  // AES method is used by  the U.S. gov't to encrypt top secret documents.
$secretHash = "ankit";
//$secretHash = strtohex($secretHash);
echo $secretHash."<br>";

  $ivsize = openssl_cipher_iv_length(METHOD);
  $iv = openssl_random_pseudo_bytes($ivsize);
  $ciphertext = openssl_encrypt($textToEncrypt,METHOD,$secretHash,OPENSSL_RAW_DATA,$iv);
  $ciphertext = $iv.$ciphertext;
  echo $ciphertext."<br>";
       

  $fp = fopen( "/var/www/html/patients/a.txt","wb");//store  encrypted in another file 
  fwrite($fp,$ciphertext);
  fclose($fp);
  $fp = fopen( "/var/www/html/patients/a.txt","r");
  $ciphertext = fread($fp,filesize("/var/www/html/patients/a.txt"));
   $iv = mb_substr($ciphertext, 0, $ivsize, '8bit');
        $ciphertext = mb_substr($ciphertext, $ivsize, null, '8bit');
        
  $temp=openssl_decrypt($ciphertext,METHOD,$secretHash,OPENSSL_RAW_DATA,$iv);//temp variable to store decrypt entities
  echo $temp."<br>";

  
  //echo md5("a");
?>