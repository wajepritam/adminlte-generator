<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Recipes;

class RecipesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_recipes()
    {
        $recipes = factory(Recipes::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/recipes', $recipes
        );

        $this->assertApiResponse($recipes);
    }

    /**
     * @test
     */
    public function test_read_recipes()
    {
        $recipes = factory(Recipes::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/recipes/'.$recipes->id
        );

        $this->assertApiResponse($recipes->toArray());
    }

    /**
     * @test
     */
    public function test_update_recipes()
    {
        $recipes = factory(Recipes::class)->create();
        $editedRecipes = factory(Recipes::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/recipes/'.$recipes->id,
            $editedRecipes
        );

        $this->assertApiResponse($editedRecipes);
    }

    /**
     * @test
     */
    public function test_delete_recipes()
    {
        $recipes = factory(Recipes::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/recipes/'.$recipes->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/recipes/'.$recipes->id
        );

        $this->response->assertStatus(404);
    }
}
