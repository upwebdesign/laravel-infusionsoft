<?php

namespace Upwebdesign\Infusionsoft;

/**
 * This class is the main entry point of Infusionsoft. Usually this the interaction
 * with this class will be done through the Infusionsoft Facade
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use Infusionsoft\Infusionsoft as Inf;

class Infusionsoft extends Inf
{
    /**
     * Token name
     *
     * @var string
     */
    protected $token_name;

    /**
     * oAuth autorization code
     *
     * @var string
     */
    protected $authorization_code;

    /**
     * Cache store
     *
     * @var string
     */
    protected $store;

    /**
     * Create a new confide instance.
     */
    public function __construct($account = false)
    {
        $is_multi = is_string($account);
        $this->store = config('infusionsoft.cache');
        // Determine the cache token name
        if ($is_multi) {
            $this->setTokenName(sprintf('%s.%s', config('infusionsoft.token_name'), $account));
        } else {
            $this->setTokenName(sprintf('%s.default', config('infusionsoft.token_name')));
        }
        if (config('infusionsoft.multi') && $is_multi) {
            $infusionsoft_accounts = json_decode(trim(stripslashes(config('infusionsoft.accounts'))), true);
            $infusionsoft_account = current(
                array_filter($infusionsoft_accounts, function ($infusionsoft_account) use ($account) {
                    return $account === array_key_first($infusionsoft_account);
                })
            );

            if (!$infusionsoft_account) {
                throw new \Infusionsoft\InfusionsoftException(
                    'Infusionsoft account could not be found in config using multi',
                    1
                );
            }

            $client_id = $infusionsoft_account[$account]['client_id'];
            $client_secret = $infusionsoft_account[$account]['client_secret'];
            $redirect_uri = $infusionsoft_account[$account]['redirect_uri'];
        } elseif (config('infusionsoft.multi')) {
            // There was a problem with config setup
            throw new \Infusionsoft\InfusionsoftException(
                'Infusionsoft is set up for multi, but no account was set',
                1
            );
        } else {
            $client_id = config('infusionsoft.client_id');
            $client_secret = config('infusionsoft.client_secret');
            $redirect_uri = config('infusionsoft.redirect_uri');
        }
        // Check for existing client id
        if (empty($client_id)) {
            throw new \Infusionsoft\InfusionsoftException('Infusionsoft Client ID not present', 1);
        }
        // Check for existing client secret
        if (empty($client_secret)) {
            throw new \Infusionsoft\InfusionsoftException('Infusionsoft Client Secret not present', 1);
        }

        $this->setClientId($client_id);
        $this->setClientSecret($client_secret);
        $this->setRedirectUri(url($redirect_uri));

        if (config('infusionsoft.debug')) {
            $this->setDebug(true);
        }
        if (
            cache()
                ->store($this->store)
                ->has($this->token_name)
        ) {
            $token = unserialize(
                cache()
                    ->store($this->store)
                    ->get($this->token_name)
            );
            $this->setToken(new \Infusionsoft\Token($token));
            $this->checkIfExpired();
        } elseif (request()->has('code')) {
            // Request a new token if we have a code
            $this->requestAccessToken(request()->get('code'));
            $this->storeAccessToken();
        } else {
            // Authorize the app to use the API
            return redirect($this->getAuthorizationUrl());
        }
    }

    /**
     * Set authorization code returned back from Infusionsoft
     *
     * @param string $authorization_code
     * @return self
     */
    public function setAuthorizationCode($authorization_code)
    {
        $this->authorization_code = $authorization_code;
        return $this;
    }

    /**
     * Set token name
     *
     * @param string $name
     * @return self
     */
    public function setTokenName($name)
    {
        $this->token_name = $name;
        return $this;
    }

    /**
     * Check if a token is expired
     *
     * @return  void
     */
    public function checkIfExpired()
    {
        $token = $this->getToken();
        if ($token->isExpired()) {
            $token = $this->refreshAccessToken();
            $this->setToken($token);
            $this->storeAccessToken();
        }
    }

    /**
     * Store access token
     *
     * @return void
     */
    public function storeAccessToken()
    {
        $token = $this->getToken();
        $extra = $token->getExtraInfo();

        cache()
            ->store($this->store)
            ->forever(
                $this->token_name,
                serialize([
                    'access_token' => $token->getAccessToken(),
                    'refresh_token' => $token->getRefreshToken(),
                    'expires_in' => 86400, // Infusionsoft tokens expire after 24 hours
                    // 'expires_in' => $token->getEndOfLife(),
                    'token_type' => $extra['token_type'],
                    'scope' => $extra['scope'],
                ])
            );
    }
}
