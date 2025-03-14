<?php

use olcaytaner\Dictionary\Syllibification\SyllableList;
use PHPUnit\Framework\TestCase;

class SyllableListTest extends TestCase
{
    public function testSyllableList()
    {
        $syllableList = new SyllableList("başöğretmen");
        $this->assertEquals(["ba", "şöğ", "ret", "men"], $syllableList->getSyllables());
        $syllableList = new SyllableList("fransa");
        $this->assertEquals(["fran", "sa"], $syllableList->getSyllables());
        $syllableList = new SyllableList("traktör");
        $this->assertEquals(["trak", "tör"], $syllableList->getSyllables());
        $syllableList = new SyllableList("kraker");
        $this->assertEquals(["kra", "ker"], $syllableList->getSyllables());
        $syllableList = new SyllableList("trake");
        $this->assertEquals(["tra", "ke"], $syllableList->getSyllables());
        $syllableList = new SyllableList("ilköğretim");
        $this->assertEquals(["il", "köğ", "re", "tim"], $syllableList->getSyllables());
        $syllableList = new SyllableList("semizotu");
        $this->assertEquals(["se", "mi", "zo", "tu"], $syllableList->getSyllables());
        $syllableList = new SyllableList("ali");
        $this->assertEquals(["a", "li"], $syllableList->getSyllables());
        $syllableList = new SyllableList("türk");
        $this->assertEquals(["türk"], $syllableList->getSyllables());
        $syllableList = new SyllableList("kırktürk");
        $this->assertEquals(["kırk", "türk"], $syllableList->getSyllables());
        $syllableList = new SyllableList("kardanadam");
        $this->assertEquals(["kar", "da", "na", "dam"], $syllableList->getSyllables());
        $syllableList = new SyllableList("çöpadam");
        $this->assertEquals(["çö", "pa", "dam"], $syllableList->getSyllables());
        $syllableList = new SyllableList("faal");
        $this->assertEquals(["fa", "al"], $syllableList->getSyllables());
    }
}