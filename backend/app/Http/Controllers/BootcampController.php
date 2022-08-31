<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootcampCollection;
use App\Http\Resources\BootcampResource;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    //parametros:
    // 1: data que va enviar al cliente
    //2. codigo de estatus http
    {
        return response()->json(  new BootcampCollection(Bootcamp::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBootcampRequest $request)
    {

        return response()->json(["success" => true,
                                 "data" => new BootcampResource(Bootcamp::create($request->all()))] , 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(["succes" => true,
                                  "data" => new BootcampResource(Bootcamp::find($id))] ,200);
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
        //1. localizar el bootcamp con el id
        $b = Bootcamp::find($id);
        //2. actualizarlo con update
        $b -> update($request->all());
        return response()->json(["succes" => true,
        "data" => new BootcampResource($b) ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $b = Bootcamp::find($id);
        //2. borrarlo con delete
        $b -> delete($id);
        return response()->json(["succes" => true,
        "data" => new BootcampResource ($b) ] ,200);
    }
}
