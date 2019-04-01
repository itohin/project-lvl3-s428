<?php

namespace App\States;


class InitState implements RequestState
{
    protected $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function fail()
    {
        $this->context->state = new FailedState($this->context);
    }

    public function complete()
    {
        $this->context->state = new CompletedState($this->context);
    }

    public function __toString()
    {
        return Request::INIT;
    }
}
