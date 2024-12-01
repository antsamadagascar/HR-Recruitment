<?php 

/**
 * Calcule le score ATS pour un candidat
 * @param array $candidat
 * @param array $profilRequis
 * @return int
 */
function calculateATSScore($candidat, $profilRequis) {
    $score = 0;
    $weights = [
        'competences' => 0.4,
        'experienceTechnique' => 0.3,
        'experienceGenerale' => 0.3
    ];

    // Score des compétences
    $competencesRequises = array_map('trim', explode(',', $profilRequis['qualite_requise']));
    $competencesCandidat = array_map('trim', explode(',', $candidat['competence_description']));
    
    $matchingCompetences = array_intersect(
        array_map('strtolower', $competencesCandidat),
        array_map('strtolower', $competencesRequises)
    );
    
    $competencesScore = !empty($competencesRequises) ? 
        count($matchingCompetences) / count($competencesRequises) : 0;

    // Score de l'expérience technique
    $expTechScore = calculateExperienceMatch(
        $candidat['qualite_experience_technique'],
        $profilRequis['experience_technique_requise']
    );

    // Score de l'expérience générale
    $expGenScore = calculateExperienceMatch(
        $candidat['qualite_experience_generale'],
        $profilRequis['experience_generale_requise']
    );

    // Calcul du score final
    $score = ($competencesScore * $weights['competences']) +
             ($expTechScore * $weights['experienceTechnique']) +
             ($expGenScore * $weights['experienceGenerale']);

    return round($score * 100);
}

/**
 * Calcule la correspondance d'expérience
 * @param string $candidatExp
 * @param string $requisExp
 * @return float
 */
function calculateExperienceMatch($candidatExp, $requisExp) {
    $candidatYears = extractYears($candidatExp);
    $requisYears = extractYears($requisExp);
    
    if ($requisYears == 0) return 1;
    if ($candidatYears >= $requisYears) return 1;
    return $candidatYears / $requisYears;
}

/**
 * Extrait le nombre d'années d'une chaîne
 * @param string $experience
 * @return int
 */
function extractYears($experience) {
    if (empty($experience)) return 0;
    if (is_numeric($experience)) return intval($experience);
    
    preg_match('/(\d+)[\s]*(ans?|années?)?/i', $experience, $matches);
    return isset($matches[1]) ? intval($matches[1]) : 0;
}

/**
 * Retourne la classe CSS en fonction du score
 * @param int $score
 * @return string
 */
function getScoreClass($score) {
    if ($score >= 75) return 'score-high';
    if ($score >= 50) return 'score-medium';
    return 'score-low';
}
?>