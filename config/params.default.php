<?php

$ldap = require __DIR__ . '/ldap.php';

return [
    'adminEmail' => 'admin@example.com',
    'ldap' => $ldap,
    'vip' => ["admin", "vip"],
    'admin' => ["admin"],
];
