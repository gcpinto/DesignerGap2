<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Profiledomain Object
 * 
 * @name DAOProfiledomain
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOProfiledomain
{
    private static $tablename="profiledomain";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new profiledomain();
        $object->id=$row['id'];        
        $object->profile_id=$row['profile_id'];
        $object->domain_id=$row['domain_id'];
        $object->date=$row['date'];
        
		//foreign key
        //$object->client=DAOProfile::Load($object->profile_id);
		$object->client=DAODomain::Load($object->domain_id);
		
        return $object;        
    }
    
    private static function Insert(profiledomain &$object)
    {
        $sql="insert into ".self::$tablename."(
            profile_id,
            domain_id,
            date
            ) values(
            '{$object->profile_id}',
            {$object->domain_id},
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
    
    private static function Update(profiledomain &$object)
	{        
        $sql="update ".self::$tablename."
        set profile_id='{$object->profile_id}'
        ,domain_id={$object->domain_id}
        ,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(profiledomain &$object)
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
	
	public static function LoadProfile($profile_id)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where profile_id={$profile_id}";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
	
	public static function LoadbyDomain($id)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where domain_id={$id}";
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
