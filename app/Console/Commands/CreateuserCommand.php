<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateuserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-user {userName} {userEmail} {userPassword}';

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
        echo "
            //**************************************
            //
            // Comando para criar usuários sem precisar
            // do formulário
            //
            //***************************************
        ";

        $userName = $this->argument('userName');
        $userEmail = $this->argument('userEmail');
        $userPassword = $this->argument('userPassword');

        $user = User::where('email', $userEmail)->first();

        if (is_null($user)) {
            $user = User::create([
                'email' => $userEmail,
                'name' => $userName,
                'password' => Hash::make($userPassword),
            ]);

            echo " \n
                Usuario criado com sucesso
             ";
            exit;
        }

        echo " \n
            Usuario já existe na base de dados
         ";

    }
}
