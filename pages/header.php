<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lord Commander</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom, #2563eb, #ffffff);
    }
    #mobile-menu {
      position: fixed;
      top: 0;
      right: 0;
      height: 100%;
      width: 250px;
      background-color: #2563eb;
      z-index: 1000;
      display: flex;
      flex-direction: column;
      padding: 1rem;
      transform: translateX(100%);
      transition: transform 0.3s ease-in-out;
    }
    #mobile-menu.open {
      transform: translateX(0);
    }
    #mobile-menu a {
      margin-bottom: 1rem;
      color: white;
    }
    .overflow-hidden {
      overflow: hidden;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen">
  <header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto text-center">
      <h1 class="text-4xl font-bold">Lord Commander</h1>
      <h2 class="text-2xl">L'application pour les passionnés de Warhammer</h2>
    </div>
    <nav class="bg-blue-600">
      <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
          <div class="flex-1 flex justify-between items-center">
            <div class="flex-shrink-0">
            <a href="?lang=fr<?php echo isset($_GET['page']) ? '&page=' . $_GET['page'] : ''; ?>" class="text-white" onclick="updatePreferredLanguage('fr'); return true;">🇫🇷</a>
  <a href="?lang=en<?php echo isset($_GET['page']) ? '&page=' . $_GET['page'] : ''; ?>" class="text-white" onclick="updatePreferredLanguage('en'); return true;">🇬🇧</a>
  <a href="?lang=it<?php echo isset($_GET['page']) ? '&page=' . $_GET['page'] : ''; ?>" class="text-white" onclick="updatePreferredLanguage('it'); return true;">🇮🇹</a>

            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <a class="text-white hover:bg-blue-700 px-3 py-2 rounded-md" href="index.php?page=home&lang=<?php echo $language; ?>"><?php echo $translations['home']; ?></a>
                <a class="text-white hover:bg-blue-700 px-3 py-2 rounded-md" href="index.php?page=warhammer&lang=<?php echo $language; ?>">⚔️ Warhammer</a>
                <a class="text-white hover:bg-blue-700 px-3 py-2 rounded-md" href="index.php?page=warhammer40k&lang=<?php echo $language; ?>">🔫 Warhammer 40 000</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                  <a class="text-white hover:bg-blue-700 px-3 py-2 rounded-md" href="index.php?page=profile&lang=<?php echo $language; ?>"><?php echo $translations['profile']; ?></a>
                  <a class="text-white hover:bg-blue-700 px-3 py-2 rounded-md" href="actions/logout_action.php"><?php echo $translations['logout']; ?></a>
                <?php else: ?>
                  <a class="text-white hover:bg-blue-700 px-3 py-2 rounded-md" href="index.php?page=register&lang=<?php echo $language; ?>"><?php echo $translations['register']; ?></a>
                  <a class="text-white hover:bg-blue-700 px-3 py-2 rounded-md" href="index.php?page=login&lang=<?php echo $language; ?>"><?php echo $translations['login']; ?></a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <div class="flex space-x-2">
              <a href="?lang=fr<?php echo isset($_GET['page']) ? '&page=' . $_GET['page'] : ''; ?>" class="text-white" onclick="updatePreferredLanguage('fr'); return true;">🇫🇷</a>
<a href="?lang=en<?php echo isset($_GET['page']) ? '&page=' . $_GET['page'] : ''; ?>" class="text-white" onclick="updatePreferredLanguage('en'); return true;">🇬🇧</a>
<a href="?lang=it<?php echo isset($_GET['page']) ? '&page=' . $_GET['page'] : ''; ?>" class="text-white" onclick="updatePreferredLanguage('it'); return true;">🇮🇹</a>
</div>
            </div>
          </div>
          <div class="md:hidden">
            <button id="menu-toggle" class="text-white hover:text-gray-300 focus:outline-none focus:text-gray-300">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>
        </div>
      </div>
      <div id="mobile-menu" class="md:hidden">
        <button id="close-menu" class="text-white text-xl mb-4">&times;</button>
        <a class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md" href="index.php?page=home&lang=<?php echo $language; ?>"><?php echo $translations['home']; ?></a>
        <a class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md" href="index.php?page=warhammer&lang=<?php echo $language; ?>">⚔️ Warhammer</a>
        <a class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md" href="index.php?page=warhammer40k&lang=<?php echo $language; ?>">🔫 Warhammer 40 000</a>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md" href="index.php?page=profile&lang=<?php echo $language; ?>"><?php echo $translations['profile']; ?></a>
          <a class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md" href="actions/logout_action.php"><?php echo $translations['logout']; ?></a>
        <?php else: ?>
          <a class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md" href="index.php?page=register&lang=<?php echo $language; ?>"><?php echo $translations['register']; ?></a>
          <a class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md" href="index.php?page=login&lang=<?php echo $language; ?>"><?php echo $translations['login']; ?></a>
        <?php endif; ?>
      </div>
    </nav>
  </header>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var menuToggle = document.getElementById('menu-toggle');
    var mobileMenu = document.getElementById('mobile-menu');
    var closeMenu = document.getElementById('close-menu');

    menuToggle.addEventListener('click', function() {
      mobileMenu.classList.toggle('open');
      document.body.classList.toggle('overflow-hidden');
    });

    closeMenu.addEventListener('click', function() {
      mobileMenu.classList.remove('open');
      document.body.classList.remove('overflow-hidden');
    });

    document.addEventListener('click', function(event) {
      if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target) && mobileMenu.classList.contains('open')) {
        mobileMenu.classList.remove('open');
        document.body.classList.remove('overflow-hidden');
      }
    });

    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape' && mobileMenu.classList.contains('open')) {
        mobileMenu.classList.remove('open');
        document.body.classList.remove('overflow-hidden');
      }
    });
  });

  function updatePreferredLanguage(lang) {
    if (<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
      fetch('actions/update_language.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'lang=' + lang
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          console.log('Langue mise à jour avec succès');
          if (data.reload) {
            window.location.reload();
          }
        } else {
          console.error('Erreur lors de la mise à jour de la langue');
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
      });
    } else {
      window.location.reload();
    }
  }
  </script>
  <main class="flex-grow mb-16">