<?php include 'header.php'; ?>

<div class="container mx-auto mt-20 px-4">
  <h2 class="text-3xl md:text-4xl font-bold text-center text-white mb-8"><?php echo $translations['profile']; ?></h2>
  
  <?php
  // Récupérer les informations de l'utilisateur
  $user_id = $_SESSION['user_id'];
  $query = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
  $query->bind_param("i", $user_id);
  $query->execute();
  $result = $query->get_result();
  $user = $result->fetch_assoc();
  ?>

  <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg mb-8">
    <h3 class="text-2xl font-semibold mb-4"><?php echo $translations['user_info']; ?></h3>
    <div class="grid grid-cols-2 gap-4">
      <p><strong><?php echo $translations['first_name']; ?>:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
      <p><strong><?php echo $translations['last_name']; ?>:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
      <p><strong><?php echo $translations['username']; ?>:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
      <p><strong><?php echo $translations['email']; ?>:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      <p><strong><?php echo $translations['commander_name']; ?>:</strong> <?php echo htmlspecialchars($user['user_gamertag']); ?></p>
      <p><strong><?php echo $translations['favorite_game']; ?>:</strong> <?php echo htmlspecialchars($user['favorite_game']); ?></p>
      <p><strong><?php echo $translations['favorite_faction']; ?>:</strong> <?php echo htmlspecialchars($user['favorite_faction']); ?></p>
      <p><strong><?php echo $translations['preferred_language']; ?>:</strong> <?php echo htmlspecialchars($user['preferred_language']); ?></p>
    </div>
    <?php if ($user['profile_image_url']): ?>
      <div class="mt-4">
        <img src="<?php echo htmlspecialchars($user['profile_image_url']); ?>" alt="Profile Image" class="max-w-xs mx-auto rounded-full">
      </div>
    <?php endif; ?>
  </div>

  <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h3 class="text-2xl font-semibold mb-4"><?php echo $translations['additional_info']; ?></h3>
    <!-- Cet espace est laissé vide pour de futures fonctionnalités -->
  </div>
</div>

<?php include 'footer.php'; ?>