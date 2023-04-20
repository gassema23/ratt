<?php

namespace App\Events;

class Lockout
{
    public $key, $identifier;

    public function __construct(string $key, string $identifier = '')
    {
        $this->key = $key;
        $this->identifier = $identifier;
    }
}
