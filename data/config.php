<?php
class Config
{
	
	/* Database Configuration */
	/**
	 * @var string
	 */
	public static $databaseserver="localhost";
	//public static $databaseserver="designergap.load-interactive.com";
	/**
	 * @var string
	 */
    public static $databaseuser="root";
	//public static $databaseuser="usergap";
	/**
	 * @var string
	 */
	public static $databasepassword="";
	//public static $databasepassword="us3rg4p#";
	/**
	 * @var string
	 */
    //public static $selecteddatabase="designer_db";
    public static $debug=true;
	public static $selecteddatabase="LOAD_dgap";
	//public static $selecteddatabase="load_dgap";
    //public static $debug=true;
	/* End of Database configuration */
	
    public static $uploadfilepath="uploadedfiles/";	
}
?>
