<?php
include_once("inc/Config.php");
include_once("inc/Module.php");

if (file_exists("data/githubRepos.php")) {
	include_once("data/githubRepos.php");
}

$reportsDir = $config["REPORTS_DIR"];
$archiveDir = $config["ARCHIVE_DIR"];

$modules = modulesInDirectory($reportsDir);
$firstModule = array_values($modules)[0];

$moduleForBuildTime = new Module();
$moduleForBuildTime->deserializeSummary($reportsDir.$firstModule->filename);
$timestamp = $moduleForBuildTime->date->getTimestamp()*1000;

$foundGithubRepos = array();
echo "<?php </br></br>";
echo "\$githubRepos = array();<br/>";
foreach ($modules as $key => $tmpModule) {
	$name = $tmpModule->name;
	if (!array_key_exists($name, $githubRepos)) {
		$githubRepoURL = findProjectOnGithub($tmpModule->name);
		echo "\$githubRepos[\"$tmpModule->name\"]" . " = ";
		if ($githubRepoURL) {
			echo '"'.$githubRepoURL.'";';
			$foundGithubRepos[$tmpModule->name] = $githubRepoURL;
		}else{
			echo '"";';
		}
		echo "<br/>";
	}
	flush();
}
echo "?>";

//print_r($foundGithubRepos);



function findProjectOnGithub($name) {
	$url = "https://api.github.com/search/repositories?q=$name+language:objective-c&sort=stars&order=desc";
	$content = get_data($url);
	$json = json_decode($content, true);
	if (array_key_exists("items", $json)) {
		if (count($json["items"]) > 0) {
			return $json["items"][0]["html_url"];
		}
	}else{
		print_r($json);exit;
	}

}

function get_data($url) {
	global $config;

	$ch = curl_init();
	$timeout = 5;
	$userAgent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36";
	curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
	curl_setopt($ch, CURLOPT_URL, $url);

	$username = $config["GITHUB_USERNAME"];
	$password = $config["GITHUB_TOKEN"];
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
?>