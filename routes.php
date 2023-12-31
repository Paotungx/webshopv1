<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");
    error_reporting(0);
    ini_set('display_errors', 0);
    get('/', 'page/home.php');
    get('/member/login', 'page/AuthSignin.php');
    get('/member/register', 'page/AuthSignup.php');
    get('/member/home', 'page/home.php');
    get('/member/roulette', '/page/roulette.php');
    get('/member/history', '/page/history.php');
    get('/member/changepassword', '/page/changepassword.php');
    get('/member/logout', 'system/logout.php');
    get('/admin/backend', 'backend/backend.php');
    get('/member/topup', '/page/topup.php');
    get('/admin/backend/managewebsite', 'backend/managewebsite.php');
    get('/admin/backend/redeem', 'backend/redeem.php');
    get('/admin/backend/manageproduct', 'backend/manageproduct.php');
    get('/admin/backend/managestock', 'backend/managestock.php');
    get('/admin/backend/truemoneywallet', 'backend/truemoneywallet.php');
    get('/app/css/mongkuyrai', 'app.css.php');
    get('/api/v1/getitems', 'system/get_json_item.php');
    get('/api/v1/getitems/$id', 'system/get_json_item_view.php');
	get('/api/v1/users/web_profile_info/$i', 'profile.php');

    post('/api/v1/deleteitem', 'system/del_item.php');
    post('/api/v1/deletestock', 'system/del_stock.php');
    post('/api/v1/deleteredeem', 'system/del_redeem.php');
    post('/api/v1/edititem', 'system/edit_item.php');
    post('/api/v1/editstock', 'system/edit_stock.php');
    post('/api/v1/addproduct', 'system/cargo_add.php');
    post('/api/v1/addstock', 'system/add_stock.php');
    post('/api/v1/addredeem', 'system/point_redeem.php');
    post('/api/v1/changediscord', 'system/change_discord.php');
    post('/api/v1/changefacebook', 'system/change_facebook.php');
    post('/api/v1/changewallet', 'system/change_wallet.php');
    post('/api/v1/changeicon', 'system/change_icon.php');
    post('/api/v1/changelogo', 'system/change_logo.php');
    post('/api/v1/changecolor', 'system/change_color.php');
    post('/api/v1/changebanner', 'system/change_banner.php');
    post('/api/v1/changenamestore', 'system/change_namestore.php');
    post('/api/v1/roulette', 'system/roulette.php');
    post('/api/v1/buy/$id', 'system/buyitem.php');
    post('/api/v1/login' , 'system/login.php');
    post('/api/v1/register' , 'system/register.php');
    post('/api/v1/topup/wallet', 'system/topup_wallet.php');
    post('/api/v1/topup/redeem', 'system/redeem.php');
    post('/api/v1/changepassword', 'system/changepassword.php');
    // post('/api/v1/logout', 'system/logout.php');

    any('/404','page/404.php');