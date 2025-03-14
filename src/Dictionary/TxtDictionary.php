<?php

namespace olcaytaner\Dictionary\Dictionary;

use olcaytaner\Dictionary\Dictionary\Trie\Trie;
use olcaytaner\Util\FileUtils;

class TxtDictionary extends Dictionary
{
    private array $misspelledWords = [];

    /**
     * Another constructor of {@link TxtDictionary} class which takes a String filename, a {@link WordComparator} and
     * a misspelled word dictionary file as inputs. And calls its super class {@link Dictionary} with given
     * {@link WordComparator}, assigns given filename input to the filename variable. Then, it calls loadFromText
     * method with given filename. It also loads the misspelling file.
     *
     * @param string $fileName String input.
     * @param WordComparator $comparator {@link WordComparator} input.
     * @param string $misspelledFileName String input.
     * @param string $morphologicalLexicon String input.
     */
    public function __construct(WordComparator $comparator = WordComparator::TURKISH,
                                string         $fileName = "../turkish_dictionary.txt",
                                ?string         $misspelledFileName = "../turkish_misspellings.txt",
                                ?string         $morphologicalLexicon = "../turkish_morphological_lexicon.txt")
    {
        parent::__construct($comparator);
        $this->loadFromText($fileName);
        if ($misspelledFileName != null){
            $this->loadMisspelledWords($misspelledFileName);
        }
        if ($morphologicalLexicon != null){
            $this->loadMorphologicalLexicon($morphologicalLexicon);
        }
    }

    /**
     * The loadFromText method takes a String filename as an input. It reads given file line by line and splits
     * according to space and assigns each word to the String array. Then, adds these word with their flags to the
     * words {@link Array}. At the end it sorts the words {@link Array}.
     *
     * @param string $fileName File input.
     */
    private function loadFromText(string $fileName): void
    {
        $file = fopen($fileName, "r");
        while ($line = fgets($file)) {
            $list = explode(" ", trim($line));
            if (count($list) > 0) {
                $currentWord = new TxtWord($list[0]);
                for ($i = 1; $i < count($list); $i++) {
                    $currentWord->addFlag($list[$i]);
                }
                $this->words[] = $currentWord;
            }
        }
        fclose($file);
        $this->sort();
    }

    /**
     * The loadMisspellWords method takes a String filename as an input. It reads given file line by line and splits
     * according to space and assigns each word with its misspelled form to the the misspelledWords hashMap.
     *
     * @param string $misspelledFileName File stream input.
     */
    private function loadMisspelledWords(string $misspelledFileName): void
    {
        $this->misspelledWords = FileUtils::readHashMap($misspelledFileName);
    }

    /**
     * Loads the morphological lexicon of a given language. Only Turkish is currently supported. Morphological lexicon
     * contains subwords (possibly meaningful words or metamorphemes) of each root word in the Turkish dictionary. For
     * example, abacılık has subwords aba+CH+LHK.
     * @param string $fileName Morphological lexicon file
     */
    private function loadMorphologicalLexicon(string $fileName): void
    {
        $file = fopen($fileName, "r");
        while ($line = fgets($file)) {
            $list = explode(" ", trim($line));
            if (count($list) == 2) {
                $word = $this->getWordWithName($list[0]);
                if ($word instanceof TxtWord) {
                    $word->setMorphology($list[1]);
                }
            }
        }
        fclose($file);
    }

    /**
     * The addWithFlag method takes a String name and a flag as inputs. First it creates a {@link TxtWord} word, then if
     * given name is not in words {@link Array} it creates new {@link TxtWord} with given name and assigns it to
     * the word and adds given flag to the word, it also add newly created word to the words {@link Array}'s index
     * found by performing a binary search and return true at the end. If given name is in words {@link Array},
     * it adds it the given flag to the $word.
     *
     * @param string $name String input.
     * @param string $flag String flag.
     * @return bool true if given name is in words {@link Array}, false otherwise.
     */
    public function addWithFlag(string $name, string $flag): bool
    {
        if ($this->getWordWithName(mb_strtolower($name, "utf-8")) === null) {
            $word = $this->getWordWithName(mb_strtolower($name, "utf-8"));
            if ($word instanceof TxtWord) {
                $word->addFlag($flag);
            }
            $insertIndex = -$this->binarySearch($word) - 1;
            if ($insertIndex >= 0) {
                array_splice($this->words, $insertIndex, 0, [$word]);
            }
            return true;
        } else {
            $word = $this->getWordWithName(mb_strtolower($name, "utf-8"));
            if ($word instanceof TxtWord && !$word->containsFlag($flag)) {
                $word->addFlag($flag);
            }
        }
        return false;
    }

    /**
     * The addNumber method takes a String name and calls addWithFlag method with given name and IS_SAYI flag.
     *
     * @param string $name String input.
     */
    public function addNumber(string $name): void
    {
        $this->addWithFlag($name, "IS_SAYI");
    }

    /**
     * The addRealNumber method takes a String name and calls addWithFlag method with given name and IS_REELSAYI flag.
     *
     * @param string $name String input.
     */
    public function addRealNumber(string $name): void
    {
        $this->addWithFlag($name, "IS_REALSAYI");
    }

    /**
     * The addFraction method takes a String name and calls addWithFlag method with given name and IS_KESIR flag.
     *
     * @param string $name String input.
     */
    public function addFraction(string $name): void
    {
        $this->addWithFlag($name, "IS_KESIR");
    }

    /**
     * The addTime method takes a String name and calls addWithFlag method with given name and IS_ZAMAN flag.
     *
     * @param string $name String input.
     */
    public function addTime(string $name): void
    {
        $this->addWithFlag($name, "IS_ZAMAN");
    }

    /**
     * The addProperNoun method takes a String name and calls addWithFlag method with given name and IS_OA flag.
     *
     * @param string $name String input.
     * @return bool true if given name is in words {@link Array}, false otherwise.
     */
    public function addProperNoun(string $name): bool
    {
        return $this->addWithFlag($name, "IS_OA");
    }

    /**
     * The addNoun method takes a String name and calls addWithFlag method with given name and CL_ISIM flag.
     *
     * @param string $name String input.
     * @return bool true if given name is in words {@link Array}, false otherwise.
     */
    public function addNoun(string $name): bool
    {
        return $this->addWithFlag($name, "CL_ISIM");
    }

    /**
     * The addVerb method takes a String name and calls addWithFlag method with given name and CL_FIIL flag.
     *
     * @param string $name String input.
     * @return bool true if given name is in words {@link Array}, false otherwise.
     */
    public function addVerb(string $name): bool
    {
        return $this->addWithFlag($name, "CL_FIIL");
    }

    /**
     * The addAdjective method takes a String name and calls addWithFlag method with given name and IS_ADJ flag.
     *
     * @param string $name String input.
     * @return bool true if given name is in words {@link Array}, false otherwise.
     */
    public function addAdjective(string $name): bool
    {
        return $this->addWithFlag($name, "IS_ADJ");
    }

    /**
     * The addAdverb method takes a String name and calls addWithFlag method with given name and IS_ADVERB flag.
     *
     * @param string $name String input.
     * @return bool true if given name is in words {@link Array}, false otherwise.
     */
    public function addAdverb(string $name): bool
    {
        return $this->addWithFlag($name, "IS_ADVERB");
    }

    /**
     * The addPronoun method takes a String name and calls addWithFlag method with given name and IS_ZM flag.
     *
     * @param string $name String input.
     * @return bool true if given name is in words {@link Array}, false otherwise.
     */
    public function addPronoun(string $name): bool
    {
        return $this->addWithFlag($name, "IS_ZM");
    }

    /**
     * The getCorrectForm returns the correct form of a misspelled $word->
     * @param string $misspelledWord Misspelled form.
     * @return ?string Correct form.
     */
    public function getCorrectForm(string $misspelledWord): ?string
    {
        if (isset($this->misspelledWords[$misspelledWord])) {
            return $this->misspelledWords[$misspelledWord];
        }
        return null;
    }

    /**
     * The addWordWhenRootSoften is used to add word to Trie whose last consonant will be soften.
     * For instance, in the case of Dative Case Suffix, the word is 'müzik' when '-e' is added to the word, the last
     * char is drooped and root became 'müzi' and by changing 'k' into 'ğ' the word transformed into 'müziğe' as in the
     * example of 'Herkes müziğe doğru geldi'.
     * <p>
     * In the case of accusative, possessive of third person and a derivative suffix, the word is 'kanat' when '-i' is
     * added to word, last char is dropped, root became 'kana' then 't' transformed into 'd' and added to Trie. The word is
     * changed into 'kanadı' as in the case of 'Kuşun kırık kanadı'.
     *
     * @param Trie $trie the name of the Trie to add the $word->
     * @param string $last the last char of the word to be soften.
     * @param string $root the substring of the word whose last one or two chars are omitted from the word to bo softed.
     * @param TxtWord $word the original $word->
     */
    private function addWordWhenRootSoften(Trie $trie, string $last, string $root, TxtWord $word): void
    {
        switch ($last) {
            case "p":
                $trie->addWord($root . "b", $word);
                break;
            case "ç":
                $trie->addWord($root . "c", $word);
                break;
            case "t":
                $trie->addWord($root . "d", $word);
                break;
            case "k":
            case "g":
                $trie->addWord($root . "ğ", $word);
                break;
        }
    }

    /**
     * The prepareTrie method is used to create a Trie with the given dictionary. First, it gets the word from dictionary,
     * then checks some exceptions like 'ben' which does not fit in the consonant softening rule and transforms into 'bana',
     * and later on it generates a root by removing the last char from the word however if the length of the word is greater
     * than 1, it also generates the root by removing the last two chars from the word.
     * <p>
     * Then, it gets the last char of the root and adds root and word to the result Trie. There are also special cases such as;
     * lastIdropsDuringSuffixation condition, if it is true then addWordWhenRootSoften method will be used rather than addWord.
     * Ex : metin + i = metni
     * isPortmanteauEndingWithSI condition, if it is true then addWord method with rootWithoutLastTwo will be used.
     * Ex : ademelması + lar = ademelmaları
     * isPortmanteau condition, if it is true then addWord method with rootWithoutLast will be used.
     * Ex : mısıryağı + lar = mısıryağları
     * vowelEChangesToIDuringYSuffixation condition, if it is then addWord method with rootWithoutLast will be used
     * depending on the last char whether it is 'e' or 'a'.
     * Ex : ye + iniz - yiyiniz
     * endingKChangesIntoG condition, if it is true then addWord method with rootWithoutLast will be used with added 'g'.
     * Ex : ahenk + i = ahengi
     *
     * @return Trie the resulting Trie.
     */
    public function prepareTrie(): Trie
    {
        $result = new Trie();
        $lastBefore = " ";
        for ($i = 0; $i < $this->size(); $i++) {
            $word = $this->getWordWithIndex($i);
            if ($word instanceof TxtWord) {
                $root = $word->getName();
                $length = mb_strlen($root);
                if ($root == "ben") {
                    $result->addWord("bana", $word);
                }
                if ($root == "sen") {
                    $result->addWord("sana", $word);
                }
                $rootWithoutLast = mb_substr($root, 0, $length - 1);
                if ($length > 1) {
                    $rootWithoutLastTwo = mb_substr($root, 0, $length - 2);
                } else {
                    $rootWithoutLastTwo = "";
                }
                if ($length > 1) {
                    $lastBefore = mb_substr($root, $length - 2, 1);
                }
                $last = mb_substr($root, $length - 1, 1);
                $result->addWord($root, $word);
                if ($word->lastIdropsDuringSuffixation() || $word->lastIdropsDuringPassiveSuffixation()) {
                    if ($word->rootSoftenDuringSuffixation()) {
                        $this->addWordWhenRootSoften($result, $last, $rootWithoutLastTwo, $word);
                    } else {
                        $result->addWord($rootWithoutLastTwo . $last, $word);
                    }
                }
                // NominalRootNoPossesive
                if ($word->isPortmanteauEndingWithSI()) {
                    $result->addWord($rootWithoutLastTwo, $word);
                }
                if ($word->rootSoftenDuringSuffixation()) {
                    $this->addWordWhenRootSoften($result, $last, $rootWithoutLast, $word);
                }
                if ($word->isPortmanteau()) {
                    if ($word->isPortmanteauFacedVowelEllipsis()) {
                        $result->addWord($rootWithoutLastTwo . $last . $lastBefore, $word);
                    } else {
                        if ($word->isPortmanteauFacedSoftening()) {
                            switch ($lastBefore) {
                                case 'b':
                                    $result->addWord($rootWithoutLastTwo . 'p', $word);
                                    break;
                                case 'c':
                                    $result->addWord($rootWithoutLastTwo . 'ç', $word);
                                    break;
                                case 'd':
                                    $result->addWord($rootWithoutLastTwo . 't', $word);
                                    break;
                                case 'ğ':
                                    $result->addWord($rootWithoutLastTwo . 'k', $word);
                                    break;
                            }
                        } else {
                            $result->addWord($rootWithoutLast, $word);
                        }
                    }
                }
                if ($word->vowelEChangesToIDuringYSuffixation() || $word->vowelAChangesToIDuringYSuffixation()) {
                    switch ($last) {
                        case 'e':
                        case 'a':
                            $result->addWord($rootWithoutLast, $word);
                            break;
                    }
                }
                if ($word->endingKChangesIntoG()) {
                    $result->addWord($rootWithoutLast . 'g', $word);
                }
            }
        }
        return $result;
    }
}