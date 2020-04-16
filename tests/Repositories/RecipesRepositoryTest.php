<?php namespace Tests\Repositories;

use App\Models\Recipes;
use App\Repositories\RecipesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RecipesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RecipesRepository
     */
    protected $recipesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->recipesRepo = \App::make(RecipesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_recipes()
    {
        $recipes = factory(Recipes::class)->make()->toArray();

        $createdRecipes = $this->recipesRepo->create($recipes);

        $createdRecipes = $createdRecipes->toArray();
        $this->assertArrayHasKey('id', $createdRecipes);
        $this->assertNotNull($createdRecipes['id'], 'Created Recipes must have id specified');
        $this->assertNotNull(Recipes::find($createdRecipes['id']), 'Recipes with given id must be in DB');
        $this->assertModelData($recipes, $createdRecipes);
    }

    /**
     * @test read
     */
    public function test_read_recipes()
    {
        $recipes = factory(Recipes::class)->create();

        $dbRecipes = $this->recipesRepo->find($recipes->id);

        $dbRecipes = $dbRecipes->toArray();
        $this->assertModelData($recipes->toArray(), $dbRecipes);
    }

    /**
     * @test update
     */
    public function test_update_recipes()
    {
        $recipes = factory(Recipes::class)->create();
        $fakeRecipes = factory(Recipes::class)->make()->toArray();

        $updatedRecipes = $this->recipesRepo->update($fakeRecipes, $recipes->id);

        $this->assertModelData($fakeRecipes, $updatedRecipes->toArray());
        $dbRecipes = $this->recipesRepo->find($recipes->id);
        $this->assertModelData($fakeRecipes, $dbRecipes->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_recipes()
    {
        $recipes = factory(Recipes::class)->create();

        $resp = $this->recipesRepo->delete($recipes->id);

        $this->assertTrue($resp);
        $this->assertNull(Recipes::find($recipes->id), 'Recipes should not exist in DB');
    }
}
