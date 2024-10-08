<?php

use Illuminate\Support\Facades\DB;

$sidebar = DB::table('vw_menu')->get()->select('*');

?>

<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
            <span>
              Hizrian
              <span class="user-level">Administrator</span>
            </span>
          </a>
          <div class="clearfix"></div>

        </div>
      </div>
      <ul class="nav nav-primary">
        <?php
        foreach ($sidebar as $sd) : ?>
          <li class="nav-item active">
            <a href="{{ url('dashboard') }}">
              <i class="fa fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Database</h4>
          </li>
          <li class="nav-item">
            <a data-toggle="collapse" href="#base">
              <i class="fas fa-cubes"></i>
              <p>Master Data</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="base">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ url('supplier') }}">
                    <span class="sub-item">Supplier</span>
                  </a>
                </li>
                <li>
                  <a href="{{ url('units') }}">
                    <span class="sub-item">Units</span>
                  </a>
                </li>
                <li>
                  <a href="{{ url('category') }}">
                    <span class="sub-item">Category</span>
                  </a>
                </li>
                <li>
                  <a href="{{ url('part') }}">
                    <span class="sub-item">Part Material</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-toggle="collapse" href="#proc">
              <i class="fas fa-layer-group"></i>
              <p>Stock</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="proc">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ url('entrystock') }}">
                    <span class="sub-item">Upload Safe Stock</span>
                  </a>
                </li>
                <li>
                  <a href="{{ url('monitorStock') }}">
                    <span class="sub-item">Monitor Stock</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-toggle="collapse" href="#tools">
              <i class="fas fa-cog"></i>
              <p>Tools</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="tools">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{ url('entrystock') }}">
                    <span class="sub-item">Roles</span>
                  </a>
                </li>
                <li>
                  <a href="{{ url('monitorStock') }}">
                    <span class="sub-item">Users</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->