<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FiveamCode\LaravelNotionApi\Notion;
use App\Models\Document;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class FetchNotionPage extends Command
{
    protected $signature = 'fetch:notion-page';
    protected $description = 'Fetches public Notion page data and stores it in the documents table';

    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://notion-api.splitbee.io/v1/page/',
        ]);

        $pageIds = ['94f766a01c1b410d9b1eaffa23628779', 'bae4a7b9844c4398a7e25cccd6854d57', '93db07de819e4308b1a9399c4c96fc45', '8d993ff5e6b04c0887c765168eae2160', '0a9b621abf3e452b99c0ff823df72c9c'];

        // DB::table('documents')->orderBy('created_at')->limit(5)->delete();

        foreach ($pageIds as $pageId) {

            $formattedPageId = substr($pageId, 0, 8) . '-' . substr($pageId, 8, 4) . '-' . substr($pageId, 12, 4) . '-' . substr($pageId, 16, 4) . '-' . substr($pageId, 20);
        
            $response = $client->request('GET', $formattedPageId);
        
            $data = json_decode($response->getBody(), true);

            $title = $data[$formattedPageId]['value']['properties']['title'][0][0];

            $author = null;
            if (isset($data[$formattedPageId]['value']['properties']['Author'])) {
                $author = $data[$formattedPageId]['value']['properties']['Author']['rich_text'][0]['plain_text'];
            }

            $language = null;
            if (isset($data[$formattedPageId]['value']['properties']['Language'])) {
                $language = $data[$formattedPageId]['value']['properties']['Language']['select']['name'];
            }

            $source = null;
            if (isset($data[$formattedPageId]['value']['properties']['Source'])) {
                $source = $data[$formattedPageId]['value']['properties']['Source']['rich_text'][0]['plain_text'];
            }

            $category = null;
            if (isset($data[$formattedPageId]['value']['properties']['Category'])) {
                $category = $data[$formattedPageId]['value']['properties']['Category']['select']['name'];
            }

            $keywords = null;
            if (isset($data[$formattedPageId]['value']['properties']['Tags'])) {
                $keywords = implode(', ', array_map(function($tag) {
                    return $tag['name'];
                }, $data[$formattedPageId]['value']['properties']['Tags']['multi_select']));
            }

            $pageId = $data[$formattedPageId]['value']['id'];
            $url = 'https://www.notion.so/' . $data[$formattedPageId]['value']['id'];
          

            $document = Document::createFromNotion($title, $author, $language, $source, $category, $keywords, $pageId, $url);
        
           
        }

    }
}
