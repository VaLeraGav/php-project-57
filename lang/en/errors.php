<?php

return [
    'label' => [
        'name_unique' => 'A label with this name already exists',
        'name_max' => 'The name must not exceed 255 characters',
        'name_required' => 'This is a required field',
        'description_max' => 'The name must not exceed 500 characters',
    ],
    'status' => [
        'name_unique' => 'A status with this name already exists',
        'name_max' => 'The name must not exceed 100 characters',
        'name_required' => 'This is a required field'
    ],
    'task' => [
        'name_unique' => 'A task with this name already exists',
        'name_required' => 'This is a required field',
        'name_max' => 'Maximum number of characters: 255',
        'status_id_required' => 'This is a required field',
        'assigned_to_id_required' => 'This is a required field',
        'description_max' => 'Maximum number of characters: 255',
    ],
    'message' => 'Oops! Something went wrong',
    'login' => [
        'email' => 'Enter the correct username and password',
    ],
    'registered' => [
        'name' => 'The name must not exceed 255 characters',
        'email_max' => 'The length of the email should not exceed 255 characters',
        'email_unique' => 'The email has already been registered',
        'password_min' => 'Password must be at least 8 characters long',
        'password_confirmed' => 'Password and confirmation don\'t match'
    ],
];
