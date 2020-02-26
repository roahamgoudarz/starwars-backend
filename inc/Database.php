<?php

// Define configuration
define("DB_HOST", $config['db']['db1']['host']);
define("DB_USER", $config['db']['db1']['username']);
define("DB_PASS", $config['db']['db1']['password']);
define("DB_NAME", $config['db']['db1']['dbname']);


if(!class_exists('Database')){

class Database extends PDO {
	
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
 
    private $dbh;
    private $error;
	
	private $stmt;

 
    private static $db = null;
	 
     public static function singleton($dbname = DB_NAME)
    {
        if (is_null(self::$db) === true)
        {
			

        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT  		  => true ,
            PDO::ATTR_EMULATE_PREPARES    => false ,
            PDO::ATTR_ERRMODE    	      =>  PDO::ERRMODE_WARNING
        );
        // Create a new PDO instanace
        try{
			 // self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbname.';charset=utf8', DB_USER, DB_PASS, $options);
			 self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbname.';charset=utf8', DB_USER, DB_PASS, $options);

        }
        // Catch any errors
        catch(PDOException $e){
            die($e->getMessage());
        }
		
		
        }

        return self::$db;
    }
	
	
	 
     public static function singletonUtf8($dbname = DB_NAME)
    {
        // if (is_null(self::$db) === true)
        // {
			

        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT  		  => true ,
            PDO::ATTR_EMULATE_PREPARES    => false ,
            PDO::ATTR_ERRMODE    	      =>  PDO::ERRMODE_WARNING
        );
        // Create a new PDO instanace
        try{
			 // self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbname.';charset=utf8', DB_USER, DB_PASS, $options);
			 self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbname.';charset=utf8', DB_USER, DB_PASS, $options);

        }
        // Catch any errors
        catch(PDOException $e){
            die($e->getMessage());
        }
		
		
        //}

        return self::$db;
    }
	
	
    public function __construct(){
		
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname.';charset=utf8';
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT  		  => true ,
            PDO::ATTR_EMULATE_PREPARES    => false ,
            PDO::ATTR_ERRMODE    	      =>  PDO::ERRMODE_WARNING
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
		

    }
	
	
	// Prepare
	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}
	
	public function errorInfo(){
	
		$error = $this->dbh->errorInfo();

		if($error[2] == ''){return true;}else{echo $error[2];}
	
	}

	// Bind
	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}
	
	// Execute
	public function execute(){
		return $this->stmt->execute();
	}
	

	// Result Set	
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll();
	}	
	

	
	// Single
	public function sql($query){

		$this->stmt = $this->dbh->query($query);
	//	echo $query;
	}	
	// Single
	public function mfa(){

		//$this->execute();
		$rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
return array_shift($rows);

	}
	
	// Single
	public function single(){
		$this->execute();
		return $this->stmt->fetch();
	}
	
	// Row Count
	public function count(){
		return $this->stmt->fetchColumn();
	}

	public function rowCount(){
		return $this->stmt->rowCount();
	}
	
	// Last Insert Id
	/*
	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}
	*/
	
	
	// Transactions
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}
	
	public function endTransaction(){
		return $this->dbh->commit();
	}
	
	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}
	
	function inj($inj)
	{
		return $inj;
	}


	// Debug Dump Parameters
	public function debugDumpParams(){
		return $this->stmt->debugDumpParams();
	}
	
}
}