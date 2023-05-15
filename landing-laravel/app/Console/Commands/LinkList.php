<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;

class LinkList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:link-list';

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
        $headers = [ 'id', 'url', 'description' ];
        $links = Link::all(['id', 'url', 'description'])->toArray();
        $this->table($headers, $links);

        return 0;
    }
}
