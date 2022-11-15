<?php

namespace Hillel\AgentUserMatomo\Test;

use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use DeviceDetector\Parser\Client\Browser;
use DeviceDetector\Parser\OperatingSystem;
use Hillel\AgentUser\Test\UserAgentInterface;
use Illuminate\Http\Request;

class MatomoService implements UserAgentInterface
{
    private $dd;

    public function __construct()
    {
        $this->getServerInfo();
    }

    public function getServerInfo()
    {
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

        $userAgent = request()->server('HTTP_USER_AGENT'); // change this to the useragent you want to parse
        $clientHints = ClientHints::factory(request()->server()); // client hints are optional

        $dd = new DeviceDetector($userAgent, $clientHints);

        $dd->parse();
        $this->dd = $dd;
    }

    public function getBrowser(): string
    {
        $browserFamily = Browser::getBrowserFamily($this->dd->getClient('name'));

        return $browserFamily;
    }

    public function getOS(): string
    {
        $osFamily = OperatingSystem::getOsFamily($this->dd->getOs('name'));
        return $osFamily;
    }
}