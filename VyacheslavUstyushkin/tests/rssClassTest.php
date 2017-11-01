<?php
namespace VyacheslavUstyushkin\src;
require __DIR__ . "/../src/rssClass.php";
require __DIR__ . "/../src/params.php";
class rssClassTest extends \PHPUnit\Framework\TestCase
{
	/**
	* phpunit tests/rssClassTest
	*/

	/**
	* @expectedException InvalidArgumentException
	*/
	public function testConstructor()
	{
		$testedObject = new rssClass(array("1","2"));
	}
	/**
	* @expectedException InvalidArgumentException
	*/
	public function testConstructor2()
	{
		$testedObject = new rssClass(null);
	}
	/**
	* Test loading rss. must be array
	*/
	public function testLoadRSS()
	{
		$tempObject = new params(array("1","2","3","4"));
		$testedObject = new rssClass($tempObject);
		$tempArray = $testedObject->loadRSS();
		$this->assertInternalType("array", $tempArray);
	}
	/**
	* @expectedException Exception
	*/
	public function testSaveCSS()
	{
		$tempObject = new params(array("1","csv:extended","ht$%^tp://feeds.nationalgeographic.com/ng/News/News_Main","qwe.csv"));
		$testedObject = new rssClass($tempObject);
		$tempArray = $testedObject->saveCSV(null);
		//$this->assertInternalType("array", $tempArray);
	}
	/**
	* Test save rss. must be true
	*/
	public function testSaveCSS2()
	{
		$tempObject = new params(array("1","csv:extended","ht$%^tp://feeds.nationalgeographic.com/ng/News/News_Main","qwe.csv"));
		$testedObject = new rssClass($tempObject);
		$temp = $testedObject->saveCSV($testedObject->loadRSS());
		$this->assertTrue($temp, true);
	}


}
