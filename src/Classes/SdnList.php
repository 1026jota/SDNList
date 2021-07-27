<?php
namespace Jota\SdnList\Classes;
use Jota\SdnList\Exceptions\ConnectionException;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;
use Exception;

class SdnList{
    
    /**
     * contains the search result
     * @var array $result
     */
    private array $result;

    /**
     * contains each of the search results
     * @var array $data
     */
    private array $data;

    public function __construct()
    {
        $this->result['is_registered'] = false;
        $this->result['total_results'] = 0;
        $this->result['result'] = [];
    }

    /**
     * Search a name within the sdn list
     * @param $name name to search
     * @param $score
     * @return void
     */
    public function search(string $name, int $score = 100) : void
    {
        try {
            $client = new Client();
            $crawler = $client->request('GET', config('sdnlist.url'));
            $form = $crawler->filter('[id="ctl00_MainContent_btnSearch"]')->form();
            $form['ctl00$MainContent$txtLastName'] = $name;
            $form['ctl00$MainContent$Slider1'] = $score;
            $response = $client->submit($form);
            $this->makeData($response);

        }catch(Exception $e){
            throw new ConnectionException('Connection error, verify url: '. $this->url, $e);
        }
    }

    /**
     * This function organizes the data
     */
    private function makeData(Crawler $request) : void
    {
        $table = $request->filter('[id="gvSearchResults"]');
        $table->filter('tr')->each(function ($row) {
            $this->result['total_results'] += 1;
            $row->filter('td')->each(function ($col, $i) {
                if ($i == 0) {
                    $this->data['name'] = strtolower($col->text());
                    $this->data['link'] = config('sdnlist.url') . $col->filter('a')->attr('href');
                } elseif ($i == 1) {
                    $this->data['addres'] = strtolower($col->text());
                } elseif ($i == 2) {
                    $this->data['type'] = strtolower($col->text());
                } elseif ($i == 3) {
                    $this->data['program'] = strtolower($col->text());
                } elseif ($i == 4) {
                    $this->data['list'] = $col->text();
                } elseif ($i == 5) {
                    $this->data['score'] = $col->text();
                }
            });
        $this->result['is_registered'] = false;
            if($this->result['total_results'] > 0){
                $this->result['is_registered'] = true;
            }
            array_push($this->result['result'], $this->data);
        });
    }

    /**
     * Return the search result in array
     * @return array
     */
    public function getResult() : array
    {
        return $this->result;
    }   
}