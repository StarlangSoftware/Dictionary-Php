<?php


use olcaytaner\Dictionary\Dictionary\TxtDictionary;
use olcaytaner\Dictionary\Dictionary\WordComparator;
use PHPUnit\Framework\TestCase;

class DictionaryTest extends TestCase
{
    public function testGetWordIndex(){
        $lowerCaseDictionary = new TxtDictionary(WordComparator::TURKISH, "../lowercase.txt", null, null);
        $mixedCaseDictionary = new TxtDictionary(WordComparator::TURKISH_IGNORE_CASE, "../mixedcase.txt", null, null);
        $this->assertEquals(0, $lowerCaseDictionary->getWordIndex("a"));
        $this->assertEquals(3, $lowerCaseDictionary->getWordIndex("ç"));
        $this->assertEquals(8, $lowerCaseDictionary->getWordIndex("ğ"));
        $this->assertEquals(10, $lowerCaseDictionary->getWordIndex("ı"));
        $this->assertEquals(18, $lowerCaseDictionary->getWordIndex("ö"));
        $this->assertEquals(22, $lowerCaseDictionary->getWordIndex("ş"));
        $this->assertEquals(25, $lowerCaseDictionary->getWordIndex("ü"));
        $this->assertEquals(28, $lowerCaseDictionary->getWordIndex("z"));
        $this->assertTrue($mixedCaseDictionary->getWordIndex("A") == 0 || $mixedCaseDictionary->getWordIndex("A") == 1);
        $this->assertTrue($mixedCaseDictionary->getWordIndex("Ç") == 6 || $mixedCaseDictionary->getWordIndex("Ç") == 7);
        $this->assertTrue($mixedCaseDictionary->getWordIndex("Ğ") == 16 || $mixedCaseDictionary->getWordIndex("Ğ") == 17);
        $this->assertTrue($mixedCaseDictionary->getWordIndex("I") == 20 || $mixedCaseDictionary->getWordIndex("I") == 21);
        $this->assertTrue($mixedCaseDictionary->getWordIndex("İ") == 22 || $mixedCaseDictionary->getWordIndex("İ") == 23);
        $this->assertTrue($mixedCaseDictionary->getWordIndex("Ş") == 44 || $mixedCaseDictionary->getWordIndex("Ş") == 45);
        $this->assertTrue($mixedCaseDictionary->getWordIndex("Ü") == 50 || $mixedCaseDictionary->getWordIndex("Ü") == 51);
        $this->assertTrue($mixedCaseDictionary->getWordIndex("Z") == 56 || $mixedCaseDictionary->getWordIndex("Z") == 57);
    }

    public function testSize(){
        $dictionary = new TxtDictionary();
        $lowerCaseDictionary = new TxtDictionary(WordComparator::TURKISH, "../lowercase.txt", null, null);
        $mixedCaseDictionary = new TxtDictionary(WordComparator::TURKISH_IGNORE_CASE, "../mixedcase.txt", null, null);
        $this->assertEquals(29, $lowerCaseDictionary->size());
        $this->assertEquals(58, $mixedCaseDictionary->size());
        $this->assertEquals(62120, $dictionary->size());
    }

    public function testGetWord(){
        $lowerCaseDictionary = new TxtDictionary(WordComparator::TURKISH, "../lowercase.txt", null, null);
        $this->assertEquals("a", $lowerCaseDictionary->getWordWithIndex(0)->getName());
        $this->assertEquals("ç", $lowerCaseDictionary->getWordWithIndex(3)->getName());
        $this->assertEquals("ğ", $lowerCaseDictionary->getWordWithIndex(8)->getName());
        $this->assertEquals("ı", $lowerCaseDictionary->getWordWithIndex(10)->getName());
        $this->assertEquals("ö", $lowerCaseDictionary->getWordWithIndex(18)->getName());
        $this->assertEquals("ş", $lowerCaseDictionary->getWordWithIndex(22)->getName());
        $this->assertEquals("ü", $lowerCaseDictionary->getWordWithIndex(25)->getName());
        $this->assertEquals("z", $lowerCaseDictionary->getWordWithIndex(28)->getName());
    }

    public function testLongestWordSize(){
        $dictionary = new TxtDictionary();
        $lowerCaseDictionary = new TxtDictionary(WordComparator::TURKISH, "../lowercase.txt", null, null);
        $mixedCaseDictionary = new TxtDictionary(WordComparator::TURKISH_IGNORE_CASE, "../mixedcase.txt", null, null);
        $this->assertEquals(1, $lowerCaseDictionary->longestWordSize());
        $this->assertEquals(1, $mixedCaseDictionary->longestWordSize());
        $this->assertEquals(21, $dictionary->longestWordSize());
    }

    public function testGetWordStartingWith(){
        $lowerCaseDictionary = new TxtDictionary(WordComparator::TURKISH, "../lowercase.txt", null, null);
        $mixedCaseDictionary = new TxtDictionary(WordComparator::TURKISH_IGNORE_CASE, "../mixedcase.txt", null, null);
        $this->assertEquals(0, $lowerCaseDictionary->getWordStartingWith("a"));
        $this->assertEquals(1, $lowerCaseDictionary->getWordStartingWith("b"));
        $this->assertEquals(20, $lowerCaseDictionary->getWordStartingWith("q"));
        $this->assertEquals(27, $lowerCaseDictionary->getWordStartingWith("w"));
        $this->assertEquals(27, $lowerCaseDictionary->getWordStartingWith("x"));
        $this->assertEquals(40, $mixedCaseDictionary->getWordStartingWith("Q"));
        $this->assertEquals(54, $mixedCaseDictionary->getWordStartingWith("W"));
        $this->assertEquals(54, $mixedCaseDictionary->getWordStartingWith("X"));
    }
}
