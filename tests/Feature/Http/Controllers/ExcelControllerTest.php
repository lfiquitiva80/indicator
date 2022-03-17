<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Excel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ExcelController
 */
class ExcelControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $excels = Excel::factory()->count(3)->create();

        $response = $this->get(route('excel.index'));

        $response->assertOk();
        $response->assertViewIs('excel.index');
        $response->assertViewHas('excels');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('excel.create'));

        $response->assertOk();
        $response->assertViewIs('excel.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ExcelController::class,
            'store',
            \App\Http\Requests\ExcelStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('excel.store'));

        $response->assertRedirect(route('excel.index'));
        $response->assertSessionHas('excel.id', $excel->id);

        $this->assertDatabaseHas(excels, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $excel = Excel::factory()->create();

        $response = $this->get(route('excel.show', $excel));

        $response->assertOk();
        $response->assertViewIs('excel.show');
        $response->assertViewHas('excel');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $excel = Excel::factory()->create();

        $response = $this->get(route('excel.edit', $excel));

        $response->assertOk();
        $response->assertViewIs('excel.edit');
        $response->assertViewHas('excel');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ExcelController::class,
            'update',
            \App\Http\Requests\ExcelUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $excel = Excel::factory()->create();

        $response = $this->put(route('excel.update', $excel));

        $excel->refresh();

        $response->assertRedirect(route('excel.index'));
        $response->assertSessionHas('excel.id', $excel->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $excel = Excel::factory()->create();

        $response = $this->delete(route('excel.destroy', $excel));

        $response->assertRedirect(route('excel.index'));

        $this->assertDeleted($excel);
    }
}
