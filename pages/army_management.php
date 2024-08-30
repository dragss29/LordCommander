<?php
include_once __DIR__ . '/../db.php';
echo "<script>console.log('Game in army_management: " . $game . "');</script>";
?>

<section class="py-12">
  <div class="container mx-auto">
    <div class="bg-white p-6 rounded shadow">
      <h3 class="text-2xl font-semibold"><?php echo $translations['search']; ?></h3>
      <div class="mb-4">
        <label class="block text-gray-700"><?php echo $translations['choose_faction']; ?></label>
        <select id="faction-selector" class="w-full px-3 py-2 border rounded">
          <option value=""><?php echo $translations['select_faction']; ?></option>
          <?php
          $stmt = $mysqli->prepare("SELECT id, {$language}_nom as nom FROM factions WHERE univers = ?");
          $stmt->bind_param("s", $game);
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['nom'], ENT_QUOTES, 'UTF-8') . "</option>";
          }
          $stmt->close();
          ?>
        </select>
      </div>
      <div id="unit-selector-container" style="display: none;">
        <label class="block text-gray-700"><?php echo $translations['choose_unit']; ?></label>
        <select id="unit-selector" class="w-full px-3 py-2 border rounded">
          <option value=""><?php echo $translations['select_unit']; ?></option>
        </select>
      </div>
      <div id="unit-table-container" class="mt-4" style="display: none;">
        <table id="unit-table" class="w-full">
          <thead>
            <tr>
              <th><?php echo $translations['unit_name']; ?></th>
              <th class="text-center"><?php echo $translations['points']; ?></th>
              <th class="text-center"><?php echo $translations['actions']; ?></th>
            </tr>
          </thead>
          <tbody>
            <!-- Les unités seront ajoutées ici dynamiquement -->
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="mt-8 bg-white p-6 rounded shadow">
      <h3 class="text-2xl font-semibold mb-4"><?php echo $translations['create_new_army']; ?></h3>
      <form id="create-army-form">
        <div class="mb-4">
          <label class="block text-gray-700"><?php echo $translations['army_name']; ?></label>
          <input type="text" name="army_name" required class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700"><?php echo $translations['army_description']; ?></label>
          <textarea name="army_description" class="w-full px-3 py-2 border rounded"></textarea>
        </div>
        <div id="army-units" class="mb-4">
          <!-- Les unités sélectionnées seront ajoutées ici -->
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"><?php echo $translations['create_army']; ?></button>
      </form>
    </div>
  </div>
</section>

<section class="py-12">
  <div class="container mx-auto">
    <h3 class="text-2xl font-semibold text-white mb-4"><?php echo $translations['army_lists']; ?></h3>
    <div class="mb-4">
      <input type="text" id="army-search" class="w-full px-3 py-2 border rounded" placeholder="<?php echo $translations['search_armies']; ?>">
    </div>
    <div id="army-list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Les listes d'armées seront ajoutées ici dynamiquement -->
    </div>
  </div>
</section>

<script>
const translations = <?php echo json_encode($translations); ?>;
const game = '<?php echo $game; ?>';
const lang = '<?php echo $language; ?>';

const factionSelector = document.getElementById('faction-selector');
const factionCount = factionSelector.options.length - 1; // -1 pour exclure l'option par défaut
console.log(`${game}->${factionCount}`);
</script>
<script type="module" src="js/army_management.js" data-game="<?php echo $game; ?>" data-lang="<?php echo $language; ?>"></script>