<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class Freearticles
 * @package App\Models
 * @version December 19, 2021, 8:55 pm UTC
 *
 * @property string $title
 * @property string $description
 */
class Freearticles extends Model
{


    public $table = 'freearticless';
    
    public $timestamps = false;




    public $fillable = [
        'title',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string'
    ];

    
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
