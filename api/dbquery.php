<?php
class DbQuery
{
    public $conn;
    public $sql;
    public function __construct()
    {
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
        // Check connection
        if ($conn->connect_error) {
            die( "Connection failed: " . $conn->connect_error );
        }
    }

    public function insert($table, $inputs = array())
    {
        global $sql , $conn;
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

        $sql = "INSERT INTO"." $table"." (".$field.") "." VALUES "." (".$values.")";
    }

    public function exec()
    {
        global $sql, $conn;
        if ($conn->query($sql) === true) {
            return $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
       
    }

    public function select($table, $array, $id1, $id2)
    {
        global $sql, $conn;
        $value = "";
        for ($i = 0; $i < count($array)-1; $i++) {
            $value .= $array[$i].", ";
        }
        $value .= $array[count($array) -1];
        $sql = "SELECT $value FROM $table where $id1 = '$id2' LIMIT 1";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public function update($table, $inputs, $id1, $id2)
    {
        global $sql , $conn;
        $field = "";
        $counter = count($inputs);

        foreach ($inputs as $key => $value) {
            $counter--;
            if (!$counter) {
                $field .= $key."='".$value."'";

            } else {
                $field .= $key."='".$value."',";
                $i++;
            }
        }
        $sql = "UPDATE"." $table"." SET"." $field"." WHERE". " $id1"." ="."'$id2'";
        $conn->query($sql);
    }
}
