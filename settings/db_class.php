<?php
// Including the database credentials
require_once('db_cred.php');

/**
 * @author David Sampah
 * @version 1.1
 */
class db_connection
{
    // Properties
    public $db = null;
    public $results = null;

    // Constructor to establish the connection when the object is created
    public function __construct() {
        $this->db_connect();
    }

    // Connecting to the database
    private function db_connect() {
        // Establishing connection
        $this->db = mysqli_connect(SERVER, USERNAME, PASSWD, DATABASE);
// 
        // Testing the connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Executing a query
    public function db_query($sqlQuery) {
        // Runing query 
        $this->results = mysqli_query($this->db, $sqlQuery);
        
        if ($this->results === false) {
            return false;
        }
        return true;
    }

    // Fetching one record from the database
    public function db_fetch_one($sql) {
        if (!$this->db_query($sql)) {
            return false;
        }
        return mysqli_fetch_assoc($this->results);
    }

    // Fetching all records from the database
    public function db_fetch_all($sql) {
        if (!$this->db_query($sql)) {
            return false;
        }
        return mysqli_fetch_all($this->results, MYSQLI_ASSOC);
    }

    // Counting records
    public function db_count() {
        if ($this->results === null) {
            return false;
        }
        return mysqli_num_rows($this->results);
    }

    function get_insert_id(){

        if ($this ->db !== null){
            return mysqli_insert_id($this ->db);
        }

        return false;
    }

    // Destructor to close the connection when done
    public function __destruct() {
        if ($this->db) {
            mysqli_close($this->db);
        }
    }
}
?>
