<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Alert;
use Auth;
use Crypt;
use Mapper;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $building = Building::orderBy('fakultas', 'asc')->orderBy('name', 'asc')->get();

        $data = [
            'building' => $building,
        ];

        return view('building.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Mapper::map(-7.315600, 112.726878, ['zoom' => 15.5, 'markers' => ['symbol' => 'circle', 'scale' => 1000, 'animation' => 'DROP', 'draggable' => true, 'eventDragEnd' => 'dragend(event);']]);

        return view('building.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        
        $data['coordinate'] = new Point($data['lng'], $data['lat']);	// (lat, lng)
        $data['userid_created'] = Auth::user()->id;
        $data['userid_updated'] = Auth::user()->id;

        Building::create($data);

        Alert::success('Data berhasil disimpan')->persistent('Ok');

        $successmessage = "Proses Tambah Pengaturan Berhasil !!";
        return redirect()->route('building.index')->with('successMessage', $successmessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $building = Building::where('name', $id)->first();

        $data = [
            'building' => $building,
        ];

        return view('building.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $building = Building::find(Crypt::decrypt($id));

        Mapper::map($building->coordinate->getLng(), $building->coordinate->getLat(), ['zoom' => 18, 'markers' => ['symbol' => 'circle', 'scale' => 1000, 'animation' => 'DROP', 'draggable' => true, 'eventDragEnd' => 'dragend(event);']]);

        $data = [
            'building' => $building,
        ];

        return view('building.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $building = Building::findOrFail($id);

        $data = $request->except('_token');

        $data['coordinate'] = new Point($data['lng'], $data['lat']);	// (lat, lng)
        $data['userid_updated'] = Auth::user()->id;
        $building->update($data);

        Alert::success('Data berhasil diubah')->persistent('Ok');
        return redirect()->route('building.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Building::where('id', Crypt::decrypt($id))->delete(Crypt::decrypt($id));

            return redirect()->route('building.index');
        } catch (\Exception $id) {
            return redirect()->route('building.index');
        }
    }
}
