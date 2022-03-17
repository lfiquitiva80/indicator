<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Ssl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SslController
 */
class SslControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $ssls = Ssl::factory()->count(3)->create();

        $response = $this->get(route('ssl.index'));

        $response->assertOk();
        $response->assertViewIs('ssl.index');
        $response->assertViewHas('ssls');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('ssl.create'));

        $response->assertOk();
        $response->assertViewIs('ssl.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SslController::class,
            'store',
            \App\Http\Requests\SslStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('ssl.store'));

        $response->assertRedirect(route('ssl.index'));
        $response->assertSessionHas('ssl.id', $ssl->id);

        $this->assertDatabaseHas(ssls, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $ssl = Ssl::factory()->create();

        $response = $this->get(route('ssl.show', $ssl));

        $response->assertOk();
        $response->assertViewIs('ssl.show');
        $response->assertViewHas('ssl');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $ssl = Ssl::factory()->create();

        $response = $this->get(route('ssl.edit', $ssl));

        $response->assertOk();
        $response->assertViewIs('ssl.edit');
        $response->assertViewHas('ssl');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SslController::class,
            'update',
            \App\Http\Requests\SslUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $ssl = Ssl::factory()->create();

        $response = $this->put(route('ssl.update', $ssl));

        $ssl->refresh();

        $response->assertRedirect(route('ssl.index'));
        $response->assertSessionHas('ssl.id', $ssl->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $ssl = Ssl::factory()->create();

        $response = $this->delete(route('ssl.destroy', $ssl));

        $response->assertRedirect(route('ssl.index'));

        $this->assertDeleted($ssl);
    }
}
