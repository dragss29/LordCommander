<?php include 'header.php'; ?>

<section class="py-12">
  <div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row items-center">
      <div class="w-full md:w-1/2 mb-8 md:mb-0">
        <h1 class="text-3xl md:text-4xl font-bold text-white text-center md:text-left"><?php echo $translations['welcome']; ?></h1>
        <p class="text-lg md:text-xl mt-4 text-white text-center md:text-left"><?php echo $translations['description']; ?></p>
        <div class="text-center md:text-left">
          <a href="index.php?page=login&lang=<?php echo $language; ?>" class="bg-blue-600 text-white px-6 py-3 mt-6 inline-block rounded hover:bg-blue-700 transition duration-300"><?php echo $translations['start']; ?></a>
        </div>
      </div>
      <div class="w-full md:w-1/2">
        <img src="https://via.placeholder.com/800x600.png?text=Warhammer+Banner" alt="Warhammer Banner" class="w-full h-auto rounded-lg shadow-md">
      </div>
    </div>
  </div>
</section>

<section class="py-12 bg-gray-100">
  <div class="container mx-auto">
    <h2 class="text-3xl font-bold text-center"><?php echo $translations['features']; ?></h2>
    <div class="flex flex-wrap mt-8">
      <div class="w-full md:w-1/3 p-4">
        <div class="bg-white p-6 rounded shadow">
          <h3 class="text-2xl font-semibold"><?php echo $translations['custom_army']; ?></h3>
          <p class="mt-4"><?php echo $translations['custom_army_desc']; ?></p>
        </div>
      </div>
      <div class="w-full md:w-1/3 p-4">
        <div class="bg-white p-6 rounded shadow">
          <h3 class="text-2xl font-semibold"><?php echo $translations['strategies']; ?></h3>
          <p class="mt-4"><?php echo $translations['strategies_desc']; ?></p>
        </div>
      </div>
      <div class="w-full md:w-1/3 p-4">
        <div class="bg-white p-6 rounded shadow">
          <h3 class="text-2xl font-semibold"><?php echo $translations['community']; ?></h3>
          <p class="mt-4"><?php echo $translations['community_desc']; ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-12">
  <div class="container mx-auto">
    <h2 class="text-3xl font-bold text-center"><?php echo $translations['universes']; ?></h2>
    <div class="flex flex-wrap mt-8">
      <div class="w-full md:w-1/2 p-4">
        <div class="bg-white rounded shadow">
          <img src="/contents/w40k.jpg" alt="Warhammer 40 000" class="w-full h-auto rounded-t">
          <div class="p-6">
            <p class="text-2xl font-semibold"><?php echo $translations['warhammer_40k']; ?></p>
            <a href="index.php?page=warhammer40k" class="bg-blue-600 text-white px-4 py-2 mt-4 inline-block rounded"><?php echo $translations['see_more']; ?></a>
          </div>
        </div>
      </div>
      <div class="w-full md:w-1/2 p-4">
        <div class="bg-white rounded shadow">
          <img src="/contents/w.jpg" alt="Warhammer" class="w-full h-auto rounded-t">
          <div class="p-6">
            <p class="text-2xl font-semibold"><?php echo $translations['warhammer']; ?></p>
            <a href="index.php?page=warhammer" class="bg-blue-600 text-white px-4 py-2 mt-4 inline-block rounded"><?php echo $translations['see_more']; ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>