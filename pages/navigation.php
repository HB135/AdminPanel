<?php
echo "
	<!-- Navigation bar -->
    <div class='l-navbar' id='nav-bar'>
        <nav class='nav'>
            <div>
              <a href='index.php' class='nav_logo'> <i class='bx bx-layer nav_logo-icon'></i> <span class='nav_logo-name'>K1J Ltd</span> </a>
                <div class='nav_list'>
                  <a href='index.php' class='nav_link active'> <i class='bx bx-grid-alt nav_icon'></i> <span class='nav_name'>Dashboard</span> </a>

                  <a href='pages/dashboard.php' class='nav_link'> <i class='bx bx-grid-alt nav_icon'></i> <span class='nav_name'>Dashboard</span> </a>

                  <a href='admins.php' class='nav_link'> <i class='bx bxs-user-detail nav_icon'></i> <span class='nav_name'>Admins</span> </a>

                  <a href='graph.php' class='nav_link'> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class='nav_name'>Stats</span> </a>

                  <a href='users.php' class='nav_link'> <i class='bx bx-list-ul nav_icon'></i> <span class='nav_name'>Users | Customers</span> </a>

                  <a href='products.php' class='nav_link'> <i class='bx bx-store-alt nav_icon'></i> <span class='nav_name'>Products</span> </a>

                  <a href='profile.php' class='nav_link'> <i class='bx  bx-user nav_icon'></i> <span class='nav_name'>Profile</span> </a>

                  <a href='log.txt' class='nav_link'> <i class='bx bx-message-square-detail nav_icon'></i> <span class='nav_name'>Log</span> </a>

                </div>
            </div> <a href='logout.php' class='nav_link'> <i class='bx bx-log-out nav_icon'></i> <span class='nav_name'>SignOut</span> </a>
        </nav>
    </div>";
?>