<?php
// Encryption function
function encryptText($plaintext, $key) {
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    
    // Encrypt the plaintext using AES encryption with CBC mode
    $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    
    // Combine the IV and ciphertext and encode as base64
    $encryptedText = base64_encode($iv . $ciphertext);
    
    return $encryptedText;
}

// Decryption function
function decryptText($encryptedText, $key) {
    // Decode the base64 encoded string
    $encryptedData = base64_decode($encryptedText);
    
    // Extract the IV and ciphertext
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($encryptedData, 0, $ivLength);
    $ciphertext = substr($encryptedData, $ivLength);
    
    // Decrypt the ciphertext using AES decryption with CBC mode
    $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    
    return $plaintext;
}

// Define your secret key
$key = "YourSecretKey123"; // Change this to your secret key

// Text to encrypt
$plaintext = "Hello World";

// Encrypt the text
$encryptedText = encryptText($plaintext, $key);
echo "Encrypted text: " . $encryptedText . "\n";

// Decrypt the text
$decryptedText = decryptText($encryptedText, $key);
echo "Decrypted text: " . $decryptedText . "\n";
?>

