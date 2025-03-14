<?php

use olcaytaner\Dictionary\Dictionary\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    public function testCharCount()
    {
        $word = new Word("ali");
        $this->assertEquals(3, $word->charCount());
        $word = new Word("Veli");
        $this->assertEquals(4, $word->charCount());
        $word = new Word("ahmet");
        $this->assertEquals(5, $word->charCount());
        $word = new Word("çöğüşı");
        $this->assertEquals(6, $word->charCount());
    }

    public function testIsCapital()
    {
        $this->assertTrue(!Word::isCapital("ali"));
        $this->assertTrue(Word::isCapital("Ali"));
        $this->assertTrue(!Word::isCapital("ısı"));
        $this->assertTrue(Word::isCapital("Isıtıcı"));
        $this->assertTrue(!Word::isCapital("çin"));
        $this->assertTrue(Word::isCapital("Çin"));
        $this->assertTrue(!Word::isCapital("ödül"));
        $this->assertTrue(Word::isCapital("Ödül"));
        $this->assertTrue(!Word::isCapital("şişe"));
        $this->assertTrue(Word::isCapital("Şişe"));
        $this->assertTrue(!Word::isCapital("üretici"));
        $this->assertTrue(Word::isCapital("Üretici"));
    }

    public function testToCapital()
    {
        $this->assertEquals("Ali", Word::toCapital("ali"));
        $this->assertEquals("İlginç", Word::toCapital("ilginç"));
        $this->assertEquals("Ç", Word::toCapital("ç"));
    }

    public function testIsPunctuation(){
        $this->assertTrue(Word::isPunctuationSymbol("."));
        $this->assertTrue(Word::isPunctuationSymbol("..."));
        $this->assertTrue(Word::isPunctuationSymbol("["));
        $this->assertTrue(Word::isPunctuationSymbol("]"));
        $this->assertTrue(Word::isPunctuationSymbol("\u2026"));
        $this->assertTrue(Word::isPunctuationSymbol("%"));
        $this->assertTrue(Word::isPunctuationSymbol("&"));
        $this->assertTrue(Word::isPunctuationSymbol("="));
        $this->assertTrue(Word::isPunctuationSymbol("\u0060\u0060"));
        $this->assertTrue(Word::isPunctuationSymbol("\u0060"));
        $this->assertTrue(Word::isPunctuationSymbol("''"));
        $this->assertTrue(Word::isPunctuationSymbol("$"));
        $this->assertTrue(Word::isPunctuationSymbol("!"));
        $this->assertTrue(Word::isPunctuationSymbol("?"));
        $this->assertTrue(Word::isPunctuationSymbol(","));
        $this->assertTrue(Word::isPunctuationSymbol(":"));
        $this->assertTrue(Word::isPunctuationSymbol("--"));
        $this->assertTrue(Word::isPunctuationSymbol(";"));
        $this->assertTrue(Word::isPunctuationSymbol("("));
        $this->assertTrue(Word::isPunctuationSymbol(")"));
        $this->assertTrue(Word::isPunctuationSymbol("'"));
        $this->assertTrue(Word::isPunctuationSymbol("\""));
        $this->assertTrue(Word::isPunctuationSymbol("\u201C"));
        $this->assertTrue(Word::isPunctuationSymbol("\u2018"));
        $this->assertTrue(Word::isPunctuationSymbol("\u201D"));
        $this->assertTrue(Word::isPunctuationSymbol("…"));
        $this->assertTrue(Word::isPunctuationSymbol("\u25CF"));
        $this->assertTrue(Word::isPunctuationSymbol("/"));
        $this->assertTrue(Word::isPunctuationSymbol("-"));
        $this->assertTrue(Word::isPunctuationSymbol("+"));
        $this->assertTrue(Word::isPunctuationSymbol("-LRB-"));
        $this->assertTrue(Word::isPunctuationSymbol("-RRB-"));
        $this->assertTrue(Word::isPunctuationSymbol("-LCB-"));
        $this->assertTrue(Word::isPunctuationSymbol("-RCB-"));
        $this->assertTrue(Word::isPunctuationSymbol("-LSB-"));
        $this->assertTrue(Word::isPunctuationSymbol("-RSB-"));
    }

    public function testIsHonorific(){
        $this->assertTrue(Word::isHonorific("bay"));
        $this->assertTrue(Word::isHonorific("Bay"));
        $this->assertTrue(Word::isHonorific("BAY"));
        $this->assertTrue(Word::isHonorific("bayan"));
        $this->assertTrue(Word::isHonorific("Bayan"));
        $this->assertTrue(Word::isHonorific("BAYAN"));
    }

    public function testIsOrganization(){
        $this->assertTrue(Word::isOrganization("corp"));
        $this->assertTrue(Word::isOrganization("Corp"));
        $this->assertTrue(Word::isOrganization("inc."));
        $this->assertTrue(Word::isOrganization("co."));
        $this->assertTrue(Word::isOrganization("Co."));
    }

    public function testIsMoney(){
        $this->assertTrue(Word::isMoney("dolar"));
        $this->assertTrue(Word::isMoney("sterlin"));
        $this->assertTrue(Word::isMoney("paunt"));
        $this->assertTrue(Word::isMoney("ons"));
        $this->assertTrue(Word::isMoney("ruble"));
        $this->assertTrue(Word::isMoney("mark"));
        $this->assertTrue(Word::isMoney("frank"));
        $this->assertTrue(Word::isMoney("sent"));
        $this->assertTrue(Word::isMoney("cent"));
        $this->assertTrue(Word::isMoney("yen"));
        $this->assertTrue(Word::isMoney("Dolar"));
        $this->assertTrue(Word::isMoney("Sterlin"));
        $this->assertTrue(Word::isMoney("Paunt"));
        $this->assertTrue(Word::isMoney("Ons"));
        $this->assertTrue(Word::isMoney("Ruble"));
        $this->assertTrue(Word::isMoney("Mark"));
        $this->assertTrue(Word::isMoney("Frank"));
        $this->assertTrue(Word::isMoney("Sent"));
        $this->assertTrue(Word::isMoney("Cent"));
        $this->assertTrue(Word::isMoney("Yen"));
        $this->assertTrue(Word::isMoney("3000$"));
        $this->assertTrue(!Word::isMoney("3000"));
    }

    public function testisDateTime(){
        $this->assertTrue(Word::isDateTime("9:1"));
        $this->assertTrue(Word::isDateTime("9:12"));
        $this->assertTrue(Word::isDateTime("12:1"));
        $this->assertTrue(Word::isDateTime("12:13"));
        $this->assertTrue(Word::isDateTime("1:9:1"));
        $this->assertTrue(Word::isDateTime("1:9:12"));
        $this->assertTrue(Word::isDateTime("1:12:1"));
        $this->assertTrue(Word::isDateTime("2:13:14"));
        $this->assertTrue(Word::isDateTime("12:9:1"));
        $this->assertTrue(Word::isDateTime("11:9:12"));
        $this->assertTrue(Word::isDateTime("10:12:1"));
        $this->assertTrue(Word::isDateTime("21:13:14"));
        $this->assertTrue(!Word::isDateTime("12"));
        $this->assertTrue(!Word::isDateTime("1:1:1:1"));
        $this->assertTrue(Word::isDateTime("ocak"));
        $this->assertTrue(Word::isDateTime("şubat"));
        $this->assertTrue(Word::isDateTime("mart"));
        $this->assertTrue(Word::isDateTime("nisan"));
        $this->assertTrue(Word::isDateTime("mayıs"));
        $this->assertTrue(Word::isDateTime("haziran"));
        $this->assertTrue(Word::isDateTime("temmuz"));
        $this->assertTrue(Word::isDateTime("ağustos"));
        $this->assertTrue(Word::isDateTime("eylül"));
        $this->assertTrue(Word::isDateTime("ekim"));
        $this->assertTrue(Word::isDateTime("kasım"));
        $this->assertTrue(Word::isDateTime("aralık"));
        $this->assertTrue(Word::isDateTime("Ocak"));
        $this->assertTrue(Word::isDateTime("Şubat"));
        $this->assertTrue(Word::isDateTime("Mart"));
        $this->assertTrue(Word::isDateTime("Nisan"));
        $this->assertTrue(Word::isDateTime("Mayıs"));
        $this->assertTrue(Word::isDateTime("Haziran"));
        $this->assertTrue(Word::isDateTime("Temmuz"));
        $this->assertTrue(Word::isDateTime("Ağustos"));
        $this->assertTrue(Word::isDateTime("Eylül"));
        $this->assertTrue(Word::isDateTime("Ekim"));
        $this->assertTrue(Word::isDateTime("Kasım"));
        $this->assertTrue(Word::isDateTime("Aralık"));
        $this->assertTrue(Word::isDateTime("pazartesi"));
        $this->assertTrue(Word::isDateTime("salı"));
        $this->assertTrue(Word::isDateTime("çarşamba"));
        $this->assertTrue(Word::isDateTime("perşembe"));
        $this->assertTrue(Word::isDateTime("cuma"));
        $this->assertTrue(Word::isDateTime("cumartesi"));
        $this->assertTrue(Word::isDateTime("pazar"));
        $this->assertTrue(Word::isDateTime("Pazartesi"));
        $this->assertTrue(Word::isDateTime("Salı"));
        $this->assertTrue(Word::isDateTime("Çarşamba"));
        $this->assertTrue(Word::isDateTime("Perşembe"));
        $this->assertTrue(Word::isDateTime("Cuma"));
        $this->assertTrue(Word::isDateTime("Cumartesi"));
        $this->assertTrue(Word::isDateTime("Pazar"));
        $this->assertTrue(!Word::isDateTime("1234567"));
        $this->assertTrue(!Word::isDateTime("-1234"));
        $this->assertTrue(!Word::isDateTime("1834"));
        $this->assertTrue(!Word::isDateTime("2201"));
        $this->assertTrue(Word::isDateTime("1934"));
    }
}