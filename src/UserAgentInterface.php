<?php

namespace Hillel\AgentUser\Test;
/**
 * Interface UserAgentInterface
 * @package Hillel\AgentUser\Test\UserAgent
 */
interface UserAgentInterface
{
    public function getBrowser(): string;

    public function getOS(): string;
}
