<?php

namespace olcaytaner\Dictionary\Dictionary;

class ExceptionalWord extends Word
{
    private readonly string $root;
    private readonly Pos $pos;

    /**
     * A constructor of {@link ExceptionalWord} class which takes a {@link Pos} as a  part of speech and two Strings; name
     * and root as inputs. Then, calls its super class {@link Word} with given name and initialises root and pos variables
     * with given inputs.
     *
     * @param string $name String input.
     * @param string $root String input.
     * @param Pos $pos  {@link Pos} type input.
     */
    public function __construct(string $name, string $root, Pos $pos){
        parent::__construct($name);
        $this->root = $root;
        $this->pos = $pos;
    }

    /**
     * Getter for the root variable.
     *
     * @return string root variable.
     */
    public function getRoot(): string
    {
        return $this->root;
    }

    /**
     * Getter for the pos variable.
     *
     * @return Pos pos variable.
     */
    public function getPos(): Pos
    {
        return $this->pos;
    }
}