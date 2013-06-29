<?php
class gLogic
{
    public static function GetPage()
    {
        $phpself = $_SERVER["PHP_SELF"];
        $page = str_replace("/","",$phpself);
        return $page;
    }
        
    public static function get_include_contents($filename) 
    {
        if (is_file($filename))
        {
            ob_start();
            include $filename;
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }
        return false;
    }
	
	
	
	public static function SetSocialTags($share)
    {
    	//var_dump($share);
       /* if (isset($share))
        {
            $project = explode("project",$page);
            //$page = $project[0];
            if (!empty($project[1]))
            {  
                //$project = DAOProject::Load($project[1]);
                Facebook::$faceSiteName = "Load Interactive - Digital Agency";
                Facebook::$faceTitle = utils::lang('checkproject')." - ".$project->name."";
                Facebook::$faceImage = "http://load-interactive.com/uploadedfiles/".$project->filename_web."";
                Facebook::$faceUrl = "http://load-interactive.com/{$page}";
                foreach ($project->translationlist as $translation)
                {
                    if ($translation->language_id == $_SESSION['lang'])
                        Facebook::$faceDescription = $translation->value;
                }
            }
            else
            {   
                Facebook::$faceSiteName = "Load Interactive - Digital Agency";
                Facebook::$faceTitle = "Load Interactive";
                Facebook::$faceImage = "http://load-interactive.com/images/logo_black.png";
                Facebook::$faceUrl = "http://load-interactive.com/";           
                Facebook::$faceDescription = utils::lang('agency_description');           
            }
        }
        else
        {  */ 
        	$face = New Facebook();
			$face->faceSiteName = "sitename";
			$face->faceTitle = "faceTitle";
			$face->faceUrl = "FaceURL";
         /*   Facebook::$faceSiteName = "Load Interactive - Digital Agency";
            Facebook::$faceTitle = "Load Interactive";
            Facebook::$faceImage = "http://load-interactive.com/images/logo_black.png";
            Facebook::$faceUrl = "http://load-interactive.com/";           
            Facebook::$faceDescription = utils::lang('agency_description');   */        
       // }
        return $face;
    }
    
    public static function GetUsers()
    {
        $html=array();
        $row = self::get_include_contents("templates/user.html");
        
        $list = DAOUser::LoadAll();
        if ($list == null) $html[] = "";
        else
        {
            foreach ($list as $user)
            {
        
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("id"=>$user->id,"firstname"=>$user->firstname,"email"=>$user->email),$row);            
            }
        }
        return implode($html);
    }
	
	 public static function GetUserdetail($id)
    {
        $html=array();
        $row = self::get_include_contents("templates/userdetail.html");
        
        $user = DAOUser::Load($id);
        if ($user == null) $html[] = "";
        else
        {
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("id"=>$user->id,"firstname"=>$user->firstname,"email"=>$user->email),$row);            
        }
        return implode($html);
    }
	
	 /*public static function GetContents()
    {
        $html=array();
        $row = self::get_include_contents("templates/content.html");
        
        $list = DAOContent::LoadAll();
        if ($list == null) $html[] = "";
        else
        {
            foreach ($list as $content)
            {
        
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("id"=>$content->id,"link"=>$content->link,"title"=>$content->title),$row);            
            }
        }
        return implode($html);
    }
	*/
	
	public static function GetContents($domainid, $id)
    {
        $html=array();
        $row = self::get_include_contents("templates/content.html");
		$sources = DAOSource::LoadByDomain($domainid);
		$domain="";
		foreach ($sources as $object)
		{
		if ($domain=="")
			$domain = $object->id;
		else {
			$domain = $domain.",".$object->id;
		}
		}
       // $list = DAOContent::LoadbyDomainMore($id, $domain);
       	$list = DAOContent::LoadbyDomain($domain, "More");
		//=0;
        if ($list == null) $html[] = "Not exist more news";
        else
        {
            foreach ($list as $content)
            {
        
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("link"=>$content->link,"title"=>$content->title,"id"=>$content->id),$row);
			//	$lastid= $content->id;            
            }
        }
		//echo $lastid;
        return implode($html);
    }
	
	
	 public static function GetHowitWorks()
    {
        $html=array();
        $row = self::get_include_contents("templates/HowItWorks.html");
        
        $list = DAOText::LoadByTag("hiw");
        if ($list == null) $html[] = "";
        else
        {
            foreach ($list as $faq)
            {
        
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("id"=>$faq->id,"description"=>$faq->description,"title"=>$faq->title),$row);            
            }
        }
        return implode($html);
    }
	
	 public static function GetCopyRight()
    {
        $html=array();
        $row = self::get_include_contents("templates/copyright.html");
        
        $list = DAOText::LoadByTag("copy");
        if ($list == null) $html[] = "";
        else
        {
            foreach ($list as $faq)
            {
        
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("id"=>$faq->id,"description"=>$faq->description,"title"=>$faq->title, "filename"=>$faq->filename),$row);            
            }
        }
        return implode($html);
    }
	
	public static function GetAllSuggestion()
	{
		
	return	DAOSuggestion::LoadAll();
	}
	
	public static function RemoveSuggestion($id)
	{
		DAOSuggestion::Remove($id);
		echo "REMOVE";
	}
	
	public static function GetAllSubscription()
	{
		return DAOSubscription::LoadAll();
	}
	
	public static function RemoveSubscription($id)
	{
		DAOSubscription::Remove($id);
		echo "REMOVE";
	}
	
	 public static function GetSubscription()
    {
        $html=array();
        $row = self::get_include_contents("templates/Subscription.html");
        
        $list = DAOSubscription::LoadAll();
        if ($list == null) $html[] = "";
        else
        {
            foreach ($list as $subs)
            {
        
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("id"=>$subs->id,"email"=>$subs->email,"date"=>$subs->date),$row);            
            }
        }
        return implode($html);
    }
	
	public static function CheckEmail($email)
	{
		$check=DAOSubscription::LoadByEmail($email);
		if ($check==null) {
			return 0;
			
		} else {
			return 1;
			
		}
	}
	
	public static function SaveSubscription($email)
	{
		$subs= new Subscription();
		$subs->email=$email;
		$subs->active=1;
		return	DAOSubscription::Save($subs);
	
	}
	
	public static function SaveSuggestion($object)
	{
		
		
		return	DAOSuggestion::Save($object);
	
	}
	
	 public static function GetSources()
    {
        $html=array();
        $row = self::get_include_contents("templates/Source.html");
        
        $list = DAOSource::LoadAll();
        if ($list == null) $html[] = "";
        else
        {
            foreach ($list as $source)
            {
        
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("id"=>$source->id,"topic"=>$source->topic,"link"=>$source->link,"feed"=>$source->feed, "rank"=>$source->rank),$row);            
            }
        }
        return implode($html);
    }
	
	 public static function GetContentmedia($id)
    {
        $html=array();
        $row = self::get_include_contents("templates/contentmedia.html");
        
        $list = DAOContentmedia::LoadAll();
        if ($list == null) $html[] = "";
        else
        {
            foreach ($list as $media)
            {
        
                //$logo = Config::$uploadfilepath.$client->filename;                
                $html[] = utils::AssignArray(array("id"=>$media->id,"name"=>$media->name,"path"=>$source->path),$row);            
            }
        }
        return implode($html);
    }
	
	
	public static function GetAllSourcesByDomain($id)
	{
		return DAOSource::LoadByDomain($id);
		
	}
	
	public static function TryRemoveSource($id)
	{
		$test = DAOContent::LoadBySource($id);
		if ($test == NULL)
		{
		echo "REMOVE";
			DAOSource::Remove($id);
		}
		else {
			echo "NOT REMOVE";
			return FALSE;
		}
		
	}
	
	public static function GetSource ($id)
	{
		return DAOSource::Load($id);
	}
	
	public static function SaveSource($object)
	{
		var_dump($object);
		DAOSource::Save($object);		
	}
	
	 public static function GetContentBySource($id)
		{
			$html=array();
			$row = self::get_include_contents("templates/content.html");
			
			$list = DAOContent::LoadBySource();
			if( $list == NULL) $html[]= "";
			else
			{
				foreach ($list as $content)
				{
				
				 $html[] = utils::AssignArray(array("id"=>$content->id,"link"=>$content->link,"title"=>$content->title),$row);            
				
				}
			}
        
		return implode($html);
		
		}
		
	 public static function GetSourceByUser($id)
		{
			$html=array();
			$row = self::get_include_contents("templates/source.html");
			
			$list = DAOSource::LoadByUser();
			if( $list == NULL) $html[]= "";
			else
			{
				 foreach ($list as $source)
				{
        
                   $html[] = utils::AssignArray(array("id"=>$source->id,"topic"=>$source->topic,"link"=>$source->link,"feed"=>$source->feed),$row); 
				
				}
			}
        
		return implode($html);
		
		}
		
	public static function GetAllCategoriesByDomain($id)
	{
		$list = DAOCategory::LoadByDomain($id);
		return $list;
		
	}
	
	public static function GetCategories ()
	{
		$row = self::get_include_contents("templates/category.html");
		$list = DAOCategory::LoadAll();
		//var_dump($list);
		if ( $list == NULL) $html[]="";
		else 
			{
				foreach ($list as $category ) 
				{
					
					$html[]= utils::AssignArray(array("id"=>$category->id,"name"=>$category->name),$row);
				
				}
			}
			
			return implode($html);
	}
	
	public static function GetCategory ($id)
	{
		//$row = self::get_include_contents("templates/categorydetail.html");
		$list= DAOCategory::Load($id);
		/*if ( $list == NULL) $html[]="";
		//else 
			{
			
				$html[]= utils::AssignArray(array("name"=>$category->name,"description"=>$category->description,"Active"=>$category->active,"date"=>$category->date),$row);
				
			}
			return implode($html);*/
		return $list;
	}
	
	public static function SaveCategory($object)
	{
		//return var_dump($object);
	 	return DAOCategory::Save($object);	
	}
	
	public static function GetAllDomains()
	{
		return DAODomain::LoadAll();
	}
	
	
	
	
	public static function GetAllContent($id)
	{
		$sources = DAOSource::LoadByDomain($id);
		//$content = new Content();
		$domain="";
		foreach ($sources as $object)
		{
		if ($domain=="")
			$domain = $object->id;
		else {
			$domain = $domain.",".$object->id;
		}	
		}
		//var_dump($domain);
		//return $list;
		return DAOContent::LoadbyDomain($domain);
	}
	
		public static function GetAllContents($id)
	{
		$sources = DAOSource::LoadByDomain($id);
		//$content = new Content();
		$domain="";
		//unset($_SESSION['LastLoad']);
		foreach ($sources as $object)
		{
			if ($domain=="")
				$domain = $object->id;
			else {
				$domain = $domain.",".$object->id;
			}
		}
		$ini = 1;
		return DAOContent::LoadbyDomain($domain, "Refresh");
		//return DAOContent::LoadbyDomainord($domain);
	}
	
	public static function GetContentList ($id)
	{
		$row = self::get_include_contents("templates/contentlist.html");
		$list = DAOContent::LoadByCategory($id);
		//var_dump($list);
		if ($list==NULL) $html[]="Não existem artigos nesta categoria";
		else
			{
			foreach ($list as $content)
				{
					$html[]= utils::AssignArray(array("title"=>$content->title,"id"=>$content->id),$row);	
				}
			}	
			return implode($html);
	}
	
	public static function regfedd()
	{
		$sources = DAOSource::LoadByDomain(1);
		foreach ( $sources as $object)
		{
			$feedURL = $object->feed;
			self::feedinsert($feedURL, $object->id);
			//echo "Insert Content of source ".$object->topic;	
		}	
	}
	
	
 public static function feedinsert($feedUrl, $source_id)
 {	
	// Fetch feed from URL
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $feedUrl);
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	 
	// FeedBurner requires a proper USER-AGENT...
	curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
	curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11");
	 /*
	  * // FeedBurner requires a proper USER-AGENT…
	curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
	curl_setopt($curl, CURLOPT_ENCODING, “gzip, deflate”);
	curl_setopt($curl, CURLOPT_USERAGENT, “Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3″);
	  * 
	  * */
	$feedContent = curl_exec($curl);
	curl_close($curl);
 	//var_dump($feedContent);
	// Did we get feed content?
	if($feedContent && !empty($feedContent))
		{
		$feedXml = @simplexml_load_string($feedContent);
		//var_dump($feedXml);
		if($feedXml)
			{
			if ( isset($feedXml->entry))
				{
				//	echo " -- entry --";
			  	foreach($feedXml->entry as $item)
			  		{
					//<li style="padding:4px 0;"><a href="<?php echo $item->link; "><?php echo $item->title;</a></li>
				 //	var_dump($item->category);
				 	$object = new Content();
					$object->source_id= $source_id;
					$object->title = $item->title."";
					$object->link = $item->link['href']."";
					$object->category_id= 1;
					$object->active = 1;
					//var_dump($object);
					DAOContent::Save($object);			
					}
				}
			elseif (isset($feedXml->channel->item))
			{
			//	echo " -- Channel->item --";
				foreach($feedXml->channel->item as $item)
			  		{
					//<li style="padding:4px 0;"><a href="<?php echo $item->link; "><?php echo $item->title;</a></li>
				 	//var_dump($item);
				 	$object = new Content();
					$object->source_id= $source_id;
					$object->title = $item->title."";
					$object->link = $item->guid."";
					$object->category_id= 1;
					$object->active = 1;
					//var_dump($object);
					DAOContent::Save($object);			
					}
			}
			else {
				echo "<strong> not found a metod </strong>";
			}
			}
		}
}


		public static function GetContentbytop ($id)
		{
			
			return DAOContent::Load($id);
			
		}
	
	
		public static function GetContent ($id)
		{
			
			return DAOContent::Load($id);
			
		}
	
		public static function GetContentbyTitle ($id)
		{
			
			return DAOContent::LoadbyTitle($id);
			
		}
		
		public static function GetContentDetail ($id)
		{
			$row = self::get_include_contents("templates/contentdetail.html");
		$content = DAOContent::Load($id);
		//var_dump($category);
		if ( $content == NULL) $html[]="Este Artigo não tem detalhe";
		else 
			{
				self::UpdateContentHistory($id);
				$html[]= utils::AssignArray(array("description"=>$content->description,"title"=>$content->title,"link"=>$content->link),$row);
				
			}
			return implode($html);
	}
	
	public static function SaveContent($object)
	{
		DAOContent::Save($object);
		
	}
	
	public static function TryRemoveContent($id)
	{
	$test = DAOContenthistory::LoadByContent($id);
	$test2= DAOContentmedia::LoadByContent($id);
		if ($test==Null and $test2==NULL)
		{
			DAOContent::Remove($id);
		}
		else {
			return "Não é possivel remover";
		}
		return "Removido";	
		
	}
	
	public static function UpdateContentHistory($id)
	{
		
		$object= new Contenthistory;
		$object->content_id=$id;
		$object->ip="000.000.000.000";
		$object->user_id=1;
		DAOContenthistory::Save($object);
	}
	
	public static function Rank($id)
	{
		$rank=new rank();
		$list=DAOContenthistory::GetRank($id);
		if ($list !=Null)
		{
		$object=DAOContent::Load($id);
		$rank->title= $object->title;
		$rank->rank= count($list);
		
		}
		else {
			$rank=Null;
		}
		//var_dump($rank);
		
		return $rank;
	}
	
	public static function Top()
	{
	$now = new datetime();
	$day = clone $now;
	$day->modify('- 1 day');
	$week = clone $now;
	$week->modify ('- 7 day');
	$month = clone $now;
	$month->modify ('-1 month');
	//$date1=DateInterval($date);
	//$list=DAOContenthistory::LoadAll();
	//echo "NOW - ".$week->format( 'Y-m-d H:i:s' )." and ".$now->format( 'Y-m-d H:i:s' );
	$topWeek = DAOContenthistory::GetbyDates($week->format( 'Y-m-d'), $now->format( 'Y-m-d' ));
	$topmont = DAOContenthistory::GetbyDates($month->format( 'Y-m-d'), $now->format( 'Y-m-d' ));
	$topDay = DAOContenthistory::GetbyDates($now->format('Y-m-d'), $now->format('Y-m-d'));
	$topall = DAOContenthistory::GetAllTime();
	//var_dump($topDay); 
	//var_dump($topWeek);
	//var_dump($topmont);
	if ($topDay != null)
	{
		$object1 = DAOContent::LoadMoreTop($topDay);
	}
	else {
		$object1 = self::TopToday($day);
	}
	if ($topWeek != null)
	{
		$object2 = DAOContent::LoadMoreTop($topWeek);
	}
	else {
		$object2 = self::TopWeek($week);
	}
	$object3 = DAOContent::LoadMoreTop($topall);
	/*echo " Top of Day --- ".$object1->title." ---- \n" ;
	echo "\n";
	echo " Top of Week --- ".$object2->title." ---- \n" ;
	echo "\n";
	echo " Top of Month --- ".$object3->title." ---- \n" ;*/
	$data = array();
	$data[0]=$object1;
	$data[1]=$object2;
	$data[2]=$object3;
	//var_dump($data[0]);	
	return $data;
	}



	public static function TopToday($date)
	{
		$now = new datetime();
		if(!isset($date))
			{
				$date = clone $now;
			}
	$topDay = DAOContenthistory::GetbyDates($date->format('Y-m-d'), $now->format('Y-m-d'));
	if ($topDay != null)
	{
		$object = DAOContent::LoadMoreTop($topDay);
	}	
	else {
		while ($topDay == Null)
		{
		$date->modify('- 1 day');
		$topDay = DAOContenthistory::GetbyDates($date->format('Y-m-d'), $now->format('Y-m-d'));	
		//var_dump($date->format('Y-m-d'));
		}
		$object = DAOContent::LoadMoreTop($topDay);
	}
	return $object;
	}
	
	public static function TopWeek($date)
	{
	$now = new datetime();
	if(!isset($date))
	{
	 $date = clone $now;
	 $date->modify ('-7 day');	
	}
	$topWeek = DAOContenthistory::GetbyDates($date->format( 'Y-m-d'), $now->format( 'Y-m-d' ));
	if ($topWeek != null)
	{
		$object = DAOContent::LoadMoreTop($topWeek);
	}
	else {
		while ($topWeek == Null)
		{
		$topWeek = DAOContenthistory::GetbyDates($date->format('Y-m-d'), $now->format('Y-m-d'));	
		$date->modify('- 7 day');
		}
		$object = DAOContent::LoadMoreTop($topWeek);
	}
	return $object;
	}
	
	public static function TopAllTime()
	{
	$top = DAOContenthistory::GetAllTime();
	if ($top != null)
	{
		$object = DAOContent::LoadMoreTop($top);
	}	
	return $object;
	}

	public static function Facebook()
	{
		$face = new Facebook();
		
	}
	
	public static function Search ($keyword)
	{
		$list= DAOContent::Search($keyword);
		
		return $list;
		
	}
	
	
	
	
	public static function ShowSearch ($keyword)
	{
		$row = self::get_include_contents("templates/search.html");
		//$row = self::get_include_contents("templates/content.html");
		$list= DAOContent::Search($keyword);
		//var_dump($list);
		if ( $list == NULL) $html[]="A procura não retornou qualquer resultado";
		else 
			{
			foreach ($list as $object ) 
				{
					$html[]= utils::AssignArray(array("id"=>$object->id,"title"=>$object->title),$row);
					
				}
			}
			//var_dump($html);
		return implode($html);
	}
	
	public static function GetNews ($cat_id)
	{
		//$row = self::get_include_contents("templates/search.html");
		$row = self::get_include_contents("templates/content.html");
		$list = DAOContent::LoadNews($cat_id);
		
		
		//var_dump($list);
		if ($list == NULL) 
			{
				$cat = DAOCategory::Load($cat_id);
				if ($cat ==Null)
				{
					$html[]="Category Not Exist  ";	
				}
				else {
					$html[]="Not Exist News to Category name ".$cat->name;	
				}
			
			
			}
		else {
			foreach ($list as $object)
			{
				
				$html[]= utils::AssignArray(array("id"=>$object->id,"title"=>$object->title),$row);
				
			}
		}
		return implode($html);	
	}
	
	public static function GetProfile($email)
	{
		
		$user = DAOUser::LoadProfile($email);
		return $user;
	}
	
	public static function GetSelectDomain($profile_id)
	{
			$list = DAOProfiledomain::LoadProfile($profile_id);
			//var_dump($list);
			$domain = array();
			foreach ($list as $object) {
				array_push($domain,DAODomain::Load($object->domain_id));
			}
			return $domain;
		
	}
	
	public static function SaveProfileDomain($object)
	{
	return	DAOProfiledomain::Save($object);
	}
	
	public static function ShowDomain ($list)
	{
		$row = self::get_include_contents("../templates/admin/Domains.html");
		//var_dump($row);
		if ($list == NULL) $html[]="";
		else {
			foreach ($list as $object)
			{
				//var_dump($object);
				
				$html[]= utils::AssignArray(array("id"=>$object->id,"codname"=>$object->codname,"name"=>$object->name),$row);
				
			}
		}
		//var_dump($html);
		return implode($html);	
	}
	
	public static function GetDomain($id)
	{
	 return	DAODomain::Load($id);
	}
	
	public static function SaveDomain($object)
	{
		$id = DAODomain::Save($object);
	
            return $id;
	}
	
	public static function TryRemoveDomain($id)
	{
			echo "tryRemove";
			$list = DAOProfiledomain::LoadbyDomain($id);
			foreach ($list as $object )
			{
				DAOProfiledomain::Remove($object->id);
			}
			DAODomain::Remove($id);
			$list=glogic::GetSelectDomain($_SESSION['profile']);
			$_SESSION['list']=$list;
			echo "\n"."Removed";
	}
	
	
	public static function ShowManagement ($id)
	{
		$row = self::get_include_contents("../templates/admin/management.html");
				
				$html[]= utils::AssignArray(array(),$row);

		return implode($html);	
	}
	
	public static function TryRemoveCategory ($id)
	{
		$test = DAOContent::LoadByCategory($id);
		if ($test==Null)
		{
			DAOCategory::Remove($id);
		}
		else {
			return "Não é possivel remover";
		}
		return "Removido";
		
	}
	
	
	// --------------------------------------------------------------//
	// -----------------  PUB MANAGEMENT --------------------------- //
	// --------------------------------------------------------------//
	
	public static function GetAllpreAdvertiser()
	{
		return DAOPreadvertiser::LoadAll();
		
	}
	
	public static function GetAllPubtypes()
	{
		 return DAOPubtype::LoadAll();
	}
	
	public static function SavePreadvertiser($object)
	{
		DAOPreadvertiser::Save($object);
		
	}
	
	public static function GetPreAdvertiser($id)
	{
		
		return DAOPreadvertiser::Load($id);
		
	}
	
	public static function TryRemovePreadvertiser($id)
	{
		
		$test = DAOPub::LoadbyPreadvertiser($id);
		if (empty($test)) DAOPreadvertiser::Remove($id);
		else 
		{
			DAOPub::Remove($test[0]->id);
			DAOPreadvertiser::Remove($id);
		}
		return "Removed";
	}
	
	public static function RemovePub($id)
	{
		DAOPub::Remove($id);
		return "Removed";
	}
	
	public static function SavePub($object)
	{
		DAOPub::Save($object);
	}
	
	public static function GetPub($id)
	{
		return DAOPub::LoadByPreadvertiser($id);
		
	}
	
	public static function GetPubFilename($id)
	{
			
		$object = DAOPub::LoadByPreadvertiser($id);
		//var_dump($object);
		if ( empty($object) ) return null;
		else {
			return $object[0];
		}
		
	}
	
	public static function SaveAdvertiser($object)
	{
		DAOAdvertiser::Save($object);
	}
	
	public static function RemoveAdvertiser($id)
	{
		DAOAdvertiser::Remove($id);	
	}
	
	public static function SavePubType($object)
	{
		DAOPubtype::Save($object);
	}
	
	public static function RemovePubType($id)
	{
		DAOPubtype::Remove($id);
	}
	
	public static function GetAdvertiser($id)
	{
		return DAOAdvertiser::Load($id);
	}
	
		public static function GetAdvertiserBy($id)
	{
		return DAOAdvertiser::LoadByPreAdvertiser($id);
	}
	
	// --------------------------------------------------------------//
	// --------------------------------------------------------------//
	
	
	public static function GetAllUser()
	{
		return DAOUser::LoadAll();
		
	}
	
	public static function SaveUser($object)
	{
		DAOUser::Save($object);
	}
	
	
	public static function login($login)
	{
		$object = DAOUser::Loadbylogin($login);
		if (empty($object))
			{
				return False;
			}
		else {
				$_SESSION['GapID']=$object->id;
				$_SESSION['level']= $object->profile->level;
				$_SESSION['profile']=$object->profile_id;
				return TRUE;
				}
	}
	
	public static function logout()
	{
		$id=$_SESSION['GapID'];
		unset($_SESSION);
		session_unset();
		session_destroy();
	}
	
	public static function cssfile()
	{
		$browser = new Browser();
		if ($browser->getPlatform()== Browser::PLATFORM_ANDROID)
		{
			echo "ipod.css";
			/*
			if ($browser->getBrowser()== Browser::BROWSER_ANDROID)
			{
				 echo "Browser Android";
			}
			elseif ($browser->getBrowser()== Browser::BROWSER_OPERA_MINI)
			{
				echo "Browser OPERA_MINI";
			}
			 * */
		}
		elseif ($browser->getPlatform()== Browser::PLATFORM_IPAD) {
			echo "ipad.css";
		}
		elseif ($browser->getPlatform()== Browser::PLATFORM_IPOD) {
			echo "ipod.css";
		}
		elseif ($browser->getPlatform()== Browser::PLATFORM_WINDOWS) 
		{
			
			if ($browser->getBrowser()== Browser::BROWSER_IE)
			{
				 echo "gapstyle_IE8.css";
			}
			else {
				echo "gapstyle.css";
			}
			/*
			elseif ($browser->getBrowser()== Browser::BROWSER_FIREFOX)
			{
				echo "<br />Browser FIREFOX";
			}
			elseif ($browser->getBrowser()== Browser::BROWSER_OPERA)
			{
				echo "<br />Browser OPERA";
			}
			elseif ($browser->getBrowser()== Browser::BROWSER_CHROME)
			{
				echo "<br />Browser Chrome";
			}*/
		}
		elseif ($browser->getPlatform()== Browser::PLATFORM_APPLE) 
		{
			echo "gapstyle.css";
		}
		elseif ($browser->getPlatform()== Browser::PLATFORM_LINUX) {
			echo "gapstyle.css";
		}	
	}
	
}
?>
