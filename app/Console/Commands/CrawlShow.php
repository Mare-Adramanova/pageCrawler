<?php

namespace App\Console\Commands;


use App\Services\CrawlService;
use Illuminate\Console\Command;

class CrawlShow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:show';

    /**
     * The console command description.
     *
     * @var string
     */                                        
    protected $description = 'This command shows SEO results from crawl url and links that are related to it';
    
    /**
     * The console command description.
     *
     * @var object
     */
    protected $crawl; 

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CrawlService $crawl)
    {
        $this->crawl = $crawl;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('This are SEO results from the crawl URL');
        $this->newLine();
    
        $crawl = $this->crawl->showCrawl(env('CRAWL_URL'));
        $id = $crawl->id;
        $this->info('id : '. $id );
        $this->newLine();
        $url = $crawl->url;
        $this->info('Page URL : '. $url );
        $this->newLine();
        $title = $crawl->title;
        $this->info('Page title : '. $title );
        $this->newLine();
        $description = $crawl->description;
        $this->info('Page description : '. $description );
        $this->newLine();
        $keywords = $crawl->keywords;
        $this->info('Page Keywords : '. $keywords );
        $this->newLine();
        $number_of_links = $crawl->number_of_links;
        $this->info('Number of links the page has: '. $number_of_links );
        $this->newLine();
        $created_at = $crawl->created_at;
        $this->info('Date when this crawl was made: '. $created_at );

        $this->newLine();
        $this->info('This are links related to this page');
        $this->newLine();
        $headers = ['id', 'crawl_id', 'url'];

        $links = $this->crawl->showCrawlPageUrl(env('CRAWL_URL'));
        $url = $links->url; 
        $id = $links->id;
        $crawl_id = $links->crawl_id;
        $explodUrl = explode(',', $url);
        $table_rows = [];
        foreach($explodUrl as $url){
            $table_rows[] = [$id, $crawl_id, $url];
        }
        $this->table($headers, $table_rows);
        return 0;
    }
}
