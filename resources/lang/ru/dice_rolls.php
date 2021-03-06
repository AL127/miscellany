<?php

return [
    'create'        => [
        'description'   => 'Создание Нового Броска Кубика',
        'success'       => 'Бросок Кубика ":name" создан.',
        'title'         => 'Новый Бросок Кубика',
    ],
    'destroy'       => [
        'dice_roll' => 'Бросок Кубика удален.',
        'success'   => 'Бросок Кубика ":name" удален.',
    ],
    'edit'          => [
        'description'   => 'Редактирование Броска Кубика.',
        'success'       => 'Бросок Кубика ":name" обновлен.',
        'title'         => 'Редактирование Броска Кубика :name',
    ],
    'fields'        => [
        'created_at'    => 'Брошен в',
        'name'          => 'Название',
        'parameters'    => 'Параметры',
        'results'       => 'Результаты',
        'rolls'         => 'Броски',
    ],
    'hints'         => [
        'parameters'    => 'Какие функции у моего кубика?',
    ],
    'index'         => [
        'actions'       => [
            'dice'      => 'Броски Кубиков',
            'results'   => 'Результаты',
        ],
        'add'           => 'Новый Бросок Кубика',
        'description'   => 'Управление Бросками Кубиков :name.',
        'header'        => 'Броски Кубиков :name',
        'title'         => 'Броски Кубиков',
    ],
    'placeholders'  => [
        'dice_roll' => 'Бросок Кубика',
        'name'      => 'Название Броска Кубика',
        'parameters'=> '4d6+3',
    ],
    'results'       => [
        'actions'   => [
            'add'   => 'Бросить',
        ],
        'error'     => 'Бросок Кубика не произошел. Недействительные параметры.',
        'fields'    => [
            'creator'   => 'Создатель',
            'date'      => 'Дата',
            'result'    => 'Результат',
        ],
        'hint'      => 'Все броски для этого Шаблона Бросков Кубиков выполнены.',
        'success'   => 'Кубик брошен.',
    ],
    'show'          => [
        'description'   => 'Детальный вид Броска Кубика.',
        'tabs'          => [
            'results'   => 'Результаты',
        ],
        'title'         => 'Бросок Кубика :name',
    ],
];
