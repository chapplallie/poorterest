<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Category extends BaseModel
{
   use HasFactory;

   protected $table = 'categories';

   /**
    * The attributes that are mass assignable.
    *
    * @var list<string>
    */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */ 
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];   
}
