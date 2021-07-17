<?php

namespace App\Console\Commands;

use App\Category;
use App\SubCategory;
use Illuminate\Console\Command;

class CreateCategoryDataForTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-fake-category-data {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fake data for category';

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

        $category = Category::select('id')->get();

        if (count($category) < 50) {
            for ($i =0; $i < 50; $i++) {
                Factory(Category::class)->create();
            }
        }

        $bar = $this->output->createProgressBar($amount);

        $bar->start();

        for ($i = 0; $i < $amount; $i++) {
            $subCategory = SubCategory::inRandomOrder()->first();

            Factory(Category::class)->create([
                'subcategory_id' => $subCategory->id
            ]);

            $bar->advance();
        }

        $bar->finish();
    }
}
