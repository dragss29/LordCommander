function openArmyDetailsModal(armyId) {
    // Logique pour ouvrir le modal avec les détails de l'armée
    console.log(`Ouverture des détails de l'armée avec ID: ${armyId}`);
    // Ajoutez ici le code pour récupérer et afficher les détails de l'armée
}

// Gestion des événements pour les boutons "Détails de l'Unité" (si nécessaire)
document.querySelectorAll('.view-unit').forEach(button => {
    button.addEventListener('click', function() {
        const unitId = this.dataset.id;
        openUnitDetailsModal(unitId); // Appel à la fonction pour afficher les détails de l'unité
    });
});

function openUnitDetailsModal(unitId) {
    // Logique pour ouvrir le modal avec les détails de l'unité
    console.log(`Ouverture des détails de l'unité avec ID: ${unitId}`);
    // Ajoutez ici le code pour récupérer et afficher les détails de l'unité
}