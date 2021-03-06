<?php
require_once('../config/ini_config.php');
require_once('../config/config.php');
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

    //function to insert a record to the database
    public function insert($table, $inputs = array())
    {
        $field=$values="";
        $counter = count($inputs);
        foreach ($inputs as $input_key => $input_value) {
            $key = mysqli_real_escape_string($this->conn, $input_key);
            $value = mysqli_real_escape_string($this->conn, $input_value);
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

    //function to select a record from the database
    public function select($table, $array, $id1, $id2)
    {
        $value = "";

        for ($i = 0; $i < count($array)-1; $i++) {
            $array[$i] = mysqli_real_escape_string($this->conn, $array[$i]);
            $value .= $array[$i].", ";
        }

        $array[count($array) - 1] = mysqli_real_escape_string($this->conn, $array[count($array) -1]);
        $value .= $array[count($array) -1];
        if ($id1 != '') {
            $id1 = mysqli_real_escape_string($this->conn, $id1);
            $id2 = mysqli_real_escape_string($this->conn, $id2);
            $this->sql = "SELECT $value FROM $table where $id1 = '$id2'";
            $result = $this->conn->query($this->sql);
            return $result->fetch_assoc();
        } else {
            $this->sql = "SELECT $value FROM $table where '$id1' = '$id2'";
            $result = $this->conn->query($this->sql);
            $ret = array();
            $i = 0;

            while ($row = $result->fetch_assoc()) {
                $ret[$i][0] = $row['name'];
                $ret[$i][1] = $row['email'];
                $ret[$i][2] = $row['phone'];
                $ret[$i][3] = $row['dob'];
                $ret[$i][4] = $row['gender'];
                $i++;
            }
            return $ret;
        }
    }

    public function join($id)
    {
        $this->sql = "SELECT interest.interest FROM user JOIN user_interest ON user_interest.user_id = user.id JOIN interest ON interest.id = user_interest.interest_id  WHERE user.id = $id";
        $result = $this->conn->query($this->sql);
        $value = array();
        while ($row = $result->fetch_assoc()) {
            $value[] = $row["interest"];
        }
        return $value;
    }

    //function to update a record into database
    public function update($table, $inputs, $id1, $id2)
    {
        $field = "";
        $counter = count($inputs);

        foreach ($inputs as $input_key => $input_value) {
            $key = mysqli_real_escape_string($this->conn, $input_key);
            $value = mysqli_real_escape_string($this->conn, $input_value);
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
