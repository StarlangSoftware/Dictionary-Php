<?php


use olcaytaner\Dictionary\Dictionary\Trie\Trie;
use olcaytaner\Dictionary\Dictionary\Word;
use PHPUnit\Framework\TestCase;

class TrieTest extends TestCase
{
    public function testGetWordsWithPrefixSimple()
    {
        $simpleTrie = new Trie();
        $simpleTrie->addWord("azı", new Word("azı"));
        $simpleTrie->addWord("az", new Word("az"));
        $simpleTrie->addWord("ad", new Word("ad"));
        $simpleTrie->addWord("adi", new Word("adi"));
        $simpleTrie->addWord("adil", new Word("adil"));
        $simpleTrie->addWord("a", new Word("a"));
        $simpleTrie->addWord("adilane", new Word("adilane"));
        $simpleTrie->addWord("ısı", new Word("ısı"));
        $simpleTrie->addWord("ısıtıcı", new Word("ısıtıcı"));
        $simpleTrie->addWord("ölü", new Word("ölü"));
        $simpleTrie->addWord("ölüm", new Word("ölüm"));
        $simpleTrie->addWord("ören", new Word("ören"));
        $simpleTrie->addWord("örgü", new Word("örgü"));
        $this->assertEqualsCanonicalizing([new Word("a")], $simpleTrie->getWordsWithPrefix("a"));
        $this->assertEqualsCanonicalizing([new Word("a"), new Word("ad")], $simpleTrie->getWordsWithPrefix("ad"));
        $this->assertEqualsCanonicalizing([new Word("a"), new Word("ad"), new Word("adi")], $simpleTrie->getWordsWithPrefix("adi"));
        $this->assertEqualsCanonicalizing([new Word("a"), new Word("ad"), new Word("adi"), new Word("adil")], $simpleTrie->getWordsWithPrefix("adil"));
        $this->assertEqualsCanonicalizing([new Word("a"), new Word("ad"), new Word("adi"), new Word("adil"), new Word("adilane")], $simpleTrie->getWordsWithPrefix("adilane"));
        $this->assertEqualsCanonicalizing([new Word("ölü")], $simpleTrie->getWordsWithPrefix("ölü"));
        $this->assertEqualsCanonicalizing([new Word("ölü"), new Word("ölüm")], $simpleTrie->getWordsWithPrefix("ölüm"));
        $this->assertEqualsCanonicalizing([new Word("ısı")], $simpleTrie->getWordsWithPrefix("ısı"));
        $this->assertEqualsCanonicalizing([new Word("ısı"), new Word("ısıtıcı")], $simpleTrie->getWordsWithPrefix("ısıtıcı"));
    }
}
