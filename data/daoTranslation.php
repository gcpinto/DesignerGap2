<?php

/**
 * @author Davide Ricardo
 * @package iPDF
 */
/**
 * Data FileTag class for FileTag Object
 * 
 * @name DAOFileTag
 * @author Davide Ricardo
 * @since  21-12-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package iPDF
 * @subpackage Data
 *
 */
class DAOTranslation  implements IDaoObject
{
    private static $tablename="translation";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Translation();
        $object->id=$row['id'];
        $object->value=$row['value'];
        $object->table=$row['table'];
        $object->language_id=$row['language_id'];
        $object->ref_id=$row['ref_id'];
        $object->date=$row['date'];
        return $object;        
    }
    
    private static function Insert(Translation &$object)
    {
        $sql="insert into ".self::$tablename."(
            value,
            `table`,
            language_id,
            ref_id,
            date
            ) values(
            '{$object->value}',
            '{$object->table}',
            {$object->language_id},
            {$object->ref_id},
            now()
            )";
            $res=SQLConnection::myQA($sql);
            if($res[1]>0)
            {
                $sql="select t.*,l.code from ".self::$tablename." t inner join language l on t.language_id=l.id order by t.id desc limit 1;";
                try
                {
                    $object=self::LoadObject(SQLConnection::myF(SQLConnection::myQ($sql)));
                }catch(Exception $ex)
                {
                    if(Config::$debug)
                        print_r("Translation retrieving object after save: ".$sql." Exception: ".$ex->getTrace());
                }
            }else
            {
                if(Config::$debug)
                    print_r("Translation Inserting Translation Object:".$sql);

                throw new Exception("Translation Inserting Translation Object:".$sql,1);
            }
    }
    
    private static function LoadByTableRefLang($tablename,$ref_id,$language_id)
    {
        $sql="select t.*,l.code from ".self::$tablename." t inner join language l on t.language_id=l.id where t.`table`='{$tablename}' and t.ref_id={$ref_id} and t.language_id={$language_id}";
        return self::LoadObject(SQLConnection::myF(SQLConnection::myQ($sql)));
    }
    
    private static function Update(Translation &$object)
	{
		$sql="update ".self::$tablename."
        set value='{$object->value}'
        ,`table`='{$object->table}'
        ,language_id={$object->language_id}
        ,ref_id={$object->ref_id}
        ,date=now() where id={$object->id}";
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Object &$object)
	{
        if($object->id>0)
            return self::Update($object);
        else
        {
            $obj=self::LoadByTableRefLang($object->table,$object->ref_id,$object->language_id);
            if($obj==null)
	            return self::Insert($object);
            else
            {
                $object->id=$obj->id;
                return self::Update($object);
            }
        }
	}
    
    public static function Load($id)
    {
        return self::LoadObject(SQLConnection::myF(SQLConnection::myQ("select t.*,l.code from ".self::$tablename." t inner join language l on t.language_id=l.id where t.id={$id}")));
    }
    
    public static function LoadAllByLang($lang)
    {
        $list=array();
        $sql="select t.*,l.code from ".self::$tablename." t inner join language l on t.language_id=l.id where t.language_id={$lang}";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
    
    public static function LoadAll()
    {
        $list=array();
        $sql="select t.*,l.code from ".self::$tablename." t inner join language l on t.language_id=l.id";
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
    
    public static function LoadByTableRef($tablename,$ref_id)
    {
        $list=array();
        $sql="select t.*,l.code from ".self::$tablename." t inner join language l on t.language_id=l.id where t.`table`='{$tablename}' and t.ref_id={$ref_id} order by t.language_id asc";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            $list[$row["language_id"]]=self::LoadObject($row);
        }
        return $list;
    }
}
?>
