<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoanTest extends TestCase
{
    /**
     * testVisitsadf.
     *
     * @return void
     */
    public function testRedirectVisit()
    {
        //test redirect to loan
        $response = $this->get('/')
                        ->assertStatus(302)
                        ->assertRedirect(url('/loans'));
    }

    public function testDirectVisit()
    {
        //test visit index
        $response = $this->get('/loans')
                        ->assertStatus(200)
                        ->assertSee('All Loans');
    }

    public function testVisitWithValidPage()
    {
        //test visit index
        $response = $this->get('/loans?page=2')
                        ->assertStatus(200)
                        ->assertSee('All Loans');
    }

}
