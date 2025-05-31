<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetlocalizationController extends Controller
{
    public function setlocalization($locale)
    {
        
       if(!in_array($locale, ['en', 'kh'])){
            abort(404);
        }
        // App::setLocale($locale);
        session(['localization' => $locale]);
        
        return redirect()->back();
    }
}
