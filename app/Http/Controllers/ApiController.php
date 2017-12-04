<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
  protected $recordCountPerPage = 5;

  protected $jsonHeader = array (
    'Content-Type' => 'application/json; charset=UTF-8',
    'charset' => 'utf-8'
  );
}