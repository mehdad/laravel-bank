<?php

namespace App\Services;

class TextService
{
    public static function convertDigitsToEnglish(string $text): string
    {
        $persianArabicDigits = array("۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹", "۰", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩", "٠");
        $englishDigits = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        return str_replace($persianArabicDigits, $englishDigits, $text);
    }

}
