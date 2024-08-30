// Nouvelle fonction pour générer dynamiquement l'URL de l'image en fonction du nom de la faction.
function getFactionImageUrl(factionName) {
  const sanitizedFactionName = factionName.toLowerCase().replace(/ /g, '_').replace(/[^a-z_]/g, '');
  return `contents/factions/${sanitizedFactionName}.png`;
}

function loadArmies(game, lang) {
  fetch(`actions/get_armies.php?game=${game}&lang=${lang}`)
    .then(response => response.json())
    .then(armies => {
      const armyList = document.getElementById('army-list');
      armyList.innerHTML = '';

      if (armies.length === 0) {
        armyList.innerHTML = `<p class="text-white">${translations.no_armies_found}</p>`;
        return;
      }

      armies.forEach(army => {
        const armyCard = document.createElement('div');
        armyCard.className = 'bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105';

        let factionImagePath = '';
        if (army.factions) {
          console.log('Army Factions:', army.factions); // Ajout du console.log
          console.log('Factions Array:', army.factions.split(',')); // Ajout du console.log
          console.log('Army Object:', army); // Ajout du console.log
          const factionName = army.factions.split(',')[0].trim();
          console.log('Faction Name:', factionName); // Ajout du console.log
          factionImagePath = getFactionImageUrl(factionName);
        }

        armyCard.innerHTML = `
          <div class="army-tile" style="position: relative; height: 200px; overflow: hidden;">
            <img src="${factionImagePath}" alt="${factionName}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">
            <div style="position: relative; padding: 20px; color: white; background: rgba(0, 0, 0, 0.5);">
              <h4 class="text-xl font-semibold">${army.name}</h4>
              <p>${army.description}</p>
              <p><strong>${translations.total_points}:</strong> ${army.total_points}</p>
              <p><strong>${translations.unit_count}:</strong> ${army.unit_count}</p>
            </div>
          </div>
          <div class="p-4 flex justify-between">
            <button class="view-army bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200" data-id="${army.id}">${translations.see_details}</button>
            <button class="delete-army bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-200" data-id="${army.id}">${translations.delete}</button>
          </div>
        `;
        armyList.appendChild(armyCard);
      });

      // Gestionnaire d'événements pour les boutons de suppression
      document.querySelectorAll('.delete-army').forEach(button => {
        button.addEventListener('click', function() {
          const armyId = this.getAttribute('data-id');
          deleteArmy(armyId, game, lang);
        });
      });
    })
    .catch(error => {
      console.error('Erreur lors du chargement des armées:', error);
      const armyList = document.getElementById('army-list');
      armyList.innerHTML = `<p class="text-white">Erreur lors du chargement des armées. Veuillez réessayer plus tard.</p>`;
    });
}

function deleteArmy(armyId, game, lang) {
  if (confirm('Êtes-vous sûr de vouloir supprimer cette armée ?')) {
    fetch(`actions/delete_army.php?id=${armyId}`, {
      method: 'DELETE',
    })
    .then(response => {
      if (response.ok) {
        alert('Armée supprimée avec succès.');
        loadArmies(game, lang);
      } else {
        alert('Erreur lors de la suppression de l\'armée.');
      }
    })
    .catch(error => console.error('Erreur:', error));
  }
}

// Appel initial de la fonction de chargement des armées
document.addEventListener('DOMContentLoaded', function() {
  const game = document.querySelector('script[data-game]').getAttribute('data-game');
  const lang = document.querySelector('script[data-lang]').getAttribute('data-lang');
  loadArmies(game, lang);
});