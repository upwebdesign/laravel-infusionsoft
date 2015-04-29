<?php namespace Upwebdesign\Infusionsoft;

/**
 * This class is the main entry point of Infusionsoft. Usually this the interaction
 * with this class will be done through the Infusionsoft Facade
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use \Infusionsoft\Infusionsoft as Inf;
use \Infusionsoft\Token;
use \Config;

class Infusionsoft extends Inf
{
    /**
     * Laravel app
     *
     * @var object
     */
    protected $app;

    /**
     * oAuth autorization code
     *
     * @var string
     */
    protected $authorization_code;

    /**
     * Create a new confide instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setAuthorizationCode(env('INFUSIONSOFT_CODE'));
        $this->setClientId(env('INFUSIONSOFT_ID'));
        $this->setClientSecret(env('INFUSIONSOFT_SECRET'));
        $token_path = sprintf('%s/infusionsoft.token', storage_path());
        if (file_exists($token_path)) {
            $this->setToken(new Token(json_decode(file_get_contents($token_path))));
        } else if (empty($this->authorization_code)) {
            $this->setRedirectUri('http://digitalexpertsacademy.app');
            dd(sprintf('You must authorize your application here: %s', $infusionsoft->getAuthorizationUrl()));
        } else {
            $this->requestAccessToken(env('INFUSIONSOFT_CODE'));
        }
        $token = $this->getToken();
        if ($token->getEndOfLife() < time()) {
            $token = $this->refreshAccessToken();
            $extra = $token->getExtraInfo();
            file_put_contents($token_path, json_encode([
                "access_token" => $token->getAccessToken(),
                "refresh_token" => $token->getRefreshToken(),
                "expires_in" => $token->getEndOfLife(),
                "token_type" => $extra['token_type'],
                "scope" => $extra['scope']
            ]));
        }
    }

    /**
     * @param string $code
     * @return string
     */
    public function setAuthorizationCode($authorization_code)
    {
        $this->authorization_code = $authorization_code;
        return $this;
    }
}