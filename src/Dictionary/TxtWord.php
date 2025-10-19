<?php

namespace olcaytaner\Dictionary\Dictionary;

class TxtWord extends Word
{
    private array $flags = [];
    private string $morphology;

    /**
     * A constructor of {@link TxtWord} class which takes a String name as an input and calls its super class {@link Word}
     * with given name. Then, creates a new {@link Array} as flags.
     *
     * @param string $name String name.
     * @param string|null $flag String input.
     */
    public function __construct(string $name, ?string $flag = null)
    {
        parent::__construct($name);
        if ($flag != null) {
            $this->addFlag($flag);
        }
    }

    /**
     * The addFlag method takes a String flag as an input and adds given flag to the flags {@link Array}.
     *
     * @param string $flag String input to add.
     */
    public function addFlag(string $flag): void
    {
        $this->flags[] = $flag;
    }

    /**
     * The removeFlag method takes a String flag as an input and removes given flag from the flags {@link Array}.
     *
     * @param string $flag String input to remove.
     */
    public function removeFlag(string $flag): void
    {
        $index = array_search($flag, $this->flags, true);
        if ($index !== false) {
            array_splice($this->flags, $index, 1);
        }
    }

    /**
     * Accessor for the inner morphology of the word.
     * @return string Inner morphology of the word.
     */
    public function getMorphology(): string
    {
        return $this->morphology;
    }

    /**
     * Mutator for the inner morphology of the word.
     * @param string $morphology New inner morphology of the word.
     */
    public function setMorphology(string $morphology): void
    {
        $this->morphology = $morphology;
    }

    /**
     * The verbType method checks flags {@link Array} and returns the corresponding cases.
     *
     * @return string the corresponding cases.
     */
    public function verbType(): string
    {
        if (in_array("F2P1-NO-REF", $this->flags)) {
            /*
             F2P1-NO-REF: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             can take CausativeT suffix. e.g. Doğ, göç, için
             */
            return "F2P1-NO-REF";
        }
        if (in_array("F3P1-NO-REF", $this->flags)) {
            /*
             *F3P1-NO-REF: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take Passive Hl suffix,
             *can take CausativeT suffix. e.g. Ak
             */
            return "F3P1-NO-REF";
        }
        if (in_array("F4P1-NO-REF", $this->flags)) {
            /*
             *F4P1-NO-REF: The bare-form is a verb and depending on this attribute, the verb can't take PassiveHn suffix, can take CausativeT suffix.
             *e.g. Aksa
             */
            return "F4P1-NO-REF";
        }
        if (in_array("F4PR-NO-REF", $this->flags)) {
            /*
             *F4PR-NO-REF: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             *can take CausativeT suffix. e.g. Çevir, göster
             */
            return "F4PR-NO-REF";
        }
        if (in_array("F4PL-NO-REF", $this->flags)) {
            /*
             *F4PL-NO-REF: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix,
             *can take CausativeT suffix. e.g. Azal, çoğal
             */
            return "F4PL-NO-REF";
        }
        if (in_array("F4PW-NO-REF", $this->flags)) {
            /*
             *F4PW-NO-REF: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveN suffix,
             *can take CausativeT suffix. e.g. Birle, boya
             */
            return "F4PW-NO-REF";
        }
        if (in_array("F5PL-NO-REF", $this->flags)) {
            /*
             *F5PL-NO-REF: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix,
             *can take CausativeDHr suffix. e.g. Çal, kal
             */
            return "F5PL-NO-REF";
        }
        if (in_array("F5PR-NO-REF", $this->flags)) {
            /*
             *F5PR-NO-REF: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             *can take CausativeDHr suffix. e.g. Birleş, çöz
             */
            return "F5PR-NO-REF";
        }
        if (in_array("F5PW-NO-REF", $this->flags)) {
            /*
             *F5PW-NO-REF: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             *can take CausativeDHr suffix. e.g. Ye
             */
            return "F5PW-NO-REF";
        }
        if (in_array("F1P1", $this->flags)) {
            /*
             *F1P1: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             *can take CausativeAr suffix, can take ReciprocalHs suffix. e.g. Çık, kop
             */
            return "F1P1";
        }
        if (in_array("F2P1", $this->flags)) {
            /*
             *F2P1: The bare-form is a verb and depending on this attribute, the verb can can not PassiveHn suffix, can take CausativeHr suffix,
             *can take CausativeDHr suffix, can take ReciprocalHs suffix. e.g. Bit, doy, düş
             */
            return "F2P1";
        }
        if (in_array("F2PL", $this->flags)) {
            /*
             *F2PL: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take CausativeHr suffix,
             *can take CausativeDHr suffix, can take ReciprocalHs suffix. e.g. Art, çök
             */
            return "F2PL";
        }
        if (in_array("F3P1", $this->flags)) {
            /*
             *F3P1: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             *can take CausativeHl suffix, can take ReciprocalHs suffix. e.g. Kok, sark
             */
            return "F3P1";
        }
        if (in_array("F4P1", $this->flags)) {
            /*
             *F4P1: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix,
             *can take CausativeT suffix, can take ReciprocalHs suffix. e.g. Anla
             */
            return "F4P1";
        }
        if (in_array("F4PR", $this->flags)) {
            /*
             *F4PR: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             *can take CausativeT suffix, can take ReciprocalHs suffix. e.g. Bitir, çağır
             */
            return "F4PR";
        }
        if (in_array("F4PL", $this->flags)) {
            /*
             *F4PL: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveN suffix,
             *can take CausativeT suffix, can take ReciprocalHs suffix. e.g. Bolal, çömel
             */
            return "F4PL";
        }
        if (in_array("F4PW", $this->flags)) {
            /*
             *F4PW: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveN suffix,
             *can take CausativeT suffix, can take ReciprocalHs suffix. e.g. Boyla, çağla
             */
            return "F4PW";
        }
        if (in_array("F5P1", $this->flags)) {
            /*
             *F5P1: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             *can take CausativeDHr suffix, can take ReciprocalHs suffix, can take ReflexiveHn suffix. e.g. Giy
             */
            return "F5P1";
        }
        if (in_array("F5PL", $this->flags)) {
            /*
             *F5PL: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveHl suffix,
             *can take CausativeDHr suffix, can take ReciprocalHs suffix. e.g. Böl, dal
             */
            return "F5PL";
        }
        if (in_array("F5PR", $this->flags)) {
            /*
             *F5PR: The bare-form is a verb and depending on this attribute, the verb can take NominalVerb suffixes "-sHm, -SHn, -yHz, SHnHz, -lAr",
             *can take NominalVerb1 suffixes, "-yDH, -ysA
             ", can take NominalVerb2 suffix, "-ymHs", can take AdjectiveRoot suffix, "-SH",
             *can take Adjective suffix, "-ŞAr" e.g. Bilin, çalış
             */
            return "F5PR";
        }
        if (in_array("F5PW", $this->flags)) {
            /*
             *F5PW: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix,
             *can take CausativeDHr suffix, can take ReciprocalHs suffix. e.g. Boşver, cezbet
             */
            return "F5PW";
        }
        if (in_array("F6P1", $this->flags)) {
            /*
             *F6P1: The bare-form is a verb and depending on this attribute, the verb can not take PassiveHn suffix, can take PassiveN suffix,
             *can take ReciprocalHs suffix, can take ReflexiveHn suffix. e.g. Gizle, hazırla, kaşı
             */
            return "F6P1";
        }
        return "";
    }

    /**
     * The samePos method takes {@link TxtWord} as input and returns true if;
     * <p>
     * flags {@link Array} contains CL_ISIM
     * CL_ISIM: The bare-form of the word is a noun. e.g. Abla
     * <p>
     * flags {@link Array} contains CL_FIIL
     * CL_FIIL: The bare-form of the word is a verb. e.g. Affet
     * <p>
     * flags {@link Array} contains IS_ADJ
     * IS_ADJ: The bare-form of the word is a adjective. e.g. Acayip
     * <p>
     * flags {@link Array} contains IS_ZM
     * IS_ZM: The bare-form of the word is a pronoun. e.g. Başkası
     * <p>
     * flags {@link Array} contains IS_ADVERB
     * IS_ADVERB: The bare-form of the word is a adverb. e.g. Tekrar, açıktan, adeta
     *
     * @param TxtWord $word {@link TxtWord} type input.
     * @return bool true if given word is nominal, verb, adjective, pronoun or adverb, false otherwise.
     */
    public function samePos(TxtWord $word): bool
    {
        if ($this->isNominal() && $word->isNominal()) {
            return true;
        }
        if ($this->isVerb() && $word->isVerb()) {
            return true;
        }
        if ($this->isAdjective() && $word->isAdjective()) {
            return true;
        }
        if ($this->isPronoun() && $word->isPronoun()) {
            return true;
        }
        if ($this->isAdverb() && $word->isAdverb()) {
            return true;
        }
        return false;
    }

    /**
     * The isNominal method returns true if flags {@link Array} contains CL_ISIM.
     *
     * @return bool true if flags {@link Array} contains CL_ISIM.
     */
    public function isNominal(): bool
    {
        return in_array("CL_ISIM", $this->flags);
    }

    /**
     * The isPassive method returns true if flags {@link Array} contains PASSIVE-HN.
     *
     * @return bool true if flags {@link Array} contains PASSIVE-HN.
     */
    public function isPassive(): bool
    {
        return in_array("PASSIVE-HN", $this->flags);
    }

    /**
     * The isAbbreviation method returns true if flags {@link Array} contains IS_KIS.
     *
     * @return bool true if flags {@link Array} contains IS_KIS.
     */
    public function isAbbreviation(): bool
    {
        /*
         IS_KIS: The bare-form of the word is an abbrevation which does not obey
         vowel harmony while taking suffixes. Örn. Ab
         */
        return in_array("IS_KIS", $this->flags);
    }

    /**
     * The isInterjection method returns true if flags {@link Array} contains IS_INTERJ.
     *
     * @return bool true if flags {@link Array} contains IS_INTERJ.
     */
    public function isInterjection(): bool
    {
        /*
         *IS_INTERJ: An interjection is a part of speech that shows the emotion or feeling. e.g. Ah, aferin
         */
        return in_array("IS_INTERJ", $this->flags);
    }

    /**
     * The isDuplicate method returns true if flags {@link Array} contains IS_DUP.
     *
     * @return bool true if flags {@link Array} contains IS_DUP.
     */
    public function isDuplicate(): bool
    {
        /*
         *IS_DUP: The bare-form is part of a duplicate form. e.g. Abuk
         */
        return in_array("IS_DUP", $this->flags);
    }

    /**
     * The isDuplicate method returns true if flags {@link Array} contains IS_CODE.
     *
     * @return bool true if flags {@link Array} contains IS_CODE.
     */
    public function isCode(): bool
    {
        return in_array("IS_CODE", $this->flags);
    }

    /**
     * The isDuplicate method returns true if flags {@link Array} contains IS_METRIC.
     *
     * @return bool true if flags {@link Array} contains IS_METRIC.
     */
    public function isMetric(): bool
    {
        return in_array("IS_METRIC", $this->flags);
    }

    /**
     * The isHeader method returns true if flags {@link Array} contains IS_HEADER.
     *
     * @return bool true if flags {@link Array} contains IS_HEADER.
     */
    public function isHeader(): bool
    {
        return in_array("IS_HEADER", $this->flags);
    }

    /**
     * The isAdjective method returns true if flags {@link Array} contains IS_ADJ.
     *
     * @return bool true if flags {@link Array} contains IS_ADJ.
     */
    public function isAdjective(): bool
    {
        return in_array("IS_ADJ", $this->flags);
    }

    /**
     * The isPureAdjective method returns true if flags {@link Array} contains IS_PUREADJ.
     *
     * @return bool true if flags {@link Array} contains IS_PUREADJ.
     */
    public function isPureAdjective(): bool
    {
        return in_array("IS_PUREADJ", $this->flags);
    }

    /**
     * The isPronoun method returns true if flags {@link Array} contains IS_ZM.
     *
     * @return bool true if flags {@link Array} contains IS_ZM.
     */
    public function isPronoun(): bool
    {
        /*
         *IS_ZM: The bare-form of the word is a pronoun. e.g. Hangi, hep, hiçbiri
         */
        return in_array("IS_ZM", $this->flags);
    }

    /**
     * The isQuestion method returns true if flags {@link Array} contains IS_QUES.
     *
     * @return bool true if flags {@link Array} contains IS_QUES.
     */
    public function isQuestion(): bool
    {
        /*The bare-form of the word is a question. e.g. Mi, mu, mü
         */
        return in_array("IS_QUES", $this->flags);
    }

    /**
     * The isVerb method returns true if flags {@link Array} contains CL_FIIL.
     *
     * @return bool true if flags {@link Array} contains CL_FIIL.
     */
    public function isVerb(): bool
    {
        return in_array("CL_FIIL", $this->flags);
    }

    /**
     * The isPortmanteau method returns true if flags {@link Array} contains IS_BILEŞ.
     *
     * @return bool true if flags {@link Array} contains IS_BILEŞ.
     */
    public function isPortmanteau(): bool
    {
        /*
         *IS_BILEŞ: The bare-form is a portmanteau word in affixed form. e.g. gelinçiçeği
         */
        return in_array("IS_BILEŞ", $this->flags);
    }

    /**
     * The isDeterminer method returns true if flags {@link Array} contains IS_DET.
     *
     * @return bool true if flags {@link Array} contains IS_DET.
     */
    public function isDeterminer(): bool
    {
        /*
         *IS_DET: The bare-form of the word is a determiner. e.g. Bazı, bir
         */
        return in_array("IS_DET", $this->flags);
    }

    /**
     * The isConjunction method returns true if flags {@link Array} contains IS_CONJ.
     *
     * @return bool true if flags {@link Array} contains IS_CONJ.
     */
    public function isConjunction(): bool
    {
        /*
         *IS_CONJ: The bare-form of the word is a conjunction. e.g. Gerek, halbuki
         */
        return in_array("IS_CONJ", $this->flags);
    }

    /**
     * The isAdverb method returns true if flags {@link Array} contains IS_ADVERB.
     *
     * @return bool true if flags {@link Array} contains IS_ADVERB.
     */
    public function isAdverb(): bool
    {
        return in_array("IS_ADVERB", $this->flags);
    }

    /**
     * The isPostP method returns true if flags {@link Array} contains IS_POSTP.
     *
     * @return bool true if flags {@link Array} contains IS_POSTP.
     */
    public function isPostp(): bool
    {
        /*
         *The bare-form of the word is a postposition. e.g. Önce, takdirde, üzere
         */
        return in_array("IS_POSTP", $this->flags);
    }

    /**
     * The isPortmanteauEndingWithSI method returns true if flags {@link Array} contains IS_B_SI.
     *
     * @return bool true if flags {@link Array} contains IS_B_SI.
     */
    public function isPortmanteauEndingWithSI(): bool
    {
        /*
         *IS_B_SI: The bare-form is a portmanteau word ending with "sı". e.g. Giritlalesi
         */
        return in_array("IS_B_SI", $this->flags);
    }

    /**
     * The isPortmanteauFacedVowelEllipsis method returns true if flags {@link Array} contains IS_B_UD.
     *
     * @return bool true if flags {@link Array} contains IS_B_UD.
     */
    public function isPortmanteauFacedVowelEllipsis(): bool
    {
        /*
         *IS_B_UD: The bare-form of the word includes vowel epenthesis,
         *therefore the last inserted vowel drops during suffixation. e.g. İnsanoğlu
         */
        return in_array("IS_B_UD", $this->flags);
    }

    /**
     * The isPortmanteauFacedSoftening method returns true if flags {@link Array} contains IS_B_UD.
     *
     * @return bool true if flags {@link Array} contains IS_B_SD.
     */
    public function isPortmanteauFacedSoftening(): bool
    {
        /*
         *IS_B_SD: The bare-form of the word includes softening. e.g. Çançiçeği
         */
        return in_array("IS_B_SD", $this->flags);
    }

    /**
     * The isSuffix method returns true if flags {@link Array} contains EK.
     *
     * @return bool true if flags {@link Array} contains EK.
     */
    public function isSuffix(): bool
    {
        /*
         * EK: This tag indicates complementary verbs. e.g. İdi, iken, imiş.
         */
        return in_array("EK", $this->flags);
    }

    /**
     * The isProperNoun method returns true if flags {@link Array} contains IS_OA.
     *
     * @return bool true if flags {@link Array} contains IS_OA.
     */
    public function isProperNoun(): bool
    {
        /*
         *IS_OA: The bare-form of the word is a proper noun. e.g. Abant, Beşiktaş
         */
        return in_array("IS_OA", $this->flags);
    }

    /**
     * The isPlural method returns true if flags {@link Array} contains IS_CA.
     *
     * @return bool true if flags {@link Array} contains IS_CA.
     */
    public function isPlural(): bool
    {
        /*
         *IS_CA: The bare-form of the word is already in a plural form,
         *therefore can not take plural suffixes such as "ler" or "lar". e.g. Buğdaygiller
         */
        return in_array("IS_CA", $this->flags);
    }

    /**
     * The isNumeral method returns true if flags {@link Array} contains IS_SAYI.
     *
     * @return bool true if flags {@link Array} contains IS_SAYI.
     */
    public function isNumeral(): bool
    {
        /*
         *IS_SAYI: The word is a number. e.g. Dört
         */
        return in_array("IS_SAYI", $this->flags);
    }

    /**
     * The isReal method returns true if flags {@link Array} contains IS_REELSAYI.
     *
     * @return bool true if flags {@link Array} contains IS_REELSAYI.
     */
    public function isReal(): bool
    {
        return in_array("IS_REELSAYI", $this->flags);
    }

    /**
     * The isFraction method returns true if flags {@link Array} contains IS_KESIR.
     *
     * @return bool true if flags {@link Array} contains IS_KESIR.
     */
    public function isFraction(): bool
    {
        return in_array("IS_KESIR", $this->flags);
    }

    /**
     * The isTime method returns true if flags {@link Array} contains IS_ZAMAN.
     *
     * @return bool true if flags {@link Array} contains IS_ZAMAN.
     */
    public function isTime(): bool
    {
        return in_array("IS_ZAMAN", $this->flags);
    }

    /**
     * The isDate method returns true if flags {@link Array} contains IS_DATE.
     *
     * @return bool true if flags {@link Array} contains IS_DATE.
     */
    public function isDate(): bool
    {
        return in_array("IS_DATE", $this->flags);
    }

    /**
     * The isPercent method returns true if flags {@link Array} contains IS_PERCENT.
     *
     * @return bool true if flags {@link Array} contains IS_PERCENT.
     */
    public function isPercent(): bool
    {
        return in_array("IS_PERCENT", $this->flags);
    }

    /**
     * The isRange method returns true if flags {@link Array} contains IS_RANGE.
     *
     * @return bool true if flags {@link Array} contains IS_RANGE.
     */
    public function isRange(): bool
    {
        return in_array("IS_RANGE", $this->flags);
    }

    /**
     * The isOrdinal method returns true if flags {@link Array} contains IS_ORD.
     *
     * @return bool true if flags {@link Array} contains IS_ORD.
     */
    public function isOrdinal(): bool
    {
        /*
         *IS_ORD: The bare-form of the word can take suffixes and these suffixes define a ranking. e.g. Birinci
         */
        return in_array("IS_ORD", $this->flags);
    }

    /**
     * The notObeysVowelHarmonyDuringAgglutination method returns true if flags {@link Array} contains IS_UU.
     *
     * @return true if flags {@link Array} contains IS_UU.
     */
    public function notObeysVowelHarmonyDuringAgglutination(): bool
    {
        /*
         *IS_UU: The bare-form does not obey vowel harmony while taking suffixes. e.g. Dikkat
         */
        return in_array("IS_UU", $this->flags);
    }

    /**
     * The obeysAndNotObeysVowelHarmonyDuringAgglutination method returns true if flags {@link Array} contain IS_UUU.
     *
     * @return bool true if flags {@link Array} contains IS_UUU.
     */
    public function obeysAndNotObeysVowelHarmonyDuringAgglutination(): bool
    {
        /*
         *IS_UUU: The bare-form does not obey vowel harmony while taking suffixes. e.g. Bol, kalp
         */
        return in_array("IS_UUU", $this->flags);
    }

    /**
     * The rootSoftenDuringSuffixation method returns true if flags {@link Array} contains IS_SD, F_SD.
     *
     * @return bool true if flags {@link Array} contains IS_SD, F_SD.
     */
    public function rootSoftenDuringSuffixation(): bool
    {
        return in_array("IS_SD", $this->flags) || in_array("F_SD", $this->flags);
    }

    /**
     * The rootSoftenAndNotSoftenDuringSuffixation method returns true if flags {@link Array} contains IS_SDD.
     *
     * @return bool true if flags {@link Array} contains IS_SDD.
     */
    public function rootSoftenAndNotSoftenDuringSuffixation(): bool
    {
        /*
         *The bare-form final consonant can (or can not) get devoiced during vowel-initial suffixation. e.g. Kalp
         */
        return in_array("IS_SDD", $this->flags);
    }

    /**
     * The verbSoftenDuringSuffixation method returns true if flags {@link Array} contains F_SD.
     *
     * @return bool true if flags {@link Array} contains F_SD.
     */
    public function verbSoftenDuringSuffixation(): bool
    {
        /*
         * F_SD: The bare-form final consonant gets devoiced during vowel-initial suffixation. e.g. Cezbet
         */
        return in_array("F_SD", $this->flags);
    }

    /**
     * The nounSoftenDuringSuffixation method returns true if flags {@link Array} contains IS_SD.
     *
     * @return bool true if flags {@link Array} contains IS_SD.
     */
    public function nounSoftenDuringSuffixation(): bool
    {
        /*
         *IS_SD: The bare-form final consonant already has an accusative suffix. e.g. Kabağı
         */
        return in_array("IS_SD", $this->flags);
    }

    /**
     * The endingKChangesIntoG method returns true if flags {@link Array} contains IS_KG.
     *
     * @return bool true if flags {@link Array} contains IS_KG.
     */
    public function endingKChangesIntoG(): bool
    {
        /*
         *IS_KG: The bare-form includes vowel epenthesis, therefore the last inserted vowel drope
         *during suffixation. e.g. Çelenk
         */
        return in_array("IS_KG", $this->flags);
    }

    /**
     * The isExceptional method returns true if flags {@link Array} contains IS_EX.
     *
     * @return true if flags {@link Array} contains IS_EX.
     */
    public function isExceptional(): bool
    {
        /*
         *IS_EX: This tag defines exception words. e.g. Delikanlı
         */
        return in_array("IS_EX", $this->flags);
    }

    /**
     * The duplicatesDuringSuffixation method returns true if flags {@link Array} contains IS_ST.
     *
     * @return bool true if flags {@link Array} contains IS_ST.
     */
    public function duplicatesDuringSuffixation(): bool
    {
        /*
         *IS_ST: The second consonant of the bare-form undergoes a resyllabification. e.g. His
         */
        return in_array("IS_ST", $this->flags);
    }

    /**
     * The duplicatesAndNotDuplicatesDuringSuffixation method returns true if flags {@link Array} contains IS_STT.
     *
     * @return bool true if flags {@link Array} contains IS_STT.
     */
    public function duplicatesAndNotDuplicatesDuringSuffixation(): bool
    {
        /*
         *IS_STT: The second consonant of the bare-form undergoes a resyllabification. e.g. His
         */
        return in_array("IS_STT", $this->flags);
    }

    /**
     * The lastIdropsDuringSuffixation method returns true if flags {@link Array} contains IS_UD.
     *
     * @return bool true if flags {@link Array} contains IS_UD.
     */
    public function lastIdropsDuringSuffixation(): bool
    {
        /*
         *IS_UD: The bare-form includes vowel epenthesis, therefore the last inserted vowel drops during suffixation.
         *e.g. Boyun
         */
        return in_array("IS_UD", $this->flags);
    }

    /**
     * The lastIDropsAndNotDropDuringSuffixation method returns true if flags {@link Array} contains IS_UDD.
     *
     * @return bool true if flags {@link Array} contains IS_UDD.
     */
    public function lastIDropsAndNotDropDuringSuffixation(): bool
    {
        /*
         *The bare-form includes vowel epenthesis, therefore the last inserted vowel can (or can not) drop during
         * suffixation. e.g. Kadir
         */
        return in_array("IS_UDD", $this->flags);
    }

    /**
     * The takesRelativeSuffixKi method returns true if flags {@link Array} contains IS_KI.
     *
     * @return bool true if flags {@link Array} contains IS_KI.
     */
    public function takesRelativeSuffixKi(): bool
    {
        /*
         *IS_KI: The word can take a suffix such as "ki". e.g. Önce
         */
        return in_array("IS_KI", $this->flags);
    }

    /**
     * The takesRelativeSuffixKu method returns true if flags {@link Array} contains IS_KU.
     *
     * @return bool true if flags {@link Array} contains IS_KU.
     */
    public function takesRelativeSuffixKu(): bool
    {
        /*
         *IS_KU: The word can take a suffix such as "kü". e.g. Bugün
         */
        return in_array("IS_KU", $this->flags);
    }

    /**
     * The consonantSMayInsertedDuringPossesiveSuffixation method returns true if flags {@link Array} contains IS_SII.
     *
     * @return bool true if flags {@link Array} contains IS_SII.
     */
    public function consonantSMayInsertedDuringPossesiveSuffixation(): bool
    {
        return in_array("IS_SII", $this->flags);
    }

    /**
     * The lastIdropsDuringPassiveSuffixation method returns true if flags {@link Array} contains F_UD.
     *
     * @return bool true if flags {@link Array} contains F_UD.
     */
    public function lastIdropsDuringPassiveSuffixation(): bool
    {
        /*
         *F_UD: The bare-form includes vowel epenthesis, therefore the last "ı"
         *drops during passive suffixation. e.g. Çağır
         */
        return in_array("F_UD", $this->flags);
    }

    /**
     * The vowelAChangesToIDuringYSuffixation method returns true if flags {@link Array} contains F_GUD.
     *
     * @return bool true if flags {@link Array} contains F_GUD.
     */
    public function vowelAChangesToIDuringYSuffixation(): bool
    {
        /*
         *F_GUD: The verb bare-form includes vowel reduction, the last vowel "a" of the bare-form is replaced with "ı"
         *e.g. Buzağıla
         */
        return in_array("F_GUD", $this->flags);
    }

    /**
     * The vowelEChangesToIDuringYSuffixation method returns true if flags {@link Array} contains F_GUDO.
     *
     * @return bool true if flags {@link Array} contains F_GUDO.
     */
    public function vowelEChangesToIDuringYSuffixation(): bool
    {
        /*
         *F_GUDO: The verb bare-form includes viwel reduction, the last vowel "e" of the
         *bare-form is replaced with "i". e.g. Ye
         */
        return in_array("F_GUDO", $this->flags);
    }

    /**
     * The takesSuffixIRAsAorist method returns true if flags {@link Array} contains F_GIR.
     *
     * @return bool true if flags {@link Array} contains F_GIR.
     */
    public function takesSuffixIRAsAorist()
    {
        /*
         *F_GIR: The bare-form of the word takes "ir" suffix. e.g. Geç
         */
        return !in_array("F_GIR", $this->flags);
    }

    /**
     * The takesSuffixDIRAsFactitive method returns true if flags {@link Array} contains F_DIR.
     *
     * @return bool true if flags {@link Array} contains F_DIR.
     */
    public function takesSuffixDIRAsFactitive(): bool
    {
        return !in_array("F_DIR", $this->flags);
    }

    /**
     * The showsSuRegularities method returns true if flags {@link Array} contains IS_SU.
     *
     * @return bool true if flags {@link Array} contains IS_SU.
     */
    public function showsSuRegularities(): bool{
        return in_array("IS_SU", $this->flags);
    }

    /**
     * The containsFlag method returns true if flags {@link Array} contains flag.
     *
     * @param string $flag Flag to be cheked
     * @return bool true if flags {@link Array} contains flag.
     */
    public function containsFlag(string $flag): bool{
        return in_array($flag, $this->flags);
    }

    public function __toString(): string
    {
        $result = parent::__toString();
        foreach ($this->flags as $flag) {
            $result .= " " . $flag;
        }
        return $result;
    }
}