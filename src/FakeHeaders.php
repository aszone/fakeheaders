<?php

namespace Aszone\FakeHeaders;

class FakeHeaders
{
    private $browserFile = __DIR__ . '/../resources/UserAgent/Browser.ini';
    
    private $systemFile = __DIR__ . '/../resources/UserAgent/System.ini';
    
    private $localeFile = __DIR__ . '/../resources/UserAgent/Locale.ini';

    private $browser, $system, $locale;

    private function parseIniFiles()
    {
        $this->browser = parse_ini_file($this->browserFile);
        $this->system  = parse_ini_file($this->systemFile);
        $this->locale  = parse_ini_file($this->localeFile);
    }

    public function setBrowserFile($file)
    {
        $this->browserFile = $file;
    }

    public function setSystemFile($file)
    {
        $this->systemFile = $file;
    }

    public function setLocaleFile($file)
    {
        $this->localeFile = $file;
    }

    public function getUserAgent()
    {
        $this->parseIniFiles();

        $randBrowser = $this->browser[rand(0, count($this->browser) - 1)];
        $randSystem  = $this->system[rand(0, count($this->system) - 1)];
        $randLocale  = $this->locale[rand(0, count($this->locale) - 1)];

        $format = "%s/%d.%d (%s %d.%d; %s;)";

        $userAgent = sprintf(
            $format, 
            $randBrowser, 
            rand(1, 20),
            rand(0, 20),
            $randSystem,
            rand(1, 7),
            rand(0, 9),
            $randLocale
        );

        return ['User-Agent' => $userAgent];
    }
}

