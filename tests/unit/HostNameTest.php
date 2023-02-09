<?php

declare(strict_types=1);

namespace Serato\ServiceDiscovery\Test;

use PHPUnit\Framework\TestCase;
use Serato\ServiceDiscovery\HostName;
use Exception;

class HostNameTest extends TestCase
{
    public function testInvalidEnvName(): void
    {
        $this->expectException(Exception::class);
        new HostName('wrong', 1);
    }

    public function testAppName(): void
    {
        $this->expectException(Exception::class);
        $hosts = new HostName('dev', 1);
        $hosts->get('wrong');
    }

    /**
     * Smoke test the HostName::get method with the `backend` variant
     *
     * @param string $envName
     * @param integer $envNumber
     * @param string $appName
     * @param string $backendMatch
     * @param string $frontendMatch
     * @return void
     *
     * @dataProvider smokeTestProvider
     */
    public function testGetSmokeTestBackend(
        string $envName,
        int $envNumber,
        string $appName,
        string $backendMatch,
        string $frontendMatch = null
    ): void {
        $hosts = new HostName($envName, $envNumber);
        $hostName = $hosts->get($appName, HostName::BACKEND);
        $this->assertTrue(strpos($hostName, $backendMatch) !== false);
    }

    /**
     * Smoke test the HostName::get method with the `frontend` variant
     *
     * @param string $envName
     * @param integer $envNumber
     * @param string $appName
     * @param string $backendMatch
     * @param string $frontendMatch
     * @return void
     *
     * @dataProvider smokeTestProvider
     */
    public function testGetSmokeTestFrontend(
        string $envName,
        int $envNumber,
        string $appName,
        string $backendMatch,
        string $frontendMatch = null
    ): void {
        $hosts = new HostName($envName, $envNumber);
        $hostName = $hosts->get($appName, HostName::FRONTEND);
        $this->assertTrue(strpos($hostName, $frontendMatch ?? $backendMatch) !== false);
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
            ['production', 0, HostName::REWARDS, 'https://'],
            ['production', 0, HostName::REWARDS, '.com'],
            ['production', 0, HostName::VIDEO, 'https://'],
            ['production', 0, HostName::VIDEO, '.com'],
            ['production', 0, HostName::AI_PROXY, '.com'],
            ['production', 1, HostName::STUDIO_WEB_APP, '.com'],
            ['production', 1, HostName::STUDIO_WEB_APP, 'https://'],
            ['production', 0, HostName::STUDIO_WEB_APP, '.com'],
            ['production', 0, HostName::STUDIO_WEB_APP, 'https://'],
            ['production', 1, HostName::VISUALIZER, '.com'],
            ['production', 1, HostName::VISUALIZER, 'https://'],
            ['production', 0, HostName::VISUALIZER, '.com'],
            ['production', 0, HostName::VISUALIZER, 'https://'],
            ['production', 1, HostName::MY_SERATO, 'https://myserato.serato.com'],
            ['production', 1, HostName::SDJ_SIMULATOR, 'https://sdjsim.serato.com'],
            ['production', 0, HostName::MY_SERATO, 'https://myserato.serato.com'],
            ['production', 0, HostName::SDJ_SIMULATOR, 'https://sdjsim.serato.com'],

            ['test', 1, HostName::SERATO_COM, '.xyz'],
            ['test', 1, HostName::SERATO_COM, 'https://'],
            ['test', 1, HostName::CONSOLE, '.net'],
            ['test', 1, HostName::CONSOLE, 'https://'],
            ['test', 1, HostName::IDENTITY, '.xyz'],
            ['test', 1, HostName::IDENTITY, 'https://'],
            ['test', 1, HostName::REWARDS, '.xyz'],
            ['test', 1, HostName::REWARDS, 'https://'],
            ['test', 1, HostName::VIDEO, '.xyz'],
            ['test', 1, HostName::VIDEO, 'https://'],
            ['test', 1, HostName::AI_PROXY, 'https://'],
            ['test', 1, HostName::STUDIO_WEB_APP, '.net'],
            ['test', 1, HostName::STUDIO_WEB_APP, 'https://'],
            ['test', 1, HostName::VISUALIZER, '.net'],
            ['test', 1, HostName::VISUALIZER, 'https://'],
            ['test', 1, HostName::MY_SERATO, 'https://myserato.serato.xyz'],
            ['test', 1, HostName::SDJ_SIMULATOR, 'https://sdjsim.serato.xyz'],

            ['test', 0, HostName::SERATO_COM, '.biz'],
            ['test', 0, HostName::SERATO_COM, 'https://'],
            ['test', 0, HostName::CONSOLE, '.net'],
            ['test', 0, HostName::CONSOLE, 'https://'],
            ['test', 0, HostName::IDENTITY, '.biz'],
            ['test', 0, HostName::IDENTITY, 'https://'],
            ['test', 0, HostName::VIDEO, '.biz'],
            ['test', 0, HostName::VIDEO, 'https://'],
            ['test', 0, HostName::AI_PROXY, '.biz'],
            ['test', 0, HostName::AI_PROXY, 'https://'],
            ['test', 0, HostName::STUDIO_WEB_APP, '.net'],
            ['test', 0, HostName::STUDIO_WEB_APP, 'https://'],
            ['test', 0, HostName::VISUALIZER, '.net'],
            ['test', 0, HostName::VISUALIZER, 'https://'],
            ['test', 0, HostName::MY_SERATO, 'https://myserato.serato.xyz'],
            ['test', 0, HostName::SDJ_SIMULATOR, 'https://sdjsim.serato.xyz'],

            ['dev', 0, HostName::SERATO_COM, 'http://192.'],
            ['dev', 0, HostName::CONSOLE, 'http://192.'],
            ['dev', 0, HostName::IDENTITY, 'http://192.'],

            ['dev', 1, HostName::SERATO_COM, 'http://192.'],
            ['dev', 1, HostName::CONSOLE, 'http://192.'],
            ['dev', 1, HostName::IDENTITY, 'http://192.'],
            ['dev', 1, HostName::REWARDS, 'http://192.'],
            ['dev', 1, HostName::VIDEO, 'http://192.'],
            ['dev', 1, HostName::AI_PROXY, 'http://192.'],
            ['dev', 1, HostName::STUDIO_WEB_APP, 'http://'],
            ['dev', 1, HostName::STUDIO_WEB_APP, 'localhost'],
            ['dev', 1, HostName::VISUALIZER, 'http://'],
            ['dev', 1, HostName::VISUALIZER, 'localhost'],
            ['dev', 1, HostName::MY_SERATO, 'http://'],
            ['dev', 1, HostName::MY_SERATO, 'localhost:8083'],
            ['dev', 1, HostName::SDJ_SIMULATOR, 'http://'],
            ['dev', 1, HostName::SDJ_SIMULATOR, 'localhost:8082'],

            ['dev', 2, HostName::SERATO_COM, 'serato-websites', 'localhost:8500'],
            ['dev', 2, HostName::MANAGE_SERATO_COM, 'serato-websites', 'localhost:8501'],
            ['dev', 2, HostName::AUTH_SERATO_COM, 'serato-websites', 'localhost:8502'],
            ['dev', 2, HostName::PLAYLISTS, 'serato-websites', 'localhost:8503'],
            ['dev', 2, HostName::SERA_TO, 'serato-websites', 'localhost:8505'],
            ['dev', 2, HostName::CONSOLE, 'http://192.'],
            ['dev', 2, HostName::IDENTITY, 'sws-identity', 'localhost:8300'],
            ['dev', 2, HostName::LICENSE, 'sws-license', 'localhost:8301'],
            ['dev', 2, HostName::ECOM, 'sws-ecom', 'localhost:8302'],
            ['dev', 2, HostName::NOTIFICATIONS, 'sws-notifications', 'localhost:8303'],
            ['dev', 2, HostName::DIGITAL_ASSETS, 'sws-da', 'localhost:8304'],
            ['dev', 2, HostName::PROFILE, 'sws-profile', 'localhost:8305'],
            ['dev', 2, HostName::REWARDS, 'sws-rewards', 'localhost:8306'],
            ['dev', 2, HostName::AI_PROXY, 'sws-ai-proxy', 'localhost:8308'],
            ['dev', 2, HostName::STUDIO_WEB_APP, 'http://'],
            ['dev', 2, HostName::STUDIO_WEB_APP, 'localhost'],
            ['dev', 2, HostName::VISUALIZER, 'http://'],
            ['dev', 2, HostName::VISUALIZER, 'localhost'],
            ['dev', 2, HostName::MY_SERATO, 'http://'],
            ['dev', 2, HostName::MY_SERATO, 'localhost:8083'],
            ['dev', 2, HostName::SDJ_SIMULATOR, 'http://'],
            ['dev', 2, HostName::SDJ_SIMULATOR, 'localhost:8082'],

            ['test', 2, HostName::SERATO_COM, '.net'],
            ['test', 2, HostName::SERATO_COM, 'https://test-2'],
            ['test', 2, HostName::CONSOLE, '.net'],
            ['test', 2, HostName::IDENTITY, '.net'],
            ['test', 2, HostName::IDENTITY, 'https://test-2'],
            ['test', 2, HostName::REWARDS, '.net'],
            ['test', 2, HostName::REWARDS, 'https://test-2'],
            ['test', 2, HostName::AI_PROXY, '.net'],
            ['test', 2, HostName::AI_PROXY, 'https://test-2'],
            ['test', 2, HostName::STUDIO_WEB_APP, '.net'],
            ['test', 2, HostName::STUDIO_WEB_APP, 'https://'],
            ['test', 2, HostName::VISUALIZER, '.net'],
            ['test', 2, HostName::VISUALIZER, 'https://'],
            ['test', 2, HostName::MY_SERATO, 'https://myserato.serato.xyz'],
            ['test', 2, HostName::SDJ_SIMULATOR, 'https://sdjsim.serato.xyz'],

            ['test', 12, HostName::SERATO_COM, '.net'],
            ['test', 12, HostName::SERATO_COM, 'https://test-12'],
            ['test', 12, HostName::CONSOLE, '.net'],
            ['test', 12, HostName::IDENTITY, '.net'],
            ['test', 12, HostName::IDENTITY, 'https://test-12'],
            ['test', 12, HostName::REWARDS, '.net'],
            ['test', 12, HostName::REWARDS, 'https://test-12'],
            ['test', 12, HostName::AI_PROXY, '.net'],
            ['test', 12, HostName::AI_PROXY, 'https://test-12'],
            ['test', 12, HostName::STUDIO_WEB_APP, '.net'],
            ['test', 12, HostName::STUDIO_WEB_APP, 'https://'],
            ['test', 12, HostName::VISUALIZER, '.net'],
            ['test', 12, HostName::VISUALIZER, 'https://'],
            ['test', 12, HostName::MY_SERATO, 'https://myserato.serato.xyz'],
            ['test', 12, HostName::SDJ_SIMULATOR, 'https://sdjsim.serato.xyz']
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
