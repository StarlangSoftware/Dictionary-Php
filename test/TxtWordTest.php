<?php

use olcaytaner\Dictionary\Dictionary\TxtDictionary;
use olcaytaner\Dictionary\Dictionary\TxtWord;
use PHPUnit\Framework\TestCase;

class TxtWordTest extends TestCase
{

    public function testVerbType(){
        $verbs = [];
        $dictionary = new TxtDictionary();
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord) {
                $verbType = $word->verbType();
                if (isset($verbs[$verbType])) {
                    $verbs[$verbType]++;
                } else {
                    $verbs[$verbType] = 1;
                }
            }
        }
        $this->assertEquals(5, $verbs["F2P1-NO-REF"]);
        $this->assertEquals(1, $verbs["F3P1-NO-REF"]);
        $this->assertEquals(1, $verbs["F4P1-NO-REF"]);
        $this->assertEquals(14, $verbs["F4PR-NO-REF"]);
        $this->assertEquals(2, $verbs["F4PL-NO-REF"]);
        $this->assertEquals(67, $verbs["F4PW-NO-REF"]);
        $this->assertEquals(10, $verbs["F5PL-NO-REF"]);
        $this->assertEquals(111, $verbs["F5PR-NO-REF"]);
        $this->assertEquals(1, $verbs["F5PW-NO-REF"]);
        $this->assertEquals(2, $verbs["F1P1"]);
        $this->assertEquals(11, $verbs["F2P1"]);
        $this->assertEquals(4, $verbs["F3P1"]);
        $this->assertEquals(1, $verbs["F4P1"]);
        $this->assertEquals(1, $verbs["F5P1"]);
        $this->assertEquals(7, $verbs["F6P1"]);
        $this->assertEquals(2, $verbs["F2PL"]);
        $this->assertEquals(49, $verbs["F4PL"]);
        $this->assertEquals(18, $verbs["F5PL"]);
        $this->assertEquals(173, $verbs["F4PR"]);
        $this->assertEquals(808, $verbs["F5PR"]);
        $this->assertEquals(1396, $verbs["F4PW"]);
        $this->assertEquals(13, $verbs["F5PW"]);
    }

    public function testIsNominal(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isNominal()) {
                $count++;
            }
        }
        $this->assertEquals(30603, $count);
    }

    public function testIsPassive(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isPassive()) {
                $count++;
            }
        }
        $this->assertEquals(10, $count);
    }

    public function testIsAbbreviation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isAbbreviation()) {
                $count++;
            }
        }
        $this->assertEquals(102, $count);
    }

    public function testIsInterjection(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isInterjection()) {
                $count++;
            }
        }
        $this->assertEquals(106, $count);
    }

    public function testIsDuplicate(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isDuplicate()) {
                $count++;
            }
        }
        $this->assertEquals(124, $count);
    }

    public function testIsAdjective(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isAdjective()) {
                $count++;
            }
        }
        $this->assertEquals(9687, $count);
    }

    public function testIsPronoun(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isPronoun()) {
                $count++;
            }
        }
        $this->assertEquals(49, $count);
    }

    public function testIsQuestion(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isQuestion()) {
                $count++;
            }
        }
        $this->assertEquals(4, $count);
    }

    public function testIsVerb(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isVerb()) {
                $count++;
            }
        }
        $this->assertEquals(5043, $count);
    }

    public function testIsPortmanteau(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isPortmanteau()) {
                $count++;
            }
        }
        $this->assertEquals(1294, $count);
    }

    public function testIsDeterminer(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isDeterminer()) {
                $count++;
            }
        }
        $this->assertEquals(13, $count);
    }

    public function testIsConjunction(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isConjunction()) {
                $count++;
            }
        }
        $this->assertEquals(52, $count);
    }

    public function testIsAdverb(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isAdverb()) {
                $count++;
            }
        }
        $this->assertEquals(1849, $count);
    }

    public function testIsPostP(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isPostP()) {
                $count++;
            }
        }
        $this->assertEquals(49, $count);
    }

    public function testIsPortmanteauEndingWithSI(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isPortmanteauEndingWithSI()) {
                $count++;
            }
        }
        $this->assertEquals(178, $count);
    }

    public function testIsPortmanteauFacedVowelEllipsis(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isPortmanteauFacedVowelEllipsis()) {
                $count++;
            }
        }
        $this->assertEquals(25, $count);
    }

    public function testIsPortmanteauFacedSoftening(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isPortmanteauFacedSoftening()) {
                $count++;
            }
        }
        $this->assertEquals(348, $count);
    }

    public function testIsSuffix(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isSuffix()) {
                $count++;
            }
        }
        $this->assertEquals(3, $count);
    }

    public function testIsProperNoun(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isProperNoun()) {
                $count++;
            }
        }
        $this->assertEquals(19014, $count);
    }

    public function testIsPlural(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isPlural()) {
                $count++;
            }
        }
        $this->assertEquals(398, $count);
    }

    public function testIsNumeral(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isNumeral()) {
                $count++;
            }
        }
        $this->assertEquals(33, $count);
    }

    public function testNotObeysVowelHarmonyDuringAgglutination(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->notObeysVowelHarmonyDuringAgglutination()) {
                $count++;
            }
        }
        $this->assertEquals(315, $count);
    }

    public function testObeysAndNotObeysVowelHarmonyDuringAgglutination(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->obeysAndNotObeysVowelHarmonyDuringAgglutination()) {
                $count++;
            }
        }
        $this->assertEquals(5, $count);
    }

    public function testRootSoftenDuringSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->rootSoftenDuringSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(5530, $count);
    }

    public function testRootSoftenAndNotSoftenDuringSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->rootSoftenAndNotSoftenDuringSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(14, $count);
    }

    public function testVerbSoftenDuringSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->verbSoftenDuringSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(87, $count);
    }

    public function testNounSoftenDuringSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->nounSoftenDuringSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(5444, $count);
    }

    public function testEndingKChangesIntoG(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->endingKChangesIntoG()) {
                $count++;
            }
        }
        $this->assertEquals(26, $count);
    }

    public function testIsExceptional(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->isExceptional()) {
                $count++;
            }
        }
        $this->assertEquals(31, $count);
    }

    public function testDuplicatesDuringSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->duplicatesDuringSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(36, $count);
    }

    public function testDuplicatesAndNotDuplicatesDuringSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->duplicatesAndNotDuplicatesDuringSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(4, $count);
    }

    public function testLastIdropsDuringSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->lastIdropsDuringSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(167, $count);
    }

    public function testLastIDropsAndNotDropDuringSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->lastIDropsAndNotDropDuringSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(4, $count);
    }

    public function testTakesRelativeSuffixKi(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->takesRelativeSuffixKi()) {
                $count++;
            }
        }
        $this->assertEquals(16, $count);
    }

    public function testTakesRelativeSuffixKu(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->takesRelativeSuffixKu()) {
                $count++;
            }
        }
        $this->assertEquals(4, $count);
    }

    public function testLastIdropsDuringPassiveSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->lastIdropsDuringPassiveSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(11, $count);
    }

    public function testVowelAChangesToIDuringYSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->vowelAChangesToIDuringYSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(1301, $count);
    }

    public function testVowelEChangesToIDuringYSuffixation(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->vowelEChangesToIDuringYSuffixation()) {
                $count++;
            }
        }
        $this->assertEquals(2, $count);
    }

    public function testTakesSuffixIRAsAorist(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && !$word->takesSuffixIRAsAorist()) {
                $count++;
            }
        }
        $this->assertEquals(51, $count);
    }

    public function testTakesSuffixDIRAsFactitive(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && !$word->takesSuffixDIRAsFactitive()) {
                $count++;
            }
        }
        $this->assertEquals(197, $count);
    }

    public function testShowsSuRegularities(){
        $dictionary = new TxtDictionary();
        $count = 0;
        for ($i = 0; $i < $dictionary->size(); $i++) {
            $word = $dictionary->getWordWithIndex($i);
            if ($word instanceof TxtWord && $word->showsSuRegularities()) {
                $count++;
            }
        }
        $this->assertEquals(5, $count);
    }

}