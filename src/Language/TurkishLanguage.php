<?php

namespace olcaytaner\Dictionary\Language;

class TurkishLanguage extends Language
{
    public static string $VOWELS = "aeıioöuüâî";
    public static string $BACK_VOWELS = "aıouâ";
    public static string $FRONT_VOWELS = "eiöüî";
    public static string $BACK_ROUNDED_VOWELS = "ou";
    public static string $BACK_UNROUNDED_VOWELS = "aıâ";
    public static string $FRONT_ROUNDED_VOWELS = "öü";
    public static string $FRONT_UNROUNDED_VOWELS = "eiî";
    public static string $CONSONANT_DROPS = "nsy";
    public static string $CONSONANTS = "bcçdfgğhjklmnprsştvyzxqw";
    public static string $SERT_SESSIZ = "çfhkpsşt";
    public static string $LOWERCASE_LETTERS = "abcçdefgğhıijklmnoöprsştuüvyz";
    public static string $UPPERCASE_LETTERS = "ABCÇDEFGĞHIİJKLMNOÖPRSŞTUÜVYZ";
    public static string $LETTERS = "abcçdefgğhıijklmnoöprsştuüvyzABCÇDEFGĞHIİJKLMNOÖPRSŞTUÜVYZ";

    /**
     * The isVowel method takes a character as an input and returns true if given character is a vowel.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a vowel.
     */
    public static function isVowel(string $ch): bool
    {
        return str_contains(TurkishLanguage::$VOWELS, $ch);
    }

    /**
     * The isBackVowel method takes a character as an input and returns true if given character is a back vowel.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a back vowel.
     */
    public static function isBackVowel(string $ch): bool
    {
        return str_contains(TurkishLanguage::$BACK_VOWELS, $ch);
    }

    /**
     * The isFrontVowel method takes a character as an input and returns true if given character is a front vowel.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a front vowel.
     */
    public static function isFrontVowel(string $ch): bool
    {
        return str_contains(TurkishLanguage::$FRONT_VOWELS, $ch);
    }

    /**
     * The isBackRoundedVowel method takes a character as an input and returns true if given character is a back rounded vowel.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a back rounded vowel.
     */
    public static function isBackRoundedVowel(string $ch): bool
    {
        return str_contains(TurkishLanguage::$BACK_ROUNDED_VOWELS, $ch);
    }

    /**
     * The isFrontRoundedVowel method takes a character as an input and returns true if given character is a front rounded vowel.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a front rounded vowel.
     */
    public static function isFrontRoundedVowel(string $ch): bool
    {
        return str_contains(TurkishLanguage::$FRONT_ROUNDED_VOWELS, $ch);
    }

    /**
     * The isBackUnroundedVowel method takes a character as an input and returns true if given character is a back unrounded vowel.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a back unrounded vowel.
     */
    public static function isBackUnroundedVowel(string $ch): bool
    {
        return str_contains(TurkishLanguage::$BACK_UNROUNDED_VOWELS, $ch);
    }

    /**
     * The isFrontUnroundedVowel method takes a character as an input and returns true if given character is a front unrounded vowel.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a front unrounded vowel.
     */
    public static function isFrontUnroundedVowel(string $ch): bool
    {
        return str_contains(TurkishLanguage::$FRONT_UNROUNDED_VOWELS, $ch);
    }

    /**
     * The isConsonantDrop method takes a character as an input and returns true if given character is a dropping consonant.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a dropping consonant.
     */
    public static function isConsonantDrop(string $ch): bool
    {
        return str_contains(TurkishLanguage::$CONSONANT_DROPS, $ch);
    }

    /**
     * The isConsonant method takes a character as an input and returns true if given character is a consonant.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a consonant.
     */
    public static function isConsonant(string $ch): bool
    {
        return str_contains(TurkishLanguage::$CONSONANTS, $ch);
    }

    /**
     * The isSertSessiz method takes a character as an input and returns true if given character is a sert sessiz.
     *
     * @param string $ch {@link Character} input to check.
     * @return bool true if given character is a sert sessiz.
     */
    public static function isSertSessiz(string $ch): bool
    {
        return str_contains(TurkishLanguage::$SERT_SESSIZ, $ch);
    }
}