<?php


use olcaytaner\Dictionary\Dictionary\TxtDictionary;
use olcaytaner\Dictionary\Dictionary\TxtWord;
use olcaytaner\Dictionary\Dictionary\Word;
use PHPUnit\Framework\TestCase;

class TxtDictionaryTest extends TestCase
{
    public function testMorphology()
    {
        $dictionary = new TxtDictionary();
        $this->assertEquals("ab", ($dictionary->getWordWithName("ab"))->getMorphology());
        $this->assertEquals("çarp+HcH+lHk", ($dictionary->getWordWithName("çarpıcılık"))->getMorphology());
        $this->assertEquals("aciz+lAş+yAbil+mA", ($dictionary->getWordWithName("âcizleşebilme"))->getMorphology());
        $this->assertEquals("ak+Hş+GAn+lAş+DHr+HCH+lHk", ($dictionary->getWordWithName("akışkanlaştırıcılık"))->getMorphology());
    }

    public function testTrie(){
        ini_set('memory_limit', '150M');
        $dictionary = new TxtDictionary();
        $trie = $dictionary->prepareTrie();
        $this->assertContains("ben", array_keys($trie->getWordsWithPrefix("bana")));
        $this->assertContains("sen", array_keys($trie->getWordsWithPrefix("sana")));
        $this->assertContains("metin", array_keys($trie->getWordsWithPrefix("metni")));
        $this->assertContains("ağız", array_keys($trie->getWordsWithPrefix("ağzı")));
        $this->assertContains("ayır", array_keys($trie->getWordsWithPrefix("ayrıldı")));
        $this->assertContains("buyur", array_keys($trie->getWordsWithPrefix("buyruldu")));
        $this->assertContains("ahit", array_keys($trie->getWordsWithPrefix("ahdi")));
        $this->assertContains("kayıp", array_keys($trie->getWordsWithPrefix("kaybı")));
        $this->assertContains("kutup", array_keys($trie->getWordsWithPrefix("kutbu")));
        $this->assertContains("ademelması", array_keys($trie->getWordsWithPrefix("ademelmaları")));
        $this->assertContains("ağaçküpesi", array_keys($trie->getWordsWithPrefix("ağaçküpeleri")));
        $this->assertContains("ağaçlık", array_keys($trie->getWordsWithPrefix("ağaçlığı")));
        $this->assertContains("sumak", array_keys($trie->getWordsWithPrefix("sumağı")));
        $this->assertContains("deveboynu", array_keys($trie->getWordsWithPrefix("deveboyunları")));
        $this->assertContains("gökcismi", array_keys($trie->getWordsWithPrefix("gökcisimleri")));
        $this->assertContains("gökkuşağı", array_keys($trie->getWordsWithPrefix("gökkuşakları")));
        $this->assertContains("hintarmudu", array_keys($trie->getWordsWithPrefix("hintarmutları")));
        $this->assertContains("hintpirinci", array_keys($trie->getWordsWithPrefix("hintpirinçleri")));
        $this->assertContains("sudolabı", array_keys($trie->getWordsWithPrefix("sudolapları")));
        $this->assertContains("ye", array_keys($trie->getWordsWithPrefix("yiyor")));
        $this->assertContains("de", array_keys($trie->getWordsWithPrefix("diyor")));
        $this->assertContains("depola", array_keys($trie->getWordsWithPrefix("depoluyor")));
        $this->assertContains("dışla", array_keys($trie->getWordsWithPrefix("dışlıyor")));
        $this->assertContains("fiyonk", array_keys($trie->getWordsWithPrefix("fiyongu")));
        $this->assertContains("gonk", array_keys($trie->getWordsWithPrefix("gongu")));
    }
}
