<?php

namespace App\Services;

use Goutte\Client;
use App\Models\Crawl;
use App\Models\PageUrl;

class CrawlService {

    /**
     * The console command description.
     *
     * @var object
     */
    protected $client;

    /**
     * The console command description.
     *
     * @var object
     */
    protected $crawl;

    public function __construct(Client $client, Crawl $crawl)
    {
        $this->client = $client;
        $this->crawl = $crawl;
    }

    public function crawler(){

        $crawler = $this->client->request('GET', env('CRAWL_URL'));
        $pageLink = $crawler->getUri();
        $keyWord = $crawler->filter('title')->text();
        $title = $crawler->filter('.site-title > a')->text();
        $description = $crawler->filter('.elementor-element-381a0e70')->text();
        $links_count = $crawler->filter('a')->count(); 
        
        $crawl = $this->crawl->firstOrNew();
        $crawl->url = $pageLink;
        $crawl->title = $title;
        $crawl->keywords = $keyWord;
        $crawl->description = $description;
        $crawl->number_of_links = $links_count;
        $crawl->save();

        $all_links = [];
        if($links_count > 0){
            $links = $crawler->filter('a')->links();
            foreach ($links as $link) {
                $all_links[] = $link->getURI();
            }
        $all_links = array_unique($all_links);
        $all_links = implode(',', $all_links);
        $crawl->pageUrls()->updateOrCreate(['url'=>$all_links]);
        }else{
            echo "No links in this page";
        }

    }

    public function showCrawl($url)
    {
        return Crawl::where('url', $url)->first();
        
    }

    public function showCrawlPageUrl($url)
    {
        $id = $this->showCrawl($url)['id'];
        return PageUrl::where('crawl_id', $id)->first();
      
    }


}