<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Content Object
 * 
 * @name DAOSubscription
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOSuggestion
{
    private static $tablename="suggestion";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Suggestion();
        $object->id=$row['id'];
		$object->ip=$row['ip'];
		$object->title=$row['title'];
		$object->suggestion=$row['suggestion'];        
        $object->email=$row['email'];
        $object->date=$row['date'];
        //foreign key

        return $object;        
    }
    
    private static function Insert(Suggestion &$object)
    {
        $sql=" insert into ".self::$tablename."(
            ip,
            title,
            suggestion,
            email,
            date
            ) values(
            '{$object->ip}',
            '{$object->title}',
            '{$object->suggestion}',
            '{$object->email}',
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
    
    private static function Update(Suggestion &$object)
	{        
        $sql="update ".self::$tablename."
        set ip='{$object->ip}'
            ,title='{$object->title}'
            ,suggestion='{$object->suggestion}'
        	,email='{$object->email}'
        	,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Suggestion &$object)
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
	
	 public static function LoadByEmail($email)
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
