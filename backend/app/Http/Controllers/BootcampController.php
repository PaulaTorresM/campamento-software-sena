<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootcampCollection;
use App\Http\Resources\BootcampResource;
use App\Http\Controllers\BaseController;

class BootcampController extends BaseController
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
        //return response()->json(

            try{
                return $this->sendResponse(new BootcampCollection(Bootcamp::all()));
            }catch(\Exception $e){
                return $this->sendErrors('Server Error' , 500);

            }
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBootcampRequest $request)
    {
        try {
            return $this->sendResponse(new BootcampResource(Bootcamp::create($request->all())) , 201);
        } catch (\Exception $th) {

              return $this->sendErrors('Server Error' , 500);
           
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
        try {
           //1. encontrar el bootcamp por id
        $bootcamp = Bootcamp::find($id);
        //2. en caso de que el bootcamp no exista 
        if (!$bootcamp) {
         return $this->sendErrors("bootcamp con id:$id no encontrado", 400);
        }
        return $this->sendResponse(new BootcampResource($bootcamp));
    }catch(\Exception $e){
        return $this->sendErrors('Server Error' , 500);

    }
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
        try {
            $b = Bootcamp::find($id);
            if (!$b) {
                return $this->sendErrors("bootcamp con id:$id no encontrado", 400);
               }
                  //2. actualizarlo con update
        $b -> update($request->all());
        return $this->sendResponse(new BootcampResource($b));
        } catch (\Exception $e) {
            return $this->sendErrors('Server Error' , 500);
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
        try {
            $b = Bootcamp::find($id);
        if (!$b) {
            return $this->sendErrors("bootcamp con id:$id no encontrado", 400);
           }
        $b -> delete();
        return $this->sendResponse(new BootcampResource($b));
        } catch (\Exception $e){
            return $this->sendErrors('Server Error' , 500);
        }
 
}
}