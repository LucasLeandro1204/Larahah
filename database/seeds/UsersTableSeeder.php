<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lucas = new User([
            'name' => 'Lucas',
            'username' => 'lucasleandro1204',
            'email' => 'lucas@lucas.com',
            'password' => '123',
        ]);
        $lucas->save();

        $eryc = new User([
            'name' => 'Eryc',
            'username' => 'eryc',
            'email' => 'eryc@eryc.com',
            'password' => '123',
        ]);
        $eryc->save();
    }
}
