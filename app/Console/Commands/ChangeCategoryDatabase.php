<?php

namespace App\Console\Commands;

use App\Category;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeCategoryDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-category-from-external-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get category from external db';

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
        $categoryFromOtherDb = DB::connection('prod_periodico')
            ->table('categoria')
            ->get();

        $bar = $this->output->createProgressBar(count($categoryFromOtherDb));
        $bar->start();

        foreach($categoryFromOtherDb as $externalCategory) {
            $category = Category::updateOrCreate(
                [
                    'id' => $externalCategory->id_categoria,
                ],
                [
                    'name' => $externalCategory->categoria_nome,
                    'deleted_at' => $externalCategory->categoria_status == 1 ? null : Carbon::now()
                ]
            );

            if ($externalCategory->categoria_status == false) {
                $category->delete();
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
