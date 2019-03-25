<?php

namespace Upwebdesign\Infusionsoft\Http\Controllers;

use App\Http\Controllers\Controller;

class InfusionsoftController extends Controller
{
    /**
     * @return [type] [description]
     */
    public function auth()
    {
        // Check for existing client id
        if (empty(config('infusionsoft.client_id'))) {
            throw new \Exception("Infusionsoft Client ID not present", 1);
        }
        // Check for existing client secret
        if (empty(config('infusionsoft.client_secret'))) {
            throw new \Exception("Infusionsoft Client Secret not present", 1);
        }
        // Check for existing redirect uri
        if (empty(config('infusionsoft.redirect_uri'))) {
            throw new \Exception("Infusionsoft Redirect URI not present", 1);
        }

        $infusionsoft = (new \Infusionsoft\Infusionsoft)
            ->setClientId(config('infusionsoft.client_id'))
            ->setClientSecret(config('infusionsoft.client_secret'))
            ->setRedirectUri(config('infusionsoft.redirect_uri'));
        // Return a redirect to authorize app to access Infusionsoft
        return redirect($infusionsoft->getAuthorizationUrl());
    }

    /**
     * @return function [description]
     */
    public function callback(\Illuminate\Http\Request $request)
    {
        $res = \Upwebdesign\Infusionsoft\InfusionsoftFacade::data('xml')
            ->query('Contact', 1, 0, ['Id' => '*'], ['Id'], 'Id', true);
        // If Infusionsoft returns an array, we have successfully connected to the serice
        if (! is_array($res)) {
            throw new Infusionsoft\InfusionsoftException(
                "There was an issue connecting to Infusionsoft using your access code"
            );
        }

        return 'Token set successfully. You may now use the Infusionsoft API.';
    }
}
