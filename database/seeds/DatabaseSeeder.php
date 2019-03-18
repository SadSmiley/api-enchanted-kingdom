<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$user = [
            'name' => 'Admin',
            'email' => 'admin@sample.com',
            'password' => Hash::make('water123')
        ];

        User::create($user);

        DB::table("oauth_clients")->insert([
            'name' => 'Laravel Personal Access Client',
            'secret' => 'PBKraq8HyH3ACWaqhPgsVn6rXQksp7lh1NDw3nI0',
            'redirect' => 'http://localhost',
            'personal_access_client' => '1',
            'password_client' => '0',
            'revoked' => '0',
        ]);

        DB::table("oauth_clients")->insert([
            'name' => 'Laravel Password Grant Client',
            'secret' => 'TQrLloDLYWgwIcsP5teR5EEO56uXBVAPw7rrKt6K',
            'redirect' => 'http://localhost',
            'personal_access_client' => '0',
            'password_client' => '1',
            'revoked' => '0',
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
