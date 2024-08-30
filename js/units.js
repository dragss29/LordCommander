function fetchUnits(factionId, lang) {
    console.log('Fetching units for faction:', factionId);
    const unitTableContainer = document.getElementById('unit-table-container');
    const unitTable = document.getElementById('unit-table');
  
    if (!unitTableContainer || !unitTable) {
      console.error('Element with id "unit-table-container" or "unit-table" not found');
      return;
    }
  
    fetch(`actions/get_units.php?faction_id=${factionId}&lang=${lang}`)
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        if (data.error) {
          throw new Error(data.error);
        }
        console.log('Units data received:', data);
        if (Array.isArray(data) && data.length > 0) {
          displayUnits(data);
        } else {
          unitTable.querySelector('tbody').innerHTML = '<tr><td colspan="3">' + translations.no_units_found + '</td></tr>';
        }
        unitTableContainer.style.display = 'block';
      })
      .catch(error => {
        console.error('Erreur lors du chargement des unités:', error);
        if (unitTable) {
          unitTable.querySelector('tbody').innerHTML = `<tr><td colspan="3">${translations.error_loading_units} (${error.message})</td></tr>`;
        }
        unitTableContainer.style.display = 'block';
      });
  }
  
  function displayUnits(units) {
    const unitTable = document.getElementById('unit-table');
    const tbody = unitTable.querySelector('tbody');
    tbody.innerHTML = '';
  
    units.forEach(unit => {
      const row = tbody.insertRow();
      row.innerHTML = `
        <td>${unit.nom}</td>
        <td class="text-center">${unit.points}</td>
        <td class="text-center">
          <button class="add-unit bg-blue-500 text-white px-2 py-1 rounded" data-id="${unit.id}" data-name="${unit.nom}">+</button>
          <button class="view-unit bg-green-500 text-white px-2 py-1 rounded ml-2" data-id="${unit.id}">🔍</button>
        </td>
      `;
    });
  
    document.querySelectorAll('.add-unit').forEach(button => {
      button.addEventListener('click', function() {
        const unitId = this.dataset.id;
        const unitName = this.dataset.name;
        addUnitToArmy(unitId, unitName);
      });
    });
  
    document.querySelectorAll('.view-unit').forEach(button => {
      button.addEventListener('click', function() {
        const unitId = this.dataset.id;
        openUnitInfoModal(unitId);
      });
    });
  }
  
  export { fetchUnits, displayUnits };