<?php

namespace olcaytaner\Dictionary\Dictionary\Trie;

use olcaytaner\Dictionary\Dictionary\Word;

class TrieNode
{
    private array $children = [];
    private ?array $words = null;

    /**
     * A constructor of {@link TrieNode} class which creates a new children {@link Map}.
     */
    public function __construct(){
    }

    /**
     * The addWord method takes a String word, an index, and a {@link Word} root as inputs. First it creates a {@link TrieNode} child
     * and if words {@link Set} is null it creates a new {@link Set} and add the given root word to this {@link Set}, if it
     * is not null, it directly adds it to the {@link Set} when the given index is equal to the length of given word.
     * <p>
     * Then, it extracts the character at given index of given word and if children {@link Map} contains a mapping for the
     * extracted character, it assigns it to the {@link TrieNode} child, else it creates a new {@link TrieNode} and assigns it to the
     * child. At the end, it recursively calls the addWord method with the next index of child and puts the character with
     * the child into the children {@link Map}.
     *
     * @param string $word  String input.
     * @param ?int $index Integer index.
     * @param Word $root  {@link Word} input to add.
     */
    public function addWord(string $word, Word $root, ?int $index = null): void{
        if ($index === null){
            $this->addWord($word, $root, 0);
        } else {
            if ($index == mb_strlen($word)) {
                if ($this->words == null) {
                    $this->words = [];
                    $this->words[$root->getName()] = $root;
                } else {
                    $this->words[$root->getName()] = $root;
                }
                return;
            }
            $ch = mb_substr($word, $index, 1);
            if (isset($this->children[$ch])) {
                $child = $this->children[$ch];
            } else {
                $child = new TrieNode();
            }
            $child->addWord($word, $root, $index + 1);
            $this->children[$ch]  = $child;
        }
    }

    /**
     * The getChild method takes a {@link string} and gets its corresponding value from children {@link Map}.
     *
     * @param string $ch {@link Character} input.
     * @return ?TrieNode the value from children {@link Map}.
     */
    public function getChild(string $ch): ?TrieNode{
        if (isset($this->children[$ch])) {
            return $this->children[$ch];
        } else {
            return null;
        }
    }

    /**
     * The getWords method returns the words {@link Set}.
     *
     * @return ?array the words {@link Set}.
     */
    public function getWords(): ?array{
        return $this->words;
    }
}