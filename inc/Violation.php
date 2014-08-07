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
      global $config;

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

      $path = $this->path;
      $gitHubRoot = $config["GITHUB_ROOT"];
      if (array_key_exists($this->module->name, $config["GITHUB_ROOTS"])) {
         $gitHubRoot = $config["GITHUB_ROOTS"][$this->module->name];
         $pathPrefixToRemove = $config["COCOAPODS_PREFIX"].$this->module->name;
         $path = str_replace($pathPrefixToRemove, "", $path);
      }

      $this->link = $gitHubRoot . $path . "#L" . $this->startLine . "-" . $this->endLine;
   }
};
?>