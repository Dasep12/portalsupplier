<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$sidebar = DB::table('vw_menu')
  ->select('*')
  ->get();

$url = request()->segment(1);
$active = "";
$actives = "";
$show = "";
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

          @if($sd->MenuLevel == 0)
          <li class="nav-item <?= $sd->MenuUrl == $url  ? 'active' : ''  ?>">
            <a href="{{ url($sd->MenuUrl) }}">
              <i class="fa fa-home"></i>
              <p>Dashboard </p>
            </a>
          </li>
          @endif


          <?php
          $cekUrl = DB::table('vw_menu')
            ->where('MenuUrl', $url)
            ->where('ParentMenu', $sd->Menu_id)
            ->where('MenuLevel', 2)
            ->select('*')
            ->get();
          $active = $cekUrl->count() > 0 ? 'active' : '';
          $show = $cekUrl->count() > 0 ? 'show' : '';
          ?>
          @if($sd->MenuLevel == 1)
          <li class="nav-item  {{ $active }}">
            <a data-toggle="collapse" href="#{{ $sd->MenuUrl }}">
              <i class="{{ $sd->MenuIcon }}"></i>
              <p>{{ $sd->MenuName }}</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ $show }}" id="{{ $sd->MenuUrl }}">
              <ul class="nav nav-collapse">
                <?php
                $childMenu = DB::table('vw_menu')
                  ->where('ParentMenu', $sd->Menu_id)
                  ->select('*')
                  ->get();
                ?>
                <?php
                foreach ($childMenu as $ch) :
                  $cekUrls = DB::table('vw_menu')
                    ->where('MenuUrl', $url)
                    ->where('MenuName', $ch->MenuName)
                    ->select('*')
                    ->get();
                  $actives = $cekUrls->count() > 0 ? 'active' : '';
                ?>
                  <li class="{{ $actives }}">
                    <a href="{{ url($ch->MenuUrl) }}">
                      <span class="sub-item">{{ $ch->MenuName }}</span>
                    </a>
                  </li>
                <?php endforeach ?>
              </ul>
            </div>
          </li>
          @endif
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->