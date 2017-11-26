<?php namespace App;

class ResourceLocation
{
  private static $generalAwsResourceUrlPrefix;
  private static $generalWebviewUrlPrefix;

  public static function generalAwsResourceUrlPrefix(){
    if(!isset($generalAwsResourceUrlPrefix)){
      $generalAwsResourceUrlPrefix = env('AWS_RESOURCE_URL_PREFIX', 'https://s3.us-east-2.amazonaws.com/mimedia-dev-001/');
    }
    return $generalAwsResourceUrlPrefix;
  }

  public static function generalWebviewUrlPrefix(){
    if(!isset($generalWebviewUrlPrefix)){
      $generalWebviewUrlPrefix = env('WEBVIEW_URL_PREFIX', 'http://dasianmediatest.us-east-2.elasticbeanstalk.com/');
    }
    return $generalWebviewUrlPrefix;
  }
}