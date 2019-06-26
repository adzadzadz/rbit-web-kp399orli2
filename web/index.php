<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

if (! function_exists("array_key_last")) {
  function array_key_last($array) {
      if (!is_array($array) || empty($array)) {
          return NULL;
      }
      
      return array_keys($array)[count($array)-1];
  }
}

(new yii\web\Application($config))->run();
