<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batchtest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $node = Category::create([
            'name' => '',
            'children' => [
                [
                    'name' => 'コミック',

                    'children' => [
                        ['name' => '少年コミック'],
                        ['name' => '少女コミック'],
                    ],
                ],
                [
                    'name' => 'ビジネス',

                    'children' => [
                        ['name' => '経済'],
                        ['name' => 'マナー'],
                    ],
                ],
            ],
        ]);
    }
}
