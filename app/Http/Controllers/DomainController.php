<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::paginate(5);
        return view('index', compact('domains'));
    }

    public function show($id)
    {
        $domain = Domain::findOrFail($id);

        return view('show', compact('domain'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return view('home', compact('errors'));
        }

        $name = $request->input('domain');
        $domain = Domain::create(['name' => $name]);

        return redirect()->route('domains.show', ['id' => $domain->id]);
    }
}
