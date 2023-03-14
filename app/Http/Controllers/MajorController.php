<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Major::all();
        return view('admin.majors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.majors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'cover' => 'nullable|image|mimes:png,jpg',
            'describtin' => 'nullable|string|min:3',
            'is_active' => 'in:true,false|string'
        ]);

        if (!$validator->fails()) {
            $major = new Major();
            $major->name = $request->get('name');
            $major->is_active = $request->has('is_active');
            if ($request->has('cover')) {
                $image = $request->file('cover');
                $imgeName = time() . $major->name . '.' . $image->getClientOriginalExtension();
                $image->storePubliclyAs('majors', $imgeName, ['disk' => 'public']);
                $major->cover = $imgeName;
            }
            $major->describtin = $request->get('describtin');;
            $is_saved = $major->save();
            if ($is_saved) {
                return response()->json(
                    [
                        'message' => $is_saved ? 'Major Created Successfuly' : 'Major Created failed'
                    ],
                    $is_saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first()
                ],
                Response::HTTP_BAD_REQUEST
            );
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
        $major = Major::find($id);
        return view('admin.majors.edit', compact('major'));
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

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'cover' => 'nullable|image|mimes:png,jpg',
            'describtin' => 'nullable|string|min:3',
            'is_active' => 'in:true,false|string'
        ]);


        if (!$validator->fails()) {
            $major = Major::find($id);
            $major->name = $request->get('name');
            $major->is_active = $request->has('is_active');
            if ($request->has('cover')) {
                $image = $request->file('cover');
                $imgeName = time() . $major->name . '.' . $image->getClientOriginalExtension();
                $image->storePubliclyAs('majors', $imgeName, ['disk' => 'public']);
                $major->cover = $imgeName;
            }
            $major->describtin = $request->get('describtin');;
            $is_saved = $major->save();
            if ($is_saved) {
                return response()->json(
                    [
                        'message' => $is_saved ? 'Major Updated Successfuly' : 'Major Updated failed'
                    ],
                    $is_saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first()
                ],
                Response::HTTP_BAD_REQUEST
            );
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
        $item = Major::find($id);
        Storage::disk('public')->delete("majors/$item->cover");
        $deleted = $item->delete();

        return response()->json(
            [
                'message' => $deleted ? 'Major Deleted Successfuly' : 'Major Deleted failed'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
