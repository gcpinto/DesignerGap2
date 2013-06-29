<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Contentmedia Object
 * 
 * @name DAOContentmedia
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOContentmedia
{
    private static $tablename="contentmedia";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Contentmedia();
        $object->id=$row['id'];        
        $object->content_id=$row['content_id'];
        $object->path=$row['path'];
        $object->name=$row['name'];
        $object->lastupdate=$row['lastupdate'];
        $object->date=$row['date'];
        //foreign key
        $object->content=DAOContent::Load($object->content_id);
       
        return $object;        
    }
    
    private static function Insert(Contentmedia &$object)
    {
        $sql="insert into ".self::$tablename."(
            content_id,
            path,
            name,
            lastupdate,
            date
            ) values(
            {$object->content_id},
            '{$object->path}',
            '{$object->name}',
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
    
    private static function Update(Contentmedia &$object)
	{        
        $sql="update ".self::$tablename."
        set content_id={$object->content_id}
        ,path='{$object->path}'
        ,name='{$object->name}'
        ,lastupdate=now()
        ,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Contentmedia &$object)
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
    
    public static function LoadAllActive()
    {
        $list=array();
        $sql="select * from ".self::$tablename." where active=1 order by `order` asc";
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
    
    
	public static function Remove($id)
	{
		$sql="delete from ".self::$tablename." where id={$id}";
		SQLConnection::myQ($sql);
	}
      
}
?>
