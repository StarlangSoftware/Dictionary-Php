<?php

namespace olcaytaner\Dictionary\Dictionary;

use olcaytaner\Math\Vector;

class VectorizedDictionary extends Dictionary
{

    /**
     * A constructor of {@link VectorizedDictionary} class which takes a {@link WordComparator} as an input and calls its
     * super class {@link Dictionary} with {@link WordComparator} input.
     *
     * @param WordComparator $comparator {@link WordComparator} type input.
     * @param ?string $fileName Name of the file to be read
     */
    public function __construct(WordComparator $comparator, ?string $fileName = null){
        parent::__construct($comparator);
        if ($fileName !== null) {
            $file = fopen($fileName, "r");
            while ($line = fgets($file)) {
                $items = explode(" ", trim($line));
                $vector = new Vector(0, 0);
                for ($i = 1; $i < count($items); $i++) {
                    $vector->add($items[$i]);
                }
                $vectorizedWord = new VectorizedWord($items[0], $vector);
                $this->words[] = $vectorizedWord;
            }
            fclose($file);
            $this->sort();
        }
    }

    /**
     * The addWord method takes a {@link VectorizedWord} as an input and adds it to the words {@link Array}.
     *
     * @param VectorizedWord $word {@link VectorizedWord} input.
     */
    public function addWord(VectorizedWord $word){
        $this->words[] = $word;
    }

    /**
     * The mostSimilarWord method takes a String name as an input, declares a maxDistance as -MAX_VALUE and creates a
     * {@link VectorizedWord} word by getting the given name from words {@link Array}. Then, it loops through the
     * words {@link Array} and if the current word is not equal to given input it calculates the distance between current
     * word and given word by using dot product and updates the maximum distance. It then returns the result
     * {@link VectorizedWord} which holds the most similar word to the given word.
     *
     * @param string $name String input.
     * @return ?VectorizedWord VectorizedWord type result which holds the most similar word to the given word.
     */
    public function mostSimilarWord(string $name): ?VectorizedWord{
        $maxSimilarity = -PHP_FLOAT_MAX;
        $result = null;
        $word = $this->getWordWithName($name);
        if ($word === null) {
            return null;
        }
        foreach ($this->words as $current) {
            if ($word instanceof VectorizedWord && $current instanceof VectorizedWord && $current->getName() != $word->getName()) {
                $similarity = $word->getVector()->cosineSimilarity($current->getVector());
                if ($similarity > $maxSimilarity) {
                    $maxSimilarity = $similarity;
                    $result = $current;
                }
            }
        }
        return $result;
    }

}