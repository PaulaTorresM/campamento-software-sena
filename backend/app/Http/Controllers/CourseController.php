<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return response()->json(

            try{
                return $this->sendResponse(new CourseCollection(Course::all()));
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
    public function store(Request $request, $id)
    {
        $curso = new Course();
        $curso->bootcamp_id = $id;
        $curso->title = $request->title;
        $curso->descripcion = $request->descripcion;
        $curso->weeks = $request->weeks;
        $curso->enroll_cost = $request->enroll_cost;
        $curso->minimun_skill = $request->minimun_skill;
        $curso->save();
        return response()->json([ "success" => true,
                                  "data" => $curso
    ] , 200);
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
        $course = Course::find($id);
        //2. en caso de que el bootcamp no exista 
        if (!$course) {
         return $this->sendErrors("curso con id:$id no encontrado", 400);
        }
        return $this->sendResponse(new CourseResource($course));
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
            $c = Course::find($id);
            if (!$c) {
                return $this->sendErrors("curso con id:$id no encontrado", 400);
               }
                  //2. actualizarlo con update
        $c -> update($request->all());
        return $this->sendResponse(new CourseResource($c));
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
        //
    }
}
