<?php
Class Violation{
   public $name;
   public $path;
   public $startLine;
   public $startColumn;
   public $endLine;
   public $endColumn;
   public $rule;
   public $priority;
   public $message;
   public $link;

   public $module;

   public function deserialize($dict) {
      $path = $dict["path"];
      $this->path = str_replace($config["ROOT"], "", $path);
      $this->name = basename($path);

      $this->startLine = $dict["startLine"];
      $this->startColumn = $dict["startColumn"];
      $this->endLine = $dict["endLine"];
      $this->endColumn = $dict["endColumn"];
      $this->rule = $dict["rule"];
      $this->priority = $dict["priority"];
      $this->message = $dict["message"];
      $this->link = $config["GITHUB_ROOT"] . $this->path . "#L" . $this->startLine . "-" . $this->endLine;
   }
};
?>