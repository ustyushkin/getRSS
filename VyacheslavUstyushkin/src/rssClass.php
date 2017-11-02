<?php
namespace VyacheslavUstyushkin\src;

class rssClass
{
	private $tURL;
	private $parentTag;
	private $tags;
	private $filename;
	private $type;
	private $tagsToConvert;
	private $dateFormat;
	/**
	* Create a new rssClass instance
	*/
	public function __construct($params)
	{
		if ($params instanceof iParams)
		{
			$this->tURL = $params->getUrl();
			$this->parentTag = $params->getParentTag();
			$this->tags = $params->getTags();
			$this->type = $params->getType();
			$this->filename = $params->getFilename();
			$this->tagsToConvert = $params->getTagsToConvert();
			$this->dateFormat = $params->getDateFormat();
		}
		else {
			throw new \InvalidArgumentException('Not instance of iParams');
		}
	}

	/**
	* loadRSS
	*
	* @return array with rss data
	*/
	public function loadRSS()
	{
		$rss = new \DOMDocument();
		$rss->load($this->tURL);
		if(!count($rss)){
			throw new \Exception('Error load RSS');
		}
		$feed = array();
		$item = array();
		foreach ($rss->getElementsByTagName($this->parentTag) as $node) {

			foreach($this->tags as $value)
			{
				if ($node->getElementsByTagName($value)->item(0))
				{
					if (in_array($value,$this->tagsToConvert))
					{
						$item[$value] = $this->convertDate($node->getElementsByTagName($value)->item(0)->nodeValue);
					}
					else{
						$item[$value] = strip_tags($node->getElementsByTagName($value)->item(0)->nodeValue);
					}
				}
				else {
					$item[$value] = "";
				}
			}
			array_push($feed, $item);
		}
		return $feed;
	}

	/**
	* convertDate
	*
	* @param string $value for date
	* @return string converted date
	*/
	public function convertDate($value)
	{
		$date = date_create($value);
		if (!$date)
		{
		    throw new \UnexpectedValueException("Could not parse the date: $value");
		}
		return date_format($date,$this->dateFormat);
	}

	/**
	* saveCSV
	*
	* @param array $value for save to csv format
	* @return true if all rigth
	*/
	public function saveCSV($value)
	{
		if (is_array($value))
		{
			$typeWrite = ($this->type=="csv:simple")?"w":"a";
			$handle = fopen($this->filename, $typeWrite);
			if ( !$handle ) {
				throw new Exception('Can\'t open file.');
			}
			if (!fputcsv ( $handle , $this->tags , ",","\""))
			{
				throw new Exception('Error parsing header csv.');
			}
			foreach($value as $item)
			{
				if(!fputcsv ( $handle , $item , "," ,"\""))
				{
					throw new Exception('Error parsing item csv.');
				}
			}
			fclose($handle);
		}
		else {
			throw new \InvalidArgumentException('Type of parameter is not array');
		}
		return true;
	}
}
