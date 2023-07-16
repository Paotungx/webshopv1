<style>
	body {
		opacity: 0;
		transition: all .2s;
	}
</style>
<div class="bar-icon d-flex content-center ">
    <img onClick='location.href = "/member/home"' src="<?= getBackend("logo", $pdo) ?>" style="max-height: 150px;cursor:pointer;" alt="">
	<button class="text-white border-0 bg-transparent d-grid justify-content-center content-center p-3 " data-bs-toggle="offcanvas" data-bs-target="#LMenu" aria-controls="LMenu">
		<i class="fas fa-bars h4 m-auto"></i>
	</button>
	
	<div class="ms-auto d-flex content-center">
		<button class="text-white border-0 bg-transparent d-grid justify-content-center content-center p-3 ms-auto" onClick='location.href = "/member/history"'>
			<i class="far fa-shopping-cart h4 m-auto"></i>
		</button>

		<button class="text-white border-0 bg-transparent d-grid justify-content-center content-center p-3 ms-auto" onClick='location.href = "/member/logout"'>
			<i class="far fa-sign-out h4 m-auto"></i>
		</button>
	</div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="LMenu" aria-labelledby="LMenu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="LMenuLabel">เมนู</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body menu-left">
    <ul class="list-group list-group-flush redz-nav-lmenu bg-transparent">
	  <li class="list-group-item bg-transparent" onClick='location.href = "/member/home"'><i class="fas fa-home-lg"></i> หน้าหลัก</li>
	  <li class="list-group-item bg-transparent"  onClick='location.href = "/member/roulette"'><i class="fas fa-coin"></i> สุ่มพอยท์</li>
	  <li class="list-group-item bg-transparent" onClick='location.href = "/member/topup"'><i class="fas fa-wallet"></i> เติมพอยท์</li>
	  <li class="list-group-item bg-transparent" onClick='location.href = "/member/changepassword"'><i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</li>
	<?php
		if($_SESSION["role"] == 1) {
	?>
		<li class="list-group-item bg-transparent" onClick='location.href = "/admin/backend"'><i class="fas fa-users-cog"></i> จัดการหลังร้าน</li>
	<?php
		}
	?>
	</ul>
  </div>
</div>

<div class="position-relative header-banner animate__animated animate__fadeInDown">
    <img src="<?= getBackend("banner", $pdo) ?>" class="img-fluid bannerwidth" alt="">
    <div class="container py-0">
        <div class="header font-weight-bold h1">
            <span class="text-yellow"><?= getBackend("storename", $pdo) ?></span>
            <small class="h4 text-white d-block">ระบบเติมเงินอัตโนมัติ</small>
            <small class="h4 d-block text-white" style="line-height:10px;">สามารถซื้อได้ตลอด 24 ชั่วโมง</small>
            <br>
            <div class="p-1 font-weight-light h6 bg-white position-relative btn-wallet-point d-inline-block" onclick="location.href = '/member/topup'"><i class="far fa-wallet px-2"></i> ยอดเงินคงเหลือ ฿ <?= number_format($_SESSION["point"], 2) ?> <div class="px-2 d-inline-block"> </div> <i class="fal fa-angle-right" style="position: absolute; right: 10px; top: 6px;"></i></div>
        </div>
    </div>
</div>