<?php
session_start();

class Session {

    protected $session_id = NULL;
    protected $session_data = array();
    protected $session_flash_data = array();

    public function __construct() {
        // Call parent constructer
        // parent::__construct();

        if ( isset($_SESSION['flash_data']) ) {
            $this->session_flash_data = $_SESSION['flash_data'];
            $_SESSION['flash_data'] = array();
        } else {
            $_SESSION['flash_data'] = array();
        }

        if ( isset($_SESSION['data']) ) {
            $this->session_data = $_SESSION['data'];
        } else {
            $_SESSION['data'] = array();
        }
    }
    public function __destruct() {
        // data_print($this, TRUE);
        // if ( isset($_SESSION['flash_data']) ) {
            // $_SESSION['flash_data'] = array();
        // }
    }

    public function __call($methodName, $args) {
        // if (preg_match('~^(set|get)([A-Z])(.*)$~', $methodName, $matches)) {
        if (preg_match('~^(set|get)_([a-z])(.*)$~', $methodName, $matches)) {
            $property = strtolower($matches[2]) . $matches[3];
            if (!property_exists($this, $property)) {
                throw new Exception('Property ' . $property . ' not exists');
            }
            switch($matches[1]) {
                case 'set':
                    $this->checkArguments($args, 1, 1, $methodName);
                    return $this->set($property, $args[0]);
                case 'get':
                    $this->checkArguments($args, 0, 0, $methodName);
                    return $this->get($property);
                case 'default':
                    throw new Exception('Method ' . $methodName . ' does not exists.');
            }
        } else {
            // echo '.....';
        }
    }
    private function get($property) {
        return $this->$property;
    }
    private function set($property, $value) {
        $this->$property = $value;
        return $this;
    }

    public function get_session_flash_data( $string_flash_data_key = NULL ) {
        if ( is_array($this->session_flash_data) && ( count($this->session_flash_data) > 0 ) ) {
            if ( $string_flash_data_key != NULL ) {
            // if ( $string_flash_data_key != NULL && isset($this->session_flash_data[$string_flash_data_key]) && (empty($this->session_flash_data[$string_flash_data_key]) == FALSE) ) {
                // return $this->session_flash_data[$string_flash_data_key];

                // data_print($this, TRUE);

                foreach ($this->session_flash_data as $key_session_flash_data => $value_session_flash_data) {
                    if ( is_array($value_session_flash_data) && ( count($value_session_flash_data) > 0 ) ) {
                        if( $string_flash_data_key == key($value_session_flash_data) ) {
                            // data_print($value_session_flash_data[$string_flash_data_key]);
                            return $value_session_flash_data[$string_flash_data_key];
                        }
                    }
                }
                return '';
                // data_print(array_key_exists(0, $this->session_flash_data));
                // return $this->session_flash_data;
            } else {
                // return '';
                return $this->session_flash_data;
            }
        }
    return '';
    // return $this->session_flash_data;
    }
    public function set_session_flash_data( $array_flash_data = array() ) {

        if ( is_array($array_flash_data) ) {
            // $_SESSION['flash_data'] = $array_flash_data;
            array_push($_SESSION['flash_data'], $array_flash_data);
            // $this->session_flash_data = $array_flash_data;
            $this->session_flash_data = $_SESSION['flash_data'];
        }
        // data_print($this, TRUE);
    return $this;
    }

    public function get_session_data( $string_data_key = NULL ) {
        if ( is_array($this->session_data) && ( count($this->session_data) > 0 ) ) {
            if ( $string_data_key != NULL ) {
                foreach ($this->session_data as $key_session_data => $value_session_data) {
                    if ( is_array($value_session_data) && ( count($value_session_data) > 0 ) ) {
                        if( $string_data_key == key($value_session_data) ) {
                            return $value_session_data[$string_data_key];
                        }
                    }
                }
                return '';
            } else {
                return $this->session_data;
            }
        }
    return '';
    }
    public function set_session_data( $array_data = array() ) {
        if ( is_array($array_data) ) {
            array_push($_SESSION['data'], $array_data);
            $this->session_data = $_SESSION['data'];
        }
    return $this;
    }

    public function unset_session_data() {
        $_SESSION['data'] = array();
        $this->session_data = array();
    }
}

?>
