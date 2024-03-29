<?php

namespace Database\Seeders;

use App\Models\Users_info;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersInfosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Users_info $users_info
     * @return void
     */
    public function run(Users_info $users_info): void
    {
        $users_info->insert($this->getDataUserInfo());
    }

    /**
     * @return array
     */
    public function getDataUserInfo() : array
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        for($i=1; $i <= 10; $i++) {
            $data[] = [
                'user_id' => $i,
                'name' => $faker->unique()->name(),
            ];
        }

        return $data;
    }
}
