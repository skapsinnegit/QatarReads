<?php
	function routex($route, $params = [])
	{
	    if (!is_array($params)) {
	        $params = [$params];
	    }

	    $locale = App::getLocale();

	    $params['lang'] = $locale;
	    return route($route, $params);
	}
