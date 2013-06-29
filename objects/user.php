<?php
  class User extends Object
  {
      public $firstname=""; 
	  public $lastname="";      
      public $password=""; 
	  public $pin="";
      public $email="";
      public $phone="";
	  public $profile_id="";
	  public $lastupdate=null;
	  
	  //fk
	  public $profile="";
	  //public $domains="";
	
  }
?>
