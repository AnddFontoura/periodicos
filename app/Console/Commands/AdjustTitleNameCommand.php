<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;

class AdjustTitleNameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:adjust-title-name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adjust name errors for special characters';

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
        $articles = Article::withTrashed()->get();

        $bar = $this->output->createProgressBar(count($articles));
        $bar->start();

        foreach ($articles as $article) {
            $article->name = $this->sanitizeName($article->name);
            $article->save();
            
            $bar->advance();
        }

        $bar->finish();
    }

    public function sanitizeName(string $name) :string
    {
        $name = str_replace('&Atilde;', 'Ã', $name);
        $name = str_replace('&Otilde;', 'Õ', $name);
        $name = str_replace('&Aacute;', 'Á', $name);
        $name = str_replace('&Eacute;', 'É', $name);
        $name = str_replace('&Iacute;', 'Í', $name);
        $name = str_replace('&Oacute;', 'Ó', $name);
        $name = str_replace('&Uacute;', 'Ú', $name);
        $name = str_replace('&Agrave;', 'À', $name);
        $name = str_replace('&Egrave;', 'È', $name);
        $name = str_replace('&Igrave;', 'Ì', $name);
        $name = str_replace('&Ograve;', 'Ò', $name);
        $name = str_replace('&Ugrave;', 'Ù', $name);
        $name = str_replace('&Acirc;', 'Â', $name);
        $name = str_replace('&Ecirc;', 'Ê', $name);
        $name = str_replace('&Icirc;', 'Î', $name);
        $name = str_replace('&Ocirc;', 'Ô', $name);
        $name = str_replace('&Ucirc;', 'Û', $name);
        $name = str_replace('&Ccedil;', 'Ç', $name);

        return $name;
    }
}
