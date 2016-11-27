<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RawMaterial;

class RawMaterialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	/**
     * View Raw Material list
     *
     * 
     */
    public function view()
    {
        $rawmaterials = RawMaterial::all();

        $data = ['rawmaterials' => $rawmaterials];

        return view('home', $data);
    }    

    /**
     * Storing a Raw Material model
     *
     * 
     */
    public function store(Request $request)
    {
        RawMaterial::create([
            'material_name' => $request->input('add_name'),
            'amount' => $request->input('add_amount'),
            'unit' => $request->input('add_unit'),
            'threshold' => $request->input('add_threshold'),
        ]);

        return redirect('/home');
    }

    /**
     * Storing a Raw Material model
     *
     * 
     */
    public function update(Request $request)
    {
        $data = RawMaterial::find($request->input('put_id'));

		$data->material_name = $request->input('put_name');
        $data->amount = $request->input('put_amount');
        $data->unit = $request->input('put_unit');
        $data->threshold = $request->input('put_threshold');

		$data->save();

        return redirect('/home');
    }

    /**
     * Storing a Raw Material model
     *
     * 
     */
    public function delete(Request $request)
    {
        $data = RawMaterial::find($request->input('delete_id'));
        $data->delete();

        return redirect('/home');
    }
}
