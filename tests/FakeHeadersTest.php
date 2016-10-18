<?php

namespace Aszone\FakeHeaders\Test;

use Aszone\FakeHeaders\FakeHeaders;

class FakeHeadersTest extends \PHPUnit_Framework_TestCase
{
    private $fake;

    public function setUp()
    {
        $this->fake = new FakeHeaders;
    }

    public function testGetUserAgent()
    {
        $userAgent = $this->fake->getUserAgent()['User-Agent'];
        
        $format = "%s/%d.%d (%s %d.%d; %s;)";
        $this->assertStringMatchesFormat($format, $userAgent);
    }

    public function testSetBrowserFile()
    {
        $this->fake->setBrowserFile( __DIR__ . '/../resources/UserAgent/tests/Browser.ini');
        $userAgent = $this->fake->getUserAgent()['User-Agent'];
        
        $this->assertContains('Firefox', $userAgent);
    }

    public function testSystemFile()
    {
        $this->fake->setSystemFile( __DIR__ . '/../resources/UserAgent/tests/System.ini');
        $userAgent = $this->fake->getUserAgent()['User-Agent'];
        
        $this->assertContains('Android', $userAgent);
    }

    public function testSetLocaleFile()
    {
        $this->fake->setLocaleFile( __DIR__ . '/../resources/UserAgent/tests/Locale.ini');
        $userAgent = $this->fake->getUserAgent()['User-Agent'];
        
        $this->assertContains('pt_BR', $userAgent);
    }
}

