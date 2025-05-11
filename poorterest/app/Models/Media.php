<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Media extends BaseModel
{
    use HasFactory;

    protected $table = 'medias';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'media',
        'description',
        'title',
        'size',
        'category_id',
        'status',
        'userId',
    ];

    //bind category et medias pour optimisation des query 
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    protected $hidden = [
   
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];
}