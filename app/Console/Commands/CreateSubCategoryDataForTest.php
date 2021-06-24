<?php

namespace App\Console\Commands;

use App\SubCategory;
use Illuminate\Console\Command;

class CreateSubCategoryDataForTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-fake-subcategory-data {amount = 1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fake data for subcategory description';

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
     * @return mixed
     */
    public function handle()
    {
        $amount = $this->argument('amount');
        
        $bar = $this->output->createProgressBar($amount);

        $bar->start();

        for ($i = 0; $i < $amount; $i++) {
            Factory(SubCategory::class)->create();
            $bar->advance();
        }

        $bar->finish();
    }
}
