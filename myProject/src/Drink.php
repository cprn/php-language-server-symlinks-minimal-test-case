<?php

namespace Project;

use Bundle\Bar;

class Drink
{
    public function freeBeer()
    {
        $bar = new Bar;
        return $bar->getBeer();
    }
}
