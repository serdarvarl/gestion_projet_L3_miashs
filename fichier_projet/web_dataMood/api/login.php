<?php
header('Content-Type: application/json');

// Démarrer la session
session_start();

// Récupérer les données POST
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// ========== VALIDATIONS ==========

// 1. Vérifier que tous les champs sont remplis
if (empty($email) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'L\'email et le mot de passe sont requis'
    ]);
    exit;
}

// 2. Vérifier le format de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Email invalide'
    ]);
    exit;
}

// ========== CONNEXION À LA BASE DE DONNÉES ==========

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'data_moode';

try {
    $pdo = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPassword,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur de connexion à la base de données'
    ]);
    exit;
}

// ========== CHERCHER L'UTILISATEUR ==========

$stmt = $pdo->prepare('SELECT id, name, firstname, email, password FROM users WHERE email = ?');
$stmt->execute([$email]);

if ($stmt->rowCount() === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Email ou mot de passe incorrect'
    ]);
    exit;
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// ========== VÉRIFIER LE MOT DE PASSE ==========

if (!password_verify($password, $user['password'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Email ou mot de passe incorrect'
    ]);
    exit;
}

// ========== CRÉER LA SESSION ==========

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_firstname'] = $user['firstname'];
$_SESSION['user_email'] = $user['email'];

// ========== SUCCÈS ==========

echo json_encode([
    'success' => true,
    'message' => 'Connexion réussie !'
]);

?>