<?php
$discipline = array(
    0 => array(
        "id_discipline" => 0,
        "libelledisc" => "MATH",
        "s" => 2,
        "aa" => 2025,
        "id_departement" => 3,
        "id_formation" => 72,
        "libelledept" => "Informatique",
        "nom" => "BUT R&T parcours cybersécurité",
        "id_niveau" => 1,
        "besoin_heure" => "45.4"
    ),
    1 => array(
        "id_discipline" => 0,
        "libelledisc" => "MATH",
        "s" => 2,
        "aa" => 2024,
        "id_departement" => 1,
        "id_formation" => 71,
        "libelledept" => "Science des Données",
        "nom" => "BUT informatique parcours déploiement d'applications communicantes et sécurisées",
        "id_niveau" => 3,
        "besoin_heure" => "36.4"
    ),
    2 => array(
        "id_discipline" => 0,
        "libelledisc" => "MATH",
        "s" => 2,
        "aa" => 2025,
        "id_departement" => 3,
        "id_formation" => 72,
        "libelledept" => "Informatique",
        "nom" => "BUT R&T parcours cybersécurité",
        "id_niveau" => 1,
        "besoin_heure" => "45.4"
    ),
    3 => array(
        "id_discipline" => 0,
        "libelledisc" => "MATH",
        "s" => 2,
        "aa" => 2025,
        "id_departement" => 3,
        "id_formation" => 72,
        "libelledept" => "Informatique",
        "nom" => "BUT R&T parcours cybersécurité",
        "id_niveau" => 1,
        "besoin_heure" => "45.4"
    ),
    4 => array(
        "id_discipline" => 0,
        "libelledisc" => "MATH",
        "s" => 2,
        "aa" => 2025,
        "id_departement" => 3,
        "id_formation" => 72,
        "libelledept" => "Informatique",
        "nom" => "BUT R&T parcours cybersécurité",
        "id_niveau" => 1,
        "besoin_heure" => "45.4"
    ),
    5 => array(
        "id_discipline" => 0,
        "libelledisc" => "MATH",
        "s" => 2,
        "aa" => 2025,
        "id_departement" => 3,
        "id_formation" => 72,
        "libelledept" => "Informatique",
        "nom" => "BUT R&T parcours cybersécurité",
        "id_niveau" => 1,
        "besoin_heure" => "45.4"
    ),
  
);




function filtrerDonneesO_n2($donnees, $departementDesire, $semestreDesire, $anneeDesiree) {
    $resultatsFiltres = []; //compléxité O(n²) car boucle imbriqué le temps d'execusion est plus long

    foreach ($donnees as $ligne1) { 
        foreach ($donnees as $ligne2) { 
            if (
                $ligne1['id_departement'] == $departementDesire && 
                $ligne1['s'] == $semestreDesire && 
                $ligne1['annee'] == $anneeDesiree && 
                $ligne1['id_departement'] == $ligne2['id_departement'] && 
                $ligne1['s'] == $ligne2['s'] && 
                $ligne1['annee'] == $ligne2['annee'] 
            ) {
                $resultatsFiltres[] = $ligne1; 
            }
        }
    }

    return $resultatsFiltres; 
}

function filtrerDonneesO_n($donnees, $departementDesire, $semestreDesire, $anneeDesiree) {
    $resultatsFiltres = [];// complexité O(n) car une seule boucle

    foreach ($donnees as $ligne) {
        if (
            $ligne['id_departement'] == $departementDesire &&
            $ligne['s'] == $semestreDesire &&
            $ligne['annee'] == $anneeDesiree
        ) {
            $resultatsFiltres[] = $ligne;
        }
    }

    return $resultatsFiltres;
}
$start_time = microtime(true);
$start_memory = memory_get_usage();
// Appeler la première fonction
echo filtrerDonneesO_n($discipline,1,2,)
// Mesurer le temps d'exècution et l'utilisation de la mémoire
$end_time = microtime(true);
$end_memory = memory_get_usage();
$execution_time = $end_time - $start_time;
$memory_usage = $end_memory - $start_memory;
echo "Temps d'execution pour filtrerDonneesO_n : $execution_time secondes\n";

echo "Utilisation de la memoire : $memory_usage octets\n";
$start_time = microtime(true);
$start_memory = memory_get_usage();
// Appeler la première fonction
echo filtrerDonneesO_n2($discipline,1,2,)
// Mesurer le temps d'exècution et l'utilisation de la mémoire
$end_time = microtime(true);
$end_memory = memory_get_usage();
$execution_time = $end_time - $start_time;
$memory_usage = $end_memory - $start_memory;
echo "Temps d'execution pour filtrerDonneesO_n2 : $execution_time secondes\n";
echo "Utilisation de la memoire : $memory_usage octets\n";

?>

