<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('VilleSeeder');
        $path = 'app/doc_db/ville_dep.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Ville table seeded!');

        $this->call(ValueSeeder::class);
        $this->command->info('Les values sont inseree');

    }
}
