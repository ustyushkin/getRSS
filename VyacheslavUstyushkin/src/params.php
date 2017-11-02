<?php
namespace VyacheslavUstyushkin\src;
include 'iParams.php';
class params implements iParams
{
	private $type;
	private $url;
	private $filename;
	private $parentTag;
	private $tags;
	private $tagsToConvert;
	private $dateFormat;
	/**
	 * Create a new params instance
	 */
	public function __construct($argv)
	{
		if ((is_array($argv))&(count($argv)>=3))
		{
			list($this->type, $this->url, $this->filename) = array_slice($argv, 1, 4);

			if (!$this->verifyType($this->type))
			{
				$this->type = $this::type;
			}

			if (!$this->verifyURL($this->url))
			{
				$this->url = $this::url;
			}

			if (!$this->verifyFileName($this->filename))
			{
				$this->filename = $this::filename;
			}
		}
		else {
			throw new \InvalidArgumentException('Error set params');
		}
	}

	/**
	 * verifyType
	 *
	 * @param string $value
	 * @return boolean
	 */
	public function verifyType($value)
	{
		if (($value!="csv:simple")&($value!="csv:extended"))
		{
			return false;
		}
		return true;
	}

	/**
	 * verifyURL
	 *
	 * @param string $value
	 * @return boolean
	 */
	public function verifyURL($value)
	{
		if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) 
		{
			return false;
		}
		return true;
	}

	/**
	 * verifyFileName
	 *
	 * @param string $value
	 * @return boolean
	 */
	public function verifyFileName($value)
	{
		if (!preg_match('/^[a-zA-Z0-9-]+\.csv$/', $value))
        	{
           		return false;
        	}
		return true;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getFilename()
	{
		return $this->filename;
	}

	public function getParentTag()
	{
		return isset($this->parentTag)?$this->parentTag:$this::parentTag;
	}

	public function getTags()
	{
		return isset($this->tags)?$this->tags:$this::tags;
	}

	public function getTagsToConvert()
	{
		return isset($this->tagsToConvert)?$this->tagsToConvert:$this::tagsToConvert;
	}

	public function getDateFormat()
	{
		return isset($this->dateFormat)?$this->dateFormat:$this::dateFormat;
	}
}
?>
