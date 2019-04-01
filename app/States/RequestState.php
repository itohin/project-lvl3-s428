<?php

namespace App\States;


interface RequestState
{
    public function __construct($context);
    public function fail();
    public function complete();
    public function __toString();
}
