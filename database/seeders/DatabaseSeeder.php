<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(14)->create();
        $users = [
            ['name' => 'Тарас Дмитриевич Дроздов', 'email' => 'taras.drozdov@example.com'],
            ['name' => 'Виктория Дмитриевна Воронцова', 'email' => 'viktorija.vorontsova@example.com'],
            ['name' => 'Шестаков Бронислав Евгеньевич', 'email' => 'bronislav.shestakov@example.com'],
            ['name' => 'Виль Алексеевич Филатов', 'email' => 'vil.filatov@example.com'],
            ['name' => 'Кудрявцева Алина Романовна', 'email' => 'alina.kudrjavceva@example.com'],
            ['name' => 'Одинцов Артём Евгеньевич', 'email' => 'artem.odintsov@example.com'],
            ['name' => 'Андреев Вениамин Александрович', 'email' => 'veniamin.andreev@example.com'],
            ['name' => 'Носов Марат Алексеевич', 'email' => 'marat.nosov@example.com'],
            ['name' => 'Лариса Андреевна Дорофеева', 'email' => 'larisa.dorofeeva@example.com'],
            ['name' => 'Смирнов Тарас Фёдорович', 'email' => 'taras.smirnov@example.com'],
            ['name' => 'Карпова Лилия Романовна', 'email' => 'lilija.karpova@example.com'],
            ['name' => 'Степан Борисович Фадеев', 'email' => 'stepan.fadeev@example.com'],
            ['name' => 'Георгий Фёдорович Фокин', 'email' => 'georgij.fokin@example.com'],
            ['name' => 'Олеся Романовна Щукина', 'email' => 'olesja.shhukina@example.com']
        ];

        $statuses = [
            ['name' => 'новая'],
            ['name' => 'завершена'],
            ['name' => 'выполняется'],
            ['name' => 'в архиве']
        ];

        $labels = [
            ['name' => 'ошибка', 'description' => 'Какая-то ошибка в коде или проблема с функциональностью'],
            ['name' => 'документация', 'description' => 'Задача которая касается документации'],
            ['name' => 'дубликат', 'description' => 'Повтор другой задачи'],
            ['name' => 'доработка', 'description' => 'Новая фича, которую нужно запилить']
        ];

        $tasks = [
            [
                'name' => 'Исправить ошибку в какой-нибудь строке',
                'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
                'status_id' => 'в архиве',
                'labels' => ['документация']
            ],
            [
                'name' => 'Допилить дизайн главной страницы',
                'description' => 'Вёрстка поехала в далёкие края. Нужно удалить бутстрап!',
                'status_id' => 'в архиве',
                'labels' => ['доработка', 'ошибка', 'документация', 'дубликат']
            ],
            [
                'name' => 'Отрефакторить авторизацию',
                'description' => 'Выпилить всё легаси, которое найдёшь',
                'status_id' => 'выполняется',
                'labels' => ['дубликат', 'ошибка']
            ],
            [
                'name' => 'Доработать команду подготовки БД',
                'description' => 'За одно добавить тестовых данных',
                'status_id' => 'завершена',
                'labels' => ['дубликат', 'доработка', 'ошибка']
            ],
            [
                'name' => 'Пофиксить вон ту кнопку',
                'description' => 'Кажется она не того цвета',
                'status_id' => 'завершена',
                'labels' => ['ошибка']
            ],
            [
                'name' => 'Исправить поиск',
                'description' => 'Не ищет то, что мне хочется',
                'status_id' => 'выполняется',
                'labels' => ['дубликат', 'ошибка', 'доработка']
            ],
            [
                'name' => 'Добавить интеграцию с облаками',
                'description' => 'Они такие мягкие и пушистые',
                'status_id' => 'завершена',
                'labels' => ['доработка', 'ошибка', 'дубликат']
            ],
            [
                'name' => 'Выпилить лишние зависимости',
                'description' => '',
                'status_id' => 'новая',
                'labels' => ['документация']
            ],
            [
                'name' => 'Запилить сертификаты',
                'description' => 'Кому-то же они нужны?',
                'status_id' => 'завершена',
                'labels' => ['ошибка', 'документация']
            ],
            [
                'name' => 'Выпилить игру престолов',
                'description' => 'Этот сериал никому не нравится! :)',
                'status_id' => 'в архиве',
                'labels' => ['доработка', 'документация', 'ошибка']
            ],
            [
                'name' => 'Пофиксить спеку во всех репозиториях',
                'description' => 'Передать Олегу, чтобы больше не ронял прод',
                'status_id' => 'в архиве',
                'labels' => ['дубликат', 'ошибка', 'доработка']
            ],
            [
                'name' => 'Вернуть крошки',
                'description' => 'Андрей, это задача для тебя',
                'status_id' => 'новая',
                'labels' => ['ошибка', 'дубликат']
            ],
            [
                'name' => 'Установить Linux',
                'description' => 'Не забыть потестировать',
                'status_id' => 'в архиве',
                'labels' => ['дубликат', 'доработка']
            ],
            [
                'name' => 'Потребовать прибавки к зарплате',
                'description' => 'Кризис это не время, чтобы молчать!',
                'status_id' => 'завершена',
                'labels' => ['ошибка']
            ],
            [
                'name' => 'Добавить поиск по фото',
                'description' => 'Только не по моему',
                'status_id' => 'завершена',
                'labels' => ['дубликат', 'документация']
            ],
            [
                'name' => 'Съесть еще этих прекрасных французских булочек',
                'description' => '',
                'status_id' => 'завершена',
                'labels' => ['ошибка', 'доработка', 'дубликат']
            ],
        ];

        foreach ($statuses as $status) {
            TaskStatus::firstOrCreate($status);
        }

        foreach ($labels as $label) {
            Label::firstOrCreate($label);
        }

        foreach ($users as $user) {
            User::factory()->create([
                'name' => $user['name'],
                'email' => $user['email'],
            ]);
        }

        foreach ($tasks as $task_value) {
            $creator_id = rand(1, 14);
            $creator = User::find($creator_id);
            $min = $creator->id > 7 ? 1 : 8;
            $max = $creator->id > 7  ? 7 : 14;
            $assigner = User::find(rand($min, $max));
            $status = TaskStatus::where('name', $task_value['status_id'])->first();
            $labels = [];
            foreach ($task_value['labels'] as $label_value) {
                $labels[] = Label::where('name', $label_value)->first();
            }
            $task = Task::firstOrCreate([
                'name' => $task_value['name'],
                'description' => $task_value['description'],
                'status_id' => $status ? $status->id : 1,
                'created_by_id' => $creator->id,
                'assigned_to_id' => $assigner->id
            ]);
            foreach ($labels as $label) {
                $task->labels()->sync($label);
            }
        }
    }
}
