<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SuperAdmin\Symptoms;
use App\Http\Controllers\Controller;

class SymptomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Symptoms::all();
        return view('superadmin.contents.symptoms.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.contents.symptoms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:symptoms',
            'lowStart' => 'required',
            'highStart' => 'required',
            'lowEnd' => 'required',
            'highEnd' => 'required',
        ]);

     Symptoms::create([
            'name' => $request->name,
            'code' => $request->code,
            'low_start' => $request->lowStart,
            'high_start' => $request->highStart,
            'low_end' => $request->lowEnd,
            'high_end' => $request->highEnd,
        ]);

        return redirect(route('superadmin.symptoms.index'));
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
        $data = Symptoms::find($id);
        return view('superadmin.contents.symptoms.edit', compact('data'));
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
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'lowStart' => 'required',
            'lowEnd' => 'required',
            'highStart' => 'required',
            'highEnd' => 'required',
        ]);

        Symptoms::find($id)->update([
            'name' => $request->name,
            'code' => $request->code,
            'low_start' => $request->lowStart,
            'low_end' => $request->lowEnd,
            'high_start' => $request->highStart,
            'high_end' => $request->highEnd
        ]);
        return redirect(route('superadmin.symptoms.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Symptoms::find($id)->delete();

        return redirect(route('superadmin.symptoms.index'));
    }
}
