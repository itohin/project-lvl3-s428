<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

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

        $domain = $request->input('domain');
        $data = $this->getDomainData($domain);

        $domain = Domain::create($data);

        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function getDomainData($domain)
    {
        $response = $this->client->request('GET', $domain);

        $code = $response->getStatusCode();
        $type = $response->getHeader('content-type')[0];
        $body = $response->getBody()->getContents();

        $contentLength = ($response->getHeader('content-length')) ?
            $response->getHeader('content-length')[0] :
            $contentLength = strlen($body);

        $data = [
            'name' => $domain,
            'code' => $code,
            'type' => $type,
            'body' => $body,
            'length' => $contentLength
        ];

        return $data;
    }
}
