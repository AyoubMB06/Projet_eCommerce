<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'ecom');
     
	try{
		$BD = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	}
	
	catch(Exception $e){
		die('Erreur:'.$e->getMessage());
	}
	
    ?>