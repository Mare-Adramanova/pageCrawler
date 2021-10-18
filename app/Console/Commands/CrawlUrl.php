<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\CrawlService;


class CrawlUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will crawl the given url and save the data in the database';
    
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
        $this->crawl->crawler();
        
        return Command::SUCCESS;
    }

}
