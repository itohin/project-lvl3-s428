<?php

namespace Tests;

use App\Models\Domain;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DomainsTest extends TestCase
{
    use DatabaseMigrations;

    public function testMainPage()
    {
        $response = $this->get('/');
        $response->assertResponseStatus(200);
    }
}
