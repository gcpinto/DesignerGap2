<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Pub Object
 * 
 * @name DAOPub
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOPub
{
    private static $tablename="pub";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Pub();
        $object->id=$row['id'];
		$object->filename=$row['filename'];        
        $object->pubtype_id=$row['pubtype_id'];
		$object->preadvertiser_id=$row['preadvertiser_id'];
		$object->domain=$row['domain'];
        $object->date=$row['date'];
        
        return $object;        
    }
    
    private static function Insert(Pub &$object)
    {
        $sql="insert into ".self::$tablename."(
            filename,
            pubtype_id,
            preadvertiser_id,
            domain,
            date
            ) values(
            '{$object->filename}',
            {$object->pubtype_id},
            {$object->preadvertiser_id},
            '{$object->domain}',
            now()
            )";
            $res=SQLConnection::myQA($sql);
            if($res[1]>0)
            {
                $sql="select * from ".self::$tablename." order by id desc limit 1;";
                try
                {
                    $object=self::LoadObject(SQLConnection::myF(SQLConnection::myQ($sql)));
                }catch(Exception $ex)
                {
                    if(Config::$debug)
                        print_r("Retrieving object after save: ".$sql." Exception: ".$ex->getTrace());
                }
            }else
            {
                if(Config::$debug)
                    print_r("Inserting Object:".$sql);

                throw new Exception("Inserting Object:".$sql,1);
            }
    }
    
    private static function Update(Pub &$object)
	{        
        $sql="update ".self::$tablename."
        set filename='{$object->filename}'
        ,pubtype_id={$object->pubtype_id}
        ,preadvertiser_id={$object->preadvertiser_id}
        ,domain='{$object->domain}'
        ,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Pub &$object)
	{
        if($object->id>0)
            return self::Update($object);
        else
	        return self::Insert($object);
	}
    
    public static function Load($id)
    {
        return self::LoadObject(SQLConnection::myF(SQLConnection::myQ("select * from ".self::$tablename." where id={$id}")));
    }

    public static function LoadAll()
    {
        $list=array();
        $sql="select * from ".self::$tablename;
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
    
    public static function LoadByOrder($ord)
    {
        $list=array();
        $sql="select * from ".self::$tablename." order by date {$ord}";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
    
	 public static function LoadByPreadvertiser($id)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where preadvertiser_id={$id}";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
   
    
	public static function Remove($id)
	{
		$sql="delete from ".self::$tablename." where id={$id}";
		SQLConnection::myQ($sql);
	}  
}
?>
