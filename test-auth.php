<?php
require 'model/database.php';
require 'model/user.php';

session_start();

$testUsers = [
    [
        'username' => 'ingsistemas@ufps.edu.co',
        'password' => '115Sistemas',
        'expected_rol' => 1,
        'expected_md5' => '3d0c8cc3553bca64f4ec92387cd367c8'
    ],
    [
        'username' => 'lorenzorr@ufps.edu.co',
        'password' => '987654321',
        'expected_rol' => 2,
        'expected_md5' => '6ebe76c9fb411be97b3b0d48b791a7c9'
    ],
    [
        'username' => 'tomasruiz@ufps.edu.co',
        'password' => '1111111111',
        'expected_rol' => 2,
        'expected_md5' => 'e11170b8cbd2d74102651cb967fa28e5'
    ]
];

echo "<h1>Prueba de Autenticación Completa</h1>";

foreach ($testUsers as $test) {
    $userModel = new User();
    $userInDb = $userModel->Obtener($test['username']);
    
    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:20px;'>";
    echo "<h2>Probando: {$test['username']}</h2>";
    echo "<p><strong>Contraseña usada:</strong> '{$test['password']}'</p>";
    echo "<p><strong>Longitud:</strong> ".strlen($test['password'])." caracteres</p>";
    
    if (!$userInDb) {
        echo "<p style='color:red'>✗ Usuario no existe en la base de datos</p>";
        echo "</div>";
        continue;
    }
    
    echo "<p><strong>Contraseña en DB:</strong> {$userInDb->password}</p>";
    echo "<p><strong>MD5 esperado:</strong> {$test['expected_md5']}</p>";
    echo "<p><strong>MD5 generado:</strong> ".md5($test['password'])."</p>";
    
    $result = $userModel->Verificar($test['username'], $test['password']);
    
    if ($result) {
        echo "<p style='color:green'>✓ Autenticación exitosa</p>";
        echo "<p><strong>Rol obtenido:</strong> {$result->rol} (esperado: {$test['expected_rol']})</p>";
        
        if ($userInDb->password !== md5($test['password'])) {
            echo "<p style='color:orange'>⚠ Atención: La contraseña en DB no coincide con el MD5 generado</p>";
        }
    } else {
        echo "<p style='color:red'>✗ Fallo en autenticación</p>";
        
        if ($userInDb->password === md5($test['password'])) {
            echo "<p style='color:blue'>ℹ Info: Las contraseñas coinciden pero la verificación falló</p>";
        }
    }
    
    echo "</div>";
}