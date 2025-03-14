<?php

namespace olcaytaner\Dictionary\Dictionary\Trie;

use olcaytaner\Dictionary\Dictionary\TxtWord;
use olcaytaner\Dictionary\Dictionary\Word;

class Trie
{
    private readonly TrieNode $rootNode;

    /**
     * A constructor of {@link Trie} class which creates a new {@link TrieNode} as rootNode.
     */
    public function __construct(){
        $this->rootNode = new TrieNode();
    }

    /**
     * The addWord method which takes a String word and a {@link Word} root as inputs and adds given word and root to the rootNode.
     *
     * @param string $word String input.
     * @param Word $root {@link Word} input.
     */
    public function addWord(string $word, Word $root): void{
        $this->rootNode->addWord($word, $root);
    }

    /**
     * The getWordsWithPrefix method which takes a String surfaceForm as an input. First it creates a {@link TrieNode} current and assigns
     * the rootNode to it, then it creates a new {@link Set} words. It loops i times where i ranges from 0 to length of surfaceForm
     * and assigns current's child that corresponds to the surfaceForm's char at index i and assigns it as {@link TrieNode} current.
     * If current is not null, it adds all words of current to the words {@link Set}.
     *
     * @param string $surfaceForm String input.
     * @return array $words {@link Set}.
     */
    public function getWordsWithPrefix(string $surfaceForm): array{
        $current = $this->rootNode;
        $words = [];
        for ($i = 0; $i < mb_strlen($surfaceForm); $i++) {
            $current = $current->getChild(mb_substr($surfaceForm, $i, 1));
            if ($current != null) {
                if ($current->getWords() != null) {
                    foreach ($current->getWords() as $name=>$value){
                        $words[$name] = $value;
                    }
                }
            } else {
                break;
            }
        }
        return $words;
    }

    /**
     * The getCompoundWordStartingWith method takes a String hash. First it creates a {@link TrieNode} current and assigns
     * the rootNode to it. Then it loops i times where i ranges from 0 to length of given hash and assigns current's child that
     * corresponds to the hash's char at index i and assigns it as current. If current is null, it returns null.
     * <p>
     * If current is not null,  it loops through the words of current {@link TrieNode} and if it is a Portmanteau word, it
     * directly returns the word.
     *
     * @param string $hash String input.
     * @return ?TxtWord null if {@link TrieNode} is null, otherwise portmanteau word.
     */
    public function getCompoundWordStartingWith(string $hash): ?TxtWord{
        $current = $this->rootNode;
        for ($i = 0; $i < mb_strlen($hash); $i++) {
            $current = $current->getChild($hash[$i]);
            if ($current == null) {
                return null;
            }
        }
        if ($current->getWords() != null) {
            foreach ($current->getWords() as $word=>$value) {
                if ($word instanceof TxtWord && $word->isPortmanteau()) {
                    return $word;
                }
            }
        }
        return null;
    }
}
