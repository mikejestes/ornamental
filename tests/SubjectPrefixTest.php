<?php

namespace Ornamental\Tests;

class SubjectPrefixTest extends OrnamentalTestSuite
{
    public function testLoadMessage()
    {
        $setup = \Ornamental\Settings::getInstance();
        $setup->subjectPrefix = '[test] ';

        $message = new \Ornamental\Message('user_welcome');
        $message->user = array('name' => 'Joe');
        $message->send();
        $this->assertEquals('service@example.com', $message->from);
        $this->assertEquals('[test] Welcome to Ornamental, Joe', $message->subject);
    }

    public function testRepeatSend()
    {
        $setup = \Ornamental\Settings::getInstance();
        $setup->subjectPrefix = '[test] ';

        $message = new \Ornamental\Message('user_welcome');
        $message->user = array('name' => 'Joe');
        $message->send();
        $message->send();

        $this->assertEquals('service@example.com', $message->from);
        $this->assertEquals('[test] Welcome to Ornamental, Joe', $message->subject);
    }
}
