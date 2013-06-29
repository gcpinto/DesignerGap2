<?php
  class Category extends Object
  {     
      public $name="";
	  public $description="";
	  public $active="";     
	  public $domain_id="";  
	  
	  //fk
	  public $domain="";    
  }
?>