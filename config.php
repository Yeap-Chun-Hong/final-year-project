<?php

define('DBSERVER', 'localhost'); // Database server
define('DBUSERNAME', 'root'); // Database username
define('DBPASSWORD', ''); // Database password
define('DBNAME', 'hbms'); // Database name

/* connect to MySQL database */
$dbc = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD);

// Check db connection
if ($dbc) {
    if (mysqli_select_db($dbc, DBNAME)) {
        
    } else {
        echo "Could not select the database because : " . mysqli_error($dbc)
        . "<br/>";
    }
} else {
    echo "Could not connect to MySQL.<br/>";
}
?>