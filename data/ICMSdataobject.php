<?php
interface ICMSDataObject
{
	public static function Save(&$object);
	
	public static function Load($id);
	
	public static function LoadByContentId($id,$order);
}
?>