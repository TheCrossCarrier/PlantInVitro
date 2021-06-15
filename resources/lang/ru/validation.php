<?php

return [
    // 'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'В поле :attribute введён не валидный URL.',
    // 'after' => 'The :attribute must be a date after :date.',
    // 'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'Поле :attribute должно содержать только буквы.',
    'alpha_dash' => 'Поле :attribute должно содержать только буквы, цифры, "-" и "_".',
    'alpha_num' => 'Поле :attribute должно содержать только буквы и цифры.',
    'array' => 'Поле :attribute должно содержать массив.',
    // 'before' => 'The :attribute must be a date before :date.',
    // 'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'Значение поля :attribute должно быть между :min и :max.',
        'file' => 'Файл поля :attribute должен весить от :min до :max килобайт.',
        'string' => 'Поле :attribute должно содержать от :min до :max символов.',
        'array' => 'Поле :attribute должно содержать от :min до :max элементов.',
    ],
    // 'boolean' => 'The :attribute field must be true or false.',
    // 'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'Поле :attribute не является правильной датой.',
    // 'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'Поле :attribute не совпадает с форматом :format.',
    'different' => 'Поля :attribute и :other не должны совпадать.',
    'digits' => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between' => 'Поле :attribute должно содержать от :min до :max цифр.',
    // 'dimensions' => 'The :attribute has invalid image dimensions.',
    // 'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Поле :attribute содержит неверный e-mail адрес.',
    // 'ends_with' => 'The :attribute must end with one of the following: :values.',
    // 'exists' => 'The selected :attribute is invalid.',
    'file' => 'В поле :attribute должен быть файл.',
    'filled' => 'Поле :attribute должно быть заполнено.',
    'gt' => [
        'numeric' => 'Значение поля :attribute должно быть больше :value.',
        'file' => 'Файл поля :attribute должен весить больше :value килобайт.',
        'string' => 'Поле :attribute должно содержать больше :value символов.',
        'array' => 'Поле :attribute должно содержать больше :value элементов.',
    ],
    'gte' => [
        'numeric' => 'Значение поля :attribute должно быть больше либо равно :value.',
        'file' => 'Файл поля :attribute должен весить от :value килобайт.',
        'string' => 'Поле :attribute должно содержать от :value символов.',
        'array' => 'Поле :attribute должно содержать от :value элементов.',
    ],
    'image' => 'Файл поля :attribute должен быть изображением.',
    'in' => 'Неверное значение поля :attribute.',
    // 'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'Значение поля :attribute должно быть целым числом.',
    'ip' => 'В поле :attribute должен быть правильный IP адрес.',
    'ipv4' => 'В поле :attribute должен быть правильный IPv4 адрес.',
    'ipv6' => 'В поле :attribute должен быть правильный IPv6 адрес.',
    'json' => 'В поле :attribute должна быть валидная JSON строка.',
    'lt' => [
        'numeric' => 'Значение поля :attribute должно быть меньше :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'Поле :attribute должно содержать меньше :value символов.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'Значение поля :attribute должно быть меньше либо равно :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'Поле :attribute должно содержать :value или меньше символов.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'Поле :attribute должно быть не больше :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'Поле :attribute может содержать максимум :max символов.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'Значение поля :attribute должно быть не меньше :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'Поле :attribute должно содержать минимум :min символов.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    // 'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'Неверное значение поля :attribute.',
    // 'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Значение поля :attribute должно быть числом.',
    'password' => 'Неверный пароль',
    // 'present' => 'The :attribute field must be present.',
    // 'regex' => 'The :attribute format is invalid.',
    'required' => 'Поле :attribute обязательно к заполнению.',
    'required_if' => 'Поле :attribute обязательно к заполнению, когда в поле :other выбрано :value.',
    // 'required_unless' => 'The :attribute field is required unless :other is in :values.',
    // 'required_with' => 'The :attribute field is required when :values is present.',
    // 'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'Поле :attribute обязательно к заполнению, когда поле :values не заполнено.',
    // 'required_without_all' => 'The :attribute field is required when none of :values are present.',
    // 'prohibited' => 'The :attribute field is prohibited.',
    // 'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    // 'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'same' => 'Значения полей :attribute и :other должны совпадать.',
    'size' => [
        'numeric' => 'Поле :attribute должно быть :size.',
        'file' => 'Файл поля :attribute должен весить :size килобайт.',
        'string' => 'Поле :attribute должно содержать :size символов.',
        'array' => 'Поле :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Такое :attribute уже занято.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'attributes' => [
        'username' => 'имя пользователя',
        'password' => 'пароль',
        'repeat_password' => 'повторение пароля',
        'name' => 'название',
        'short_name' => 'краткое название',
        'taxon' => 'таксон',
        'id' => 'номер',
        'medium' => 'питательная среда',
        'description' => 'описание',
        'family' => 'семейство',
        'genus' => 'род',
        'species' => 'вид',
        'subspecies' => 'подвид',
        'date' => 'дата',
        'date_time' => 'дата и время',
        'container_id' => 'номер контейнера',
        'container_type_id' => 'тип контейнера',
        'medium_id' => 'питательная среда',
        'location_id' => 'локализация',
        'img' => 'фото',
        'comment' => 'комментарий',
    ],
];