<?php

Route::get('auth', 'InfusionsoftController@auth');
Route::get('auth/callback', 'InfusionsoftController@callback');

Route::get('{account?}/auth', 'InfusionsoftController@auth');
Route::get('{account?}/auth/callback', 'InfusionsoftController@callback');
