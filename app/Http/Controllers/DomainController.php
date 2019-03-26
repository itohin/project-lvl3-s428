<?php

namespace App\Http\Controllers;

use App\Models\Domain;

class DomainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function show($id)
    {
        $domain = Domain::findOrFail($id);

        return view('show', compact('domain'));
    }

    public function store()
    {
        //store domain
        //redirect /domains/{id}
    }
}