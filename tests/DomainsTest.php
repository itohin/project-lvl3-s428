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

    public function testDomainsPage()
    {
        factory('App\Models\Domain', 5)->create();

        $response = $this->get('/domains');
        $response->assertResponseStatus(200);
    }

    public function testStoreDomain()
    {
        $domain = factory('App\Models\Domain')->create();

        $this->post('/domains', $domain->toArray());
        $this->seeInDatabase('domains', ['name' => $domain->name]);
    }

    public function testShowDomain()
    {
        $url = 'http://domain.com';
        $domain = Domain::create(['name' => $url]);

        $response = $this->get(route('domains.show', ['id' => $domain->id]));
        $response->assertResponseStatus(200);
    }
}
