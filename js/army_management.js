// Importations
import { fetchUnits, displayUnits } from './units.js';
import { addUnitToArmy, createArmy } from './army_creation.js';
import { loadArmies, deleteArmy } from './army_list.js';
import { openUnitInfoModal, openArmyDetailsModal } from './modals.js';

let isInitialized = false;

function initializeArmyManagement(game, lang) {
  if (isInitialized) {
    console.log('Army management already initialized');
    return;
  }
  
  console.log('Initializing army management');
  console.log('Game:', game);
  console.log('Language:', lang);

  const factionSelector = document.getElementById('faction-selector');
  const unitSelector = document.getElementById('unit-selector');
  const unitSelectorContainer = document.getElementById('unit-selector-container');
  const createArmyForm = document.getElementById('create-army-form');
  const armyUnits = document.getElementById('army-units');
  const armyList = document.getElementById('army-list');

  if (!factionSelector || !unitSelector || !unitSelectorContainer || !createArmyForm || !armyUnits || !armyList) {
    console.error('One or more required elements not found');
    return;
  }

  factionSelector.addEventListener('change', function() {
    const factionId = this.value;
    if (factionId) {
      fetchUnits(factionId, lang);
    } else {
      unitSelectorContainer.style.display = 'none';
    }
  });

  if (unitSelector) {
    unitSelector.addEventListener('change', function() {
      const unitId = this.value;
      const unitName = this.options[this.selectedIndex].text;
      if (unitId) {
        addUnitToArmy(unitId, unitName);
      }
    });
  }

  createArmyForm.addEventListener('submit', function(e) {
    e.preventDefault();
    createArmy(this, game, lang);
  });

  loadArmies(game, lang);
  isInitialized = true;
}

document.addEventListener('DOMContentLoaded', function() {
  const game = document.querySelector('script[data-game]').getAttribute('data-game');
  const lang = document.querySelector('script[data-lang]').getAttribute('data-lang');
  initializeArmyManagement(game, lang);
});

// Exportations
export { initializeArmyManagement };