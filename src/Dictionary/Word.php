<?php

namespace olcaytaner\Dictionary\Dictionary;

use olcaytaner\Dictionary\Language\TurkishLanguage;
use Transliterator;

class Word
{
    protected string $name;

    /**
     * A constructor of {@link Word} class which gets a String name as an input and assigns to the name variable.
     *
     * @param string $name String input.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * The overridden toString method returns the name variable.
     *
     * @return string the name variable.
     */
    public function toString(): string
    {
        return $this->name;
    }

    /**
     * The charCount method returns the length of name variable.
     *
     * @return int the length of name variable.
     */
    public function charCount(): int
    {
        return mb_strlen($this->name);
    }

    /**
     * Getter for the name variable.
     *
     * @return string name variable.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Setter for the name variable.
     *
     * @param string $name String input.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * The beforeLastVowel method takes a {@link String} stem as an input. It loops through the given stem and returns
     * the second last vowel.
     *
     * @param string $stem String input.
     * @return string Vowel before the last vowel.
     */
    public static function beforeLastVowel(string $stem): string
    {
        $before = 1;
        $last = '0';
        for ($i = mb_strlen($stem) - 1; $i >= 0; $i--) {
            if (TurkishLanguage::isVowel(mb_substr($stem, $i, 1))) {
                if ($before == 1) {
                    $last = mb_substr($stem, $i, 1);
                    $before--;
                    continue;
                }
                return mb_substr($stem, $i, 1);
            }
        }
        return $last;
    }

    /**
     * The lastVowel method takes a {@link String} stem as an input. It loops through the given stem and returns
     * the last vowel.
     *
     * @param string $stem String input.
     * @return string the last vowel.
     */
    public static function lastVowel(string $stem): string
    {
        for ($i = mb_strlen($stem) - 1; $i >= 0; $i--) {
            if (TurkishLanguage::isVowel(mb_substr($stem, $i, 1))) {
                return mb_substr($stem, $i, 1);
            }
        }
        for ($i = mb_strlen($stem) - 1; $i >= 0; $i--) {
            if (mb_substr($stem, $i, 1) >= "0" && mb_substr($stem, $i, 1) <= "9") {
                return mb_substr($stem, $i, 1);
            }
        }
        return '0';
    }

    /**
     * The lastPhoneme method takes a {@link String} stem as an input. It then returns the last phoneme of the given stem.
     *
     * @param string $stem String input.
     * @return string the last phoneme.
     */
    public static function lastPhoneme(string $stem): string
    {
        if (mb_strlen($stem) == 0) {
            return ' ';
        }
        if (mb_substr($stem, mb_strlen($stem) - 1, 1) != "'") {
            return mb_substr($stem, mb_strlen($stem) - 1, 1);
        } else {
            return mb_substr($stem, mb_strlen($stem) - 2, 1);
        }
    }

    /**
     * The isCapital method takes a String surfaceForm as an input and returns true if the character at first index of surfaceForm
     * is a capital letter, false otherwise.
     *
     * @param string $surfaceForm String input to check the first character.
     * @return bool true if the character at first index of surfaceForm is a capital letter, false otherwise.
     */
    public static function isCapital(string $surfaceForm): bool
    {
        return str_contains(TurkishLanguage::$UPPERCASE_LETTERS, mb_substr($surfaceForm, 0, 1));
    }

    /**
     * The isPunctuation method takes a String surfaceForm as an input and returns true if it is a punctuation, false otherwise.
     * Grave accent : \u0060
     * Left quotation mark : \u201C
     * Right quotation mark : \u201D
     * Left single quotation mark : \u2018
     *Horizontal ellipsis : \u2026
     *
     * @param string $surfaceForm String input to check.
     * @return bool true if it is a punctuation, false otherwise.
     */
    public static function isPunctuationSymbol(string $surfaceForm): bool
    {
        return ($surfaceForm == "." || $surfaceForm == "..." || $surfaceForm == "[" || $surfaceForm == "]" ||
            $surfaceForm == "\u2026" || $surfaceForm == "%" || $surfaceForm == "&" || $surfaceForm == "=" ||
            $surfaceForm == "\u0060\u0060" || $surfaceForm == "\u0060" || $surfaceForm == "''" || $surfaceForm == "$" ||
            $surfaceForm == "!" || $surfaceForm == "?" || $surfaceForm == "," || $surfaceForm == ":" ||
            $surfaceForm == "--" || $surfaceForm == ";" || $surfaceForm == "(" || $surfaceForm == ")" ||
            $surfaceForm == "'" || $surfaceForm == "\"" || $surfaceForm == "\u201C" || $surfaceForm == "\u2018" ||
            $surfaceForm == "\u201D" || $surfaceForm == "…" || $surfaceForm == "\u25CF" || $surfaceForm == "/" ||
            $surfaceForm == "-" || $surfaceForm == "+" || $surfaceForm == "-LRB-" || $surfaceForm == "-RRB-" ||
            $surfaceForm == "-LCB-" || $surfaceForm == "-RCB-" || $surfaceForm == "-LSB-" || $surfaceForm == "-RSB-");
    }

    /**
     * The isHonorific method takes a String surfaceForm as an input and after converting it to lower case it returns true
     * if it equals to "bay" or "bayan", false otherwise.
     *
     * @param string $surfaceForm String input to check.
     * @return bool true if it equals to "bay" or "bayan", false otherwise.
     */
    public static function isHonorific(string $surfaceForm): bool
    {
        $lowerCase = strtolower($surfaceForm);
        return $lowerCase == "bay" || $lowerCase == "bayan";
    }

    /**
     * The isOrganization method takes a String surfaceForm as an input and after converting it to lower case it returns true
     * if it equals to "şirket", "corp", "inc.", or "co.", and false otherwise.
     *
     * @param string $surfaceForm String input to check.
     * @return bool true if it equals to "şirket", "corp", "inc.", or "co.", and false otherwise.
     */
    public static function isOrganization(string $surfaceForm): bool
    {
        $lowerCase = strtolower($surfaceForm);
        return $lowerCase == "corp" || $lowerCase == "inc." || $lowerCase == "co.";
    }

    /**
     * The isMoney method takes a String surfaceForm as an input and after converting it to lower case it returns true
     * if it equals to one of the dolar, sterlin, paunt, ons, ruble, mark, frank, yan, sent, yen' or $, and false otherwise.
     *
     * @param string $surfaceForm String input to check.
     * @return bool true if it equals to one of the dolar, sterlin, paunt, ons, ruble, mark, frank, yan, sent, yen' or $, and false otherwise.
     */
    public static function isMoney(string $surfaceForm): bool
    {
        $lowerCase = strtolower($surfaceForm);
        return str_starts_with($lowerCase, "dolar") || str_starts_with($lowerCase, "sterlin") || str_starts_with($lowerCase, "paunt")
            || str_starts_with($lowerCase, "ons") || str_starts_with($lowerCase, "ruble") || str_starts_with($lowerCase, "mark") ||
            str_starts_with($lowerCase, "frank") || $lowerCase == "yen" || str_starts_with($lowerCase, "sent") ||
            str_starts_with($lowerCase, "cent") || str_starts_with($lowerCase, "yen'") || str_contains($lowerCase, "$");
    }

    /**
     * Converts the given string into its capital form
     * @param string $surfaceForm Given string which will be converted to its capital form
     * @return string Capitalized form of the input string.
     */
    public static function toCapital(string $surfaceForm): string
    {
        return Transliterator::create("tr-Upper")->transliterate(mb_substr($surfaceForm, 0, 1)) . mb_substr($surfaceForm, 1);
    }

    /**
     * The isPunctuation method without any argument, it checks name variable whether it is a punctuation or not and
     * returns true if so.
     *
     * @return bool true if name is a punctuation.
     */
    public function isPunctuation(): bool{
        return Word::isPunctuationSymbol($this->name);
    }

    /**
     * The isTime method takes a String surfaceForm as an input and after converting it to lower case it checks some cases.
     * If it is in the form of 12:23:34 or 12:23 it returns true.
     * If it starts with name of months; ocak, şubat, mart, nisan, mayıs, haziran, temmuz, ağustos, eylül, ekim, kasım, aralık it returns true.
     * If it equals to the name of days; pazar, pazartesi, salı, çarşamba, perşembe, cuma, cumartesi it returns true.
     *
     * @param string $surfaceForm String input to check.
     * @return bool true if it presents time, and false otherwise.
     */
    public static function isDateTime(string $surfaceForm): bool{
        $lowerCase = mb_strtolower($surfaceForm, 'utf-8');
        if (preg_match("/^(\\d\\d|\\d):(\\d\\d|\\d):(\\d\\d|\\d)$/", $lowerCase) === 1 || preg_match("/^(\\d\\d|\\d):(\\d\\d|\\d)$/", $lowerCase) === 1) {
            return true;
        }
        if (str_starts_with($lowerCase, "ocak") || str_starts_with($lowerCase, "şubat") || str_starts_with($lowerCase, "mart") ||
            str_starts_with($lowerCase, "nisan") || str_starts_with($lowerCase, "mayıs") || str_starts_with($lowerCase, "haziran") ||
            str_starts_with($lowerCase, "temmuz") || str_starts_with($lowerCase, "ağustos") || str_starts_with($lowerCase, "eylül") ||
            str_starts_with($lowerCase, "ekim") || str_starts_with($lowerCase, "kasım") || $lowerCase == "aralık") {
            return true;
        }
        if ($lowerCase == "pazar" || $lowerCase == "salı" || str_starts_with($lowerCase, "çarşamba") ||
            str_starts_with($lowerCase, "perşembe") || $lowerCase == "cuma" || str_starts_with($lowerCase, "cumartesi") ||
            str_starts_with($lowerCase, "pazartesi")) {
            return true;
        }
        if (str_contains($lowerCase, "'")) {
            $lowerCase = mb_substr($lowerCase, 0, mb_stripos($lowerCase, "'"));
        }
        if (is_numeric($lowerCase) && ((int)($lowerCase)) > 1900 && ((int)($lowerCase)) < 2200) {
            return true;
        }
        return false;
    }

    /**
     * The toWordArray method takes a String {@link Array} sourceArray as an input. First it creates
     * a {@link Word} type result array and puts items of input sourceArray to this result {@link Array}.
     *
     * @param array $sourceArray String {@link Array}.
     * @return array Word type {@link Array}.
     */
    public static function toWordArray(array $sourceArray): array
    {
        $result = [];
        foreach ($sourceArray as $source) {
            $result[] = new Word($source);
        }
        return $result;
    }

    /**
     * The toCharacters method creates a {@link Word} type characters {@link Array} and adds characters of name variable
     * to newly created {@link Array}.
     *
     * @return array Word type {@link Array}.
     */
    public function toCharacters(): array{
        $characters = [];
        for ($i = 0; $i < mb_strlen($this->name); $i++) {
            $characters[] = new Word(mb_substr($this->name, $i, 1));
        }
        return $characters;
    }
}