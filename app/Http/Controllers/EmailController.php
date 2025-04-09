<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    
    function set_ip(Request $request){

        $request->validate([
            'chosen_ip' => 'required',
        ]);

        $setting = Setting::first();
        if ($setting) {
            $setting->chosen_ip = $request->chosen_ip;
            $setting->save();
        } else {
            Setting::create([
                'chosen_ip' => $request->chosen_ip
            ]);
        }

        return redirect()->back()->with('success','تم اختيار المستخدم بنجاح');
    }



}
