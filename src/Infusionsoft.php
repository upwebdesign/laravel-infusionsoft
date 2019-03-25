<?php

namespace Upwebdesign\Infusionsoft;

/**
 * This class is the main entry point of Infusionsoft. Usually this the interaction
 * with this class will be done through the Infusionsoft Facade
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use Storage;
use Infusionsoft\Token;
use Infusionsoft\Infusionsoft as Inf;
use Illuminate\Support\Facades\Request;
use Infusionsoft\InfusionsoftException;

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
     * Create a new confide instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setTokenName(config('infusionsoft.token_name'));
        $this->setClientId(config('infusionsoft.client_id'));
        $this->setClientSecret(config('infusionsoft.client_secret'));
        $this->setRedirectUri(config('infusionsoft.redirect_uri'));
        if (config('infusionsoft.debug')) {
            $this->setDebug(true);
        }
        $new_token = false;
        if (Storage::exists($this->token_name)) {
            $token = unserialize(Storage::get($this->token_name));
            $this->setToken(new Token($token));
        } elseif (Request::has('code')) {
            $this->requestAccessToken(Request::get('code'));
            $new_token = true;
        } else {
            throw new InfusionsoftException(sprintf(
                'You must authorize your application here: %s',
                $this->getAuthorizationUrl()
            ), 1);
        }
        $token = $this->getToken();
        $expired = ($token->getEndOfLife() - (time() * 2)) <= 0 ? true : false;
        if ($expired || $new_token) {
            $extra = $token->getExtraInfo();
            if (!$new_token) {
                $token = $this->refreshAccessToken();
            }
            Storage::disk(config('infusionsoft.filesystem'))->put($this->token_name, serialize([
                "access_token" => $token->getAccessToken(),
                "refresh_token" => $token->getRefreshToken(),
                "expires_in" => $token->getEndOfLife(),
                "token_type" => $extra['token_type'],
                "scope" => $extra['scope'],
            ]));
        }
    }

    /**
     * @param string $authorization_code
     * @return string
     */
    public function setAuthorizationCode($authorization_code)
    {
        $this->authorization_code = $authorization_code;
        return $this;
    }

    /**
     * @param string $name
     * @return string
     */
    public function setTokenName($name)
    {
        $this->token_name = $name;
        return $this;
    }
}
