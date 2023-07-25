<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_sitemap:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // dd(public_path('sitemap.xml'));
        SitemapGenerator::create(env('APP_URL').'/'.app()->getLocale())->writeToFile(public_path('sitemap.xml'));
        return 1;
    }
}
