<?php
declare(strict_types=1);
namespace Serato\ServiceDiscovery;

use Exception;

class HostName
{
    public const SERATO_COM = 'serato_com';
    public const MANAGE_SERATO_COM = 'manage_serato_com';
    public const AUTH_SERATO_COM = 'auth_serato_com';
    public const STORE_SERATO_COM = 'store_serato_com';
    public const API_SERATO_COM = 'api_serato.com';
    public const PLAYLISTS = 'playlists';
    public const OLD_SCRATCHLIVE_NET = 'OLD_SCRATCHLIVE_NET';
    public const SERA_TO = 'sera_to';
    public const IN_SERA_TO_API = 'in_sera_to_api';

    public const MY_ACCOUNT = 'my_account';
    public const MY_SERATO = 'my_serato';
    public const SDJ_SIMULATOR = 'sdj_simulator';
    public const CONSOLE = 'console';

    public const IDENTITY = 'identity';
    public const LICENSE = 'license';
    public const ECOM = 'ecom';
    public const NOTIFICATIONS = 'notifications';
    public const DIGITAL_ASSETS = 'da';
    public const PROFILE = 'profile';
    public const REWARDS = 'rewards';

    private const ENVIRONMENT_NAMES = ['production', 'test', 'dev'];

    private const TEST_STACK_NUM_PLACEHOLDER = '__TEST_STACK_NUM__';

    private const HOSTS = [
        self::SERATO_COM => [
            'production' => 'https://serato.com',
            'staging' => 'https://serato.xyz',
            'preprod' => 'https://serato.biz',
            'dev' => 'http://192.168.4.2:8080',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '.serato.net'
        ],
        self::MANAGE_SERATO_COM => [
            'production' => 'https://manage.serato.com',
            'staging' => 'https://manage.serato.xyz',
            'preprod' => 'https://manage.serato.biz',
            'dev' => 'http://192.168.4.2:8083',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-manage.serato.net'
        ],
        self::AUTH_SERATO_COM => [
            'production' => 'https://auth.serato.com',
            'staging' => 'https://auth.serato.xyz',
            'preprod' => 'https://auth.serato.biz',
            'dev' => 'http://192.168.4.2:8081',
            'test' => 'http://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-my.serato.net'
        ],
        self::STORE_SERATO_COM => [
            'production' => 'https://store.serato.com',
            'staging' => 'https://store.serato.xyz',
            'preprod' => 'https://store.serato.biz',
            'dev' => 'http://192.168.2.2',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-store.serato.net'
        ],
        self::API_SERATO_COM => [
            'production' => 'https://api.serato.com',
            'staging' => 'https://api.serato.xyz',
            # No DNS entry for this (ie. doesn't exist in pre-prod):
            'preprod' => 'https://api.serato.biz',
            'dev' => 'http://192.168.5.2',
            # No test stacks exist and no DNS entries. So this is made up :-)
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-api.serato.net'
        ],
        self::PLAYLISTS => [
            'production' => 'https://playlists.serato.com',
            'staging' => 'https://playlists.serato.xyz',
            'preprod' => 'https://playlists.serato.biz',
            'dev' => 'http://192.168.4.2:8085',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-playlists.serato.net'
        ],
        self::OLD_SCRATCHLIVE_NET => [
            'production' => 'http://old.scratchlive.net',
            'staging' => 'https://translation.serato.xyz',
            'preprod' => 'https://translation.serato.biz',
            'dev' => 'http://192.168.4.2:8086',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-translation.serato.net'
        ],
        self::SERA_TO => [
            'production' => 'https://sera.to',
            'staging' => 'https://redirects.serato.xyz',
            'preprod' => 'http://redirects.serato.biz',
            'dev' => 'http://192.168.4.2:8084',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-redirects.serato.net'
        ],
        self::IN_SERA_TO_API => [
            'production' => 'https://in.api.sera.to',
            'staging' => 'https://in-api.serato.xyz',
            # No DNS entry for this (ie. doesn't exist in pre-prod):
            'preprod' => 'https://in-api.serato.xyz',
            'dev' => 'http://192.168.0.2',
            # No test stacks exist and no DNS entries. So this is made up :-)
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-in-api.serato.net'
        ],

        # Frontend apps service from the "apps.serato.com" web application
        # These currently all use the same domain name.
        self::MY_ACCOUNT => [
            'production' => 'https://account.serato.com',
            'staging' => 'https://account.serato.xyz',
            'preprod' => 'https://account.serato.biz',
            'dev' => 'http://192.168.4.10',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-apps.serato.net'
        ],
        self::MY_SERATO => [
            'production' => 'https://account.serato.com',
            'staging' => 'https://account.serato.xyz',
            'preprod' => 'https://account.serato.biz',
            'dev' => 'http://192.168.4.10',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-apps.serato.net'
        ],
        self::SDJ_SIMULATOR => [
            'production' => 'https://account.serato.com',
            'staging' => 'https://account.serato.xyz',
            'preprod' => 'https://account.serato.biz',
            'dev' => 'http://192.168.4.10',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-apps.serato.net'
        ],
        self::CONSOLE => [
            'production' => 'https://account.serato.com',
            'staging' => 'https://account.serato.xyz',
            'preprod' => 'https://account.serato.biz',
            'dev' => 'http://192.168.4.10',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-apps.serato.net'
        ],

        # SWS Web Services
        self::IDENTITY => [
            'production' => 'https://id.serato.com',
            'staging' => 'https://id.serato.xyz',
            'preprod' => 'https://id.serato.biz',
            'dev' => 'http://192.168.4.14:8585',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-id.serato.net',
            'sws_host_key' => 'id'
        ],
        self::LICENSE => [
            'production' => 'https://license.serato.com',
            'staging' => 'https://license.serato.xyz',
            'preprod' => 'https://license.serato.biz',
            'dev' => 'http://192.168.4.14:8686',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-license.serato.net',
            'sws_host_key' => 'license'
        ],
        self::ECOM => [
            'production' => 'https://ecom.serato.com',
            'staging' => 'https://ecom.serato.xyz',
            'preprod' => 'https://ecom.serato.biz',
            'dev' => 'http://192.168.4.14:8787',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-ecom.serato.net',
            'sws_host_key' => 'ecom'
        ],
        self::NOTIFICATIONS => [
            'production' => 'https://notifications.serato.com',
            'staging' => 'https://notifications.serato.xyz',
            'preprod' => 'https://notifications.serato.biz',
            'dev' => 'http://192.168.4.14:8484',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-notifications.serato.net',
            'sws_host_key' => 'notifications'
        ],
        self::DIGITAL_ASSETS => [
            'production' => 'https://da.serato.com',
            'staging' => 'https://da.serato.xyz',
            'preprod' => 'https://da.serato.biz',
            'dev' => 'http://192.168.4.14:8383',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-da.serato.net',
            'sws_host_key' => 'da'
        ],
        self::PROFILE => [
            'production' => 'https://profile.serato.com',
            'staging' => 'https://profile.serato.xyz',
            'preprod' => 'https://profile.serato.biz',
            'dev' => 'http://192.168.4.14:8282',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-profile.serato.net',
            'sws_host_key' => 'profile'
        ],
        self::REWARDS => [
            'production' => 'https://rewards.serato.com',
            'staging' => 'https://rewards.serato.xyz',
            'preprod' => 'https://rewards.serato.biz',
            'dev' => 'http://192.168.4.14:8788',
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-profile.serato.net',
            'sws_host_key' => 'rewards'
        ]
    ];

    /** @var string */
    private $environmentName;

    /** @var integer */
    private $environmentNumber;

    public function __construct(string $environmentName, int $environmentNumber)
    {
        if (!in_array($environmentName, self::ENVIRONMENT_NAMES)) {
            throw new Exception(
                'Invalid environment name `' . $environmentName . '`. Valid environment names are `' .
                implode('`, `', self::ENVIRONMENT_NAMES) . '`.'
            );
        }

        $this->environmentName = $environmentName;
        $this->environmentNumber = $environmentNumber;
    }

    /**
     * Returns a host name, including protocol, for the specified application
     *
     * @param string $app
     * @return string
     * @throws Exception
     */
    public function get(string $app): string
    {
        if (!isset(self::HOSTS[$app])) {
            throw new Exception('Invalid application name `' . $app . '`');
        } elseif ($this->environmentName === 'production' || $this->environmentName === 'dev') {
            # 'production' and 'dev'
            return self::HOSTS[$app][$this->environmentName];
        } elseif ($this->environmentNumber === 0) {
            # pre-prod
            return self::HOSTS[$app]['preprod'];
        } elseif ($this->environmentNumber === 1) {
            # staging
            return self::HOSTS[$app]['staging'];
        } else {
            # All other test stacks
            return str_replace(
                self::TEST_STACK_NUM_PLACEHOLDER,
                (string)$this->environmentNumber,
                self::HOSTS[$app]['test']
            );
        }
    }

    /**
     * Returns an array of all hosts
     *
     * @return array<string, string>
     */
    public function getAll(): array
    {
        $hosts = [];
        foreach (self::HOSTS as $host => $hostData) {
            $hosts[$host] = $this->get($host);
        }
        return $hosts;
    }

    /**
     * Returns an array of host names for all SWS web services.
     *
     * The keys of the array are as follows:
     *
     * - 'profile'
     * - 'da'
     * - 'notifications'
     * - 'id'
     * - 'license'
     * - 'ecom'
     * - 'rewards'
     *
     * @return array<string, string>
     */
    public function getSwsHosts(): array
    {
        # FWIW, the `sws_host_key` value is used because this method is primarily a convenience method
        # for generating an array of URIs to feed into the SWS JS SDK.
        # The SWS JS SDK expects certain keys in this array. The `sws_host_key` value is used for the key
        # value. ie. It must be the value expected by the SWS JS SDK.
        $hosts = [];
        foreach (self::HOSTS as $host => $hostData) {
            if (isset($hostData['sws_host_key'])) {
                $hosts[$hostData['sws_host_key']] = $this->get($host);
            }
        }
        return $hosts;
    }
}
