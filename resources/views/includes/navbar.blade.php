<ul class="navbar-nav navbar-right">
     <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
               <img alt="image" src="<?php echo base_url('assets/img/avatar/avatar-1.png"');?> class="rounded-circle mr-1">
               <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $this->session->userdata('nama'); ?></div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
               <div class="dropdown-title">Terakhir Login Pada <br><?php echo indonesian_date($this->session->last_login) ?></div>
               <a  href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Keluar
               </a>
          </div>
     </li>
</ul>