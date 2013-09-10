<?php

namespace Ornamental\Tests;

class CustomSender implements \Ornamental\Sender
{
    public $wasCalled = false;

    public function send($message)
    {
        $this->wasCalled = true;
    }
}

class MultipleSendersTest extends OrnamentalTestSuite
{
    public function testSend()
    {
        $senderOne = new CustomSender();
        $senderTwo = new CustomSender();

        $setup = \Ornamental\Settings::getInstance();
        $setup->addSender($senderOne);
        $setup->addSender($senderTwo);

        $message = new \Ornamental\Message('user_welcome');
        $message->user = array('data' => 1);
        $message->send();

        $this->assertTrue($senderOne->wasCalled);
        $this->assertTrue($senderTwo->wasCalled);
    }
}
