<?php

namespace olcaytaner\Dictionary\Syllibification;

use olcaytaner\Dictionary\Language\TurkishLanguage;

class SyllableList
{
    private array $syllables;

    /**
     * A constructor of {@link SyllableList} class which takes a String word as an input. First it creates a syllable {@link Array}
     * and a {@link string} sbSyllable. Then it loops i times, where i ranges from 0 to length of given word, first
     * it gets the ith character of given word and checks whether it is a vowel and the last character of the word.
     * <p>
     * If it is a vowel it appends it to the sbSyllable and if it is the last vowel it also appends the next character to the sbSyllable.
     * Then, it adds the sbSyllable tot he syllables {@link Array}.
     * <p>
     * If it is not a vowel, and the sbSyllable's length is 1 also the previous character is a consonant it gets the last item of
     * syllables {@link Array} since there cannot be a Turkish word which starts with two consonants. However, if it is
     * two last characters of word, then it adds it to the syllable {@link Array}. At the end, it updates the syllables {@link Array}.
     *
     * @param string $word String input.
     */
    public function __construct(string $word){
        $this->syllables = [];
        $sbSyllable = "";
        for ($i = 0; $i < mb_strlen($word); $i++) {
            $c = mb_substr($word, $i, 1);
            $isVowel = TurkishLanguage::isVowel($c);
            $isLastChar = $i == mb_strlen($word) - 1;
            if ($isVowel) {
                $sbSyllable .= $c;
                // If it is the last vowel.
                if ($i == mb_strlen($word) - 2) {
                    $sbSyllable .= mb_substr($word, $i + 1, 1);
                    $i++;
                }
                $this->syllables[] = new Syllable($sbSyllable);
                $sbSyllable = "";
            } else {
                // A syllable should not start with two consonants.
                $tempSyl = $sbSyllable;
                if (mb_strlen($tempSyl) == 1) {
                    // The previous character was also a consonant.
                    if (!TurkishLanguage::isVowel(mb_substr($tempSyl, 0, 1))) {
                        if (count($this->syllables) == 0){
                            $sbSyllable .= $c;
                            continue;
                        }
                        $lastPos = count($this->syllables) - 1;
                        $str = $this->syllables[$lastPos]->getText();
                        $str = $str . $tempSyl;
                        if ($isLastChar) {
                            // If the last char is also a consonant, add it to latest syllable. Ex: 'park'.
                            $str = $str . $c;
                        }
                        // Update previous syllable.
                        array_splice($this->syllables, $lastPos, 1, [new Syllable($str)]);
                        $sbSyllable = "";
                    }
                }
                $sbSyllable .= $c;
            }
        }
    }

    /**
     * The getSyllables method creates a new {@link Array} syllables and loops through the globally defined syllables
     * {@link Array} and adds each item to the newly created syllables {@link Array}.
     *
     * @return array ArrayList syllables.
     */
    public function getSyllables(): array{
        $syllables = [];
        foreach ($this->syllables as $syllable) {
            $syllables[] = $syllable->getText();
        }
        return $syllables;
    }
}