<?php
// Script de test pour vérifier la connexion à la base de données

// Charger l'autoloader (adaptez le chemin selon votre structure)
require_once dirname(__DIR__) . '/Autoloader.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Chargement des variables d'environnement
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Afficher les erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Test de connexion à la base de données</h1>";
echo "<h2>Variables d'environnement</h2>";
echo "DB_HOST: " . $_ENV['DB_HOST'] . "<br>";
echo "DB_NAME: " . $_ENV['DB_NAME'] . "<br>";
echo "DB_USER: " . $_ENV['DB_USER'] . "<br>";
echo "DB_PASS: " . (empty($_ENV['DB_PASS']) ? "vide" : "défini") . "<br>";

try {
    // Utiliser PDO directement pour le test
    $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    echo "<h3 style='color:green'>✅ Connexion à la base de données réussie</h3>";

    // Requête pour obtenir les informations sur la table projects
    echo "<h2>Structure de la table 'projects'</h2>";
    $stmt = $pdo->query("SHOW TABLES LIKE 'projects'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color:green'>✅ La table 'projects' existe</p>";

        $stmt = $pdo->query("DESCRIBE projects");
        echo "<h3>Colonnes:</h3>";
        echo "<ul>";
        while ($row = $stmt->fetch()) {
            echo "<li><strong>{$row->Field}</strong> - Type: {$row->Type} - Null: {$row->Null} - Key: {$row->Key} - Default: {$row->Default}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color:red'>❌ La table 'projects' n'existe pas!</p>";
    }

    // Lister les projets
    echo "<h2>Contenu de la table 'projects'</h2>";
    try {
        $stmt = $pdo->query("SELECT * FROM projects");
        $projects = $stmt->fetchAll();

        if (count($projects) > 0) {
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>ID</th><th>Nom</th><th>Statut</th><th>Autres champs</th></tr>";

            foreach ($projects as $project) {
                echo "<tr>";
                echo "<td>{$project->id}</td>";
                echo "<td>{$project->name}</td>";
                echo "<td>{$project->status}</td>";
                echo "<td>";
                // Afficher les autres champs
                foreach ($project as $key => $value) {
                    if (!in_array($key, ['id', 'name', 'status'])) {
                        echo "<strong>{$key}</strong>: {$value}<br>";
                    }
                }
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p style='color:orange'>⚠️ Aucun projet trouvé dans la table</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red'>❌ Erreur lors de la récupération des projets: " . $e->getMessage() . "</p>";
    }
} catch (PDOException $e) {
    echo "<h3 style='color:red'>❌ Erreur de connexion: " . $e->getMessage() . "</h3>";
}

// Test avec le ProjetRepository
echo "<h2>Test avec ProjetRepository</h2>";
try {
    $repo = new \App\Repository\ProjetRepository();
    $projects = $repo->findAll();

    echo "<pre>";
    print_r($projects);
    echo "</pre>";
} catch (Exception $e) {
    echo "<p style='color:red'>❌ Erreur avec le Repository: " . $e->getMessage() . "</p>";
}
