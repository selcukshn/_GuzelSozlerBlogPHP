<?php

namespace security;

class hash
{
    private const CIPHER = "aes-128-cbc";
    private const KEY = "45lck5hn6";

    static function sha256($var)
    {
        return hash("sha256", hash("sha256", $var));
    }

    static function encrypt($value)
    {
        return @openssl_encrypt($value, self::CIPHER, self::KEY);
    }
    static function decrypt($value)
    {
        return openssl_decrypt($value, self::CIPHER, self::KEY);
    }
}
