<?php
// php/admin/dashboard.php - Dashboard d'administration PHP

require_once __DIR__ . '/../database.php';

// Simuler une session simple pour la démo
// Dans un vrai projet, utilisez session_start() et vérifiez l'authentification
$db = Database::getInstance();
$pdo = $db->getConnection();

// Récupérer les abonnés
$subscribers = $pdo->query("SELECT * FROM newsletter ORDER BY created_at DESC")->fetchAll();

// Récupérer les news
$news = $pdo->query("SELECT * FROM news ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin PHP - ALTIMANCE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">ALTIMANCE Admin (PHP)</h1>
            <a href="../../index.html" class="text-sm hover:underline">Voir le site</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6 md:p-10">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Section Newsletters -->
            <section class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Inscriptions Newsletter</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Email</th>
                                <th class="py-2">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subscribers as $s): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2"><?php echo htmlspecialchars($s['email']); ?></td>
                                    <td class="py-2 text-sm text-gray-500"><?php echo $s['created_at']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Section News -->
            <section class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Gestion des News</h2>
                <div class="space-y-4">
                    <?php foreach ($news as $n): ?>
                        <div class="p-4 border rounded-lg flex justify-between items-center">
                            <div>
                                <h3 class="font-bold"><?php echo htmlspecialchars($n['title']); ?></h3>
                                <p class="text-xs text-gray-500"><?php echo htmlspecialchars($n['date_published']); ?></p>
                            </div>
                            <span class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full">Actif</span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="mt-6 w-full py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors">
                    + Ajouter une Actualité
                </button>
            </section>
        </div>
    </main>
</body>
</html>
