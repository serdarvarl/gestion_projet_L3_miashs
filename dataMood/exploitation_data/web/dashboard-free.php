<?php
session_start();

// Pas de vérification de login - page publique
$is_logged_in = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Free - Data Moode</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f9fafb;
            color: #1f2937;
        }

        /* Header */
        header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 20px 30px;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #6B3FB8;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #ffffffff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            overflow: hidden;
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .plan-badge {
            background: #f3e8ff;
            color: #6B3FB8;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #6B3FB8;
            color: white;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .btn-secondary {
            background: white;
            color: #6B3FB8;
            border: 2px solid #6B3FB8;
        }

        .btn-secondary:hover {
            background: #f3e8ff;
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 16px;
        }

        /* Upgrade Banner */
        .upgrade-banner {
            background: linear-gradient(135deg, #6B3FB8 0%, #7c3aed 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .upgrade-banner-content h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .upgrade-banner-content p {
            font-size: 14px;
            color: #e9d5ff;
        }

        .upgrade-banner .btn {
            background: white;
            color: #6B3FB8;
        }

        .upgrade-banner .btn:hover {
            background: #f3f4f6;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .card-header {
            margin-bottom: 20px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .card-description {
            font-size: 14px;
            color: #6b7280;
        }

        .image-container {
            width: 100%;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            border-radius: 8px;
            background: #f9fafb;
            overflow: hidden;
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .insight-box {
            background: #f3e8ff;
            border-left: 4px solid #6B3FB8;
            padding: 12px 15px;
            border-radius: 6px;
            margin-top: 15px;
            font-size: 14px;
            color: #1f2937;
        }

        .insight-box strong {
            color: #6B3FB8;
        }

        .stat-display {
            text-align: center;
            padding: 20px 0;
        }

        .stat-number {
            font-size: 48px;
            font-weight: bold;
            color: #6B3FB8;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 15px;
        }

        .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #dcfce7;
            color: #166534;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .stat-badge.positive::before {
            content: "↑";
            font-weight: bold;
        }

        footer {
            background: white;
            border-top: 1px solid #e5e7eb;
            padding: 20px 30px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-top: 50px;
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
            }

            .upgrade-banner {
                flex-direction: column;
                gap: 15px;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="index.php" class="logo">
                <div class="logo-icon">
                    <img src="images/logoDataMood.png" alt="Data Moode Logo">
                </div>
                <span>Data Moode</span>
            </a>
            <div class="header-actions">
                <span class="plan-badge">Plan FREE</span>
                <?php if ($is_logged_in): ?>
                    <a href="dashboard-pro.php" class="btn btn-secondary">Mon Compte PRO</a>
                    <a href="logout.php" class="btn btn-secondary">Déconnexion</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-secondary">Se connecter</a>
                    <a href="signup.php" class="btn btn-primary">Essayer PRO</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <div class="page-header">
            <h1> Vos Comparaisons Clés</h1>
            <p>Accédez à 6 analyses pré-configurées pour comprendre vos utilisateurs</p>
        </div>

        <!-- Upgrade Banner -->
        <div class="upgrade-banner">
            <div class="upgrade-banner-content">
                <h3>Passez à PRO pour débloquer plus de fonctionnalités</h3>
                <p>Analyses illimitées, export PDF/PNG, accès API complet...</p>
            </div>
            <a href="signup.php" class="btn">Essayer PRO →</a>
        </div>

        <!-- Charts Cards with Images -->
        <div class="cards-grid">
            <!-- Card 1: Comparaison Temporelle -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Comparaison Temporelle 2020 vs 2024</h3>
                    <p class="card-description">Voir l'évolution du comportement client</p>
                </div>
                <div class="image-container">
                    <img src="images/comparaison_temporelle.png" alt="Comparaison Temporelle">
                </div>
                <div class="insight-box">
                    <strong>📈 Insight:</strong> Le genre féminin a augmenté de 15% en 4 ans
                </div>
            </div>

            <!-- Card 2: Nombre de Pays Actifs -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nombre de Pays Actifs</h3>
                    <p class="card-description">Expansion géographique</p>
                </div>
                <div class="stat-display">
                    <div class="stat-number">40</div>
                    <div class="stat-label">pays actifs en 2024</div>
                    <div class="stat-badge positive">+12 pays (+43%)</div>
                </div>
            </div>

            <!-- Card 3: Genre Dominant -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Genre Dominant</h3>
                    <p class="card-description">Répartition actuelle</p>
                </div>
                <div class="image-container">
                    <img src="images/genre_dominant.png" alt="Genre Dominant">
                </div>
            </div>

            <!-- Card 4: Adoption des Plateformes -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Adoption des Plateformes (2020 vs 2024)</h3>
                    <p class="card-description">Évolution par plateforme</p>
                </div>
                <div class="image-container">
                    <img src="images/adoption_applications_1.png" alt="Adoption des Plateformes">
                </div>
                <div class="insight-box">
                    <strong>🚀 Insight:</strong> iOS App adoption +45%
                </div>
            </div>

            <!-- Card 5: Top Pays -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top 5 Pays Actifs</h3>
                    <p class="card-description">Classement par volume d'activité</p>
                </div>
                <div class="image-container">
                    <img src="images/top5_pays_actifs.webp" alt="Top 5 Pays Actifs">
                </div>
            </div>

            <!-- Card 6: Impact Photo Profil + Ancienneté -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Impact Photo Profil + Ancienneté sur les Ventes</h3>
                    <p class="card-description">Corrélation entre ancienneté et performances</p>
                </div>
                <div class="image-container">
                    <img src="images/impact_photo_anciennete.webp" alt="Impact Photo Profil">
                </div>
                <div class="insight-box">
                    <strong>✅ Insight:</strong> Photo de profil + compte ancien = +35% ventes
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Data Moode. Tous droits réservés.</p>
    </footer>
</body>
</html>