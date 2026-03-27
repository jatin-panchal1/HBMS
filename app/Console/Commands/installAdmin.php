<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class installAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Admin User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new \App\Models\User([
            'name' => "BMS admin",
            'email' => "bms@yopmail.com",
            'phone_no' => "6546546552" ,
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'user_type' => 1
        ]);
        if($user->save()){
            $this->info('Admin user created successfully');
        }else{
            $this->error('Failed to create admin user');
        }
    }
}
