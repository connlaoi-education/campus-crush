<?php
	// FILE FOR DATABASE CONNECTIVITY
	$filename = "db.php";
	$authors = "Connlaoi";
	
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	

	// open a database connection
	function db_connect(){	
		// set the connection values
		// to change the host switch between DATABASE_HOST_SERVER and DATABASE_HOST_LOCAL
		$conn = pg_connect("host=". DATABASE_HOST_SERVER . " dbname=" . DATABASE_NAME . " user=" . DATABASE_USER . " password=" . DATABASE_PASSWORD);
		return $conn;
	}
	
	$connection = db_connect();

	$results = pg_prepare($connection, "date_update", 'UPDATE users SET last_access = current_date WHERE id = $1');

	$results = pg_prepare($connection, "find_user", 'SELECT id, password, first_name, last_name, email_address, account_type, enroll_date, last_access FROM users WHERE id = $1');

	$results = pg_prepare($connection, "select_id_pass", 'SELECT id, password, first_name, last_name, email_address, enroll_date, last_access FROM users WHERE id = $1 AND password = $2');

	function getProperty($table, $property, $id, $idName) {
		$connection = db_connect();
		$results = pg_prepare($connection, "get_property_where", "SELECT " . $property . " FROM " . $table . " WHERE " . $idName . " = $1");
		$results = pg_execute($connection, "get_property_where", array($id));
		return pg_fetch_result($results, 0, $property);
	}

	function getAllProperty($table, $property) {
		$connection = db_connect();
		$sql = "SELECT " . $property . " FROM " . $table;
		$results = pg_query($connection, $sql);
		return pg_fetch_all($results);
	}

     function buildDropDown($name, $table, $property) {
        $array = getAllProperty($table, $property);
        echo("<select name=\"" . $name . "\">\n");
        for ($i=0; $i < count($array); $i++) { 
            if ($_SESSION[$name] == $i)
            {
                echo("<option value=\"" . $i . "\" selected>" . $array[$i][$property] . "</option>\n");
            }
            else
            {
                if ($i == 0)
                {echo("<option value=\"" . $i . "\"selected>" . $array[$i][$property] . "</option>\n");
                }
                else
                {echo("<option value=\"" . $i . "\">" . $array[$i][$property] . "</option>\n");
                }
            
            }
        }
        echo("</select>");
    }

	function buildRadioButton($name, $table, $property) {
		$array = getAllProperty($table, $property);
		$first = true;

		for ($i=0; $i < count($array); $i++) { 
			if ($_SESSION[$name] == $i) {
			echo("<input type=\"radio\" name=\"" . $name . "\" value=\"" . $i . "\" checked>" . $array[$i][$property] . "<br/>\n");
			} else {
			echo("<input type=\"radio\" name=\"" . $name . "\" value=\"" . $i . "\"/>" . $array[$i][$property] . "<br/>\n");
			}
		}
	}
?>