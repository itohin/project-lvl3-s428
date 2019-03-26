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

    public function testStoreDomain()
    {
        $url = 'http://domain.com';
        $domain = Domain::create(['name' => $url]);

        $this->post('/domains', $domain->toArray());
        $this->seeInDatabase('domains', ['name' => $url]);
    }

    public function testShowDomain()
    {
        $url = 'http://domain.com';
        $domain = Domain::create(['name' => $url]);

        $response = $this->get("/domains/{$domain->id}");
        $response->assertResponseStatus(200);
    }
}
