<?php
namespace App;

class Request
{
    public $event;
    public $context;

    function __construct($event = null, $context = null) {
        $this->event = $event;
        $this->context = $context;
    }

}
