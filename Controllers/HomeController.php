<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\TablePins;
use Validator;

class HomeController extends BaseController {
     public function tableSelections(Request $request) {
        // dd($request);exit;
        $table_pin = $request->input('table_pin');

       

        $TablePins = TablePins::where('table_pin', '=', $table_pin)
                ->select('id','table_no','table_pin','status')
                ->get();
      
        if($TablePins->isEmpty()) {
       
            return $this->sendError('Table Number not found.');
        }



        return $this->sendResponse($TablePins, 'Table Number Get Successfully.');
    }

}
