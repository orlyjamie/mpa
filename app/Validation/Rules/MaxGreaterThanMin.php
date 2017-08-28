<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class MaxGreaterThanMin extends AbstractRule
{
    protected $min;

    public function __construct($min)
    {
        $this->min = $min;
    }

    public function validate($input)
    {
        if(!empty($input) && ($input < $this->min)){
            return false;
        } else{
            return true;
        }
    }

}