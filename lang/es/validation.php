<?php

// Mensajes de validación en español para las reglas que usa la aplicación.
// Lo que no esté aquí se muestra con el texto en inglés de Laravel.
return [
    'accepted' => 'Debes aceptar :attribute.',
    'after' => ':Attribute debe ser una fecha posterior a :date.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'current_password' => 'La contraseña no es correcta.',
    'date' => ':Attribute no es una fecha válida.',
    'email' => ':Attribute debe ser un email válido.',
    'image' => ':Attribute debe ser una imagen.',
    'lowercase' => ':Attribute debe ir en minúsculas.',
    'max' => [
        'file' => ':Attribute no puede pesar más de :max kilobytes.',
        'string' => ':Attribute no puede tener más de :max caracteres.',
    ],
    'min' => [
        'file' => ':Attribute debe pesar al menos :min kilobytes.',
        'string' => ':Attribute debe tener al menos :min caracteres.',
    ],
    'numeric' => ':Attribute debe ser un número.',
    'password' => [
        'letters' => ':Attribute debe tener al menos una letra.',
        'mixed' => ':Attribute debe tener mayúsculas y minúsculas.',
        'numbers' => ':Attribute debe tener al menos un número.',
        'symbols' => ':Attribute debe tener al menos un símbolo.',
        'uncompromised' => 'Esta contraseña ha aparecido en una filtración de datos. Elige otra.',
    ],
    'required' => 'Falta :attribute.',
    'string' => ':Attribute debe ser texto.',
    'unique' => 'Ya existe una cuenta con :attribute indicado.',

    'attributes' => [
        'name' => 'el nombre',
        'email' => 'el email',
        'password' => 'la contraseña',
        'phone' => 'el teléfono',
        'startDate' => 'la fecha de llegada',
        'endDate' => 'la fecha de salida',
        'message' => 'el mensaje',
        'current_password' => 'la contraseña actual',
        'image' => 'la imagen',
        'title' => 'el nombre',
    ],
];
