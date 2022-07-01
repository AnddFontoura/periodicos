<?php

namespace App\Console\Commands;

use App\Article;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeArticleDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-article-from-external-db';

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
        
        $articleFromOtherDb = DB::connection('prod_periodico')
            ->table('arquivo')
            ->get();

        $bar = $this->output->createProgressBar(count($articleFromOtherDb));
        $bar->start();

        foreach($articleFromOtherDb as $externalArticle) {
            $article = Article::updateOrCreate(
                [
                    'id' => $externalArticle->id_arquivo,
                ],
                [
                    'subcategory_id' => $externalArticle->categoria_sub_id,
                    'name' => $externalArticle->arquivo_nome,
                    'path' => $externalArticle->arquivo_caminho,
                    'authors' => $externalArticle->arquivo_autores,
                    'resume' => $externalArticle->arquivo_resumo,
                    'abstract' => $externalArticle->arquivo_keyword,
                    
                ]
            );

            $bar->advance();
        }

        $bar->finish();
    }
}
