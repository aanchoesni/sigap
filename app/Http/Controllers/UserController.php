<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use Alert;
use Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('name', 'asc')->get();

        $data = [
            'user' => $user,
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        );
        $errormessage = array(
            'required' => 'Form Input Ini Tidak Boleh Kosong / Harus Diisi',
            'min' => 'Password minimal 8 karakter',
            'password_confirmation.same' => 'Password tidak sama',
        );

        $data = $request->except('_token');
        $validator = Validator::make($data, $rules, $errormessage);

        if ($validator->fails()) {
            $errormessage = $validator->messages();
            return redirect()->route('user.create')
                ->withErrors($validator)
                ->withInput();
        }

        $data['password'] = bcrypt($request->input('password'));

        User::create($data);

        Alert::success('Data berhasil disimpan')->persistent('Ok');

        $successmessage = "Proses Tambah User Berhasil !!";
        return redirect()->route('user.index')->with('successMessage', $successmessage);
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
        $user = User::find(Crypt::decrypt($id));
        return view('user.edit', compact('user'));
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
        $user = User::where('id', $id)->first();
        $rules = array(
            'name' => 'required',
            'email' => 'required',
        );
        $errormessage = array(
            'required' => 'Form Input Ini Tidak Boleh Kosong / Harus Diisi',
        );

        $validator = Validator::make($request->all(), $rules, $errormessage);

        if ($validator->fails()) {
            $errormessage = $validator->messages();
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('password') != null || $request->input('password') != '') {
            User::where('id', $id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            User::where('id', $id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('user.index')->with('successMessage', 'Berhasil mengubah user');
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
            User::where('id', Crypt::decrypt($id))->delete(Crypt::decrypt($id));

            return redirect()->route('user.index')->with('successMessage', 'Berhasil menghapus user');
        } catch (\Exception $id) {
            return redirect()->route('user.index')->with('successMessage', 'Berhasil menghapus user');
        }
    }
}
