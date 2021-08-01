<?php

namespace App\Console\Commands;

use App\Articles;
use App\Category;
use App\SubCategory;
use Illuminate\Console\Command;

class CreateArticleDataForTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-fake-article-data {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fake data for article';

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
        $amount = $this->argument('amount') ?? 1;

        $subCategory = Category::select('id')->get();

        if (count($subCategory) < 50) {
            for ($i =0; $i < 50; $i++) {
                Factory(SubCategory::class)->create();
            }
        }

        $bar = $this->output->createProgressBar($amount);

        $bar->start();

        for ($i = 0; $i < $amount; $i++) {
            $subCategory = SubCategory::inRandomOrder()->first();

            Factory(Articles::class)->create([
                'subcategory_id' => $subCategory->id
            ]);

            $bar->advance();
        }

        $bar->finish();
    }
}
