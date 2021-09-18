 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="<?=base_url('assets/')?>ICON.png"
           
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Survey</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
          <?php if($this->session->userdata('akunn')=='admin'):?>
       
          <li class="nav-item">
            <a href="<?=base_url('Home')?>" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Penilain</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('log out')?>" class="nav-link">
             <i class="nav-iconfas fa-sign-out-alt"></i>
                <p>Log out</p>
            </a>
          </li>

          <?php elseif($this->session->userdata('akun')=='vote'):?>
            <li class="nav-item">
            <a href="<?=base_url('Home')?>" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('log out')?>" class="nav-link">
             <i class="nav-iconfas fa-sign-out-alt"></i>
                <p>Log out</p>
            </a>
          </li>

          <?php endif;?>
          <li class="nav-item">
            <a href="<?=base_url('log out')?>" class="nav-link">
             <i class="nav-iconfas fa-sign-out-alt"></i>
                <p>Log out</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
