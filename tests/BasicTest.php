<?php

namespace Ornamental\Tests;

class BasicTest extends OrnamentalTestSuite
{

    public function testLoadMessage()
    {
        $message = new \Ornamental\Message('user_welcome');
        $this->assertEquals('service@example.com', $message->from);
        $this->assertEquals('Welcome to Ornamental, user.name', $message->subject);
    }

    /**
     * @expectedException Exception
     */
    public function testMissingRequiredThrowsException()
    {
        $message = new \Ornamental\Message('user_welcome');
        $message->send();
    }

    public function testUnknownMessageThrowsException()
    {
        $setup = \Ornamental\Settings::getInstance();
        $this->setExpectedException('Exception', "non_existant message not found in " . $setup->messageDir);

        $message = new \Ornamental\Message('non_existant');
        $message->send();
    }

    public function testNullSend()
    {
        $message = new \Ornamental\Message('user_welcome');
        $message->user = array('data' => 1);
        $message->send();
    }
}
