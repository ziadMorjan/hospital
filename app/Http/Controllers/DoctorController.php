<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospitals = Hospital::all();
        return view('admin.doctors.create', compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(),[
            'name' => 'required|string|min:3',
            'email' => 'required|string|unique:doctors,email',
            'phone' => 'required|string|unique:doctors,phone',
            'cover' => 'nullable|image',
            'description' => 'nullable|string|min:3',
        ]);
        if (!$validator->fails())
        {
            $doctor = new Doctor();
            $doctor->name = $request->get('name');
            $doctor->email = $request->get('email');
            $doctor->phone = $request->get('phone');
            if ($request->has('cover'))
            {
                $image = $request->file('cover');
                $imgeName = time() . $doctor->name . '.' . $image->getClientOriginalExtension();
                $image->storePubliclyAs('doctors', $imgeName, ['disk' => 'public']);
                $doctor->cover = $imgeName;
            }
            $doctor->description = $request->get('description');
            $doctor->hospital_id = $request->get('hospital_id');

            $saved = $doctor->save();
            if ($saved)
            {
                return response()->json(
                    [
                        'message' => $saved ? 'Doctor Created Successfully' : 'Doctor Created failed'
                    ],
                    $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST

                );
            }
        }
        else
        {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first()
                ],
                Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $hospitals = Hospital::all();
        return view('admin.doctors.edit', compact(['doctor', 'hospitals']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = validator($request->all(),[
            'name' => 'required|string|min:3',
            'email' => ['required','email',Rule::unique('doctors')->ignore($doctor)],
            'phone' => ['required','string',Rule::unique('doctors')->ignore($doctor)],
            'cover' => 'nullable|image',
            'description' => 'nullable|string|min:3',
        ]);

//        unique:doctors,email'
        if (!$validator->fails())
        {
            $doctor->name = $request->get('name');
            if ($request->get('email') != $doctor->email)
            {
                $doctor->email = $request->get('email');
            }

            if ($request->get('phone') != $doctor->phone)
            {
                $doctor->phone = $request->get('phone');
            }
            if ($request->has('cover'))
            {
                $image = $request->file('cover');
                $imgeName = time() . $doctor->name . '.' . $image->getClientOriginalExtension();
                $image->storePubliclyAs('doctors', $imgeName, ['disk' => 'public']);
                $doctor->cover = $imgeName;
            }
            $doctor->description = $request->get('description');
            $doctor->hospital_id = $request->get('hospital_id');

            $saved = $doctor->save();
            if ($saved)
            {
                return response()->json(
                    [
                        'message' => $saved ? 'Doctor Updated Successfully' : 'Doctor Updated failed'
                    ],
                    $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST

                );
            }
        }
        else
        {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first()
                ],
                Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        Storage::disk('public')->delete("doctors/$doctor->cover");
        $deleted = $doctor->delete();

        return response()->json(
            [
                'message' => $deleted ? 'Doctor Deleted Successfully' : 'Doctor Deleted failed'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
