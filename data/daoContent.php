<?php

/**
 * @author Gabriel Pinto
 * @package DesignerGap
 */
/**
 * Data Projects class for Content Object
 * 
 * @name DAOContent
 * @author Gabriel Pinto
 * @since  10-02-2011
 * @version 1.0
 * @copyright Load-Interactive
 * @package DesignerGap
 * @subpackage Data
 *
 */
class DAOContent
{
    private static $tablename="content";
    
	static private function LoadObject($row)
    {
        if ($row['id']=="") return null;
        $object=new Content();
        $object->id=$row['id'];        
        $object->source_id=$row['source_id'];
        $object->title=$row['title'];
		$object->description=$row['description'];
        $object->link=$row['link'];
		$object->category_id=$row['category_id'];
        $object->active=$row['active'];
        $object->date=$row['date'];
        //foreign key
       // $object->source=DAOSource::Load($object->source_id);
       // $object->medialist=DAOContentmedia::LoadByContent($object->id);
       // $object->category=DAOCategory::Load($object->category_id);
        return $object;        
    }
    
    private static function Insert(Content &$object)
    {
        $sql=" insert into ".self::$tablename."(
            source_id,
            title,
            description,
            link,
            category_id,
            active,
            date
            ) values(
            {$object->source_id},
            '{$object->title}',
            '$object->description',
            '{$object->link}',
            '{$object->category_id}',
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
    
    private static function Update(Content &$object)
	{        
        $sql="update ".self::$tablename."
        set source_id={$object->source_id}
        	,title='{$object->title}'
        	,description='{$object->description}'
        	,link='{$object->link}'
        	,category_id='{$object->category_id}'
       	 	,active='{$object->active}'
        	,date='{$object->date}' 
        where id={$object->id}";            		
		SQLConnection::myQ($sql);
	}
    
	public static function Save(Content &$object)
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
	
	public static function LoadbyTitle($string)
    {
        return self::LoadObject(SQLConnection::myF(SQLConnection::myQ("select * from ".self::$tablename." where title like '%{$string}%'")));
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
        $sql="select * from ".self::$tablename." where active=1 order by `date` desc";
        $select=SQLConnection::myQ($sql);
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
        return $list;
    }
	
	
	   public static function LoadMoreTop($top)
    {
        $list=array();
		//var_dump($top);
		foreach ($top as $object)
		{
        $sql="select * from ".self::$tablename." where id=".$object->content_id." order by id desc"; 
        //echo $sql;
        $select=SQLConnection::myQ($sql);
       //	echo $select;
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
		}
		//var_dump($list);
        return $list;
    }
	
	
	 public static function LoadbyDomainMore($ini, $string)
    {
        $plus = $ini + 15;	
        $list=array();
		//var_dump($string);
		$ids = explode(",", $string);
		//var_dump($ids);
		foreach  ($ids as $id)
		{
        $sql="select * from ".self::$tablename." where source_id LiKE '%".$id."%' and id BETWEEN ".$ini." AND ".$plus." order by id asc";
       // echo $sql;
        $select=SQLConnection::myQ($sql);
		
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
		}
        return $list;
    }
	
	
	
	 public static function LoadbyDomain($string, $str)
    {
        $list=array();
		$ids = explode(",", $string);
	//	var_dump($str);
		$count = count($ids);
		if ($count<10)
		{
			$j= intval(10/$count);
		}
		else $j=1;
		$k=$j;
		$i=0;
		foreach  ($ids as $id)
		{
	        if ($str == 'Refresh')	
			{
	        $sql="select * from ".self::$tablename." where source_id=".$id." order by id desc LIMIT {$k}";
			//var_dump($sql);
			}
			else {
				//var_dump($_SESSION['LastLoad']);
				$pos = $_SESSION['LastLoad'][$id];
				$sql="select * from ".self::$tablename." where source_id=".$id." and id<{$pos} order by id desc LIMIT {$k}";
				//var_dump($sql);
			}
	       //	var_dump($sql);
			//break;
		    $select=SQLConnection::myQ($sql);
	        while(($row=SQLConnection::myF($select)))
	        {
	            array_push($list,self::LoadObject($row));
				$i++;
				$j--;
				if ( $j==0 )
				{
					$j = $k;
					$_SESSION['LastLoad'][$id]=$row["id"];
				}
				
	        }
	        if ($i == 10)
				{
					//var_dump("if -> i= ".$i);
        			return $list;
				}
		}
		//var_dump("i= ".$i);
        return $list;
    }
	
		 public static function LoadbyDomainord($string)
    {
        $list=array();
		$ids = explode(",", $string);
		foreach  ($ids as $id)
		{
        $sql="select * from ".self::$tablename." where source_id=".$id." order by date desc";
        $select=SQLConnection::myQ($sql);
        
        while(($row=SQLConnection::myF($select)))
        {
            array_push($list,self::LoadObject($row));
        }
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
    
    public static function LoadNews($category)
    {
        $list=array();
        $sql="select * from ".self::$tablename." where category_id=".$category." order by `date` desc limit 20";
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
	
		public static function search($keyword)
	{
		$list=array();
        $sql="select * from ".self::$tablename." Where title LIKE '%".$keyword."%' or description like '%".$keyword."%' order by `date` desc";
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
