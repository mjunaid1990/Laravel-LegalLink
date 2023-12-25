<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Agreements;
use Illuminate\Support\Facades\Validator;
use Auth;

class SettingsController extends Controller {

    public function index(Request $request) {
        
        $title = 'Settings';
        $agreements = Agreements::all();

        return view('admin/settings/index', compact('title', 'agreements'))->render();
    }
    

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request) {

        $data = $request->all();
        if($data) {
            unset($data['_token']);
            if(isset($data['yoco_live_mode']) && $data['yoco_live_mode'] == 1) {
                $data['yoco_live_mode'] = 1;
            }else {
                $data['yoco_live_mode'] = null;
            }
            foreach ($data as $key=>$val) {
                if(is_array($val)) {
                    $val = implode(',', $val);
                }
                $model = Settings::where('name', $key)->first();
                if($model) {
                    $model->value = $val;
                    $model->save();
                }else {
                    $model = new Settings();
                    $model->name = $key;
                    $model->value = $val;
                    $model->save();
                }
            }
            $request->session()->flash('message', 'Settings saved successfully');
        }
        return redirect()->route('admin.settings');
    }
    
    

}
