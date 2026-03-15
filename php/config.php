<?php
// php/config.php - Configuration de la base de données

// Utilisation de SQLite par défaut pour correspondre au projet existant
// S'il s'agit d'un environnement avec MySQL, décommenter les lignes ci-dessous
/*
define('DB_HOST', 'localhost');
define('DB_NAME', 'altimance');
define('DB_USER', 'root');
define('DB_PASS', '');
*/

// Chemin vers la base de données SQLite
define('SQLITE_DB_PATH', __DIR__ . '/../altimance.db');

// Paramètres de l'application
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD_HASH', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); // 'password' par défaut
?>
