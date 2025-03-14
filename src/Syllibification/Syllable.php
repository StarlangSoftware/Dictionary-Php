<?php

namespace olcaytaner\Dictionary\Syllibification;

class Syllable
{
    private readonly string $syllable;

    /**
     * A constructor of {@link Syllable} class which takes a String as an input and initializes syllable variable with given input.
     *
     * @param string $syllable String input.
     */
    public function __construct(string $syllable){
        $this->syllable = $syllable;
    }

    /**
     * Getter for the syllable variable.
     *
     * @return string the syllable variable.
     */
    public function getText(): string{
        return $this->syllable;
    }
}