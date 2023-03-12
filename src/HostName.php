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
    public const MY_ACCOUNT_OLD = 'my_account_old';
    public const MY_SERATO = 'my_serato';
    public const SDJ_SIMULATOR = 'sdj_simulator';
    public const CONSOLE = 'console';
    public const STUDIO_WEB_APP = 'studio_web_app';
    public const VISUALIZER = 'visualizer';

    public const IDENTITY = 'identity';
    public const LICENSE = 'license';
    public const ECOM = 'ecom';
    public const NOTIFICATIONS = 'notifications';
    public const DIGITAL_ASSETS = 'da';
    public const PROFILE = 'profile';
    public const REWARDS = 'rewards';
    public const VIDEO = 'video';
    public const AI_PROXY = 'ai-proxy';

    public const FRONTEND = 'frontend';
    public const BACKEND = 'backend';

    private const ENVIRONMENT_NAMES = ['production', 'test', 'dev'];

    private const TEST_STACK_NUM_PLACEHOLDER = '__TEST_STACK_NUM__';

    private const HOSTS = [
        self::SERATO_COM => [
            'production' => 'https://serato.com',
            'staging' => 'https://serato.xyz',
            'preprod' => 'https://serato.biz',
            'dev' => 'http://192.168.4.2:8080',
            'dev2' => [
                // DNS name (and port) for internal Docker `frontend` network
                self::BACKEND => 'http://serato-websites:8500',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8500'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '.serato.net'
        ],
        self::MANAGE_SERATO_COM => [
            'production' => 'https://manage.serato.com',
            'staging' => 'https://manage.serato.xyz',
            'preprod' => 'https://manage.serato.biz',
            'dev' => 'http://192.168.4.2:8083',
            'dev2' => [
                // DNS name (and port) for internal Docker `frontend` network
                self::BACKEND => 'http://serato-websites:8501',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8501'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-manage.serato.net'
        ],
        self::AUTH_SERATO_COM => [
            'production' => 'https://auth.serato.com',
            'staging' => 'https://auth.serato.xyz',
            'preprod' => 'https://auth.serato.biz',
            'dev' => 'http://192.168.4.2:8081',
            'dev2' => [
                // DNS name (and port) for internal Docker `frontend` network
                self::BACKEND => 'http://serato-websites:8502',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8502'
            ],
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
            'dev2' => [
                // DNS name (and port) for internal Docker `frontend` network
                self::BACKEND => 'http://serato-websites:8503',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8503'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-playlists.serato.net'
        ],
        self::OLD_SCRATCHLIVE_NET => [
            'production' => 'http://old.scratchlive.net',
            'staging' => 'https://translation.serato.xyz',
            'preprod' => 'https://translation.serato.biz',
            'dev' => 'http://192.168.4.2:8086',
            'dev2' => [
                // DNS name (and port) for internal Docker `frontend` network
                self::BACKEND => 'http://serato-websites:8504',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8504'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-translation.serato.net'
        ],
        self::SERA_TO => [
            'production' => 'https://sera.to',
            'staging' => 'https://redirects.serato.xyz',
            'preprod' => 'http://redirects.serato.biz',
            'dev' => 'http://192.168.4.2:8084',
            'dev2' => [
                // DNS name (and port) for internal Docker `frontend` network
                self::BACKEND => 'http://serato-websites:8505',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8505'
            ],
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

        # Legacy service that used to host our frontend apps
        # It is a stub which has not functionality besides the redirects
        self::MY_ACCOUNT_OLD => [
            'production' => 'https://account.serato.com',
            'staging' => 'https://account.serato.xyz',
            'preprod' => 'https://account.serato.biz',
            'dev' => 'http://192.168.4.10',
            'dev2' => [
                // DNS name (and port) for internal Docker `frontend` network
                self::BACKEND => 'http://old-account:8309',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8309'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-apps.serato.net'
        ],

        self::MY_ACCOUNT => [
            'production' => 'https://my.serato.com',
            'staging' => 'https://my.serato.xyz',
            'preprod' => 'https://my.serato.biz',
            'dev' => 'http://localhost:8095',
            'test' => 'https://my.serato.xyz'
        ],

        /**
         * My Serato 2.0 has 3 environments - prod, test (staging) and dev (localhost)
         * Test stacks are mapped to the staging environment (xyz)
         */
        self::MY_SERATO => [
            'production' => 'https://myserato.serato.com',
            'staging' => 'https://myserato.serato.xyz',
            'preprod' => 'https://myserato.serato.xyz',
            'dev' => 'http://localhost:8083',
            'test' => 'https://myserato.serato.xyz'
        ],
        /**
         * SDJ sim app has 3 environments - prod, test (staging) and dev (localhost)
         * Test stacks are mapped to the staging environment (xyz)
         */
        self::SDJ_SIMULATOR => [
            'production' => 'https://sdjsim.serato.com',
            'staging' => 'https://sdjsim.serato.xyz',
            'preprod' => 'https://sdjsim.serato.xyz',
            'dev' => 'http://localhost:8082',
            'test' => 'https://sdjsim.serato.xyz'
        ],
        self::CONSOLE => [
            'production' => 'https://console.serato.com',
            'staging' => 'https://console.serato.net',
            'preprod' => 'https://console.serato.net',
            'dev' => 'http://192.168.4.10',
            'test' => 'https://console.serato.net'
        ],

        # Frontend apps served from CDN distributions wth unique domain names
        self::STUDIO_WEB_APP => [
            'production' => 'https://studio.serato.com',
            'staging' => 'https://studio.serato.net',
            'preprod' => 'https://studio.serato.net',
            'dev' => 'http://localhost:8080',
            'test' => 'https://studio.serato.net'
        ],
        self::VISUALIZER => [
            'production' => 'https://visualizer.serato.com',
            'staging' => 'https://visualizer.serato.net',
            'preprod' => 'https://visualizer.serato.net',
            'dev' => 'http://localhost:8080',
            'test' => 'https://visualizer.serato.net'
        ],

        # SWS Web Services
        self::IDENTITY => [
            'production' => 'https://id.serato.com',
            'staging' => 'https://id.serato.xyz',
            'preprod' => 'https://id.serato.biz',
            'dev' => 'http://192.168.4.14:8585',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-identity',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8300'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-id.serato.net',
            'sws_host_key' => 'id'
        ],
        self::LICENSE => [
            'production' => 'https://license.serato.com',
            'staging' => 'https://license.serato.xyz',
            'preprod' => 'https://license.serato.biz',
            'dev' => 'http://192.168.4.14:8686',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-license',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8301'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-license.serato.net',
            'sws_host_key' => 'license'
        ],
        self::ECOM => [
            'production' => 'https://ecom.serato.com',
            'staging' => 'https://ecom.serato.xyz',
            'preprod' => 'https://ecom.serato.biz',
            'dev' => 'http://192.168.4.14:8787',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-ecom',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8302'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-ecom.serato.net',
            'sws_host_key' => 'ecom'
        ],
        self::NOTIFICATIONS => [
            'production' => 'https://notifications.serato.com',
            'staging' => 'https://notifications.serato.xyz',
            'preprod' => 'https://notifications.serato.biz',
            'dev' => 'http://192.168.4.14:8484',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-notifications',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8303'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-notifications.serato.net',
            'sws_host_key' => 'notifications'
        ],
        self::DIGITAL_ASSETS => [
            'production' => 'https://da.serato.com',
            'staging' => 'https://da.serato.xyz',
            'preprod' => 'https://da.serato.biz',
            'dev' => 'http://192.168.4.14:8383',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-da',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8304'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-da.serato.net',
            'sws_host_key' => 'da'
        ],
        self::PROFILE => [
            'production' => 'https://profile.serato.com',
            'staging' => 'https://profile.serato.xyz',
            'preprod' => 'https://profile.serato.biz',
            'dev' => 'http://192.168.4.14:8282',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-profile',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8305'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-profile.serato.net',
            'sws_host_key' => 'profile'
        ],
        self::REWARDS => [
            'production' => 'https://rewards.serato.com',
            'staging' => 'https://rewards.serato.xyz',
            'preprod' => 'https://rewards.serato.biz',
            'dev' => 'http://192.168.4.14:8788',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-rewards',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8306'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-rewards.serato.net',
            'sws_host_key' => 'rewards'
        ],
        self::VIDEO => [
            'production' => 'https://video.serato.com',
            'staging' => 'https://video.serato.xyz',
            'preprod' => 'https://video.serato.biz',
            'dev' => 'http://192.168.4.14:8789',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-video',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8307'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-video.serato.net',
            'sws_host_key' => 'video'
        ],
        self::AI_PROXY => [
            'production' => 'https://ai-proxy.serato.com',
            'staging' => 'https://ai-proxy.serato.xyz',
            'preprod' => 'https://ai-proxy.serato.biz',
            'dev' => 'http://192.168.4.14:8790',
            'dev2' => [
                // DNS name for internal Docker `frontend` network (HTTP available on port 80)
                self::BACKEND => 'http://sws-ai-proxy',
                // DNS name (and port) for "external" access
                self::FRONTEND => 'http://localhost:8308'
            ],
            'test' => 'https://test-' . self::TEST_STACK_NUM_PLACEHOLDER . '-ai-proxy.serato.net',
            'sws_host_key' => 'ai-proxy'
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
     * @param string $variant   Determines which URL variant to return. Only relevant for some environments (eg "dev 2")
     *                          which require different URLs when used in a frontend or backend context.
     *                          Must be one of `frontend` or `backend`.
     * @return string
     * @throws Exception
     */
    public function get(string $app, string $variant = self::BACKEND): string
    {
        if ($variant !== self::BACKEND && $variant !== self::FRONTEND) {
            throw new Exception(
                'Invalid `variant` argument value. Must be one of: "' .
                self::FRONTEND . '" or "' . self::BACKEND . '"'
            );
        }
        if (!isset(self::HOSTS[$app])) {
            throw new Exception('Invalid application name `' . $app . '`');
        } elseif ($this->environmentName === 'production') {
            # 'production'
            return $this->getVariant(self::HOSTS[$app][$this->environmentName], $variant);
        } elseif ($this->environmentName === 'dev') {
            if ($this->environmentNumber === 2 && isset(self::HOSTS[$app]['dev2'])) {
                # 'dev 2'
                return $this->getVariant(self::HOSTS[$app]['dev2'], $variant);
            } else {
                # 'dev'
                return $this->getVariant(self::HOSTS[$app][$this->environmentName], $variant);
            }
        } elseif ($this->environmentNumber === 0) {
            # pre-prod
            return $this->getVariant(self::HOSTS[$app]['preprod'], $variant);
        } elseif ($this->environmentNumber === 1) {
            # staging
            return $this->getVariant(self::HOSTS[$app]['staging'], $variant);
        } else {
            # All other test stacks
            return str_replace(
                self::TEST_STACK_NUM_PLACEHOLDER,
                (string)$this->environmentNumber,
                $this->getVariant(self::HOSTS[$app]['test'], $variant)
            );
        }
    }

    /**
     * Returns an array of all hosts
     *
     * @param string $variant   Determines which URL variant to return. Only relevant for some environments (eg "dev 2")
     *                          which require different URLs when used in a frontend or backend context.
     *                          Must be one of `frontend` or `backend`.
     * @return array<string, string>
     */
    public function getAll(string $variant = self::BACKEND): array
    {
        $hosts = [];
        foreach (self::HOSTS as $host => $hostData) {
            $hosts[$host] = $this->get($host, $variant);
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
     * @param string $variant   Determines which URL variant to return. Only relevant for some environments (eg "dev 2")
     *                          which require different URLs when used in a frontend or backend context.
     *                          Must be one of `frontend` or `backend`.
     * @return array<string, string>
     */
    public function getSwsHosts(string $variant = self::BACKEND): array
    {
        # FWIW, the `sws_host_key` value is used because this method is primarily a convenience method
        # for generating an array of URIs to feed into the SWS JS SDK.
        # The SWS JS SDK expects certain keys in this array. The `sws_host_key` value is used for the key
        # value. ie. It must be the value expected by the SWS JS SDK.
        $hosts = [];
        foreach (self::HOSTS as $host => $hostData) {
            if (isset($hostData['sws_host_key'])) {
                $hosts[$hostData['sws_host_key']] = $this->get($host, $variant);
            }
        }
        return $hosts;
    }

    /**
     * @param mixed $val
     * @param string $variant
     * @return string
     */
    private function getVariant($val, string $variant): string
    {
        if (is_string($val)) {
            return $val;
        }
        if (is_array($val)) {
            return $val[$variant];
        }
        return '';
    }
}
