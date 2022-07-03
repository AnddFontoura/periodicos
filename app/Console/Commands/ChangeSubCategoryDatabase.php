<?php

namespace App\Console\Commands;

use App\SubCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeSubCategoryDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-sub-category-from-external-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get sub category from external db';

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
        $subCategoryFromOtherDb = DB::connection('prod_periodico')
            ->table('categoria_sub')
            ->get();

        $bar = $this->output->createProgressBar(count($subCategoryFromOtherDb));
        $bar->start();

        foreach($subCategoryFromOtherDb as $externalSubCategory) {
            $subCategory = SubCategory::updateOrCreate(
                [
                    'id' => $externalSubCategory->id_categoria_sub,
                ],
                [
                    'name' => $externalSubCategory->categoria_sub_nome,
                    'category_id' => $externalSubCategory->categoria_id
                ]
            );
            
            if ($externalSubCategory->categoria_sub_status == false) {
                $subCategory->delete();
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
