<?php
  abstract class Object
  {
      public $id=0;
      public $date=null;
      
      public function __toString()
      {
          return get_class($this);
      }
      
      //public abstract function toXML();      
  }
?>
