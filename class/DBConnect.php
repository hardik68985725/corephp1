<?php

class DBConnect extends mysqli {

    public function __construct() {
        try {

            parent::__construct(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if( mysqli_connect_errno() ) {
                throw new exception('Failed to connect to MySQL: '. mysqli_connect_error() .' - '. mysqli_connect_errno() );
            }

        } catch(Exception $e) {
            data_dump($e);
        }

    return $this;
    }
    public function __destruct() {
        $this->close();
    }

    public function clean_data($value) {
        $return_value = trim($value);
        $return_value = $this->real_escape_string($value);

    return $return_value;
    }
}

?>
