<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Preadvertiser Object
 * 
 * @name DAOPreadvertiser
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOPreadvertiser
{
    private static $tablename="preadvertiser";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new preadvertiser();
        $object->id=$row['id'];
		$object->name=$row['name'];        
        $object->email=$row['email'];
		$object->phone=$row['phone'];
		$object->reference=$row['reference'];
		$object->total=$row['total'];
		$object->state=$row['state'];
		$object->pubtype_id=$row['pubtype_id'];
        $object->date=$row['date'];
        
        return $object;        
    }
    
    private static function Insert(preadvertiser &$object)
    {
        $sql="insert into ".self::$tablename."(
            name,
            email,
            phone,
            reference,
            total,
            state,
            pubtype_id,
            date
            ) values(
            '{$object->name}',
            '{$object->email}',
            '{$object->phone}',
            {$object->reference},
            {$object->total},
            {$object->state},
            {$object->pubtype_id},
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
    
    private static function Update(preadvertiser &$object)
	{        
        $sql="update ".self::$tablename."
        set name='{$object->name}'
        ,email='{$object->email}'
        ,phone='{$object->phone}'
        ,reference={$object->reference}
        ,total={$object->total}
        ,state={$object->state}
        ,pubtype_id={$object->pubtype_id}
        ,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(preadvertiser &$object)
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
    
   
    
	public static function Remove($id)
	{
		$sql="delete from ".self::$tablename." where id={$id}";
		SQLConnection::myQ($sql);
	}  
}
?>
