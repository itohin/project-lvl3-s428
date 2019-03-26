<?php

namespace App\Http\Controllers;


class DomainController extends Controller
{
    protected $fillable = ['name'];

    public function index()
    {
        return view('home');
    }
}