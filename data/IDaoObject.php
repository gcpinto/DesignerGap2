<?php
interface IDaoObject
{
	public static function Save(Object &$object);
	
	public static function Load($id);
    
    public static function LoadAll();
    
    public static function Remove($id);
	
}
?>