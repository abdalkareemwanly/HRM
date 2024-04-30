<div class="flex">
  <!-- sidebar section  -->
  <?php
  $isDepartmentsManagement = strpos($_SERVER['PHP_SELF'], 'departments_management.php') !== false;
  $isDepCategoriesManagement = strpos($_SERVER['PHP_SELF'], 'dep_categories_management.php') !== false;
  $activeClass = '';
  if ($isDepartmentsManagement || $isDepCategoriesManagement) {
    $activeClass = 'nav-btn-active';
  }
  ?>
  <div class="sidebar bg-secondColor text-white flex fixed-top flex-column flex-shrink-0 p-3  "
    style="width: 280px; min-height: 100vh; height: 100%">
    <ion-icon id="side-close-icon" name="close-outline" size="large"></ion-icon>
    <a class="flex align-items-center mb-3 mt-3 mb-md-0 me-md-auto  text-decoration-none">
      <span class="text-4xl font-semibold"> الإدارة</span>
    </a>
    <ul class="flex flex-col w-full gap-4 mt-10 px-4">
      <li class="<?php echo $activeClass; ?> nav-btn">
        <a href="departments_management.php" class="w-full block"> ادارة الاقسام </a>
      </li>
      <li
        class="<?php echo (strpos($_SERVER['PHP_SELF'], 'accounts_management.php') !== false) ? 'nav-btn-active' : ''; ?> nav-btn ">
        <a href="accounts_management.php" class="w-full block"> ادارة الموظفين </a>
      </li>

    </ul>
  </div>
  <!-- sidebar section  -->
  <!-- start the main container for content  -->
  <div class="main-container h-full bg-mainColor">
    <nav class="py-3 w-full flex justify-between items-center px-4 text-white ">
      <div class="flex gap-2 items-center">
        <ion-icon id="side-show-icon" name="reorder-four-outline" size="large"></ion-icon>

      </div>
      <a href="../../logout.php" class="underline text-redColor">تسجيل الخروج</a>
    </nav>
    <div
      style="background-image: url('../../assets/imgs/Background Image.png'); background-repeat: no-repeat; background-size: cover; background-position: center"
      class=" h-[100px]  mx-auto m-4  w-[75%] rounded-xl relative flex justify-center items-center ">
      <div class="absolute  z-[10] rounded-xl bg-[#22222275] inset-0 w-full h-full"></div>
      <h2 class="text-4xl absolute z-[11] font-bold text-white">
        <?php echo $page_title ?>
      </h2>
    </div>
    <!-- start the main container for content  -->