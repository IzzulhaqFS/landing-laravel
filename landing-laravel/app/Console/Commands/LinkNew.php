<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Link;
use App\Models\LinkList;

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

        $description = $this->ask('Link Description');
        $list_name = $this->ask('Link List (leave blank to use default)') ?? "default";

        $this->info("New Link:");
        $this->info($url . ' - ' . $description);
        $this->info("Listed in: " . $list_name);

        if ($this->confirm('Is this information correct?')) {
            $list = LinkList::firstWhere('slug', $list_name);
            if (!$list) {
                $list = new LinkList();
                $list->title = $list_name;
                $list->slug = $list_name;
                $list->save();
            }

            $link = new Link();
            $link->url = $url;
            $link->description = $description;
            $list->links()->save($link);

            $this->info("Saved.");
        }

        return 0;
    }
}
