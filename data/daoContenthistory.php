<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Contenthistory Object
 * 
 * @name DAOContenthistory
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOContenthistory
{
    private static $tablename="contenthistory";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Contenthistory();
        $object->id=$row['id'];        
        $object->user_id=$row['user_id'];
        $object->content_id=$row['content_id'];
        $object->ip=$row['ip'];
        $object->date=$row['date'];

        //foreign key
   //     $object->user=DAOUser::Load($object->user_id);
    //    $object->content=DAOContent::Load($object->Content);

        return $object;        
    }
    
    private static function Insert(Contenthistory &$object)
    {
        $sql="insert into ".self::$tablename."(
            user_id,
            content_id,
            ip,
            date
            ) values(
            {$object->user_id},
            {$object->content_id},
            '{$object->ip}',
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
    
    private static function Update(Contenthistory &$object)
	{        
        $sql="update ".self::$tablename."
        set user_id={$object->user_id}
        ,content_id='{$object->content_id}'
        ,ip='{$object->ip}'
        ,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Contenthistory &$object)
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
    
	
	public static function LoadByContent($id)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where content_id=".$id;
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
	
	
	public static function GetRank($id)
	{
       //  return self::LoadObject(SQLConnection::myF(SQLConnection::myQ("select * from ".self::$tablename." where content_id={$id}")));
	    $list=array();
        $sql="select * from ".self::$tablename." where content_id=".$id;
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
	
	public static function GetbyDates($date1,$date2)
	{
	$list=array();
        $sql="select *,count(*) as count from ".self::$tablename." where date BETWEEN '".$date1." 00:00:00' and '".$date2." 23:59:59' group by content_id order by count desc LIMIT 0 , 10";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;	
	}
	
	public static function GetAllTime()
	{
	$list=array();
        $sql="select *,count(*) as count from ".self::$tablename."  group by content_id order by count desc LIMIT 0 , 10";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;	
	}
	
	public static function GetTopDay($date)
	{
	$list=array();
        $sql="select *,count(*) as count from ".self::$tablename." where date BETWEEN '".$date." 00:00:00' and '".$date." 23:59:59' group by content_id order by count desc LIMIT 0 , 10";
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
