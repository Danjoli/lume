<?php

return [
    'required' => 'O campo :attribute é obrigatório.',
    'email' => 'Informe um e-mail válido.',
    'confirmed' => 'A confirmação de :attribute não corresponde.',
    'min' => ['string' => ':Attribute deve ter pelo menos :min caracteres.'],
    'max' => ['string' => ':Attribute não pode ter mais de :max caracteres.'],
    'unique' => 'Este :attribute já está cadastrado.',
    'current_password' => 'A senha atual está incorreta.',
    'password' => [
        'letters' => ':Attribute deve conter pelo menos uma letra.',
        'mixed' => ':Attribute deve conter letras maiúsculas e minúsculas.',
        'numbers' => ':Attribute deve conter pelo menos um número.',
        'symbols' => ':Attribute deve conter pelo menos um símbolo.',
        'uncompromised' => 'Esta senha apareceu em um vazamento de dados. Escolha outra.',
    ],
    'attributes' => [
        'name' => 'nome', 'email' => 'e-mail', 'password' => 'senha',
        'password_confirmation' => 'confirmação da senha', 'current_password' => 'senha atual',
    ],
];
