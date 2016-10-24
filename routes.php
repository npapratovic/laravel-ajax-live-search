<?php

/*
 *	Search routes
*/

Route::post('search', array('as' => 'search', 'uses' => 'PortalController@search'));
