<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PayrollController
 */
class PayrollControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $payrolls = Payroll::factory()->count(3)->create();

        $response = $this->get(route('payroll.index'));

        $response->assertOk();
        $response->assertViewIs('payroll.index');
        $response->assertViewHas('payrolls');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('payroll.create'));

        $response->assertOk();
        $response->assertViewIs('payroll.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PayrollController::class,
            'store',
            \App\Http\Requests\PayrollStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('payroll.store'));

        $response->assertRedirect(route('payroll.index'));
        $response->assertSessionHas('payroll.id', $payroll->id);

        $this->assertDatabaseHas(payrolls, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $payroll = Payroll::factory()->create();

        $response = $this->get(route('payroll.show', $payroll));

        $response->assertOk();
        $response->assertViewIs('payroll.show');
        $response->assertViewHas('payroll');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $payroll = Payroll::factory()->create();

        $response = $this->get(route('payroll.edit', $payroll));

        $response->assertOk();
        $response->assertViewIs('payroll.edit');
        $response->assertViewHas('payroll');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PayrollController::class,
            'update',
            \App\Http\Requests\PayrollUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $payroll = Payroll::factory()->create();

        $response = $this->put(route('payroll.update', $payroll));

        $payroll->refresh();

        $response->assertRedirect(route('payroll.index'));
        $response->assertSessionHas('payroll.id', $payroll->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $payroll = Payroll::factory()->create();

        $response = $this->delete(route('payroll.destroy', $payroll));

        $response->assertRedirect(route('payroll.index'));

        $this->assertDeleted($payroll);
    }
}
