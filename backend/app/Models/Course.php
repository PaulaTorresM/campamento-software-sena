<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable =[
       'title', 'descripcion', 'weeks', 'enroll_cost', 'minimun_skill', 'bootcamp_id'
    ];
       use HasFactory;
   }
   