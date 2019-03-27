<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DomainsTest extends TestCase
{
    use DatabaseMigrations;

    public function testMainPage()
    {
        $response = $this->get(route('home'));
        $response->assertResponseStatus(200);
    }

    public function testDomainsPage()
    {
        factory('App\Models\Domain', 5)->create();

        $response = $this->get(route('domains.index'));
        $response->assertResponseStatus(200);
    }

    public function testStoreDomain()
    {
        $domain = factory('App\Models\Domain')->create();

        $this->post(route('domains.store'), $domain->toArray());
        $this->seeInDatabase('domains', ['name' => $domain->name]);
    }

    public function testShowDomain()
    {
        $domain = factory('App\Models\Domain')->create();

        $response = $this->get(route('domains.show', ['id' => $domain->id]));
        $response->assertResponseStatus(200);
    }
}
