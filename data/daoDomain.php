<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Profile Object
 * 
 * @name DAODomain
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAODomain
{
    private static $tablename="domain";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Domain();
        $object->id=$row['id'];        
        $object->codname=$row['codname'];
		$object->name=$row['name'];
		$object->active=$row['active'];
        $object->url=$row['url'];
		$object->domain=$row['domain'];
        $object->date=$row['date'];
        
        return $object;        
    }
    
    private static function Insert(Domain &$object)
    {
        $sql="insert into ".self::$tablename."(
            codname,
            name,
            active,
            url,
            domain,
            date
            ) values(
            '{$object->codname}',
            '{$object->name}',
            {$object->active},
            '{$object->url}',
            '{$object->domain}',
            now()
            )";
            $res=SQLConnection::myQA($sql);
			//var_dump($res);
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
			//return $res[2];
    }
    
    private static function Update(Domain &$object)
	{        
        $sql="update ".self::$tablename."
        set codname='{$object->codname}'
           	,name='{$object->name}'
            ,active={$object->active}
            ,url='{$object->url}'
            ,domain='{$object->domain}'
        	,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Domain &$object)
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
