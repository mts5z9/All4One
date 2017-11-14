<?php

namespace all4one\Http\Controllers;

use all4one\User;
use all4one\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;


class BusinessScannerController extends BusinessController
{
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';

    public function show($status)
    {
      $businessId = $this->getBusinessID();
      $scanners = DB::table('NFC_READER')
        ->join('READER_LOCATION', 'NFC_READER.serialNum', '=','READER_LOCATION.serialNum')
        ->join('LOCATION', 'READER_LOCATION.locationID', '=', 'LOCATION.locationID')
        ->where([
                  ['LOCATION.businessID', $businessId],
                  ['NFC_READER.readerStatus', $status],
                ])
        ->select('NFC_READER.*','READER_LOCATION.locationID')->get();
      $locations = $this->getLocations($status);
      return view('business/manage-scanners',['status'=>$status,'locations' => $locations, 'scanners' => $scanners]);
    }
    public function showCreate()
    {
      $businessId = $this->getBusinessID();
      $locations = $this->getLocations('actv');
      return view('business.add-scanner',['locations' => $locations]);
    }
    public function create(Request $request)
    {
      $businessId = $this->getBusinessID();
      $this->addScannerValidator($request->all())->validate();
      DB::table('NFC_READER')
        ->insert([
                  'serialNum' => $request['serialNum'],
                  'pin' => $request['pin'],
                  'model' => $request['model'],
                  'readerStatus' => 'actv',
        ]);
      DB::table('READER_LOCATION')
        ->insert([
                  'serialNum' => $request['serialNum'],
                  'locationID' => $request['locationID'],
                  'readerLocationStatus' => 'actv',
        ]);
        return redirect('/manageScanners/actv');
    }
    public function showEdit($id)
    {
      $scanner = DB::table('NFC_READER')
                  ->where('serialNum',$id)->first();
      $locations = $this->getLocations('actv');
      return view('business.edit-scanner',['scanner'=>$scanner,'locations'=>$locations]);
    }
    public function edit(Request $request,$id)
    {
      $this->addScannerValidator($request->all())->validate();
      DB::table('NFC_READER')
          ->where('serialNum',$id)
          ->update([
                    'serialNum' => $request['serialNum'],
                    'pin' => $request['pin'],
                    'model' => $request['model'],
                  ]);
      return redirect('/manageScanners/actv');
    }
    public function addScannerValidator(array $data)
    {
      return Validator::make($data, [
        'serialNum' => 'string|max:20',
        'pin' => 'string|max:20',
        'model' => 'string|max:20',
      ]);
    }
    public function changeStatus($id) {
      $scanner = DB::table('NFC_READER')->where('serialNum',$id)->first();

      if($scanner->readerStatus == 'actv')
      {
        DB::table('NFC_READER')
        ->where('serialNum', $id)
        ->update(['readerStatus'=>'inactv']);
          return redirect('/manageScanners/actv');
      } else if ($scanner->readerStatus == 'inactv')
      {
        DB::table('NFC_READER')
        ->where('serialNum', $id)
        ->update(['readerStatus'=>'actv']);
          return redirect('/manageScanners/inactv');
      }
    }
}
