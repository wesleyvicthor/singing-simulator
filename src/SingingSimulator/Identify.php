<?php

namespace InnoGames\SingingSimulator;

trait Identify
{
    public function __toString()
    {
        return substr(strrchr(get_class($this), '\\'), 1);
    }
}
