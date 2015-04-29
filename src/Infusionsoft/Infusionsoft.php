<?php namespace Upwebdesign\Infusionsoft;

/**
 * This class is the main entry point of Infusionsoft. Usually this the interaction
 * with this class will be done through the Infusionsoft Facade
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use \Infusionsoft\Infusionsoft as Inf;
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
     * Infusionsoft user username
     *
     * @var string
     */
    protected $username;

    /**
     * Infusionsoft user password
     *
     * @var string
     */

    protected $password;

    /**
     * Create a new confide instance.
     *
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->setClientId(env('INFUSIONSOFT_ID'))
            ->setClientSecret(env('INFUSIONSOFT_SECRET'))
            ->setUsername(env('INFUSIONSOFT_USERNAME'))
            ->setPassword(env('INFUSIONSOFT_PASSWORD'));
        self::requestAccessToken();
    }

    /**
     *
     *
     * @param string $permission Permission string.
     *
     * @return bool
     */
    public function requestAccessToken($code=null)
    {
        if (is_null($code)) {
            $params = array(
                'client_id'  => $this->clientId,
                'username'   => $this->username,
                'password'   => $this->password,
                'grant_type' => 'password'
            );
            $client = $this->getHttpClient();
            $tokenInfo = $client->request($this->tokenUri, $params, array(), 'POST');
            $this->setToken(new Token($tokenInfo));
            return $this->getToken();
        }
        return parent::requestAccessToken($code);
    }

    /**
     * @param string $username
     * @return string
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $password
     * @return string
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}