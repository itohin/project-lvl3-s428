<?php

namespace App\States;


class FailedState implements RequestState
{
    protected $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function fail()
    {
        throw new \Exception('Not allowed transition');
    }

    public function complete()
    {
        throw new \Exception('Not allowed transition');
    }

    public function __toString()
    {
        return Request::FAILED;
    }
}
