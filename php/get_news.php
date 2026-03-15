<?php
// php/get_news.php - API pour récupérer les actualités

header('Content-Type: application/json');
require_once __DIR__ . '/database.php';

try {
    $db = Database::getInstance();
    $pdo = $db->getConnection();

    // On suppose que la table 'news' existe (à créer dans la DB)
    // Pour l'instant on simule avec des données si la table est vide ou n'existe pas
    
    // Vérifier si la table existe, sinon la créer
    $pdo->exec("CREATE TABLE IF NOT EXISTS news (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        category TEXT,
        date_published TEXT,
        icon TEXT DEFAULT 'rocket_launch',
        color_gradient TEXT DEFAULT 'from-primary to-blue-700'
    )");

    // Vérifier si la table est vide
    $count = $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();
    if ($count == 0) {
        // Insérer des données par défaut
        $defaultNews = [
            ['Lancement Dashboard Admin', 'ALTIMANCE dévoile son nouveau système de gestion de contenu pour une meilleure expérience client.', 'Décembre 2024', 'rocket_launch', 'from-primary to-blue-700'],
            ['Certification ISO 27001', 'ALTIMANCE obtient la certification ISO 27001 pour la sécurité de l\'information.', 'Novembre 2024', 'workspace_premium', 'from-green-500 to-emerald-600'],
            ['Expansion de l\'Équipe', 'Nous accueillons 15 nouveaux collaborateurs pour renforcer nos équipes de développement.', 'Octobre 2024', 'groups', 'from-purple-500 to-pink-600']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO news (title, content, date_published, icon, color_gradient) VALUES (?, ?, ?, ?, ?)");
        foreach ($defaultNews as $n) {
            $stmt->execute($n);
        }
    }

    $stmt = $pdo->query("SELECT * FROM news ORDER BY id DESC");
    $news = $stmt->fetchAll();

    echo json_encode(['success' => true, 'news' => $news]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => "Erreur : " . $e->getMessage()]);
}
?>
