<!--Left Sidebar collapse button-->
<div class="collapseBtn leftbar"> <a href="#" class="tipR" title="Hide Left Sidebar"><span class="icon12 minia-icon-layout"></span></a> </div>

<!--Sidebar background-->
<div id="sidebarbg"></div>

<!--Sidebar content-->
<div id="sidebar">
  <div class="shortcuts">
    <!--<ul>
      <li><a href="support.html" title="Support section" class="tip"><span class="icon24 icomoon-icon-support"></span></a></li>
      <li><a href="#" title="Database backup" class="tip"><span class="icon24 icomoon-icon-database"></span></a></li>
      <li><a href="charts.html" title="Sales statistics" class="tip"><span class="icon24 icomoon-icon-pie-2"></span></a></li>
      <li><a href="#" title="Write post" class="tip"><span class="icon24 icomoon-icon-pencil"></span></a></li>
    </ul>-->
    <div style="height: 43px;">&nbsp;</div>
  </div>
  <!-- End search -->
  <div class="sidenav">
    <div class="sidebar-widget" style="margin: -1px 0 0 0;">
      <h5 class="title" style="margin-bottom:0">Navigation</h5>
    </div>
    <!-- End .sidenav-widget -->
    <?php
	$resMainMenu = $instSys->FetchMenuByRole($_SESSION[DB_PREFIX]['r_id'], 0);
	?>
    <div class="mainnav">
      <ul>
      	<?php
		while($arrMainMenu = $resMainMenu->fetch_assoc()) {
			if($arrMainMenu['m_status']<>'A') { continue; }
			if($arrMainMenu['m_display']<>'Y') { continue; }
			if($arrMainMenu['mp_view']<>1) { continue; }
			if($arrMainMenu['m_submenu']==1) { $mainMenu['m_url'] = "javascript:void(0);"; }
			if($arrMainMenu['m_icon']=='') {
				$arrMainMenu['m_icon'] = 'icomoon-icon-play';
			}
		?>
        <li>
          <a href="<?=$arrMainMenu['m_url']?>"><span class="icon16 <?=$arrMainMenu['m_icon']?>"></span><?=$arrMainMenu['m_name']?></a>
          <?php
		  if($arrMainMenu['m_submenu']==1) {
			  $resSubMenu = $instSys->FetchMenuByRole($_SESSION[DB_PREFIX]['r_id'], $arrMainMenu['m_id']);
		  ?>
          <ul class="sub">
          	<?php
			while($arrSubMenu = $resSubMenu->fetch_assoc()) {
				if($arrSubMenu['m_status']<>'A') { continue; }
				if($arrSubMenu['m_display']<>'Y') { continue; }
				if($arrSubMenu['mp_view']<>1) { continue; }
				if($arrSubMenu['m_submenu']==1) { $mainMenu['m_url'] = "javascript:void(0);"; }
				if($arrSubMenu['m_icon']=='') {
					$arrSubMenu['m_icon'] = 'icomoon-icon-play';
				}
			?>
            <li><a href="<?=$arrSubMenu['m_url']?>"><span class="icon16 <?=$arrSubMenu['m_icon']?>"></span><?=$arrSubMenu['m_name']?></a></li>
            <?php
		  	}
			?>
          </ul>
          <?php 
		  }
		  ?>
        </li>
        <?php
		}
		?>
      </ul>
    </div>
  </div>
  <!-- End sidenav -->
  
  <!--<div class="sidebar-widget">
    <h5 class="title">Monthly Bandwidth Transfer</h5>
    <div class="content"> <span class="icon16 icomoon-icon-loop left"></span>
      <div class="progress progress-mini progress-danger left tip" title="87%">
        <div class="bar" style="width: 87%;"></div>
      </div>
      <span class="percent">87%</span>
      <div class="stat">19419.94 / 12000 MB</div>
    </div>
  </div>-->
  <!-- End .sidenav-widget -->
  
  <!--<div class="sidebar-widget">
    <h5 class="title">Disk Space Usage</h5>
    <div class="content"> <span class="icon16 icomoon-icon-drive left"></span>
      <div class="progress progress-mini progress-success left tip" title="16%">
        <div class="bar" style="width: 16%;"></div>
      </div>
      <span class="percent">16%</span>
      <div class="stat">304.44 / 8000 MB</div>
    </div>
  </div>-->
  <!-- End .sidenav-widget -->
  
  <!--<div class="sidebar-widget">
    <h5 class="title">Ad sense stats</h5>
    <div class="content">
      <div class="stats">
        <div class="item">
          <div class="head clearfix">
            <div class="txt">Advert View</div>
          </div>
          <span class="icon16 icomoon-icon-eye left"></span>
          <div class="number">21,501</div>
          <div class="change"> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> 5% </div>
          <span id="stat1" class="spark"></span> </div>
        <div class="item">
          <div class="head clearfix">
            <div class="txt">Clicks</div>
          </div>
          <span class="icon16 icomoon-icon-thumbs-up left"></span>
          <div class="number">308</div>
          <div class="change"> <span class="icon24 icomoon-icon-arrow-down-2 red"></span> 8% </div>
          <span id="stat2" class="spark"></span> </div>
        <div class="item">
          <div class="head clearfix">
            <div class="txt">Page CTR</div>
          </div>
          <span class="icon16 icomoon-icon-heart left"></span>
          <div class="number">4%</div>
          <div class="change"> <span class="icon24 icomoon-icon-arrow-down-2 red"></span> 1% </div>
          <span id="stat3" class="spark"></span> </div>
        <div class="item">
          <div class="head clearfix">
            <div class="txt">Earn money</div>
          </div>
          <span class="icon16 icomoon-icon-coin left"></span>
          <div class="number">$376</div>
          <div class="change"> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> 26% </div>
          <span id="stat4" class="spark"></span> </div>
      </div>
    </div>
  </div>-->
  <!-- End .sidenav-widget -->
  
  <!--<div class="sidebar-widget">
    <h5 class="title">Right now</h5>
    <div class="content">
      <div class="rightnow">
        <ul class="unstyled">
          <li><span class="number">34</span><span class="icon16 icomoon-icon-new-2"></span>Posts</li>
          <li><span class="number">7</span><span class="icon16 icomoon-icon-file"></span>Pages</li>
          <li><span class="number">14</span><span class="icon16 icomoon-icon-list-view"></span>Categories</li>
          <li><span class="number">201</span><span class="icon16 icomoon-icon-tag"></span>Tags</li>
        </ul>
      </div>
    </div>
  </div>-->
  <!-- End .sidenav-widget --> 
  
</div>
<!-- End #sidebar --> 