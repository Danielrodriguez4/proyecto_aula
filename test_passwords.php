<?php
require_once 'model/user.php';
require_once 'model/informacionpersonal.php';

$test_users = [
    'lorenzorr@ufps.edu.co' => '987654321',
    'tomasruiz@ufps.edu.co' => '1111111111'
];

foreach ($test_users as $email => $num_id) {
    $userModel = new User();
    $user = $userModel->Obtener($email);
    
    echo "Usuario: $email\n";
    echo "Hash en BD: " . $user->password . "\n";
    echo "MD5(num_id): " . md5($num_id) . "\n";
    echo "Coincide: " . ($user->password === md5($num_id) ? "SÍ" : "NO");
    echo "\n\n";
}