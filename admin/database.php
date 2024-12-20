<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/config.php";
?>
<?php
class Database {
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASSWORD;
    public $dbname = DB_NAME;

    public $link;
    public $error;

    // Constructor to initialize database connection
    public function __construct() {
        $this->connectDB();
    }

    // Function to establish the database connection
    private function connectDB() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->link->connect_error) {
            $this->error = "Connection failed: " . $this->link->connect_error;
            return false;
        }
        return true;
    }

    // Select or Read data
    public function select($query) {
        $result = $this->link->query($query);
        if ($result === false) {
            echo "Warning: " . $this->link->error;
            return false;
        }
        if ($result->num_rows>0) {
            return $result;
        } else {
            return false; 
        }
    }

    // Insert data
    public function insert($query) {
        $insert_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($insert_row) return $insert_row;
        else return false;
    }

    // Update data
    public function update($query) {
        $update_row = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($update_row) return $update_row;
        else return false;
    }

    // Delete Data
    public function delete($query) {
        $delete_row = $this->link->query($query) or die($this->link->error . __LINE__); // Fixed issue here
        if ($delete_row) return $delete_row;
        else return false;
    }
}
?>
