<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for CategoryObject
 * 
 * @name DAOCategory
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOCategory
{
    private static $tablename="category";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Category();
        $object->id=$row['id'];          
        $object->name=$row['name'];
		$object->description=$row['description'];
        $object->active=$row['active'];
		$object->domain_id=$row['domain_id'];
        $object->date=$row['date'];
		
		//fk
		//$object->domain=DAODomain::Load($object->domain_id);
        
        return $object;        
    }
    
    private static function Insert(Category &$object)
    {
        $sql=" insert into ".self::$tablename."(
            name,
            description,
            active,
            domain_id,
            date
            ) values(
            '{$object->name}',
            '{$object->description}',
            {$object->active},
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
    
    private static function Update(Category &$object)
	{        
        $sql="update ".self::$tablename."
        set name='{$object->name}'
        	,description='{$object->description}'
       	 	,active={$object->active}
       	 	,domain_id={$object->domain_id}
        	,date=now()
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Category &$object)
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
    
    public static function LoadByDomain($id)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where domain_id=".$id." order by id asc";
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
        $sql="select * from ".self::$tablename." where active=1 order by `date` desc";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
	
	public static function LoadBySource($id)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where source_id=".$id." order by `date` desc";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
	
	public static function LoadByCategory($category)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where category_id=".$category." order by `date` desc";
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
