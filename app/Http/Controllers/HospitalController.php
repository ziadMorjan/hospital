<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Http\Requests\HospitalRequest;
use Illuminate\Support\Facades\Storage;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hospital::all();
        return view('admin.hospitals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hospitals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HospitalRequest $request)
    {
        // $request->validate([
        //     'name'=>'required|string|min:3',
        //     'location'=>'required|string|min:3',
        //     'cover'=>'nullable|image|mimes:png,jpg',
        //     'describtin'=>'nullable|string|min:3',
        // ]);
        $hospital = new Hospital();
        $hospital->name = $request->get('name');
        $hospital->location = $request->get('location');
        $hospital->is_active = $request->has('is_active');
        $hospital->rate = 4.54;
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imgeName = time().$hospital->name.'.'.$image->getClientOriginalExtension();
            $image->storePubliclyAs('hospitals', $imgeName, ['disk'=>'public']);
            $hospital->cover = $imgeName;
        }
        $hospital->bg_background = 'bg_background';
        $hospital->describtin = $request->get('describtin');;
        $is_saved = $hospital->save();
        if($is_saved){
            session()->flash('message', 'New Hospital Added Successfuly');
            return redirect()->route('hospitals.index');
        }
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
        $hospital = Hospital::find($id);
        return view('admin.hospitals.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HospitalRequest $request, $id)
    {
        // $request->validate([
        //     'name'=>'required|string|min:3',
        //     'location'=>'required|string|min:3',
        //     'cover'=>'nullable|image|mimes:png,jpg',
        //     'describtin'=>'nullable|string|min:3',
        // ]);

        $hospital = Hospital::find($id);
        $hospital->name = $request->get('name');
        $hospital->location = $request->get('location');
        $hospital->is_active = $request->has('is_active');
        $hospital->rate = 4.54;
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imgeName = time().$hospital->name.'.'.$image->getClientOriginalExtension();
            $image->storePubliclyAs('hospitals', $imgeName, ['disk'=>'public']);
            $hospital->cover = $imgeName;
        }
        $hospital->bg_background = 'bg_background';
        $hospital->describtin = $request->get('describtin');
        $is_saved = $hospital->save();
        if($is_saved){
            session()->flash('message', 'Hospital updated Successfuly');
            return redirect()->route('hospitals.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Hospital::find($id);
        Storage::disk('public')->delete("hospitals/$item->cover");
        $deleted = $item->delete();
        if($deleted){
            session()->flash('message', 'Hospital Deleted Successfuly');
            return redirect()->route('hospitals.index');
        }
        else
        {
            return 'errore';
        }
    }
}
