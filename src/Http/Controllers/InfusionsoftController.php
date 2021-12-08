<?php

namespace Upwebdesign\Infusionsoft\Http\Controllers;

use App\Http\Controllers\Controller;
use Upwebdesign\Infusionsoft\Infusionsoft;

class InfusionsoftController extends Controller
{
    /**
     * @return [type] [description]
     */
    public function auth($account = false)
    {
        // Start a new instance of Infusionsoft with selected accout (or not)
        $infusionsoft = new Infusionsoft($account);
        // Return a redirect to authorize app to access Infusionsoft
        return redirect($infusionsoft->getAuthorizationUrl());
    }

    /**
     * @return function [description]
     */
    public function callback(\Illuminate\Http\Request $request)
    {
        $infusionsoft = config('infusionsoft.multi') ? new Infusionsoft($request->account) : new Infusionsoft();

        $res = $infusionsoft->data('xml')->query('Contact', 1, 0, ['Id' => '*'], ['Id'], 'Id', true);
        // If Infusionsoft returns an array, we have successfully connected to the serice
        if (!is_array($res)) {
            throw new Infusionsoft\InfusionsoftException(
                'There was an issue connecting to Infusionsoft using your access code'
            );
        }

        return 'Token set successfully. You may now use the Infusionsoft API.';
    }
}
