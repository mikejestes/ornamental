<?php

namespace Ornamental;

class Deliveries
{
    public $log = array();

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Deliveries();
        }

        return self::$instance;
    }

    public function add($message)
    {
        $this->log[] = $message;
    }

    public function reset()
    {
        $this->log = array();
    }
}
