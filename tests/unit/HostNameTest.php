<?php

declare(strict_types=1);

namespace Serato\ServiceDiscovery\Test;

use PHPUnit\Framework\TestCase;
use Serato\ServiceDiscovery\HostName;

class HostNameTest extends TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testInvalidEnvName(): void
    {
        new HostName('wrong', 1);
    }

    /**
     * @expectedException \Exception
     */
    public function testAppName(): void
    {
        $hosts = new HostName('dev', 1);
        $hosts->get('wrong');
    }

    /**
     * Smoke test the HostName::get method
     *
     * @param string $envName
     * @param integer $envNumber
     * @param string $appName
     * @param string $match
     * @return void
     *
     * @dataProvider smokeTestProvider
     */
    public function testGetSmokeTest(string $envName, int $envNumber, string $appName, string $match): void
    {
        $hosts = new HostName($envName, $envNumber);
        $hostName = $hosts->get($appName);
        $this->assertTrue(strpos($hostName, $match) !== false);
    }

    /**
     * @return array<array>
     */
    public function smokeTestProvider(): array
    {
        return [
            ['production', 1, HostName::SERATO_COM, '.com'],
            ['production', 1, HostName::SERATO_COM, 'https://'],
            ['production', 0, HostName::SERATO_COM, '.com'],
            ['production', 0, HostName::SERATO_COM, 'https://'],
            ['production', 1, HostName::CONSOLE, '.com'],
            ['production', 1, HostName::CONSOLE, 'https://'],
            ['production', 0, HostName::CONSOLE, '.com'],
            ['production', 0, HostName::CONSOLE, 'https://'],
            ['production', 1, HostName::IDENTITY, '.com'],
            ['production', 1, HostName::IDENTITY, 'https://'],
            ['production', 0, HostName::IDENTITY, '.com'],
            ['production', 0, HostName::IDENTITY, 'https://'],


            ['test', 1, HostName::SERATO_COM, '.xyz'],
            ['test', 1, HostName::SERATO_COM, 'https://'],
            ['test', 1, HostName::CONSOLE, '.xyz'],
            ['test', 1, HostName::CONSOLE, 'https://'],
            ['test', 1, HostName::IDENTITY, '.xyz'],
            ['test', 1, HostName::IDENTITY, 'https://'],

            ['test', 0, HostName::SERATO_COM, '.biz'],
            ['test', 0, HostName::SERATO_COM, 'https://'],
            ['test', 0, HostName::CONSOLE, '.biz'],
            ['test', 0, HostName::CONSOLE, 'https://'],
            ['test', 0, HostName::IDENTITY, '.biz'],
            ['test', 0, HostName::IDENTITY, 'https://'],

            ['dev', 0, HostName::SERATO_COM, 'http://192.'],
            ['dev', 0, HostName::CONSOLE, 'http://192.'],
            ['dev', 0, HostName::IDENTITY, 'http://192.'],
            ['dev', 1, HostName::SERATO_COM, 'http://192.'],
            ['dev', 1, HostName::CONSOLE, 'http://192.'],
            ['dev', 1, HostName::IDENTITY, 'http://192.'],

            ['test', 2, HostName::SERATO_COM, '.net'],
            ['test', 2, HostName::SERATO_COM, 'https://test-2'],
            ['test', 2, HostName::CONSOLE, '.net'],
            ['test', 2, HostName::CONSOLE, 'https://test-2'],
            ['test', 2, HostName::IDENTITY, '.net'],
            ['test', 2, HostName::IDENTITY, 'https://test-2'],

            ['test', 12, HostName::SERATO_COM, '.net'],
            ['test', 12, HostName::SERATO_COM, 'https://test-12'],
            ['test', 12, HostName::CONSOLE, '.net'],
            ['test', 12, HostName::CONSOLE, 'https://test-12'],
            ['test', 12, HostName::IDENTITY, '.net'],
            ['test', 12, HostName::IDENTITY, 'https://test-12'],
        ];
    }

    public function testGetSwsHosts(): void
    {
        $hosts = new HostName('production', 1);
        $this->assertTrue(count($hosts->getSwsHosts()) > 0);
    }

    public function testGetAll(): void
    {
        $hosts = new HostName('production', 1);
        $this->assertTrue(count($hosts->getAll()) > 0);
    }
}
