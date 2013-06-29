<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Source Object
 * 
 * @name DAOSource
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOSource
{
    private static $tablename="source";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Source();
        $object->id=$row['id'];        
        $object->user_id=$row['user_id'];
        $object->topic=$row['topic'];
        $object->link=$row['link'];
        $object->feed=$row['feed'];
        $object->rank=$row['rank'];
		$object->domain_id=$row['domain_id'];
        $object->lastupdate=$row['lastupdate'];
        $object->date=$row['date'];
        //foreign key
        //var_dump($object->user_id);
        if ($object->user_id != Null)
		{
			//echo "a carregar user data";
			$object->user=DAOUser::Load($object->user_id);
		}
        //$object->user=DAOUser::Load($object->user_id);
        
        return $object;        
    }
    
    private static function Insert(Source &$object)
    {
        $sql="insert into ".self::$tablename."(
            user_id,
            topic,
            link,
            feed,
            rank,
            domain_id,
            lastupdate,
            date
            ) values(
            {$object->user_id},
            '{$object->topic}',
            '{$object->link}',
            '{$object->feed}',
            '{$object->rank}',
            {$object->domain_id},
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
    
    private static function Update(Source &$object)
	{        
        $sql="update ".self::$tablename."
        set user_id={$object->user_id}
        ,topic='{$object->topic}'
        ,link='{$object->link}'
        ,feed='{$object->feed}'
        ,rank={$object->rank}
        ,domain_id={$object->domain_id}
        ,lastupdate=now()
        ,date='{$object->date}' 
        where id={$object->id}";  
        var_dump($sql);          		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Source &$object)
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
    
	public static function LoadByUser($id)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where user_id=".$id." order by date desc";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
	
	public static function LoadByDomain($id)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where domain_id=".$id." order by date asc";
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
