<?php include 'header.php'; ?>

<div class="container mx-auto mt-20 px-4 pb-20">
  <h2 class="text-3xl md:text-4xl font-bold text-center text-white mb-8"><?php echo $translations['register']; ?></h2>
  <form id="registration-form" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <div id="step-1" class="registration-step">
      <h3 class="text-2xl font-semibold mb-6"><?php echo $translations['step_1_identity']; ?> 👤</h3>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name"><?php echo $translations['first_name']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="text" id="first_name" name="first_name" required>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name"><?php echo $translations['last_name']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="text" id="last_name" name="last_name" required>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email"><?php echo $translations['email']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="email" id="email" name="email" required>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password"><?php echo $translations['password']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="password" id="password" name="password" required>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password"><?php echo $translations['confirm_password']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="password" id="confirm_password" name="confirm_password" required>
      </div>
    </div>
    <div id="step-2" class="registration-step hidden">
      <h3 class="text-2xl font-semibold mb-6"><?php echo $translations['step_2_game_faction']; ?> 🎮</h3>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="favorite_game"><?php echo $translations['favorite_game']; ?></label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" id="favorite_game" name="favorite_game">
          <option value="Warhammer">Warhammer</option>
          <option value="Warhammer 40k">Warhammer 40k</option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="favorite_faction"><?php echo $translations['favorite_faction']; ?></label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" id="favorite_faction" name="favorite_faction">
          <option value=""><?php echo $translations['select_faction']; ?></option>
          <?php
          include __DIR__ . '/../db.php';
          $result = $mysqli->query("SELECT id, FR_nom, univers FROM factions");
          while ($row = $result->fetch_assoc()) {
            $game = ($row['univers'] == 'Warhammer') ? 'Warhammer' : 'Warhammer 40k';
            echo "<option value='{$row['id']}' data-game='{$game}'>" . htmlspecialchars($row['FR_nom'], ENT_QUOTES, 'UTF-8') . "</option>";
          }
          ?>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="profile_image"><?php echo $translations['profile_image']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="file" id="profile_image" name="profile_image">
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="preferred_language"><?php echo $translations['preferred_language']; ?></label>
        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" id="preferred_language" name="preferred_language">
          <option value="fr"><?php echo $translations['french']; ?></option>
          <option value="uk"><?php echo $translations['english']; ?></option>
          <option value="it"><?php echo $translations['italian']; ?></option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="commander_name"><?php echo $translations['commander_name']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="text" id="commander_name" name="commander_name" required>
      </div>
    </div>
    <div id="step-3" class="registration-step hidden">
      <h3 class="text-2xl font-semibold mb-6"><?php echo $translations['step_3_confirmation']; ?> ✅</h3>
      <p class="text-gray-700"><?php echo $translations['verify_info']; ?> :</p>
      <div id="confirmation-info" class="space-y-2"></div>
    </div>
    <div class="mt-6">
      <button type="button" id="prev-btn" class="w-full bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400 transition duration-300 hidden" onclick="previousStep()">Précédent</button>
      <button type="button" id="next-btn" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300" onclick="nextStep()">Suivant</button>
      <button type="button" id="submit-btn" class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded-md hover:bg-green-700 transition duration-300 hidden" onclick="submitRegistration()">S'inscrire</button>
    </div>
  </form>
</div>

<script>
const translations = <?php echo json_encode($translations); ?>;
let currentStep = 1;

function nextStep() {
  if (validateCurrentStep()) {
    if (currentStep < 3) {
      document.getElementById(`step-${currentStep}`).classList.add('hidden');
      currentStep++;
      document.getElementById(`step-${currentStep}`).classList.remove('hidden');
      updateButtons();
      if (currentStep === 3) {
        displayConfirmationInfo();
      }
    }
  }
}

function previousStep() {
  if (currentStep > 1) {
    document.getElementById(`step-${currentStep}`).classList.add('hidden');
    currentStep--;
    document.getElementById(`step-${currentStep}`).classList.remove('hidden');
    updateButtons();
  }
}

function updateButtons() {
  const prevBtn = document.getElementById('prev-btn');
  const nextBtn = document.getElementById('next-btn');
  const submitBtn = document.getElementById('submit-btn');

  prevBtn.classList.toggle('hidden', currentStep === 1);
  nextBtn.classList.toggle('hidden', currentStep === 3);
  submitBtn.classList.toggle('hidden', currentStep !== 3);
}

function validateCurrentStep() {
  const requiredFields = document.querySelectorAll(`#step-${currentStep} [required]`);
  let isValid = true;

  requiredFields.forEach(field => {
    if (!field.value.trim()) {
      isValid = false;
      field.classList.add('border-red-500');
    } else {
      field.classList.remove('border-red-500');
    }
  });

  if (!isValid) {
    alert('Veuillez remplir tous les champs obligatoires.');
    return false;
  }

  if (currentStep === 1) {
    return validateStep1();
  } else if (currentStep === 2) {
    return validateStep2();
  }

  return true;
}

function validateStep1() {
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm_password').value;

  if (!isValidEmail(email)) {
    alert('Veuillez entrer une adresse email valide.');
    return false;
  }

  if (password !== confirmPassword) {
    alert('Les mots de passe ne correspondent pas.');
    return false;
  }

  if (password.length < 8) {
    alert('Le mot de passe doit contenir au moins 8 caractères.');
    return false;
  }

  return true;
}

function validateStep2() {
  const commanderName = document.getElementById('commander_name').value.trim();
  if (!commanderName) {
    alert('Veuillez entrer un nom de commandant.');
    return false;
  }
  return true;
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function submitRegistration() {
  if (validateCurrentStep()) {
    const form = document.getElementById('registration-form');
    const formData = new FormData(form);

    fetch('actions/register_action.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      alert(data);
      if (data === "Inscription réussie.") {
        window.location.href = 'index.php?page=login';
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      alert('Une erreur est survenue lors de l\'inscription.');
    });
  }
}

function displayConfirmationInfo() {
  const confirmationInfo = document.getElementById('confirmation-info');
  confirmationInfo.innerHTML = `
    <p><strong>${translations.first_name}:</strong> ${document.getElementById('first_name').value}</p>
    <p><strong>${translations.last_name}:</strong> ${document.getElementById('last_name').value}</p>
    <p><strong>${translations.email}:</strong> ${document.getElementById('email').value}</p>
    <p><strong>${translations.commander_name}:</strong> ${document.getElementById('commander_name').value}</p>
    <p><strong>${translations.favorite_game}:</strong> ${document.getElementById('favorite_game').value}</p>
    <p><strong>${translations.favorite_faction}:</strong> ${document.getElementById('favorite_faction').options[document.getElementById('favorite_faction').selectedIndex].text}</p>
    <p><strong>${translations.preferred_language}:</strong> ${document.getElementById('preferred_language').options[document.getElementById('preferred_language').selectedIndex].text}</p>
  `;
}

// Initialisation
updateButtons();
</script>

<?php include 'footer.php'; ?>