<?php

use App\Author;
use App\User;
use Illuminate\Database\Seeder;

class WriterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Writer',
            'email' => 'writer@writer.com',
            'password' => bcrypt('password'),
        ]);

        Author::create([
            'user_id' => $user->user_id,
            'about' => 'About me ...',
            'citation' => 'Something',
        ]);

        $user->assignRole('Writer');
    }
}
