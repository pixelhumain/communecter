<?php 
$cssAnsScriptFilesModule = array('/assets/css/docs/docs.css');
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
$cssAnsScriptFilesModule = array('/js/docs/docs.js');
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>