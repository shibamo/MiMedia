<?php namespace App;

class ResourceLocation
{
  private static $generalAwsResourceUrlPrefix;

  public static function generalAwsResourceUrlPrefix(){
    if(!isset($generalAwsResourceUrlPrefix)){
      $generalAwsResourceUrlPrefix = env('AWS_RESOURCE_URL_PREFIX', 'https://s3.us-east-2.amazonaws.com/mimedia-dev-001/');
    }
    return $generalAwsResourceUrlPrefix;
  }
}