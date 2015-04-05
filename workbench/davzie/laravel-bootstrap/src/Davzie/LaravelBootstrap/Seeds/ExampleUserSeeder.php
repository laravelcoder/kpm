<?php
namespace Davzie\LaravelBootstrap\Seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class ExampleUserSeeder extends Seeder {

    public $timestamps = false;

    public function run()
    {

        $types = [
            [
                'email'    => Config::get('laravel-bootstrap::setup.email'),
                'name'     => Config::get('laravel-bootstrap::setup.first-name'),
                'surname'  => Config::get('laravel-bootstrap::setup.last-name'),
                'password' => Hash::make( Config::get('laravel-bootstrap::setup.password') ),
            ]
        ];
        DB::table('users')->insert($types);
        $this->command->info('User Table Seeded');

    }

}
