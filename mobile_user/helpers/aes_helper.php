<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

// + ------------------------------------------------------------
// | AES加密规则
// + ------------------------------------------------------------
if ( ! function_exists('aes_encode'))
{
	function aes_encode($data, $key)
    {
        $srcdata = $data;
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
        
        $block_size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $padding_char = $block_size - (strlen($srcdata) % $block_size);
        $srcdata .= str_repeat(chr($padding_char), $padding_char);
        
        $plaintext = $srcdata;
        
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext, MCRYPT_MODE_CBC, $iv);
        
        return base64_encode($ciphertext . $iv);
    }
}


if ( ! function_exists('aes_decode'))
{
	function aes_decode($data, $key)
    {
        $data = base64_decode($data);
        $ivsize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $secsize = strlen($data) - $ivsize;
        
        $sec = substr($data, 0, $secsize);
        $iv = substr($data, $secsize);
        
        $paded = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $sec, MCRYPT_MODE_CBC, $iv);
        $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $len = strlen($paded);
        $pad = ord($paded[$len-1]);
        return substr($paded, 0, $len - $pad);
    }
}