<?php

namespace olcaytaner\Dictionary\Dictionary;

use Collator;
use Transliterator;

class Dictionary
{
    protected array $words = [];
    protected string $fileName;
    protected WordComparator $comparator = WordComparator::TURKISH;

    /**
     * Another constructor of {@link Dictionary} class which takes a {@link WordComparator} as an input and initializes
     * comparator variable with given input and also creates a new words {@link Array}.
     *
     * @param ?WordComparator $comparator {@link WordComparator} type input.
     */
    public function __construct(?WordComparator $comparator = null)
    {
        $this->comparator = $comparator;
    }

    static function wordCompareTurkish(Word $word1, Word $word2): int
    {
        $collator = new Collator('tr');
        return $collator->compare($word1->getName(), $word2->getName());
    }

    static function wordCompareEnglish(Word $word1, Word $word2): int
    {
        return strcmp($word1->getName(), $word2->getName());
    }

    static function wordCompareTurkishIgnoreCase(Word $word1, Word $word2): int
    {
        $collator = new Collator('tr');
        return $collator->compare(Transliterator::create("tr-Lower")->transliterate($word1->getName()), Transliterator::create("tr-Upper")->transliterate($word2->getName()));
    }

    protected function sort(): void
    {
        switch ($this->comparator){
            case WordComparator::TURKISH:
                usort($this->words, [TxtDictionary::class, "wordCompareTurkish"]);
                break;
            case WordComparator::ENGLISH:
                usort($this->words, [TxtDictionary::class, "wordCompareEnglish"]);
                break;
            case WordComparator::TURKISH_IGNORE_CASE:
                usort($this->words, [TxtDictionary::class, "wordCompareTurkishIgnoreCase"]);
                break;
        }
    }

    private function wordCompare(Word $word1, Word $word2): int{
        return match ($this->comparator) {
            WordComparator::TURKISH => self::wordCompareTurkish($word1, $word2),
            WordComparator::ENGLISH => self::wordCompareEnglish($word1, $word2),
            WordComparator::TURKISH_IGNORE_CASE => self::wordCompareTurkishIgnoreCase($word1, $word2),
            default => 0,
        };
    }

    /**
     * Checks if a given word exists in the dictionary by performing a binary search on the words array.
     * @param Word $word Searched word
     * @return int the index of the search word, if it is contained in the words array; otherwise, (-(insertion point) - 1). The
     * insertion point is defined as the point at which the word would be inserted into the words array.
     */
    protected function binarySearch(Word $word): int
    {
        $lo = 0;
        $hi = count($this->words) - 1;
        while ($lo <= $hi) {
            $mid = floor(($lo + $hi) / 2);
            if ($this->words[$mid]->getName() == $word->getName()) {
                return $mid;
            }
            if ($this->wordCompare($this->words[$mid], $word) <= 0) {
                $lo = $mid + 1;
            } else {
                $hi = $mid - 1;
            }
        }
        return -($lo + 1);
    }

    /**
     * The getWord method takes a String name as an input and performs binary search within words {@link Array} and assigns the result
     * to integer variable middle. If the middle is greater than 0, it returns the item at index middle of words {@link Array}, undefined otherwise.
     *
     * @param int $index String input.
     * @return Word the item at found index of words {@link Array}, undefined if cannot be found.
     */
    public function getWordWithIndex(int $index): Word
    {
        return $this->words[$index];
    }

    /**
     * The getWord method takes a String name as an input and performs binary search within words {@link Array} and assigns the result
     * to integer variable middle. If the middle is greater than 0, it returns the item at index middle of words {@link Array}, undefined otherwise.
     *
     * @param string $name String input.
     * @return ?Word the item at found index of words {@link Array}, undefined if cannot be found.
     */
    public function getWordWithName(string $name): ?Word
    {
        $middle = $this->binarySearch(new Word($name));
        if ($middle >= 0) {
            return $this->words[$middle];
        }
        return null;
    }

    /**
     * RemoveWord removes a word with the given name
     * @param string $name Name of the word to be removed.
     */
    public function removeWord(string $name): void
    {
        $middle = $this->binarySearch(new Word($name));
        if ($middle >= 0) {
            array_splice($this->words, $middle, 1);
        }
    }

    /**
     * The getWordIndex method takes a String name as an input and performs binary search within words {@link Array} and assigns the result
     * to integer variable middle. If the middle is greater than 0, it returns the index middle, -1 otherwise.
     *
     * @param string $name String input.
     * @return int found index of words {@link Array}, -1 if cannot be found.
     */
    public function getWordIndex(string $name): int
    {
        $middle = $this->binarySearch(new Word($name));
        if ($middle >= 0) {
            return $middle;
        }
        return -1;
    }

    /**
     * The size method returns the size of the words {@link Array}.
     *
     * @return int the size of the words {@link Array}.
     */
    public function size(): int
    {
        return count($this->words);
    }

    /**
     * The longestWordSize method loops through the words {@link Array} and returns the item with the maximum word length.
     *
     * @return int the item with the maximum word length.
     */
    public function longestWordSize(): int
    {
        $max = 0;
        foreach ($this->words as $word) {
            if (mb_strlen($word->getName()) > $max) {
                $max = mb_strlen($word->getName());
            }
        }
        return $max;
    }

    /**
     * The getWordStartingWith method takes a String hash as an input and performs binary search within
     * words {@link Array} and assigns the result to integer variable middle. If the middle is greater than 0, it
     * returns the index middle, -middle-1 otherwise.
     *
     * @param string $hash String input.
     * @return int found index of words {@link Array}, -middle-1 if cannot be found.
     */
    public function getWordStartingWith(string $hash): int
    {
        $middle = $this->binarySearch(new Word($hash));
        if ($middle >= 0) {
            return $middle;
        } else {
            return -$middle - 1;
        }
    }
}