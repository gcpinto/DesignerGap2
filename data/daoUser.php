<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for User Object
 * 
 * @name DAOUser
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOUser
{
    private static $tablename="user";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new User();
        $object->id=$row['id'];        
        $object->firstname=$row['firstname'];
        $object->lastname=$row['lastname'];
        $object->password=$row['password'];
        $object->pin=$row['pin'];
        $object->email=$row['email'];
        $object->phone=$row['phone'];
		$object->profile_id=$row['profile_id'];
        $object->lastupdate=$row['lastupdate'];
        $object->date=$row['date'];
        
        //foreign key
        //$object->client=DAOContent::Load($object->content_id);
        $object->profile=DAOProfile::Load($object->profile_id);
		//$object->domains=DAODomain::Load($id);
                
        return $object;        
    }
    
    private static function Insert(User &$object)
    {
        $sql="insert into ".self::$tablename."(
            firstname,
            lastname,
            password,
            pin,
            email,            
            phone,
            profile_id,
            lastupdate,
            date
            ) values(
			'{$object->firstname}',
            '{$object->lastname}',
            md5('{$object->password}'),
            {$object->pin},
			'{$object->email}',
			'{$object->phone}',
			{$object->profile_id},
            now(),
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
    
    private static function Update(User &$object)
	{
		if (empty($object->password)) 
		{       
        $sql="update ".self::$tablename."
        set firstname={$object->firstname}
        ,lastname='{$object->lastname}'
        ,pin={$object->pin}
        ,email='{$object->email}'
        ,phone='{$object->phone}'
        ,profile_id={$object->profile_id}
        ,lastupdate=now()
        ,date='{$object->date}' 
        where id={$object->id}"; 
		}
		else {
		$sql="update ".self::$tablename."
        set firstname={$object->firstname}
        ,lastname='{$object->lastname}'
        ,password=md5('{$object->password}')
        ,pin={$object->pin}
        ,email='{$object->email}'
        ,phone='{$object->phone}'
        ,profile_id={$object->profile_id}
        ,lastupdate=now()
        ,date='{$object->date}' 
        where id={$object->id}"; 
		}           		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(User &$object)
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

    
    public static function Loadbylogin($login)
    {
        return self::LoadObject(SQLConnection::myF(SQLConnection::myQ("select * from ".self::$tablename." where email='".$login['email']."' and password=md5('".$login['pass']."')")));
    }
	
	public static function LoadProfile($email)
    {
        return self::LoadObject(SQLConnection::myF(SQLConnection::myQ("select * from ".self::$tablename." where email='{$email}'")));
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
