<?php

use Illuminate\Database\Seeder;
use App\Domain\User\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email'    => 'admin@admin.com',
            'password' => '1234'
        ]);
    }
}
