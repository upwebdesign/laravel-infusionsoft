<?php

namespace Upwebdesign\Infusionsoft\Http\Controllers;

use Illuminate\Http\Request;
use Infusionsoft\Infusionsoft;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class InfusionsoftController extends Controller
{
    /**
     * @return [type] [description]
     */
    public function auth()
    {
        // Check for existing client id
        if (empty(config('infusionsoft.client_id'))) {
            throw new Exception("Infusionsoft Client ID not present", 1);
        }
        // Check for existing client secret
        if (empty(config('infusionsoft.client_secret'))) {
            throw new Exception("Infusionsoft Client Secret not present", 1);
        }
        // Check for existing redirect uri
        if (empty(config('infusionsoft.redirect_uri'))) {
            throw new Exception("Infusionsoft Redirect URI not present", 1);
        }

        $infusionsoft = (new Infusionsoft)
            ->setClientId(config('infusionsoft.client_id'))
            ->setClientSecret(config('infusionsoft.client_secret'))
            ->setRedirectUri(config('infusionsoft.redirect_uri'));
        dd($infusionsoft->getAuthorizationUrl());
        return Redirect::to($infusionsoft->getAuthorizationUrl());
        // Return a redirect to authorize app to access Infusionsoft
    }

    /**
     * @return function [description]
     */
    public function callback(Request $request)
    {
        // Read the code and store for requesting an access token
    }
}
