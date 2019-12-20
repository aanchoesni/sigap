<?php

namespace App\Http\Controllers;

use App\Ap;
use App\Building;
use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Alert;
use Auth;
use Crypt;
use Mapper;

class ApController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ap = Ap::orderBy('name', 'asc')->get();

        $data = [
            'ap' => $ap,
        ];

        return view('ap.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Mapper::map(-7.315600, 112.726878, ['zoom' => 15.5, 'markers' => ['symbol' => 'circle', 'scale' => 1000, 'animation' => 'DROP', 'draggable' => true, 'eventDragEnd' => 'dragend(event);']]);

        $building = Building::orderBy('name')->pluck('name', 'id');

        $data = [
            'building' => $building,
        ];

        return view('ap.create', $data);
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

        $data['coordinate'] = new Point($data['lng'], $data['lat']);    // (lat, lng)
        $data['userid_created'] = Auth::user()->id;
        $data['userid_updated'] = Auth::user()->id;

        Ap::create($data);

        Alert::success('Data berhasil disimpan')->persistent('Ok');

        $successmessage = "Proses Tambah Pengaturan Berhasil !!";
        return redirect()->route('ap.index')->with('successMessage', $successmessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ap = Ap::find(Crypt::decrypt($id));

        Mapper::map($ap->coordinate->getLng(), $ap->coordinate->getLat(), ['zoom' => 18, 'markers' => ['symbol' => 'circle', 'scale' => 1000, 'animation' => 'DROP', 'draggable' => true, 'eventDragEnd' => 'dragend(event);']]);

        $building = Building::orderBy('name')->pluck('name', 'id');
        
        $data = [
            'ap' => $ap,
            'building' => $building,
        ];

        return view('ap.edit', $data);
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
        $ap = Ap::findOrFail($id);

        $data = $request->except('_token');

        $data['coordinate'] = new Point($data['lng'], $data['lat']);    // (lat, lng)
        $data['userid_updated'] = Auth::user()->id;
        $ap->update($data);

        Alert::success('Data berhasil diubah')->persistent('Ok');
        return redirect()->route('ap.index');
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
            Ap::where('id', Crypt::decrypt($id))->delete(Crypt::decrypt($id));

            return redirect()->route('ap.index');
        } catch (\Exception $id) {
            return redirect()->route('ap.index');
        }
    }
}
