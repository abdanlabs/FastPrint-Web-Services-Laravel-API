<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        // return response
        $response = [
            'success' => true,
            'message' => 'Service retrieved successfully.',
            'services' => $services,
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            // return response
            $response = [
                'success' => false,
                'message' => 'Validation error.', $validator->errors(),
            ];
            return response()->json($response, 404);
        }

        $service = Service::create($input);

        // return response
        $response = [
            'success' => true,
            'message' => 'Service created successfully.', 
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);

        if (is_null($service)) {
            // return response
            $response = [
                'success' => false,
                'message' => 'Ebook not found.',
            ];
            return response()->json($response, 404);
        }

        // return response
        $response = [
            'success' => true,
            'message' => 'Book retrieved successfully.',
        ];
        return rensponse()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            // return response
            $response = [
                'success' => false,
                'message' => 'Validator error.', $validator->errors(),
            ];
            return response()->json($response, 404);
        }

        $service->name = $input['name'];
        $service->description = $input['description'];
        $service->save();

        // return response
        $response = [
            'success' => true,
            'message' => 'Service update successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        // return response
        $response = [
            'success' => true,
            'message' => 'Service delete succcessfully.',
        ];
        return response()->json($response, 200);
    }
}
