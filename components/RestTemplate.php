<?php
namespace app\components;

class RestTemplate extends \yii\base\Component
{
  public static function success($data, $msg = 'success', $code = 200)
  {
    return [
      'Author' => 'Adrian T. Saycon',
      'Website' => 'www.adriansaycon.com,',
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
      'Author' => 'Adrian T. Saycon',
      'Website' => 'www.adriansaycon.com,',
      'timestamp' => '',
      'result' => null,
      'status' => [
        'message' => $msg,
        'code' => $code
      ]
    ];
  }
}
