<?php

namespace App\Jobs;

use App\States\Request;
use DiDom\Document;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\App;

class ParsePageJob extends Job
{
    protected $domain;


    public function __construct($domain)
    {
        $this->domain = $domain;
    }


    public function handle()
    {
        $request = new Request();

        $data = $this->getDomainData($this->domain->name, $request);

        switch ($request->state) {
            case Request::INIT:
                $this->domain->update($data);
                $request->complete();
                break;
            case Request::FAILED:
                $this->domain->update($data);
                info($data['code']);
                break;
        }
    }


    public function getDomainData($domain, $request)
    {
        try {
            $client = App::make('GuzzleHttp\Client');
            $response = $client->request('GET', $domain);

            $code = $response->getStatusCode();
            $type = $response->getHeader('content-type')[0];
            $body = mb_convert_encoding($response->getBody()->getContents(), 'UTF-8');

            $contentLength = ($response->getHeader('content-length')) ?
                $response->getHeader('content-length')[0] :
                $contentLength = strlen($body);

            $data = [
                'code' => $code,
                'type' => $type,
                'body' => $body,
                'length' => $contentLength
            ];

            $document = new Document($body);

            $header = $document->find('h1');
            $data['header'] = (count($header) > 0) ? $header[0]->text() : null;

            $keywords = $document->find('meta[name=keywords]');
            $data['keywords'] = (count($keywords) > 0) ? $keywords[0]->attr('content') : null;

            $description = $document->find('meta[name=description]');
            $data['description'] = (count($description) > 0) ? $description[0]->attr('content') : null;
        } catch (RequestException $e) {
            $data = [
                'code' => $e->getMessage()
            ];
            $request->fail();
        }
        return $data;
    }
}
