<?php
date_default_timezone_set('Europe/Vienna');

$config["REPORTS_DIR"] = dirname(__FILE__)."/../reports/";
$config["ARCHIVE_DIR"] = $config["REPORTS_DIR"] . "archive/";
$config["ROOT"] = "/Users/stephen/Documents/Code/Intellum/tribe-ios";

$config["DATE_FORMAT_LONG"] = "G:i F j Y";
$config["DATE_FORMAT_SHORT"] = "F j G:i";

// Call the script to update.php the archived graph data each time the start page is opened.
$config["AUTO_UPDATAE_DATA"] = true;


$config["COCOAPODS_PREFIX"] = "Apps/KitchenSink/Pods/";
$config["GITHUB_USERNAME"] = "onato";
$config["GITHUB_TOKEN"] = "36624c760df286da1cb3a20797c6d855a29b5119";
//$config["GITHUB_ROOT"] = "https://github.com/intellum/tribe-ios/tree/master/";
$config["GITHUB_ROOT"] = "https://github.com/intellum/tribe-ios/tree/2-Catch-up-to-Browser-Features";


$githubRepos = array();
// $githubRepos["AFNetworking"] = "https://github.com/AFNetworking/AFNetworking/tree/1.3.4";
// $githubRepos["Appirater"] = "https://github.com/arashpayan/appirater/tree/master/";
// $githubRepos["Aspects"] = "https://github.com/steipete/Aspects/tree/master/";
// $githubRepos["Bolts"] = "https://github.com/BoltsFramework/Bolts-iOS/tree/master/";
// $githubRepos["CCHMapClusterController"] = "https://github.com/choefele/CCHMapClusterController/tree/master/";
// $githubRepos["CocoaSecurity"] = "https://github.com/kelp404/CocoaSecurity/tree/master/";
// $githubRepos["CRToast"] = "https://github.com/cruffenach/CRToast/tree/master/";
// $githubRepos["Facebook-iOS-SDK"] = "https://github.com/facebook/facebook-ios-sdk/tree/master/";
// $githubRepos["FMDB"] = "https://github.com/ccgus/fmdb/tree/master/";
// $githubRepos["FXBlurView"] = "https://github.com/nicklockwood/FXBlurView/tree/master/";
// $githubRepos["GoogleAnalytics-iOS-SDK"] = "https://github.com/danielctull-forks/GoogleAnalytics-SDK-iOS/tree/master/";
// $githubRepos["GPXParser"] = "https://github.com/fousa/gpx-parser-ios/tree/master/";
// $githubRepos["GRMustache"] = "https://github.com/groue/GRMustache/tree/master/";
// $githubRepos["HexColors"] = "https://github.com/mRs-/HexColors/tree/master/";
// $githubRepos["InAppSettingsKit"] = "https://github.com/futuretap/InAppSettingsKit/tree/master/";
// $githubRepos["JBChartView"] = "https://github.com/Jawbone/JBChartView/tree/master/";
// $githubRepos["JRSwizzle"] = "https://github.com/rentzsch/jrswizzle/tree/master/";
// $githubRepos["MagicalRecord"] = "https://github.com/magicalpanda/MagicalRecord/tree/master/";
// $githubRepos["MapBox"] = "https://github.com/mapbox/mapbox-ios-sdk/tree/master/";
// $githubRepos["NMRangeSlider"] = "https://github.com/muZZkat/NMRangeSlider/tree/master/";
// $githubRepos["NSData+Base64"] = "https://github.com/l4u/NSData-Base64/tree/master/";
// $githubRepos["NSLogger"] = "https://github.com/fpillet/NSLogger/tree/master/";
// $githubRepos["PonyDebugger"] = "https://github.com/square/PonyDebugger/tree/master/";
// $githubRepos["ReactiveCocoa"] = "https://github.com/ReactiveCocoa/ReactiveCocoa/tree/master/";
// $githubRepos["SMCalloutView"] = "https://github.com/ryanmaxwell/GoogleMapsCalloutView/tree/master/";
// $githubRepos["SocketRocket"] = "https://github.com/lukabernardi/AZSocketIO/tree/master/";
// $githubRepos["SSZipArchive"] = "https://github.com/soffes/ssziparchive/tree/master/";
// $githubRepos["SVProgressHUD"] = "https://github.com/samvermette/SVProgressHUD/tree/master/";
// $githubRepos["SVSegmentedControl"] = "https://github.com/samvermette/SVSegmentedControl/tree/master/";
// $githubRepos["SVWebViewController"] = "https://github.com/samvermette/SVWebViewController/tree/master/";
// $githubRepos["TestFlightSDK"] = "https://github.com/danielctull-forks/TestFlight-SDK/tree/master/";
// $githubRepos["TSMessages"] = "https://github.com/toursprung/TSMessages/tree/master/";
// $githubRepos["UIColor-HexString"] = "https://github.com/kevinrenskers/UIColor-HexString/tree/master/";
// $githubRepos["What-s-New"] = "https://github.com/mdznr/What-s-New/tree/master/";

$config["GITHUB_ROOTS"] = $githubRepos;

?>
