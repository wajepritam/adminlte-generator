<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRecipesAPIRequest;
use App\Http\Requests\API\UpdateRecipesAPIRequest;
use App\Models\Recipes;
use App\Repositories\RecipesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RecipesController
 * @package App\Http\Controllers\API
 */

class RecipesAPIController extends AppBaseController
{
    /** @var  RecipesRepository */
    private $recipesRepository;

    public function __construct(RecipesRepository $recipesRepo)
    {
        $this->recipesRepository = $recipesRepo;
    }

    /**
     * Display a listing of the Recipes.
     * GET|HEAD /recipes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $recipes = $this->recipesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($recipes->toArray(), 'Recipes retrieved successfully');
    }

    /**
     * Store a newly created Recipes in storage.
     * POST /recipes
     *
     * @param CreateRecipesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRecipesAPIRequest $request)
    {
        $input = $request->all();

        $recipes = $this->recipesRepository->create($input);

        return $this->sendResponse($recipes->toArray(), 'Recipes saved successfully');
    }

    /**
     * Display the specified Recipes.
     * GET|HEAD /recipes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Recipes $recipes */
        $recipes = $this->recipesRepository->find($id);

        if (empty($recipes)) {
            return $this->sendError('Recipes not found');
        }

        return $this->sendResponse($recipes->toArray(), 'Recipes retrieved successfully');
    }

    /**
     * Update the specified Recipes in storage.
     * PUT/PATCH /recipes/{id}
     *
     * @param int $id
     * @param UpdateRecipesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecipesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Recipes $recipes */
        $recipes = $this->recipesRepository->find($id);

        if (empty($recipes)) {
            return $this->sendError('Recipes not found');
        }

        $recipes = $this->recipesRepository->update($input, $id);

        return $this->sendResponse($recipes->toArray(), 'Recipes updated successfully');
    }

    /**
     * Remove the specified Recipes from storage.
     * DELETE /recipes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Recipes $recipes */
        $recipes = $this->recipesRepository->find($id);

        if (empty($recipes)) {
            return $this->sendError('Recipes not found');
        }

        $recipes->delete();

        return $this->sendSuccess('Recipes deleted successfully');
    }
}
