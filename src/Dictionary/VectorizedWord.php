<?php

namespace olcaytaner\Dictionary\Dictionary;

use olcaytaner\Math\Vector;

class VectorizedWord extends Word
{
    private readonly Vector $vector;

    /**
     * A constructor of {@link VectorizedWord} class which takes a String and a {@link Vector} as inputs and calls its
     * super class {@link Word} with name and also initializes vector variable with given input.
     *
     * @param string $name   String input.
     * @param Vector $vector {@link Vector} type input.
     */
    public function __construct(string $name, Vector $vector){
        parent::__construct($name);
        $this->vector = $vector;
    }

    /**
     * Getter for the vector variable.
     *
     * @return Vector the vector variable.
     */
    public function getVector(): Vector{
        return $this->vector;
    }
}