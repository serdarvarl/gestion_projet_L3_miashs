<?php
header('Content-Type: application/json');

// Démarrer la session
session_start();

// Récupérer les données POST
$name = $_POST['name'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';


// ========== VALIDATIONS ==========

// 1. Vérifier que tous les champs sont remplis
if (empty($name) || empty($firstname) || empty($email) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Tous les champs sont requis'
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

// 3. Vérifier la force du mot de passe
if (strlen($password) < 8) {
    echo json_encode([
        'success' => false,
        'message' => 'Le mot de passe doit avoir au moins 8 caractères'
    ]);
    exit;
}

if (!preg_match('/[0-9]/', $password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Le mot de passe doit contenir au moins 1 chiffre'
    ]);
    exit;
}

if (!preg_match('/[!@#$%^&*]/', $password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Le mot de passe doit contenir au moins 1 caractère spécial (!@#$%^&*)'
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

// ========== VÉRIFIER QUE L'EMAIL N'EXISTE PAS DÉJÀ ==========

$stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Cet email est déjà utilisé'
    ]);
    exit;
}

// ========== HACHER LE MOT DE PASSE ==========

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// ========== INSÉRER L'UTILISATEUR DANS LA BASE ==========

$stmt = $pdo->prepare('
    INSERT INTO users (name, firstname, email, password, created_at) 
    VALUES (?, ?, ?, ?, NOW())
');

try {
    $stmt->execute([$name, $firstname, $email, $hashedPassword]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Compte créé avec succès ! Redirection vers la connexion...'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de la création du compte'
    ]);
}

?>