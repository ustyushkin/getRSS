<?php
namespace VyacheslavUstyushkin\src;
require __DIR__ . "/../src/params.php";
class paramsTest extends \PHPUnit\Framework\TestCase
{
    /**
	 * phpunit tests/paramsTest
     */

	/**
	* @expectedException InvalidArgumentException
	*/
	public function testConstructor()
	{
		$testedObject = new params(array("1","2"));
	}
	/**
	* @expectedException InvalidArgumentException
	*/
	public function testConstructor2()
	{
		$testedObject = new params(null);
	}
	/**
	* Test verifyType. if input param wrong return false
	*/
	public function testVerifyType()
	{
		$testedObject = new params(array("1","2","3","4"));
		$res = $testedObject->verifyType('csv:sim');
		$this->assertFalse($res, false);
	}
	/**
	* Test verifyType. if input good param must return true
	*/
	public function testVerifyType2()
	{
		$testedObject = new params(array("1","2","3","4"));
		$res = $testedObject->verifyType('csv:simple');
		$this->assertTrue($res, true);
    	}
	/**
	* Test verifyURL. if wrong param must return false
	*/
	public function testVerifyURL()
	{
        	$testedObject = new params(array("1","2","3","4"));
	        $res = $testedObject->verifyURL('brokenURL:#$%//site.com/page.html');
		$this->assertFalse($res, false);
	}
	/**
	* Test verifyURL. if input good param must return true
	*/
	public function testVerifyURL2()
	{
        	$testedObject = new params(array("1","2","3","4"));
		$res = $testedObject->verifyURL('http://site.com/page.html');
		$this->assertTrue($res, true);
	}
	public function testVerifyFileName()
	{
		$testedObject = new params(array("1","2","3","4"));
		$res = $testedObject->verifyFileName('brokenF#$%ileName.csv');
		$this->assertFalse($res, false);
	}
	/**
	* Test VerifyFileName. if input good param must return true
	*/
	public function testVerifyFileName2()
    	{
        	$testedObject = new params(array("1","2","3","4"));
	        $res = $testedObject->verifyFileName('test.csv');
		$this->assertTrue($res, true);
    	}
	/**
	* Test GetType. if wrong input param must set from const
	*/
	public function testGetType()
    	{
        	$testedObject = new params(array("1","2","3","4"));
		$res = $testedObject->getType();
		$this->assertEquals($res, "csv:simple");
    	}
	/**
	* Test GetType. Must set from input params
	*/
	public function testGetType2()
    	{
        	$testedObject = new params(array("1","csv:extended","3","4"));
        	$res = $testedObject->getType();
		$this->assertEquals($res, "csv:extended");
    	}
	/**
	* Test GetURL. if wrong input param must set from const
	*/
	public function testGetURL()
    	{
        	$testedObject = new params(array("1","2","3","4"));
        	$res = $testedObject->getURL();
		$this->assertEquals($res, "http://feeds.nationalgeographic.com/ng/News/News_Main");
    	}
	/**
	* Test GetURL. Must set from input params
	*/
	public function testGetURL2()
    	{
        	$testedObject = new params(array("1","2","http://site.com/page.html","4"));
	        $res = $testedObject->getURL();
		$this->assertEquals($res, "http://site.com/page.html");
    	}
	/**
	* Test GetFilename. if wrong input param must set from const
	*/
	public function testGetFilename()
	{
        	$testedObject = new params(array("1","2","3","4"));
		$res = $testedObject->getFilename();
		$this->assertEquals($res, "example.csv");
    	}
	/**
	* Test GetFilename. Must set from input params
	*/
	public function testGetFilename2()
    	{
        	$testedObject = new params(array("1","2","3","anotherFile.csv"));
	        $res = $testedObject->getFilename();
		$this->assertEquals($res, "anotherFile.csv");
    	}
	public function testGetParentTag()
    	{
        	$testedObject = new params(array("1","2","3","4"));
        	$res = $testedObject->getParentTag();
		$this->assertEquals($res, "item");
    	}
	public function testGetTagsToConvert()
    	{
        	$testedObject = new params(array("1","2","3","4"));
	        $res = $testedObject->getTagsToConvert();
		$this->assertContains("pubDate",$res);
	}
	/**
	* Test GetDateFormat. Set from const
	*/
	public function testGetDateFormat()
    	{
        	$testedObject = new params(array("1","2","3","4"));
		$res = $testedObject->getDateFormat();
		$this->assertNotNull($res);
    	}

}
