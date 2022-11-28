<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('tasks')->count() === 0) {

            DB::table('tasks')->insert([
                [
                    'name' => 'Исправить ошибку в какой-нибудь строке',
                    'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
                    'status_id' => 1,
                    'created_by_id' => 1,
                    'assigned_to_id' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Допилить дизайн главной страницы',
                    'description' => 'Вёрстка поехала в далёкие края. Нужно удалить бутстрап!',
                    'status_id' => 2,
                    'created_by_id' => 2,
                    'assigned_to_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Отрефакторить авторизацию',
                    'description' => 'Выпилить всё легаси, которое найдёшь',
                    'status_id' => 3,
                    'created_by_id' => 2,
                    'assigned_to_id' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]);
        }
    }
}
