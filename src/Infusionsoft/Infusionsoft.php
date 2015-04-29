<?php namespace Upwebdesign\Infusionsoft;

/**
 * This class is the main entry point of entrust. Usually this the interaction
 * with this class will be done through the Entrust Facade
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use \Config;

class Infusionsoft extends \Infusionsoft\Infusionsoft
{
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
    public function __construct()
    {
        $this->setClientId(env('INFUSIONSOFT_ID'))
            ->setClientSecret(env('INFUSIONSOFT_SECRET'))
            ->setUsername(env('INFUSIONSOFT_USERNAME'))
            ->setPassword(env('INFUSIONSOFT_PASSWORD'));
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
                'grant_type' => $grand_type
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