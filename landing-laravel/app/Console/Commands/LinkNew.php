<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Link;

class LinkNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:link-new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = $this->ask('Link URL:');

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error("Invalid URL. Exiting...");
            return 1;
        }

        $description = $this->ask('Link Description:');

        $this->info("New Link:");
        $this->info($url . ' - ' . $description);

        if ($this->confirm('Is this information correct?')) {
            $link = new Link();
            $link->url = $url;
            $link->description = $description;
            $link->save();

            $this->info("Saved.");
        }

        return 0;
    }
}
