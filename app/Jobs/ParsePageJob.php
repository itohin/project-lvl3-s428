<?php

namespace App\Jobs;

use DiDom\Document;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\App;
use SM\StateMachine\StateMachine;

class ParsePageJob extends Job
{
    protected $domain;


    public function __construct($domain)
    {
        $this->domain = $domain;
    }


    public function handle()
    {
        $data = $this->getDomainData($this->domain->name);

        switch ($this->domain->getState()) {
            case 'completed':
                $this->domain->update($data);
                break;
            case 'failed':
                info($data['code']);
                break;
            case 'init':
                info('Something went wrong');
                break;
        }
    }


    public function getDomainData($domain)
    {
        try {
            $client = App::make('GuzzleHttp\Client');
            $response = $client->request('GET', $domain);

            $code = $response->getStatusCode();
            $type = $response->getHeader('content-type')[0];
            $body = $response->getBody()->getContents();

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
            $this->domain->setState('completed');
        } catch (RequestException $e) {
            $data = [
                'code' => $e->getMessage()
            ];
            $this->domain->setState('failed');
        }
        return $data;
    }
}
