<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    
    function set_email(Request $request){

        $request->validate([
            'chosen_email' => 'required',
        ]);

        $setting = Setting::first();
        if ($setting) {
            $setting->chosen_email = $request->chosen_email;
            $setting->save();
        } else {
            Setting::create([
                'chosen_email' => $request->chosen_email
            ]);
        }

        return redirect()->back()->with('success','تم اختيار المستخدم بنجاح');
    }



}
