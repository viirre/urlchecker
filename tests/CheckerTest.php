<?php

namespace League\UrlChecker\Test;

use Viirre\UrlChecker\Checker;

class CheckerTest extends \PHPUnit_Framework_TestCase
{

    protected $checker;

    public function setUp()
    {
        $this->checker = new Checker();
    }

    /**
     * Test that it throws an exception if url is malformed
     *
     * @expectedException Viirre\UrlChecker\UrlMalformedException
     */
    public function testThatItThrowsAMalformedUrlExceptionCorrectly()
    {
        $url = 'www.badurl.com';
        $this->checker->check($url);
    }


    /**
     * Test that a online host with a good url (eg. google.com) returns with status "online" and a 200 status code
     */
    public function testThatAGoodUrlIsRespondingOk()
    {
        $url = 'http://www.google.com';
        $status = $this->checker->check($url);

        $this->assertTrue($status->isRespondingOk());
        $this->assertEquals($status->getStatusCode(), 200);
    }

    /**
     * Test that a online host with a malformed url (eg. google.com/uuuuuh.html) returns with status code other than 200 but is still "responding"
     */
    public function testThatAOnlineHostWithBadUrlReturnsNotA200()
    {
        $url = 'http://www.google.com/ughhhh.htm';
        $status = $this->checker->check($url);

        $this->assertTrue($status->isResponding());
        $this->assertNotEquals($status->getStatusCode(), 200);
    }

    /**
     * Test that a fake host returns a Status with "not online"
     */
    public function testThatItReturnsOfflineForanUnresolvedHost()
    {
        $url = 'http://www.unresolvabledomainnameipromiseyouyyy.com';
        $status = $this->checker->check($url);

        $this->assertFalse($status->isRespondingOk());
        $this->assertTrue($status->hostIsUnresolvable());
    }
}
