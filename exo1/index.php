
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Etudiants - Notes</title>
</head>
<body>
<?php
// Tableau associatif : les clefs sont les noms des etudiants
// Slide 64 : tableaux associatifs.
$etudiantsNote = [
    "JOHN"   => 9,
    "BOB"    => 15.5,
    "RAYANE" => 7,
    "ROSIE"  => 13
];

// Fonction : verifie si une moyenne est superieure ou egale a 10
// Slide 71 : declaration de fonctions.
// Slide 67 : condition if/else.
// Slide 66 : operateur >=.
function estAdmissible($note)
{
    if ($note >= 10) {
        return true;
    }

    return false;
}
?>

<!-- Tableau HTML : id impose par l'enonce.
     Slide 26-27 : melange PHP et HTML. -->
<table id="table1" border="1">
<?php
// Boucle foreach : parcourt chaque clef et sa valeur
// Slides 69-70 : boucles foreach.
foreach ($etudiantsNote as $etudiant => $note) {
    $couleur = estAdmissible($note)
        ? "rgb(136,248,136)"
        : "rgb(251,173,173)";
?>
    <tr class="row" style="background-color: <?php echo $couleur; ?>;">
        <!-- Slide 61 : echo affiche une valeur PHP dans le document HTML. -->
        <td class="etud"><?php echo $etudiant; ?></td>
        <td class="note"><?php echo $note; ?></td>
    </tr>
<?php
}
?>
</table>
</body>
</html>
