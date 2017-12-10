<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

use UUID;
use JWTAuth;

use App\TvProgrameVisit;
use App\RadioProgrameVisit;
use App\ForumThreadVisit;
use App\AdVisit;

class ContentVisitController extends ApiController
{
  public function add(Request $request)
  {
    $bizTypeCode = $request->input('c');
    switch($bizTypeCode){
      case 1: // tv
        $visit = $request->only('userId','extentionCode','deviceUUID','model','platform','version','latitude','longitude');
        $visit['tvProgrameId'] = $request->input('t');
        TvProgrameVisit::create($visit);
        break;
      case 2: // radio
        $visit = $request->only('userId','extentionCode','deviceUUID','model','platform','version','latitude','longitude');
        $visit['radioProgrameId'] = $request->input('r');
        RadioProgrameVisit::create($visit);
        break;
      case 3: // forum
        $visit = $request->only('userId','extentionCode','deviceUUID','model','platform','version','latitude','longitude');
        $visit['forumThreadId'] = $request->input('f');
        ForumThreadVisit::create($visit);
        break;
      case 4: // advertisement
        $visit = $request->only('userId','extentionCode','deviceUUID','model','platform','version','latitude','longitude');
        $visit['adId'] = $request->input('a');
        AdVisit::create($visit);
        break;
      default:
        // todo: log it
    }

    return response()->json(null, 
      Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }
}