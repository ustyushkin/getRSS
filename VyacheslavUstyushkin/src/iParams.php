<?php
namespace VyacheslavUstyushkin\src;
/**
 * interface iParams
 *
 */
interface iParams
{
	const type = "csv:simple";
	const url = "http://feeds.nationalgeographic.com/ng/News/News_Main";
	const filename = "example.csv";
	const parentTag = "item";
	const tags = array('title','link','description','pubDate','creator');
	const tagsToConvert = array('pubDate');
	const dateFormat = "Y-m-d H:i:s";

	public function getType();
	public function getUrl();
	public function getFilename();
	public function getParentTag();
	public function getTags();
	public function getTagsToConvert();
	public function getDateFormat();
}
?>
