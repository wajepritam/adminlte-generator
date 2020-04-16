<?php

namespace App\Repositories;

use App\Models\Recipes;
use App\Repositories\BaseRepository;

/**
 * Class RecipesRepository
 * @package App\Repositories
 * @version April 15, 2020, 4:52 am UTC
*/

class RecipesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'img'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Recipes::class;
    }
}
