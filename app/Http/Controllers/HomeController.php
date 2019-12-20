<?php

namespace App\Http\Controllers;

use App\Ap;
use App\Building;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Mapper;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Session::has('ss_location')) {
            Session::put('ss_location', 'ketintang');
        }

        if (!Session::has('ss_showmarker')) {
            Session::put('ss_showmarker', true);
        }

        if (!Session::has('ss_showlayer')) {
            Session::put('ss_showlayer', true);
        }

        if (Session::get('ss_location') == 'lidah') {
            $ap = Building::where('location', 'Lidah Wetan')->with(['rAp'])->withCount(['rAp'])->get();

            Mapper::location('Universitas Negeri Surabaya, Lidah Wetan')->map(
                [
                    'zoom' => 15.8,
                    'center' => true,
                    'marker' => false
                ]
            );
        }

        if (Session::get('ss_location') == 'ketintang') {
            $ap = Building::where('location', 'Ketintang')->with(['rAp'])->withCount(['rAp'])->get();

            Mapper::location('Universitas Negeri Surabaya, Ketintang')->map(
                [
                    'zoom' => 15.8,
                    'center' => true,
                    'marker' => false
                ]
            );
        }

        $marker = [];
        if (Session::get('ss_showmarker') == true) {
            $marker = [];
            foreach ($ap as $key => $value) {
                foreach ($value->rAp as $k => $val) {
                    Mapper::informationWindow(
                        $val->coordinate->getLng(),
                        $val->coordinate->getLat(),
                        $val->name . '<br><i class="fa fa-circle" style="color:green;"></i> ' . $val->status,
                        ['markers' => ['animation' => 'DROP']]);
                    // $building = $value->name;
                    // $lng = $val->coordinate->getLng();
                    // $lat = $val->coordinate->getLat();
                    // $marker[]=[$building, $lng, $lat];
                }
            }
        }

        // $grouped = $ap->groupBy(function ($item, $key) {
        //     return $item['building'];
        // });

        
        // $groupCount = $grouped->map(function ($item, $key) {
        //     return collect($item)->count();
        // });

        // $results = [];

        // $no = 0;
        // foreach ($groupCount as $key => $value) {
        //     $results[$no]['building'] = $key;
        //     $results[$no]['count'] = $value;
        //     $no++;
        // }

        $data = [
            'ap' => $ap,
            'marker' => $marker,
        ];
        
        return view('home', $data);
    }
}
