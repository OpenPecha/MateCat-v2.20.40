<?php

class CJKLangUtils
{
    /**
     * @param string $string
     *
     * @return bool
     */
    public static function isCjk($string)
    {
        return self::isChinese($string) or self::isJapanese($string) or self::isKorean($string);
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public static function isChinese($string)
    {
        return self::check("/\p{Han}+/u", $string);
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public static function isJapanese($string)
    {
        return self::check('/[\x{3041}-\x{3096}\x{30A0}-\x{30FF}\x{3400}-\x{4DB5}\x{4E00}-\x{9FCB}\x{F900}-\x{FA6A}\x{2E80}-\x{2FD5}\x{FF5F}-\x{FF9F}\x{3000}-\x{303F}\x{31F0}-\x{31FF}\x{3220}-\x{3243}\x{3280}-\x{337F}-\x{FF01}-\x{FF5E}]/u', $string);
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public static function isKorean($string)
    {
        return self::check('/[\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u', $string);
    }

    /**
     * @param string $regex
     * @param string $string
     *
     * @return bool
     */
    private static function check( $regex, $string)
    {
        preg_match($regex, $string, $matches);

        return !empty($matches);
    }
}