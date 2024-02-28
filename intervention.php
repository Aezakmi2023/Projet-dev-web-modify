<?php
// Connexion à la base de données (à remplacer avec vos propres informations de connexion)
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Fonction pour récupérer les interventions attribuées à un intervenant spécifique
function recupererInterventionsIntervenant($idIntervenant) {
    global $connexion;

    $requete = "SELECT * FROM interventions WHERE id_intervenant = $idIntervenant";
    $resultat = $connexion->query($requete);

    if ($resultat->num_rows > 0) {
        // Générer le HTML pour afficher les interventions
        while ($row = $resultat->fetch_assoc()) {
            // Générer le code HTML pour chaque intervention
            echo "<tr>";
            echo "<td>" . $row["nom_client"] . "</td>";
            echo "<td>" . $row["date_intervention"] . "</td>";
            echo "<td>" . $row["statut"] . "</td>";
            echo "<td>" . $row["degre_urgence"] . "</td>";
            echo "<td>" . $row["commentaires"] . "</td>";
            // Autres colonnes à afficher selon les besoins
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Aucune intervention attribuée à cet intervenant.</td></tr>";
    }
}

// Récupérer l'ID de l'intervenant connecté (à remplacer avec votre mécanisme d'authentification)
$idIntervenantConnecte = 1; // Exemple : ID de l'intervenant connecté

// Afficher les interventions de l'intervenant connecté
recupererInterventionsIntervenant($idIntervenantConnecte);

// Fermer la connexion à la base de données
$connexion->close();
?>
