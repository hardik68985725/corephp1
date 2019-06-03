<?php

// ------------------------------------------------------------------------

if ( function_exists('slash_it') == FALSE ) {
    function slash_it($string) {
        return rtrim($string, '/') .'/';
    }
}

// ------------------------------------------------------------------------

if ( function_exists('redirect') == FALSE ) {
    /**
     * Header Redirect
     *
     * Header redirect in two flavors
     * For very fine grained control over headers, you could use the Output
     * Library's set_header() function.
     *
     * @param   string  $uri    URL
     * @param   string  $method Redirect method
     *          'auto', 'location' or 'refresh'
     * @param   int $code   HTTP Response status code
     * @return  void
     */
    function redirect($uri = '', $method = 'auto', $code = NULL)
    {
        if ( ! preg_match('#^(\w+:)?//#i', $uri))
        {
            $uri = slash_it($uri);
        }

        // IIS environment likely? Use 'refresh' for better compatibility
        if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE)
        {
            $method = 'refresh';
        }
        elseif ($method !== 'refresh' && (empty($code) OR ! is_numeric($code)))
        {
            if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1')
            {
                $code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
                    ? 303   // reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
                    : 307;
            }
            else
            {
                $code = 302;
            }
        }

        switch ($method)
        {
            case 'refresh':
                header('Refresh:0;url='. $uri);
                break;
            default:
                header('Location: '. $uri, TRUE, $code);
                break;
        }
        exit(0);
    }
}

// ------------------------------------------------------------------------

if ( function_exists('url_base') == FALSE ) {
    function url_base($path) {
        return BASE_URL . $path;
    }
}

// ------------------------------------------------------------------------

if ( function_exists('path_base') == FALSE ) {
    function path_base($path) {
        return BASE_PATH . $path;
    }
}

// ------------------------------------------------------------------------

if ( function_exists('url_asset') == FALSE ) {
    function url_asset($path) {
        return BASE_URL .'asset/'. $path;
    }
}

// ------------------------------------------------------------------------

if ( function_exists('path_asset') == FALSE ) {
    function path_asset($path) {
        return BASE_PATH .'asset/'. $path;
    }
}

// ------------------------------------------------------------------------

if ( function_exists('data_print') == FALSE ) {
    function data_print($data, $is_exit = FALSE) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if($is_exit == TRUE) {
            exit(0);
        }
    }
}

// ------------------------------------------------------------------------

if ( function_exists('data_dump') == FALSE ) {
    function data_dump($data, $is_exit = FALSE) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        if($is_exit == TRUE) {
            exit(0);
        }
    }
}

// ------------------------------------------------------------------------

if ( function_exists('array_to_object') == FALSE ) {
    function array_to_object($array) {

        $object = new stdClass();

        if( is_array($array) == TRUE ) {
            foreach ($array as $key => $value) {
                $object->$key = $value;
            }
        } else {
            $object = $array;
        }

    return $object;
    }
}

?>
