<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Recipes
 * @package App\Models
 * @version April 15, 2020, 4:52 am UTC
 *
 * @property string name
 * @property string description
 * @property string img
 */
class Recipes extends Model
{
    use SoftDeletes;

    public $table = 'recipes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'description',
        'img'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'img' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
