<?php
// php/newsletter.php - Traitement de l'inscription à la newsletter

header('Content-Type: application/json');
require_once __DIR__ . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Email invalide.']);
        exit;
    }

    try {
        $db = Database::getInstance();
        $db->initTables(); // S'assure que la table existe
        $pdo = $db->getConnection();

        $stmt = $pdo->prepare("INSERT INTO newsletter (email) VALUES (?)");
        $stmt->execute([$email]);

        echo json_encode(['success' => true, 'message' => 'Merci pour votre inscription !']);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Constraint violation (ID unique ou email existant)
            echo json_encode(['success' => false, 'message' => 'Cet email est déjà inscrit.']);
        } else {
            echo json_encode(['success' => false, 'message' => "Erreur : " . $e->getMessage()]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
}
?>
