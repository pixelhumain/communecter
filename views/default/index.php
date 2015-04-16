<?php
  header('Location: '.Yii::app()->getRequest()->getBaseUrl(true).'/'.$this->module->id."/person/");
  exit();
?>