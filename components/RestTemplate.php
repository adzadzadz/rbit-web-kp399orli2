<?php
namespace app\components;

class RestTemplate extends \yii\base\Component
{
  public static function success($data, $msg = 'success', $code = 200)
  {
    return [
      'author' => 'Adrian T. Saycon',
      'website' => 'www.adriansaycon.com,',
      'timestamp' => '',
      'result' => $data,
      'status' => [
        'message' => $msg,
        'code' => $code
      ]
    ];
  }

  public static function fail($msg = 'Not allowed', $code = 403)
  {
    return [
      'author' => 'Adrian T. Saycon',
      'website' => 'www.adriansaycon.com,',
      'timestamp' => '',
      'result' => null,
      'status' => [
        'message' => $msg,
        'code' => $code
      ]
    ];
  }
}
