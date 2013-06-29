<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Advertiser Object
 * 
 * @name DAOAdvertiser
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOAdvertiser
{
    private static $tablename="advertiser";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new advertiser();
        $object->id=$row['id'];
		$object->username=$row['username'];        
        $object->password=$row['password'];
		$object->expire=$row['expire'];
		$object->state=$row['state'];
		$object->preadvertiser_id=$row['preadvertiser_id'];
		$object->lastlogin=$row['lastlogin'];
        $object->date=$row['date'];
        
        return $object;        
    }
    
    private static function Insert(advertiser &$object)
    {
        $sql="insert into ".self::$tablename."(
            username,
            password,
            expire,
            state,
            preadvertiser_id,
            lastlogin,
            date
            ) values(
            '{$object->username}',
            md5('{$object->password}'),
            '{$object->expire}',
            {$object->state},
            {$object->preadvertiser_id},
            '{$object->lastlogin}',
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
    
    private static function Update(advertiser &$object)
	{        
        $sql="update ".self::$tablename."
        set username='{$object->username}'
        ,password=md5('{$object->password}')
        ,expire='{$object->expire}'
        ,state='{$object->state}'
        ,preadvertiser_id={$object->preadvertiser_id}
        ,lastlogin='{$object->lastlogin}'
        ,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(advertiser &$object)
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
    
	
	 public static function LoadByPreAdvertiser($id)
    {
        return self::LoadObject(SQLConnection::myF(SQLConnection::myQ("select * from ".self::$tablename." where preadvertiser_id={$id}")));

    }
   
    
	public static function Remove($id)
	{
		$sql="delete from ".self::$tablename." where id={$id}";
		SQLConnection::myQ($sql);
	}  
}
?>
