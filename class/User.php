<?php

class User extends DBConnect {

    protected $user_id = NULL;
    protected $user_name = NULL;
    protected $user_password = NULL;
    protected $user_email = NULL;


    public function __construct() {
        // Call parent constructor
        parent::__construct();

    }
    public function __destruct() {
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

    /**
    *   DB related methods
    */

    public function get_all_user() {
        $string_query = "SELECT * FROM tbl_user";
        $res_user = $this->query($string_query);
        $users = array();
        while ( $user = $res_user->fetch_object() ) {
            $users[] = $user;
        }
        $res_user->free();

    return $users;
    }

    public function get_user_by( $array_column = array(), $array_filter = array() ) {

        // data_print($array_column);
        // data_print($array_filter);

        if( is_array($array_column) && (count($array_column) > 0) ){
            $string_column = implode(',', $array_column);
        } else {
            $string_column = '*';
        }

        if( is_array($array_filter) ){
            $string_filter = '';
            foreach ($array_filter as $array_filter_key => $array_filter_value) {
                $string_filter .= $array_filter_key ."='". $this->clean_data($array_filter_value) ."'";
            }
        } else {
            $string_filter = '1';
        }

        $string_query = "SELECT ". $string_column ." FROM tbl_user WHERE ". $string_filter;
        $res_user = $this->query($string_query) or data_print($string_query .'-'. $this->error);

        $users = array();
        while ( $user = $res_user->fetch_object() ) {
            $users[] = $user;
        }
        $res_user->free();

    return $users;
    }

    public function insert_user() {

        if( $this->user_name == NULL ) {
        } else if( $this->user_password == NULL ) {
        } else if( $this->user_email == NULL ) {
        } else {
            $string_query_insert_user = "INSERT INTO tbl_user SET ";
            $string_query_insert_user .= " user_name='". $this->clean_data($this->user_name) ."'";
            $string_query_insert_user .= " ,user_password='". $this->clean_data($this->user_password) ."'";
            $string_query_insert_user .= " ,user_email='". $this->clean_data($this->user_email) ."'";

            $this->query($string_query_insert_user) or data_print($string_query_insert_user .'-'. $this->error);
        }
        $new_user_id = $this->insert_id;

    return $new_user_id;
    }

    public function update_user() {

        $string_query_update_user = "UPDATE tbl_user SET ";
        if( $this->user_name != NULL ) {
            $string_query_update_user .= " user_name='". $this->clean_data($this->user_name) ."'";
        }
        if( $this->user_password != NULL ) {
            $string_query_update_user .= " ,user_password='". $this->clean_data($this->user_password) ."'";
        }
        if( $this->user_email != NULL ) {
            $string_query_update_user .= " ,user_email='". $this->clean_data($this->user_email) ."'";
        }
        if( ($this->user_id != NULL) && (empty($this->user_id) == FALSE) ) {
            $string_query_update_user .= " WHERE user_id='". $this->clean_data($this->user_id) ."'";

            $this->query($string_query_update_user) or data_print($string_query_update_user .'-'. $this->error);
        }
        $user_affected_rows = $this->affected_rows;

    return $user_affected_rows;
    }

    public function delete_user() {
        if( ($this->user_id != NULL) && (empty($this->user_id) == FALSE) ) {
            $string_query_delete_user = "DELETE FROM tbl_user WHERE user_id='". $this->clean_data($this->user_id) ."'";

            $this->query($string_query_delete_user) or data_print($string_query_delete_user .'-'. $this->error);
        }
        $user_affected_rows = $this->affected_rows;

    return $user_affected_rows;
    }
}

?>
