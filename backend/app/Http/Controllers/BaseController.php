<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //response exitosas
public function sendResponse($data, $http_status = 200){
    //1. construir la respuesta
    $respuesta=[
        "success" => true,
        "data" => $data,
        
    ];
    //2. envia response afirmativa
     return response()->json($respuesta, $http_status);
}


    //response fallidas

public function sendErrors($errors, $http_status = 404 ){
  //1. construir la respuesta de error
$respuesta =[
    "success" => false,
    "errors" => $errors
];

//2. envia response de error
 return response()->json($respuesta , $http_status);
}
}
