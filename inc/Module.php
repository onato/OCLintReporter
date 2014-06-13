<?php
error_reporting(E_ERROR | E_PARSE);

require("inc/Config.php");
require("inc/Violation.php");

Class Module{
   private $filename;
   private $jsonObject;

   public $name;
   public $ratio;
   public $numberOfFiles;
   public $filesWithViolations;
   public $priority1;
   public $priority2;
   public $priority3;
   public $date;

   public $violations;


   public function deserialize($filename) {
      global $config;
      $this->filename = $filename;
      $this->deserializeSummary($filename);

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

   public function deserializeSummary($filename) {
      global $config;
      $this->filename = $filename;
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

      $this->name = $filename;
      $this->ratio = $ratio;
      $this->numberOfFiles = $numberOfFiles;
      $this->filesWithViolations = $filesWithViolations;
      $this->priority1 = $priority1;
      $this->priority2 = $priority2;
      $this->priority3 = $priority3;

      $this->date = date ("F d Y H:i:s", filemtime($config["REPORTS_DIR"].$filename));
   }

   private function jsonObject() {
      global $config;

      // if (!isset($this->jsonObject)) {
         $string = file_get_contents($config["REPORTS_DIR"].$this->filename);
         $this->jsonObject = json_decode($string, true);
      // }
      return $this->jsonObject;
   }
};
?>
