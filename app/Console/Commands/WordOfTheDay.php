<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:permin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a testing cron for learn.';

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
            $words = [
                'aberration' => 'a state or condition markedly different from the norm',
                'convivial' => 'occupied with or fond of the pleasures of good company',
                'diaphanous' => 'so thin as to transmit light',
                'elegy' => 'a mournful poem; a lament for the dead',
                'ostensible' => 'appearing as such but not necessarily so'
            ];
             
            // Finding a random word
            $key = array_rand($words);
            $value = $words[$key];
             
            $users = User::all();
            foreach ($users as $user) {
                Mail::raw("{$key} -> {$value}", function ($mail) use ($user) {
                    $mail->from('aviiis@tutsforweb.com');
                    $mail->to($user->email)
                        ->subject('Word of the Day');
                });
            }
             
            $this->info('Word of the Day sent to All Users');
        }
}
