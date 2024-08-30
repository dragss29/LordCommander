function addUnitToArmy(unitId, unitName) {
    const armyUnits = document.getElementById('army-units');
    const unitDiv = document.createElement('div');
    unitDiv.innerHTML = `
      <p>${unitName}</p>
      <input type="number" name="units[${unitId}]" value="1" min="1" class="w-16 px-2 py-1 border rounded">
      <button type="button" class="remove-unit bg-red-500 text-white px-2 py-1 rounded">${translations.remove_unit}</button>
    `;
    armyUnits.appendChild(unitDiv);
  
    unitDiv.querySelector('.remove-unit').addEventListener('click', function() {
      armyUnits.removeChild(unitDiv);
    });
  }
  
  function createArmy(form, game, lang) {
    let isSubmitting = false;
    
    if (isSubmitting) {
      console.log('Form submission already in progress');
      return;
    }
  
    isSubmitting = true;
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = true;
  
    const formData = new FormData(form);
    formData.append('game', game);
  
    fetch('actions/create_army.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert(translations.army_created_success);
        loadArmies(game, lang);
        form.reset();
        document.getElementById('army-units').innerHTML = '';
        document.getElementById('unit-selector-container').style.display = 'none';
      } else {
        alert(translations.army_created_error + (data.error ? ': ' + data.error : ''));
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      alert(translations.army_created_error);
    })
    .finally(() => {
      isSubmitting = false;
      submitButton.disabled = false;
    });
  }
  
  export { addUnitToArmy, createArmy };