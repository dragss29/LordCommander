<?php 
include 'header.php';
$game = $game ?? 'Warhammer 40k'; 
echo "<script>console.log('Game: " . $game . "');</script>";
?>

<div class="container mx-auto mt-10">
  <h2 class="text-3xl font-bold text-center text-white"><?php echo $translations['warhammer_40k']; ?></h2>
  <p class="text-center text-white"><?php echo $translations['welcome']; ?></p>
  
  <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0): ?>
    <?php include 'pages/army_management.php'; ?>
  <?php else: ?>
    <p class="text-center text-white">
      <?php echo $translations['please_login']; ?> 
      <a href="index.php?page=login" class="text-blue-600 underline"><?php echo $translations['login']; ?></a> 
      <?php echo $translations['to_see_create_army']; ?>
    </p>
  <?php endif; ?>
</div>
<script type="module">
import { initializeArmyManagement } from './js/army_management.js';
if (typeof window.isArmyManagementInitialized === 'undefined' || !window.isArmyManagementInitialized) {
  document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM content loaded for <?php echo $game; ?>');
    console.log('Army management script loaded for <?php echo $game; ?>');
    initializeArmyManagement('<?php echo $game; ?>', '<?php echo $_GET['lang'] ?? 'fr'; ?>');
    window.isArmyManagementInitialized = true;
  });
}
</script>

<?php include 'footer.php'; ?>