<?php

/**
 * @author Davide Ricardo
 * @package iPDF
 */
/**
 * Data File class for File Object
 * 
 * @name DAOFile
 * @author Davide Ricardo
 * @since  21-12-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package iPDF
 * @subpackage Data
 *
 */
class DAOLanguage //implements IDaoType
{
    private static $tablename="language";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Language();
        $object->id=$row['id'];
        $object->name=$row['name'];
        $object->code=$row['code'];
        $object->date=$row['date'];
        return $object;        
    }
    
    private static function Insert(Language &$object)
    {
        $sql="insert into ".self::$tablename."(
            name,
            code,
            date
            ) values(
            '{$object->value}',
            '{$object->code}',
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
                        print_r("Language retrieving object after save: ".$sql." Exception: ".$ex->getTrace());
                }
            }else
            {
                if(Config::$debug)
                    print_r("Language Inserting Language Object:".$sql);

                throw new Exception("Language Inserting Language Object:".$sql,1);
            }
    }
    
    private static function Update(Language &$object)
	{
		$sql="update ".self::$tablename."
        set name='{$object->name}',code='{$object->code}',date=now() where id={$object->id}";
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Language &$object)
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
    public static function LoadByCode($code)
    {
        return self::LoadObject(SQLConnection::myF(SQLConnection::myQ("select * from ".self::$tablename." where code='{$code}'")));
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
    
	public static function Remove($id)
	{
		$sql="delete from ".self::$tablename." where id={$id}";
		SQLConnection::myQ($sql);
	}
}
?>
