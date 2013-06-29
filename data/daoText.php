<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Text Object
 * 
 * @name DAOText
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOText
{
    private static $tablename="text";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Text();
        $object->id=$row['id']; 
		$object->title=$row['title'];       
        $object->filename=$row['filename'];
        $object->description=$row['description'];
        $object->tag=$row['tag'];
        $object->active=$row['active'];
        $object->date=$row['date'];
        //foreign key
       
        return $object;        
    }
    
    private static function Insert(Text &$object)
    {
        $sql=" insert into ".self::$tablename."(
            title,
            filename,
            description,
            tag,
            active,
            date
            ) values(
            '{$object->title}',
            '{$object->filename}',
            '{$object->description}',
            '{$object->tag}',
            {$object->active},
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
    
    private static function Update(Text &$object)
	{        
        $sql="update ".self::$tablename."
        set title='{$object->title}'
        	,filename='{$object->filename}'
       		,description='{$object->description}'
        	,tag='{$object->tag}'
        	,active='{$object->active}'
        	,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Text &$object)
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

    
    public static function LoadAllActive()
    {
        $list=array();
        $sql="select * from ".self::$tablename." where active=1 order by `date` desc";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
	
	public static function LoadByTag($tag)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where tag='".$tag."' order by `date` desc";
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
