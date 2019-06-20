<?php 

namespace app\rest;

use Yii;

/**
 * Default actually means the default controller of the module
 * DefaultUrlRule does not imply that the rules are initially applied to all controllers
 */
class AppUrlRule extends \yii\rest\UrlRule
{
	/**
	 * @inheritdoc
	 */
	public $tokens = [
		'{id}' => '<id:\\d[\\d,]*>',
		'{email}' => '<email:[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}>',
		'{token}' => '<token:[A-Za-z0-9_-]+>',
	];

	/**
	 * @inheritdoc
	 */
	public $extraPatterns = [		
			'POST login' => 'login',
			'GET required-data' => 'required-data'
    ];
}