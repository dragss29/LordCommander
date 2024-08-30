function openUnitInfoModal(unitId) {
    console.log('Ouverture de la modal pour l\'unité:', unitId);
    // Ajoutez ici le code pour récupérer et afficher les détails de l'unité
    fetch(`actions/get_unit_info.php?id=${unitId}`)
        .then(response => response.json())
        .then(unit => {
            console.log('Détails de l\'unité:', unit);
            // Ajoutez ici le code pour afficher les détails de l'unité dans le modal
        })
        .catch(error => console.error('Erreur lors de la récupération des détails de l\'unité:', error));
}
  
  function openArmyDetailsModal(armyId) {
    console.log(`Ouverture des détails de l'armée avec ID: ${armyId}`);
    // Ajoutez ici le code pour récupérer et afficher les détails de l'armée
    fetch(`actions/get_army_details.php?id=${armyId}`)
        .then(response => response.json())
        .then(army => {
            console.log('Détails de l\'armée:', army);
            // Ajoutez ici le code pour afficher les détails de l'armée dans le modal
        })
        .catch(error => console.error('Erreur lors de la récupération des détails de l\'armée:', error));
  }
  
  export { openUnitInfoModal, openArmyDetailsModal };