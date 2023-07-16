<style>
	body {
		opacity: 0;
		transition: all .2s;
	}
</style>
<div class="bar-icon d-flex content-center ">
    <img src="<?= getBackend("logo", $pdo) ?>" style="max-height: 150px;" alt="">
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
    <h5 class="offcanvas-title" id="LMenuLabel">เมนู BACKEND</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body menu-left">
    <ul class="list-group list-group-flush redz-nav-lmenu bg-transparent">
	  <li class="list-group-item bg-transparent" onClick='location.href = "/member/home"'><i class="fas fa-home-lg"></i> หน้าหลัก</li>
	  <li class="list-group-item bg-transparent" onClick='location.href = "/admin/backend/"'><i class="fas fa-home-lg"></i> หน้าหลัก BACKEND</li>
	  <li class="list-group-item bg-transparent" onClick='location.href = "/admin/backend/managewebsite"'><i class="fas fa-browser"></i> จัดการหน้าเว็บ</li>
	  <li class="list-group-item bg-transparent" onClick='location.href = "/admin/backend/manageproduct"'><i class="fas fa-store"></i> จัดการสินค้า</li>
	  <li class="list-group-item bg-transparent" onClick='location.href = "/admin/backend/managestock"'><i class="fas fa-list"></i> จัดการสต๊อก</li>
	  <li class="list-group-item bg-transparent" onClick='location.href = "/admin/backend/redeem"'><i class="fas fa-gift"></i> จัดการ Redeem</li>
	  <li class="list-group-item bg-transparent" onClick='location.href = "/admin/backend/truemoneywallet"'><i class="fas fa-wallet"></i> ตั้งค่าเบอร์วอเล็ต</li>
	</ul>
  </div>
</div>

<div class="modal fade" id="history" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content b10p">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">History</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
			<tr>
				<th>Cargo</th>
				<th>USERNAME</th>
				<th>PASSWORD</th>
				<th>DATE</th>
			</tr>
			<?php
			$stmt = $pdo->prepare("SELECT * FROM `inbox` WHERE owner_id=?");
			$stmt->execute([$_SESSION["id"]]);
			if ($stmt->rowCount() <= 0) {
			?>
			<tr>
				<td colspan="5" class="table-danger text-center">ไม่พบข้อมูล</td>
			</tr>
			<?php
			}
			foreach ($stmt as $row) {
			?>
			<tr>
				<td><?= $row["cargo"] ?></td>
				<td><?= $row["uid"] ?></td>
				<td><?= $row["pass"] ?></td>
				<td><?= date("d/m/y , h:i:s", $row["date"]) ?></td>
			</tr>
			<?php
				}
			?>
		  </table>
      </div>
    </div>
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