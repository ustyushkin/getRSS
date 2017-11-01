<?php
//php src/console.php csv:extended http://feeds.nationalgeographic.com/ng/News/News_Main rss.csv
include 'rssClass.php';
include 'params.php';
$params = new VyacheslavUstyushkin\src\params($argv);
try {
	$example = new VyacheslavUstyushkin\src\rssClass($params);
	$example->saveCSV($example->loadRSS());
	} catch (\Exception $e) {
		echo 'Exception: ',  $e->getMessage(), "\n";
	$example = null;
}

?>
