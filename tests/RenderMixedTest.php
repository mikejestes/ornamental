<?php

namespace Ornamental\Tests;

class RenderMixedTest extends OrnamentalTestSuite
{
    public function testRenderHtml()
    {
        $message = new \Ornamental\Message('mixed');
        $message->user = array(
            'name' => 'Example User',
            'email' => 'test.user@example.com',
            'link' => 'http://cnn.com/',
        );

        $html = $message->renderHtml();
        $expected = <<<END
<html>


Dear Example User,<br><br>

Welcome to our service. We really thank you for signing up.<br><br>

<a href="http://cnn.com/">Come check us out</a>.<br><br>

--<br>
The Team


</html>

END;

        $this->assertEquals($expected, $html);

    }
}
