<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'no_card' => '1234567890',
                'password' => 'password',
                'balance' => 12500000,
            ]
        );

        User::updateOrCreate(
            ['email' => 'charlie.535250180@stu.untar.ac.id'],
            [
                'name' => 'Charlie',
                'no_card' => '333666999',
                'password' => 'charliepw',
                'balance' => 125003443000,
            ]
        );
                User::updateOrCreate(
            ['email' => 'laudy.535250173@stu.untar.ac.id'],
            [
                'name' => 'Laudy',
                'no_card' => '22446688',
                'password' => 'laudypw',
                'balance' => 500000,
            ]
        );
                        User::updateOrCreate(
            ['email' => 'bhariq.535250162@stu.untar.ac.id'],
            [
                'name' => 'Bhariq',
                'no_card' => '11447799',
                'password' => 'bahriqpw',
                'balance' => 3253253,
            ]
        );
                        User::updateOrCreate(
            ['email' => 'jonathan.535250174@stu.untar.ac.id'],
            [
                'name' => 'Jonathan',
                'no_card' => '99663331',
                'password' => 'jonathanpw',
                'balance' => 643030708,
            ]
        );
                        User::updateOrCreate(
            ['email' => 'bunga.535250188@stu.untar.ac.id'],
            [
                'name' => 'Bunga',
                'no_card' => '98774547',
                'password' => 'bungapw',
                'balance' => 344355,
            ]
        );
                        User::updateOrCreate(
            ['email' => 'gerard.535250191@stu.untar.ac.id'],
            [
                'name' => 'Gerard',
                'no_card' => '11449988',
                'password' => 'gerardpw',
                'balance' => 343463443,
            ]
        );
    }
}
