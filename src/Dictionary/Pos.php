<?php

namespace olcaytaner\Dictionary\Dictionary;

enum Pos
{
    /**
     * Adjective.
     */
    case ADJECTIVE;
    /**
     * Noun.
     */
    case NOUN;
    /**
     * Verb.
     */
    case VERB;
    /**
     * Adverb.
     */
    case ADVERB;
    /**
     * Conjunction.
     */
    case CONJUNCTION;
    /**
     * Interjection.
     */
    case INTERJECTION;
    /**
     * Preposition.
     */
    case PREPOSITION;
    /**
     * Pronoun.
     */
    case PRONOUN;
}