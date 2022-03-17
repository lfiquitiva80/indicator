<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Flete;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FletesController
 */
class FletesControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $fletes = Fletes::factory()->count(3)->create();

        $response = $this->get(route('flete.index'));

        $response->assertOk();
        $response->assertViewIs('flete.index');
        $response->assertViewHas('fletes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('flete.create'));

        $response->assertOk();
        $response->assertViewIs('flete.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FletesController::class,
            'store',
            \App\Http\Requests\FletesStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('flete.store'));

        $response->assertRedirect(route('flete.index'));
        $response->assertSessionHas('flete.id', $flete->id);

        $this->assertDatabaseHas(fletes, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $flete = Fletes::factory()->create();

        $response = $this->get(route('flete.show', $flete));

        $response->assertOk();
        $response->assertViewIs('flete.show');
        $response->assertViewHas('flete');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $flete = Fletes::factory()->create();

        $response = $this->get(route('flete.edit', $flete));

        $response->assertOk();
        $response->assertViewIs('flete.edit');
        $response->assertViewHas('flete');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FletesController::class,
            'update',
            \App\Http\Requests\FletesUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $flete = Fletes::factory()->create();

        $response = $this->put(route('flete.update', $flete));

        $flete->refresh();

        $response->assertRedirect(route('flete.index'));
        $response->assertSessionHas('flete.id', $flete->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $flete = Fletes::factory()->create();
        $flete = Flete::factory()->create();

        $response = $this->delete(route('flete.destroy', $flete));

        $response->assertRedirect(route('flete.index'));

        $this->assertDeleted($flete);
    }
}
