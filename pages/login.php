<?php include 'header.php'; ?>

<div class="container mx-auto mt-20 px-4">
  <h2 class="text-3xl md:text-4xl font-bold text-center text-white mb-8"><?php echo $translations['login']; ?></h2>
  <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <form id="login-form" class="space-y-6">
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username"><?php echo $translations['username']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="text" name="username" id="username" required>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password"><?php echo $translations['password']; ?></label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="password" name="password" id="password" required>
      </div>
      <div class="mb-4">
        <button class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300" type="submit"><?php echo $translations['login']; ?></button>
      </div>
    </form>
    <div class="mt-4 text-center">
      <p class="text-sm text-gray-600"><?php echo $translations['no_account']; ?> <a href="index.php?page=register&lang=<?php echo $language; ?>" class="text-blue-600 hover:underline"><?php echo $translations['register']; ?></a></p>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
document.getElementById('login-form').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const formData = new FormData(this);
  
  fetch('actions/login_action.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    if (data === "success") {
      window.location.href = 'index.php?page=home';
    } else {
      alert(data);
    }
  })
  .catch(error => {
    console.error('Erreur:', error);
    alert('Une erreur est survenue lors de la connexion.');
  });
});
</script>