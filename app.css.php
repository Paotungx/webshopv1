<?php
    header("Content-type: text/css; charset: UTF-8");
    include("{$_SERVER['DOCUMENT_ROOT']}/db.php");
    // $colors = getBackend("colors", $pdo);
    $stmt = $pdo->prepare("SELECT * FROM `backend` WHERE Settings=?");
    $stmt->execute(["colors"]);
    $colors = $stmt->fetch(PDO::FETCH_ASSOC)["value1"];
    list($r, $g, $b) = sscanf($colors, "#%02x%02x%02x");
?>

@import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
    font-family: 'Kanit', sans-serif;
    outline: none !important;
}

body,html {
    height: 100%;
}

body {
    /*
    background: rgb(89,53,3);
    background: -webkit-gradient(linear, left top, left bottom, from(rgba(89,53,3,1)), to(rgba(0,0,0,1)));
    background: -o-linear-gradient(top, rgba(89,53,3,1) 0%, rgba(0,0,0,1) 100%);
    background: linear-gradient(180deg, rgba(89,53,3,1) 0%, rgba(0,0,0,1) 100%);
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    */
}

.roulette {
}

.bdiscord, bfacebook, a  {
    color: rgba(<?=$r?>, <?=$g?>, <?=$b?>, 1) !important;
}

.bdiscord:hover, bfacebook:hover, a:hover {
    color: rgba(<?=$r?>, <?=$g?>, <?=$b?>, 1) !important;
}

button {
	border-radius: 10px !important;
}

.b10p {
	border-radius: 10px !important;
}


.card{
	border: none !important;
}

.menu-left {
    background-image: url(https://i.imgur.com/AI642Qz.jpg) !important;
    background-repeat: no-pepeat;
    background-size: cover;
    background-position: center;
}

.redz-nav-lmenu i {
	width: 40px;

}

.redz-nav-lmenu li {
	font-size: 1.5rem;
	transition: all .2s;
	border-bottom: none !important;
	cursor: pointer;
}

.redz-nav-lmenu li:hover {
	margin-left: 5px;
	border-left: 5px solid rgba(<?=$r?>, <?=$g?>, <?=$b?>, 1);
	border-bottom: none !important
}

#details-cargo {
	border-radius: 10px;
	padding: 5px;
	border-left: 5px solid rgba(<?=$r?>, <?=$g?>, <?=$b?>, 1);
	background-color: rgba(<?=$r?>, <?=$g?>, <?=$b?>, 0.2);
}

.redzno1label {
    background-color: rgba(<?=$r?>, <?=$g?>, <?=$b?>, 1);
}

.swal-overlay {
    background-color: rgba(<?=$r?>, <?=$g?>, <?=$b?>,.4);
}

.swal-overlay--show-modal .swal-modal {
    border: 1px solid <?=$colors?>;
}

.swal-button {
    background-color: <?=$colors?> !important;
    color: #fff;
}
.border-custom {
    border-color: <?=$colors?> !important;
}

/* width */
::-webkit-scrollbar {
    width: 5px;
  }
  
  /* Track */
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px <?=$colors?>; 
  
  }
   
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: <?=$colors?>; 
  }
  
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: <?=$colors?>; 
  }


.social-button {
    color: <?=$colors?>;
}

.marginshop {
    margin-top: -50px;
    position: relative;
}

.fww:after {
    width: 100%;
    height: 30px;
    background: <?=$colors?>;
    content: '';
    position: absolute;
    right: 0;
    bottom: -30px;
}

.bannerwidth {
    object-fit: cover;
    width: 100%;
    height: 450px !important;
    max-height: 450px !important;
}

.form-group {
    margin-bottom: 1rem;
}

.btnp {
    transition: 250ms ease 0s;
    border-radius: 5px;
    font-size: 14px;
    display: inline-block;
    white-space: nowrap;
    cursor: pointer;
    position: relative;
    font-weight: 700;
    line-height: 16px;
    padding: 15px 40px;
    width: 100%;
    text-transform: uppercase;
    border: none;
}

.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}

.form-row>.col, .form-row>[class*=col-] {
    padding-right: 5px;
    padding-left: 5px;
}

.dropdown-menu.show {
    display: block !important;
}

.image-list-topup {
    vertical-align: middle;
    float: left;
    margin-right: 5px;
    max-width: 54px;
}

label {
    display: inline-block;
    margin-bottom: .5rem;
}

.btn-gray {
    border: solid 1px #ccc;
    background: rgb(238, 238, 238);
}

.btn-gray:hover {
    border: solid 1px #ccc !important;
    background: rgb(238, 238, 238) !important;
}

.btn-gray:active, .btn-gray:focus {
    -webkit-box-shadow: 0 0 0 0.25rem hsla(6, 78%, 66%, 0);
            box-shadow: 0 0 0 0.25rem hsla(6, 78%, 66%, 0);
}


.dropdown-toggle::after {
    right: 15px;
    top: 50%;
    position: absolute;
    display: inline-block;
    margin-left: .255em;
    vertical-align: .255em;
    content: "";
    border-top: .3em solid;
    border-right: .3em solid transparent;
    border-bottom: 0;
    border-left: .3em solid transparent;
}

.list-topup-desc {
    vertical-align: middle;
    color: #aaa;
    display: block;
    overflow: hidden;
    font-weight: normal;
    line-height: 1.4em;
}

.dropdown-item.active, .dropdown-item:active {
    color: #333;
    text-decoration: none;
    background-color: transparent;
}

.h-qwe {
    height: 500px !important;
    width: 100% !important;
}

.weight-light {
    font-weight: 400;
}

.form-action .buttonright {
    position: absolute;
    bottom: 30px;
    right: 0;
}

.div-allow {
    height: 10px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.border-right-0-r {
    border-top-right-radius: 0px;
    border-bottom-right-radius: 0px;
}

.container {
    padding-top: 50px;
}

.bar-icon {
    top: 0;
    z-index: 4;
    position: relative;
    background:  <?=$colors?>;

    display: block;
    height: 80px;
    width: 100%;
}

.g-recaptcha {
    max-height: 78px;
    overflow: hidden;
}

.bar-icon::after {
    content: "";
    border-radius: 360px;
    height: 250px;
    width: 250px;
    z-index: -1;
    background:  <?=$colors?>;
    position: absolute;
    bottom: -25px;
    left: 50%;
    -webkit-transform: translate(-50%,0);
        -ms-transform: translate(-50%,0);
            transform: translate(-50%,0);
}

.bar-icon img{
    position: absolute;
    top: -10px;
    left: 50%;
    -webkit-transform: translate(-50%,0%);
        -ms-transform: translate(-50%,0%);
            transform: translate(-50%,0%);
}

.text-yellow {
    color: <?=$colors?>;
}

.bg-yellow {
    background: rgb(<?=$r?>, <?=$g?>, <?=$b?>,);
    background: -webkit-gradient(linear, left top, right top, from(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)), to(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)));
    background: -o-linear-gradient(left, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
    background: linear-gradient(90deg, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
}

.input-yellow {
    border: 1px solid <?=$colors?>;
    background: rgb(<?=$r?>, <?=$g?>, <?=$b?>);
background: -webkit-gradient(linear, left top, right top, from(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)), to(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)));
background: -o-linear-gradient(left, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
background: linear-gradient(90deg, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
    -webkit-box-shadow: <?=$colors?>;
            box-shadow: <?=$colors?>;
}

.btn-red {
    color: #fff;
    background-color:#E74C3C !important;
}

.btn-red:active,.btn-red:focus {
    -webkit-box-shadow: 0 0 0 0.25rem hsla(6, 78%, 66%, 0.3);
            box-shadow: 0 0 0 0.25rem hsla(6, 78%, 66%, 0.3);
    border-color:#E74C3C;
    background-color: #E74C3C;
}

.btn-yellow {
    color: #fff;
    background: <?=$colors?>;
}

.btn-yellow:hover {
	background-color: rgba(<?=$r?>, <?=$g?>, <?=$b?>, 1);
	border-color: rgba(<?=$r?>, <?=$g?>, <?=$b?>, 1);
	color: #fff;
}

.btn-wallet-point {
    cursor: pointer !important;
    transition: all .3s;
}

.btn-wallet-point:hover {
    background-color: #f3f3f3 !important;
}

.btn-yellow-hover {
    border-radius: 0;
    position: relative;
    border: 1px solid <?=$colors?>;
    background-color: #fff;
    overflow: hidden;
}

.btn-yellow-hover span {
    position: relative;
    z-index: 3;
}


.btn-yellow-hover::after {
    content: "";
    position: absolute;
    top: 0;
    left: -50%;
    background-color: <?=$colors?> !important;
    height: 100%;
    width: 0%;
    z-index: 2;
    transition: all .5s;
    transform: skew(-30deg);
    
}


.btn-yellow-hover:hover::after {
    left: -10px;
    width:150%;
}

.btn-yellow-hover:hover {
    color: #fff;
}


.btn-yellow-hover:active,.btn-yellow-hover:focus {
    color: #000;

    -webkit-box-shadow: 0 0 0 0.25rem rgba(<?=$r?>, <?=$g?>, <?=$b?>, 0.25);
            box-shadow: 0.25 0 0 0.25rem rgba(<?=$r?>, <?=$g?>, <?=$b?>, 0.25);
    background-color:  <1=$colors?>;
}

.btn-yellow:active,.btn-yellow:focus {
    -webkit-box-shadow: 0 0 0 0.25rem rgba(<?=$r?>, <?=$g?>, <?=$b?>, 0.25);
            box-shadow: 0 0 0 0.25rem rgba(<?=$r?>, <?=$g?>, <?=$b?>, 0.25);
    border-color: <?=$colors?>;
    background-color:  <?=$colors?>;
}

.input-yellow:focus {
    color: #495057;
    background-color: #fff;
    border-color: <?=$colors?>;
    outline: 0;
    -webkit-box-shadow: 0 0 0 0.25rem rgba(<?=$r?>, <?=$g?>, <?=$b?>, 0.25);
            box-shadow: 0 0 0 0.25rem rgba(<?=$r?>, <?=$g?>, <?=$b?>, 0.25);
  }

iframe {
    width: 100% !important;
    height: 100% !important;
  }

.border-top {
    border-top-left-radius: 10px !important;
    border-top-right-radius: 10px !important;
}

.border-bottom {
    border-bottom-left-radius: 10px !important;
    border-bottom-right-radius: 10px !important;
}

.card .header-backend {
    color: <?=$colors?>;
    background-color: #fff;
    font-size: 2rem;
    padding: 10px;
    width: 50%;
    border-top-left-radius: 20px !important;
    border-bottom-right-radius: 60px !important;
}

.limit-500 {
    max-height: 210px;
    overflow: hidden;
    overflow-y: scroll;
}

.card .card-header {
    background: rgb(<?=$r?>, <?=$g?>, <?=$b?>);
    background: -webkit-gradient(linear, left top, right top, from(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)), to(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)));
    background: -o-linear-gradient(left, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
    background: linear-gradient(90deg, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
}

.bg-yellow {
    background: <?=$colors?>;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link {
    color: #333 !important;
}

.kbank-box {
    color: #333;
    min-height: 60px;
    border-radius: 3px;
    padding: 15px;
    margin-bottom: 10px;
    overflow: hidden;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link {
    position: relative;
    z-index: 4;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    background: rgb(<?=$r?>, <?=$g?>, <?=$b?>);
    background: -webkit-gradient(linear, left top, right top, from(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)), to(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)));
    background: -o-linear-gradient(left, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
    background: linear-gradient(90deg, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
    border: 1px solid rgb(<?=$r?>, <?=$g?>, <?=$b?>,) !important;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active::after {
    opacity: 0;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link::after{
    position: absolute;
    z-index: -1;
    content: "";
    width: 0%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgb(<?=$r?>, <?=$g?>, <?=$b?>,);
    background: -webkit-gradient(linear, left top, right top, from(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)), to(rgba(<?=$r?>, <?=$g?>, <?=$b?>,1)));
    background: -o-linear-gradient(left, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
    background: linear-gradient(90deg, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 0%, rgba(<?=$r?>, <?=$g?>, <?=$b?>,1) 100%);
    -webkit-transition: all 0.4s;
 -moz-transition: all 0.4s;
 transition: all 0.4s;
}

.nav-tabs .nav-link {
    border: 1px solid rgb(<?=$r?>, <?=$g?>, <?=$b?>,) !important;
    border-radius: 0;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link:hover::after{
    width: 100%;
    border: none;
}

.nav-tabs {
    border-bottom: 1px solid rgb(<?=$r?>, <?=$g?>, <?=$b?>,);
}

.card .card-body {
    /*
    background-color: #231604;
    */
}

.slide-item {
    font-size: 1.8rem;
    background-color: transparent;
    border: none;
    color: #fff;
    top: 50%;
    -webkit-transform: translate(0,-50%);
        -ms-transform: translate(0,-50%);
            transform: translate(0,-50%);
}

.s-left {
    position: absolute;
    left: 10px;
}

.s-right {
    position: absolute;
    right: 10px;
}

.position-relative {
    position: relative;
}

.header-banner::after {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    background-color: rgb(<?=$r?>, <?=$g?>, <?=$b?>);
    opacity: 0.3;
}

#image-cargo {
    vertical-align: middle;
    text-align: center;
    display: inline-block;
    margin: auto;
}

.social-button {
    content: "";
    height: 100px;
    width: 100%;
    padding: 5px;
    position: relative;
    margin-right: 20px;
    font-size: 1.5rem;
}

.social-button i{
    position: absolute;
}

.header-banner .header {
    z-index: 2;
    position: absolute;
    top: 50%;
    transform: translate(0,-50%);
}

.store-item {
    border-radius: 15px;
    transition: all 0.3s;
    width: calc(100% / 3 - 50px);
    display: inline-block;
    float: left;
    margin-right: 25px;
    margin-left: 25px;
    margin-bottom: 10px;
	overflow:hidden !important;
}


.product-btn {
    display: block;
    width: 100%;
    border: 0;
    cursor: pointer;
    padding: 10px 10px !important;
    color: #fff;
    font-weight: 600;
    font-size: 15px;
    transition: 250ms ease 0s;
	border-radius: 10px;
}

.store-item:hover {
    transform: translate(0, -10px);
}

.store-item img {
    width: calc(100% / 1);
    
    -o-object-fit: cover;
       object-fit: cover;
}

.btn-slide-item {
    border: 0;
    background-color: transparent;
    color: #231604;
    font-size: 1rem;
}

.store-item button {
    border: none;
    width: 100%;
    padding: 5px;
    transition-duration: 0.4s;
}
/*
.store-item button:hover {
    color: #fff;
    background: rgb(243,156,18);
    background: -o-linear-gradient(190deg, rgba(243,156,18,1) 0%,rgba(243,156,18,1) 100%);
    background: linear-gradient(260deg, rgba(243,156,18,1) 0%,rgba(243,156,18,1) 100%);
}

.store-item button:active,button:focus {
    background: rgb(243,156,18);
    background: -o-linear-gradient(190deg,  rgba(255,204,0,1) 0%, rgba(255,204,0,1) 100%);
    background: linear-gradient(260deg,  rgba(255,204,0,1) 0%, rgba(255,204,0,1) 100%);
}
*/


@media (max-width: 1398px) {


    .store-item {
        width: calc(100% / 2 - 20px);
        display: inline-block;
        float: left;
        margin-right: 10px;
        margin-left: 10px;
		overflow:hidden !important;
    }

}

@media (max-width: 766px) {


    .store-item {
        width: calc(100% / 1 - 20px);
        display: inline-block;
        float: left;
        margin-right: 10px;
        margin-left: 10px;
		overflow:hidden !important;
    }

}


@media (max-width: 1200.5px) {
    
    .h-qwe {
        height: 300px !important;
    }

    .w-qwe {
        width: 100% !important;
    }

}

* {
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
  }


  .image img {
	width: 100%;
  }

/* This is a compiled file, you should be editing the file in the templates directory */
.pace {
    -webkit-pointer-events: none;
    pointer-events: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }
  
  .pace-inactive {
    display: none;
  }
  
  .pace .pace-progress {
    background: <?=$colors?>;
    position: fixed;
    z-index: 2000;
    top: 0;
    right: 100%;
    width: 100%;
    height: 2px;
  }
  
  .pace .pace-progress-inner {
    display: block;
    position: absolute;
    right: 0px;
    width: 100px;
    height: 100%;
    box-shadow: 0 0 10px <?=$colors?>, 0 0 5px <?=$colors?>;
    opacity: 1.0;
    -webkit-transform: rotate(3deg) translate(0px, -4px);
    -moz-transform: rotate(3deg) translate(0px, -4px);
    -ms-transform: rotate(3deg) translate(0px, -4px);
    -o-transform: rotate(3deg) translate(0px, -4px);
    transform: rotate(3deg) translate(0px, -4px);
  }
  
  .pace .pace-activity {
    display: block;
    position: fixed;
    z-index: 2000;
    top: 15px;
    right: 15px;
    width: 14px;
    height: 14px;
    border: solid 2px transparent;
    border-top-color: <?=$colors?>;
    border-left-color: <?=$colors?>;
    border-radius: 10px;
    -webkit-animation: pace-spinner 400ms linear infinite;
    -moz-animation: pace-spinner 400ms linear infinite;
    -ms-animation: pace-spinner 400ms linear infinite;
    -o-animation: pace-spinner 400ms linear infinite;
    animation: pace-spinner 400ms linear infinite;
  }
  
  @-webkit-keyframes pace-spinner {
    0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
  }
  @-moz-keyframes pace-spinner {
    0% { -moz-transform: rotate(0deg); transform: rotate(0deg); }
    100% { -moz-transform: rotate(360deg); transform: rotate(360deg); }
  }
  @-o-keyframes pace-spinner {
    0% { -o-transform: rotate(0deg); transform: rotate(0deg); }
    100% { -o-transform: rotate(360deg); transform: rotate(360deg); }
  }
  @-ms-keyframes pace-spinner {
    0% { -ms-transform: rotate(0deg); transform: rotate(0deg); }
    100% { -ms-transform: rotate(360deg); transform: rotate(360deg); }
  }
  @keyframes pace-spinner {
    0% { transform: rotate(0deg); transform: rotate(0deg); }
    100% { transform: rotate(360deg); transform: rotate(360deg); }
  }
  