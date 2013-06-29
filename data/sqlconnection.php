<?php

class SQLConnection
{
	
	private static $connection;

	/**
	 * Construct connection to database
	 *
	 */
    private function __construct()
    {
        self::$connection = mysql_pconnect(Config::$databaseserver, Config::$databaseuser, Config::$databasepassword) or die("Could not connect : " . mysql_error());
        if (!mysql_select_db(Config::$selecteddatabase))
			die("Could not select database: " . mysql_error());
		mysql_query("SET NAMES 'utf8'");
    }
    
    public function __destruct()
    {
    	@mysql_close();
    }
    
    /**
     * Creates SQLConnection if it doesn't exists
     *
     * @return mysqlconnection
     */
	static protected function myConnect() { // MYSQL Database connection //
		if (!isset(self::$connection)) {
            $c = __CLASS__;
            self::$connection = new $c;
        }
        return self::$connection;
	}
	
	/**
	 * Executes Query against database
	 *
	 * @param string $query
	 * @return resultset
	 */
	static function myQ($query) {
		self::myConnect();		
		$result= mysql_query($query);
		self::myClose();
		return $result;
	}
	/***** TESTE
	 * 
	 * 
	 * 
	 * 
	 */
	
	static function Connect()
	{
	return	self::myConnect();
	}
	
	/**************/
	
	 
	/**
	 * Executes Query against database and returns number of affected rows
	 *
	 * @param string $query
	 * @return array(resultset,affectedrows)
	 */
	static function myQA($query) {
		self::myConnect();		
		$result[0]= mysql_query($query);
		$result[1]= mysql_affected_rows();        
        $id = mysql_insert_id();
        if(isset($id))
        {
            $result[2] = mysql_insert_id();
        }
		self::myClose();
		//var_dump($result);
		return $result;
	}

	/**
	 * Returns number of records affected by last Query
	 *
	 * Not working
	 * @return unknown
	 */
	static function MyA()
	{
		throw new Exception ("Inside SQLConnection::MyA, Code on other functions needs to be changed in order to function");
/*		self::myConnect();		
		$result= mysql_affected_rows();
		self::myClose();
		return $result;
*/
	}
	
	/**
	 * Fetches row in array format
	 *
	 * @param resultset $content
	 * @return array
	 */
	static function myF($content) {
		self::myConnect();
		$res= mysql_fetch_array($content);
		self::myClose();
		return $res;
	}
	
	static function myNum($content) {
		self::myConnect();
		$result= mysql_num_rows($content);
		self::myClose();
		return $result;
	}
	
	static function CloseConnection() {
		return @mysql_close();
	}
	
	static protected function myClose() {
		//return @mysql_close();
	}
}
?>