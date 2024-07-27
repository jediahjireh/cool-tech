<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create the database if it doesn't exist
        DB::statement('CREATE DATABASE IF NOT EXISTS cool_tech');

        // switch to (use) the newly created database by updating the database configuration
        config(['database.connections.mysql.database' => 'cool_tech']);
        // reconnect to the database with the new configuration
        DB::reconnect();

        // get the path to the SQL script file
        $path = database_path('sql/cool_tech.sql');
        // read the SQL script file content
        $sql = File::get($path);
        // execute (run) the SQL script
        DB::unprepared($sql);
    }
    /*
    run the migration:
    php artisan migrate

    Select 'Yes' when asked if you would like to create the database 'cool_tech'

    run the seeder:
    php artisan db:seed --class=DatabaseSeeder
    */
}
