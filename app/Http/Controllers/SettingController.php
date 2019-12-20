<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SettingController extends Controller
{
    public function location(Request $request)
    {
        Session::put('ss_location', $request->location);

        return redirect()->back();
    }

    public function showMarker(Request $request)
    {
        Session::put('ss_showmarker', $request->marker);

        return redirect()->back();
    }

    public function showLayer(Request $request)
    {
        Session::put('ss_showlayer', $request->layer);

        return redirect()->back();
    }
}
