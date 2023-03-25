<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\lib\session.php";
Session::checkSession();
?>
<header>
        <h2>
          <label for="nav-toggle">
            <span class="las la-bars"> </span>
          </label>
          Dashboard
        </h2>

        <div class="admin-search-wrapper">
          <span class="las la-search"></span>
          <input type="search" placeholder="Search here" />
        </div>

        <div class="admin-user-wrapper">
          <img
            src="assets/images/pic-1.png"
            width="40px"
            height="40px"
            alt=""
          />
          <div>
            <h4>
              <?php echo Session::get('adminName'); ?>
              <small>Super admin</small>
              <small>
              <?php if (isset($_GET["action"]) && $_GET["action"] == "logout") {
                Session::destroy();
              } ?>
                <a href="?action=logout">Đăng xuất</a>
              </small>

            </h4>
          </div>
        </div>
      </header>