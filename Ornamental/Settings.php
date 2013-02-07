<?php

namespace Ornamental;

class Settings
{
    public $templateDir;
    public $messageDir;
    public $layoutDir;
    public $sender;

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Settings();
            self::$instance->sender = new Sender\Null(self::$instance);
        }

        return self::$instance;
    }
}
