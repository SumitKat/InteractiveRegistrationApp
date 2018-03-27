<?php
require_once('../config/ini_config.php');
class DbQuery
{
    public $conn;
    public $sql;
    public function __construct()
    {
        $this->conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
        // Check connection
        if ($this->conn->connect_error) {
            $myfile = fopen("../logs/error_log.txt", "a+") or die("Unable to open file!");
            $txt = "error in establishing connection\n";
            fwrite($myfile, $txt);
            fclose($myfile);
        }
    }

    public function insert($table, $inputs = array())
    {
        $field=$values="";
        $counter = count($inputs);
        foreach ($inputs as $key => $value) {
            $counter--;
            if (!$counter) {
                $field .= $key;
                $values .= "'".$value."'";
            } else {
                $field .= $key.", ";
                $values .= "'".$value."', ";

            }

        }

        $this->sql = "INSERT INTO"." $table"." (".$field.") "." VALUES "." (".$values.")";
    }

    public function exec()
    {
        if ($this->conn->query($this->sql) === true) {
            return $this->conn->insert_id;
        } else {
            echo "Error: " . $this->sql . "<br>" . $this->conn->error;
        }
       
    }

    public function select($table, $array, $id1, $id2)
    {
        $value = "";
        for ($i = 0; $i < count($array)-1; $i++) {
            $value .= $array[$i].", ";
        }
        $value .= $array[count($array) -1];
        $this->sql = "SELECT $value FROM $table where $id1 = '$id2' LIMIT 1";
        $result = $this->conn->query($this->sql);
        return $result->fetch_assoc();
    }

    public function update($table, $inputs, $id1, $id2)
    {
        $field = "";
        $counter = count($inputs);

        foreach ($inputs as $key => $value) {
            $counter--;
            if (!$counter) {
                $field .= $key."='".$value."'";

            } else {
                $field .= $key."='".$value."',";
            }
        }
        $this->sql = "UPDATE"." $table"." SET"." $field"." WHERE". " $id1"." ="."'$id2'";
        $this->conn->query($this->sql);
    }
}
