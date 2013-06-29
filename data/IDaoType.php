<?php
interface IDaoType
{
	public static function Save(Type &$object);
	
	public static function Load($id);
    
    public static function LoadAll();
    
    public static function Remove($id);
	
}
?>