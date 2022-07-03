<?php

namespace App\Console\Commands;

use App\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangePageDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-page-from-external-db';

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
     * @return mixed
     */
    public function handle()
    {
        $pageFromOtherDb = DB::connection('prod_periodico')
            ->table('pagina')
            ->get();

        $bar = $this->output->createProgressBar(count($pageFromOtherDb));
        $bar->start();

        foreach($pageFromOtherDb as $externalCategory) {
            $page = Page::updateOrCreate(
                [
                    'id' => $externalCategory->id_pagina,
                ],
                [
                    'name' => $externalCategory->pagina_nome,
                    'description' => $externalCategory->pagina_conteudo
                ]
            );
            
            if ($externalCategory->pagina_status == false) {
                $page->delete();
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
