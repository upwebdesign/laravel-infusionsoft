<?php

Route::get('infusionsoft/auth', 'InfusionsoftController@auth');
Route::get('infusionsoft/auth/callback', 'InfusionsoftController@index');
