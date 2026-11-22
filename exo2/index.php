<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Monitoring de serveurs</title>
</head>
<body>
<?php
// Tableau associatif : chaque serveur contient cpu, ram et status
// Slide 64 : tableaux associatifs.
// Slide 63 : tableaux complexes imbriques.
$serveurs = [
    "api-01" => ["cpu" => 45, "ram" => 60, "status" => "1"],
    "api-02" => ["cpu" => 92, "ram" => 78, "status" => "1"],
    "db-prod" => ["cpu" => 70, "ram" => 95, "status" => "1"],
    "web-01" => ["cpu" => 30, "ram" => 40, "status" => "1"],
    "web-02" => ["cpu" => 55, "ram" => 65, "status" => "0"],
    "cache-01" => ["cpu" => 88, "ram" => 92, "status" => "1"]
];

$totalOnline = 0;
$sommeScores = 0;
$bestServ = "";
$bestScore = -1;

// Boucle foreach : parcourt les serveurs afin de calculer les indicateurs
// Slides 69-70 : boucles foreach.
foreach ($serveurs as $nom => $serveur) {
    if ($serveur["status"] === "1") {
        $totalOnline++;
    }

    // Score = 100 - moyenne de l'utilisation CPU et RAM
    // Slide 66 : operateurs arithmetiques.
    $score = 100 - (($serveur["cpu"] + $serveur["ram"]) / 2);
    $sommeScores += $score;

    if ($score > $bestScore) {
        $bestScore = $score;
        $bestServ = $nom;
    }
}

$moyScores = $sommeScores / count($serveurs);
?>

<!-- Tableau HTML : id et classes imposes par l'enonce.
     Slides 26-27 : melange PHP et HTML. -->
<table id="table1" border="1">
<?php
foreach ($serveurs as $nom => $serveur) {
    $cpu = $serveur["cpu"];
    $ram = $serveur["ram"];
    $status = $serveur["status"];

    $score = 100 - (($cpu + $ram) / 2);

    // Conditions couleur : offline, critique, score >= 50, sinon attention
    // Slide 67 : structures conditionnelles if/else.
    // Slide 66 : operateurs rationnels et logique OU.
    if ($status === "0") {
        $couleur = "rgb(200,200,200)";
        $etat = "OFFLINE";
    } elseif ($cpu > 85 || $ram > 90) {
        $couleur = "rgb(255,180,180)";
        $etat = "CRITIQUE";
    } elseif ($score >= 50) {
        $couleur = "rgb(180,255,180)";
        $etat = "OK";
    } else {
        $couleur = "rgb(255,220,150)";
        $etat = "ATTENTION";
    }
?>
    <tr class="row" style="background-color: <?php echo $couleur; ?>;">
        <td class="serveur"><?php echo $nom; ?></td>
        <td class="cpu"><?php echo $cpu; ?></td>
        <td class="ram"><?php echo $ram; ?></td>
        <td class="status"><?php echo $status === "1" ? "online" : "offline"; ?></td>
        <td class="score"><?php echo $score; ?></td>
        <td class="etat"><?php echo $etat; ?></td>
    </tr>
<?php
}
?>
</table>

<div class="resume">
    <!-- Identifiants imposes pour les informations resumees. -->
    <!-- Slide 61 : echo affiche une valeur PHP dans le document HTML. -->
    <!-- Slide 66 : concatenation avec l'operateur point. -->
    <p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
    <p>Score moyen: <span id="moy_scores"><?php echo $moyScores; ?></span></p>
    <p>Meilleur serveur: <span id="best_serv"><?php echo $bestServ . " (" . $bestScore . ")"; ?></span></p>
</div>
</body>
</html>
