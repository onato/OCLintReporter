<?php
error_reporting(E_ERROR | E_PARSE);

require_once(dirname(__FILE__)."/Config.php");
require_once(dirname(__FILE__)."/Violation.php");

Class Module{
   private $jsonObject;

   public $name;
   public $filename;
   public $pathToFile;
   public $ratio;
   public $numberOfFiles;
   public $numberOfViolations;
   public $filesWithViolations;
   public $priority1;
   public $priority2;
   public $priority3;
   public $date;

   public $violations;


   public function deserialize($pathToFile) {
      global $config;

      $this->filename = basename($pathToFile);
      $this->pathToFile = $pathToFile;
      $this->deserializeSummary($pathToFile);

      $json = $this->jsonObject();
      $this->violations = array();

      foreach ($json["violation"] as $violationDict) {
         $violation = new Violation();
         $path = $violationDict["path"];
         $violation->path = str_replace($config["ROOT"], "", $path);
         $violation->name = basename($path);

         $violation->startLine = $violationDict["startLine"];
         $violation->startColumn = $violationDict["startColumn"];
         $violation->endLine = $violationDict["endLine"];
         $violation->endColumn = $violationDict["endColumn"];
         $violation->rule = $violationDict["rule"];
         $violation->priority = $violationDict["priority"];
         $violation->message = $violationDict["message"];
         $violation->link = $config["GITHUB_ROOT"] . $violation->path . "#L" . $violation->startLine . "-" . $violation->endLine;

         $this->violations[] = $violation;
      }
      $this->jsonObject = "";
   }

   public function deserializeSummary($pathToFile) {
      global $config;
      $this->filename = basename($pathToFile);
      $this->pathToFile = $pathToFile;
      $json = $this->jsonObject();

      $summary = $json["summary"];

      $numberOfFiles = $summary["numberOfFiles"];
      $filesWithViolations = $summary["numberOfFilesWithViolations"];
      $priority1 = $summary["numberOfViolationsWithPriority"][0]["number"];
      $priority2 = $summary["numberOfViolationsWithPriority"][1]["number"];
      $priority3 = $summary["numberOfViolationsWithPriority"][2]["number"];
      $numberOfViolations = $priority1 + $priority2 + $priority3;

      $ratio = 0;
      if ( $filesWithViolations > 0 ) {
         $ratio = $numberOfViolations / $numberOfFiles;
         $ratio = number_format($ratio,1);
      }
      $summary["ratio"] = $ratio;

      $info = pathinfo($this->filename);
      $this->name = basename($this->filename,'.'.$info['extension']);
      $this->ratio = $ratio;
      $this->numberOfFiles = $numberOfFiles;
      $this->numberOfViolations = $numberOfViolations;
      $this->filesWithViolations = $filesWithViolations;
      $this->priority1 = $priority1;
      $this->priority2 = $priority2;
      $this->priority3 = $priority3;

      $datetime = new DateTime();
      $datetime->setTimestamp($json["timestamp"]);
      $this->date = $datetime;
   }

   private function jsonObject() {
      global $config;

      // if (!isset($this->jsonObject)) {
         $string = file_get_contents($this->pathToFile);
         $this->jsonObject = json_decode($string, true);
      // }
      return $this->jsonObject;
   }
};


function modulesInDirectory($directory) {
   $dh  = opendir($directory);
   $modules = array();
   while (false !== ($filename = readdir($dh))) {
       $ext = pathinfo($directory.$filename, PATHINFO_EXTENSION);
       if ($ext == "json") {
           $module = new Module();
           $module->deserializeSummary($directory.$filename);
           $modules[$filename] = $module;
       }
   }

   return $modules;
}
?>
