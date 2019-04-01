<?php

namespace App\States;

class Request extends \Illuminate\Database\Eloquent\Model
{
    const INIT = 'INIT';
    const COMPLETED = 'COMPLETED';
    const FAILED = 'FAILED';

    protected $state;

    public function __construct(array $attributes = [])
    {
        $this->state = new InitState($this);
    }

    public function complete()
    {
        $this->state->complete();
    }

    public function fail()
    {
        $this->state->fail();
    }

    public function getStateAttribute()
    {
        return $this->state;
    }

    public function setStateAttribute($value)
    {
        $this->state = $value;
    }
}
