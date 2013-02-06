<?php

namespace Ornamental;

class Settings
{
    public $templateDir;
    public $messageDir;
    public $layoutDir;

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Settings();
        }

        return self::$instance;
    }
}
