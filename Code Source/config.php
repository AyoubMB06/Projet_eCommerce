<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'id12786864_root');
    define('DB_PASSWORD', 'HRi\MoIZ0F_=TRx0');
    define('DB_NAME', 'id12786864_ecom');
     
	try{
		$BD = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	}
	
	catch(Exception $e){
		die('Erreur:'.$e->getMessage());
	}
	
    ?>
