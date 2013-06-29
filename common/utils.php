<?php

class Utils
{
    public static function Translate($str,$langfile)
    {
        $str=self::UpCaseISOchars($str);
        if(isset($langfile[$str]))
            return self::escapestrings($langfile[$str]);
        else
            return self::escapestrings($str);
    }
    
	public static function UpCaseISOchars($str)
	{
		//$str=iconv("UTF-8","ISO-8859-1",$str);
		$lowerarray=array('é','á','è','à','ó','ò','õ','ç','ã','ê','ù','ú','í');
		$upperarray=array('É','Á','È','À','Ó','Ò','Õ','Ç','Ã','Ê','Ù','Ú','Í');
	
		$str= str_replace($lowerarray,$upperarray,$str);
		$str=strtoupper($str);
		return $str;
		//return iconv("ISO-8859-1","UTF-8",$str);
	}
    
    public static function LoadTemplate($templatepath)
    {
        $myFile = $templatepath;
        $fh = fopen($myFile, 'r');
        $body = fread($fh, filesize($myFile));
        fclose($fh);
        return $body;
    }
	
	public static function setErrorsOn()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	}
	
	public static function GetMonthNumberByName($name)
	{
		if((trim($name)=="Março")||(trim($name)=="março"))
			return "3";
		switch (strtolower(trim($name)))
		{
			case "janeiro":
				return "1";
				break;
			case "fevereiro":
				return "2";
				break;
			case "março":
				return "3";
				break;
			case "abril":
				return "4";
				break;
			case "maio":
				return "5";
				break;
			case "junho":
				return "6";
				break;
			case "julho":
				return "7";
				break;
			case "agosto":
				return "8";
				break;
			case "setembro":
				return "9";
				break;
			case "outubro":
				return "10";
				break;
			case "novembro":
				return "11";
				break;
			case "dezembro":
				return "12";
				break;
			default:
				return "";//"Month Invalid";
				break;
		}
	}
	
	public static function GetDatePT()
	{
		$month=self::GetMonth(date("n"));
		return date("d")." de ".$month.", ".date("Y");
	}
	
	/**
	 * returns Month Name in pt
	 *
	 * @param integer $number
	 * @return string
	 */
	public static function GetMonth($number)
	{
		switch ($number)
		{
			case "1":
				return "Janeiro";
				break;
			case "2":
				return "Fevereiro";
				break;
			case "3":
				return "Março";
				break;
			case "4":
				return "Abril";
				break;
			case "5":
				return "Maio";
				break;
			case "6":
				return "Junho";
				break;
			case "7":
				return "Julho";
				break;
			case "8":
				return "Agosto";
				break;
			case "9":
				return "Setembro";
				break;
			case "10":
				return "Outubro";
				break;
			case "11":
				return "Novembro";
				break;
			case "12":
				return "Dezembro";
				break;
			default:
				return "";//"Month Invalid";
				break;
		}
	}
	
	public static function UpCaseFirstWords($str)
	{
		$retstr="";
		$strarray=split(" ",$str);
		foreach ($strarray as $string)
		{
			if(strlen($string)>0)
			{
				if($retstr!="")
					$retstr.=" ";
				$retstr.=strtoupper(substr($string,0,1)).substr($string,1,strlen($string)-1);
			}
		}
		return $retstr;
	}
	
	public static function GetNameShort($str)
	{
		$str=trim($str);
		$array=explode(' ',$str);
		$count=count($array);
		if($count>1)
		{
			$ret=$array[0]." ".$array[$count-1];
		}else 
		{
			$ret=$str;
		}
		return self::UpCaseFirstWords($ret);
	}
	
	public static function GetFirstName($str)
	{
		$str=trim($str);
		$array=explode(' ',$str);
		$count=count($array);
		if($count>1)
		{
			$ret=$array[0];
		}else 
		{
			$ret=$str;
		}
		return self::UpCaseFirstWords($ret);
	}
	
	/**
	 * Returns Day name in Portuguese
	 *
	 * @param integer $number
	 * @return string
	 */
	public static function GetDayName($number)
	{
		switch ($number)
		{
			case 0:
				return "Domingo";
				break;
			case 1:
				return "Segunda-Feira";
				break;
			case 2:
				return "Terça-Feira";
				break;
			case 3:
				return "Quarta-Feira";
				break;
			case 4:
				return "Quinta-Feira";
				break;
			case 5:
				return "Sexta-Feira";
				break;
			case 6:
				return "Sábado";
				break;
			default:
				return "Invalid day number";
		}
	}
	
	/**
	 * Return date formated
	 *
	 * @param integer $day
	 * @param integer $month
	 * @param integer $year
	 * @param string $format default=Y-m-d
	 * @return Date
	 */
	public static function MakeDate($day,$month,$year,$format="Y-m-d")
	{
		try 
		{
			return date($format,mktime(null,null,null,$month,$day,$year));
		}catch(Exception $ex){return "invalid date";}
	}
	
	public static function MakeMonthSelectOptions($month)
	{
		$retstr="";
		for($i=1;$i<13;$i++)
		{
			if($month==$i)
			{
				$retstr.= "<option selected value=".$i.">".self::GetMonth($i)."</option>";
			}else 
			{
				$retstr.= "<option value=".$i.">".self::GetMonth($i)."</option>";
			}
		}
		return $retstr;
	}
	
	public static function MakeDaySelectOptions($day)
	{
		$retstr="";
		for($i=1;$i<32;$i++)
		{
			if($day==$i)
			{
				$retstr.= "<option selected value=".$i.">".$i."</option>";
			}else 
			{
				$retstr.= "<option value=".$i.">".$i."</option>";
			}
		}
		return $retstr;
	}
	
	/**
	 * Creates Year Select Options for given start year and ending on current year + offset
	 *
	 * @param integer $year
	 * @param integer $startyear default=1929
	 * @param integer $offset default=0
	 * @return string
	 */
	public static function MakeYearSelectOptions($year,$startyear=1929,$offset=0)
	{
		$retstr="";
		for($i=$startyear;$i<date("Y")+1+$offset;$i++)
		{
			if($year==$i)
			{
				$retstr.= "<option selected value=".$i.">".$i."</option>";
			}else 
			{
				$retstr.= "<option value=".$i.">".$i."</option>";
			}
		}
		return $retstr;
	}
	
	/**
	 * Returns array with Alphabet letters
	 *
	 * @return array
	 */
	public static function GetUperCaseAlphabet()
	{
		$alpha=array(
		0=>"A",
		1=>"B",
		2=>"C",
		3=>"D",
		4=>"E",
		5=>"F",
		6=>"G",
		7=>"H",
		8=>"I",
		9=>"J",
		10=>"K",
		11=>"L",
		12=>"M",
		13=>"N",
		14=>"O",
		15=>"P",
		16=>"Q",
		17=>"R",
		18=>"S",
		19=>"T",
		20=>"U",
		21=>"V",
		22=>"W",
		23=>"X",
		24=>"Y",
		25=>"Z"
		);
		return $alpha;		
	}
	
	private static function GetAlphabetForPassword()
	{
		$alpha=array(
		0=>"a",
		1=>"b",
		2=>"c",
		3=>"d",
		4=>"e",
		5=>"f",
		6=>"g",
		7=>"h",
		8=>"i",
		9=>"j",
		10=>"k",
		11=>"l",
		12=>"m",
		13=>"n",
		14=>"o",
		15=>"p",
		16=>"q",
		17=>"r",
		18=>"s",
		19=>"t",
		20=>"u",
		21=>"v",
		22=>"w",
		23=>"x",
		24=>"y",
		25=>"z",
		26=>"0",
		27=>"1",
		28=>"2",
		29=>"3",
		30=>"4",
		31=>"5",
		32=>"6",
		33=>"7",
		34=>"8",
		35=>"9"
		);
		return $alpha;		
	}
	
	private static function GetFullAlphabetForPassword()
	{
		$alpha=array(
		0=>"A",
		1=>"B",
		2=>"C",
		3=>"D",
		4=>"E",
		5=>"F",
		6=>"G",
		7=>"H",
		8=>"I",
		9=>"J",
		10=>"K",
		11=>"L",
		12=>"M",
		13=>"N",
		14=>"O",
		15=>"P",
		16=>"Q",
		17=>"R",
		18=>"S",
		19=>"T",
		20=>"U",
		21=>"V",
		22=>"W",
		23=>"X",
		24=>"Y",
		25=>"Z",
		26=>"a",
		27=>"b",
		28=>"c",
		29=>"d",
		30=>"e",
		31=>"f",
		32=>"g",
		33=>"h",
		34=>"i",
		35=>"j",
		36=>"k",
		37=>"l",
		38=>"m",
		39=>"n",
		40=>"o",
		41=>"p",
		42=>"q",
		43=>"r",
		44=>"s",
		45=>"t",
		46=>"u",
		47=>"v",
		48=>"w",
		49=>"x",
		50=>"y",
		51=>"z",
		52=>"0",
		53=>"1",
		54=>"2",
		55=>"3",
		56=>"4",
		57=>"5",
		58=>"6",
		59=>"7",
		60=>"8",
		61=>"9"
		);
		return $alpha;		
	}
	
	/**
	 * Returns a string truncated at 30 chars
	 *
	 * @param string $string
	 * @return string
	 */
	public static function GetSmallString($string,$len)
	{
		if(strlen($string)<$len)
		{
			return $string;
		}else 
		{
			$pos=strpos($string," ",$len);
			if($pos>0)
				return substr($string,0,$pos);
			else 
                return substr($string,0,$len)."...";
				//return substr($string,0,$len);
		}
	}     
    
    public static function GetSmallString2($texto, $tags, $limite) 
    {
        if (strlen(strip_tags($texto)) > $limite) {
        //$texto = substr($texto, 0, $limite) . '...';    
        $texto2 = substr(strip_tags($texto,$tags), 0, $limite).'...';    
        }
        else { $texto2 = $texto; }
        return $texto2;
    } 
	
	public static function GetAbsoluteURI($url)
	{
		if($url=="")
			return "";

		$requri=$_SERVER["REQUEST_URI"];
		$uriarr=explode("/",$requri);
		$list=explode("/",$url);
		$retstr="Http://".$_SERVER["HTTP_HOST"]."/".$uriarr[1];
		$lcount=count($list);
		for($i=0;$i<$lcount;$i++)
		{
			if(($list[$i]!=".")&&($list[$i]!=".."))
				$retstr.="/".$list[$i];
		}
		return $retstr;
	}
	
	public static function GeneratePassword($len)
	{
		$alpha=self::GetAlphabetForPassword();
		$pass="";
		for($i=0;$i<$len;$i++)
		{
			$pass.=$alpha[rand(0,count($alpha)-1)];
		}
		return $pass;
	}
	
	public static function GetWeekEndDate($number,$year)
	{
		$w=0;
		for($i=0;$i<7;$i++)
		{
			$w=date("w",mktime(0,0,0,1,$i,$year));
			if($w>0)
				break;
		}
		return date("Y-m-d",mktime(0,0,0,1,($number*7)+$w,$year));
	}
	
	public static function GetMonthDays($month,$year)
	{
		switch ($month)
		{
			case 1:
				return 31;
				break;
			case 2:
				$day=date("d",mktime(0,0,0,2,29,$year));
				if($day==29)
					return 29;
				else 
					return 28;
				break;
			case 3:
				return 31;
				break;
			case 4:
				return 30;
				break;
			case 5:
				return 31;
				break;
			case 6:
				return 30;
				break;
			case 7:
				return 31;
				break;
			case 8:
				return 31;
				break;
			case 9:
				return 30;
				break;
			case 10:
				return 31;
				break;
			case 11:
				return 30;
				break;
			case 12:
				return 31;
				break;

		}
	}
	
	
	/**
	 * Fibonacci Sequence with F(0)=1
	 *
	 * @param integer $number
	 * @return integer
	 */
	public static function Fibonacci($number)
	{
		if($number<2)
		{
			return 1;
		}else 
		{
			return (self::Fibonacci($number-1)+self::Fibonacci($number-2));
		}
	}
	
	
	public static function escapestrings($b) {
	
	  if (!get_magic_quotes_gpc()) //se magic_quotes não estiver ativado, escapa a string
	  {
	    return mysql_real_escape_string ($b); // função nativa do php para escapar variáveis
	  }
	  else // caso contrario
	  {
          return mysql_real_escape_string (stripcslashes($b));
	   return $b; // retorna a variável sem necessidade de escapar duas vezes
	  }
	}
	
	public static function clearlinefeeds($str)
	{
		return str_replace("\\r\\n","",$str);
	}
	
	public static function EndsWith($FullStr, $EndStr)
	{
	        // Get the length of the end string
	    $StrLen = strlen($EndStr);
	        // Look at the end of FullStr for the substring the size of EndStr
	    $FullStrEnd = substr($FullStr, strlen($FullStr) - $StrLen);
	        // If it matches, it does end with EndStr
	    return $FullStrEnd == $EndStr;
	}
    
    public  static function  AssignArray($array,$searchstr) 
    {
        foreach ($array as $code => $value) {
            $searchstr = str_replace("{".$code."}", $value, $searchstr);
        }
        
        return $searchstr;
    }
    
    /**
    * Returns if provided email is valid
    * 
    * @param string $email
    */
    public static function ValidateEmail($email)
    {
        if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) 
        { 
          return true;
        } 
        else 
        { 
          return false;
        }
    }
    
    /**
    * @author Davide Ricardo
    */
    function redirect($url,$message,$delay) {
        echo "<meta http-equiv='Refresh' content='$delay;url=$url'>";
        if (!empty($message))
            echo "<center>$message</center>";
        die();
    }
    
    function thumb($name_img,$new_width)
    {
        $path = "uploadedfiles/fb/";
        $path_thumb = "uploadedfiles/thumbs/";
        //$name_img = "screen_img81516555233.jpg";
        $size = getimagesize($path.$name_img);

        //Tamanhos iniciais - valores automaticamente
        $width = $size[0];
        $height = $size[1];
        
        $stamp = imagecreatefrompng('images/logo_trans.png'); //watermark
        //$img = imagecreatefrompng($path.$name_img);  
        
        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        //Nome para o thumb
        $name_thumb = substr($name_img,0,strpos($name_img,"."))."_thumb".substr($name_img,strpos($name_img,"."));

        //$new_width = 130;
        $new_height = floor($height*($new_width/$width));

        $thumb = imagecreatetruecolor($new_width, $new_height);
        $img = imagecreatefrompng($path.$name_img);
        // imagem com watermarker
        imagecopy($img, $stamp, imagesx($img) - $sx - $marge_right, imagesy($img) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
        imagecopyresampled($thumb, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        //Finaliza a criacao da nova imagem
        imagejpeg($img, $path.$name_img);
        imagejpeg($thumb, $path_thumb.$name_thumb, 100);
        
        return $name_thumb;
    }
    
    function lang($row)
    {                
        include('translation.php');
        return $translation[$row][$_SESSION['lang']-1];
    }
    
    function ByteSize($bytes)  
    { 
        $size = $bytes / 1024; 
        if($size < 1024) 
            { 
            $size = number_format($size, 2); 
            $size .= ' KB'; 
            }  
        else  
            { 
            if($size / 1024 < 1024)  
                { 
                $size = number_format($size / 1024, 2); 
                $size .= ' MB'; 
                }  
            else if ($size / 1024 / 1024 < 1024)   
                { 
                $size = number_format($size / 1024 / 1024, 2); 
                $size .= ' GB'; 
                }  
            } 
        return $size; 
    }
    
    /* returns the shortened url */
    function get_bitly_short_url($url,$login,$appkey,$format='txt') {
      $connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
      return curl_get_result($connectURL);
    }

    /* returns expanded url */
    function get_bitly_long_url($url,$login,$appkey,$format='txt') {
      $connectURL = 'http://api.bit.ly/v3/expand?login='.$login.'&apiKey='.$appkey.'&shortUrl='.urlencode($url).'&format='.$format;
      return curl_get_result($connectURL);
    }

    /* returns a result form url */
    function curl_get_result($url) {
      $ch = curl_init();
      $timeout = 5;
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
    }
}
?>