<?php

use Illuminate\Database\Seeder;


class adminseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Admin::create(
            [
                'name' => 'Huỳnh Lê Hiếu Nam',
                'address' => 'KTX khu B',
                'birthday' => date_create('12-04-1997'),
                'tel' => '0707645706',
                'email' => 'huynhlehieunam@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('@123123hieunam'), // password
                'remember_token' => Str::random(10),
            ]
            );
    }
}
