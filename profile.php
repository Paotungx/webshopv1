<?php
    $isOther = false;
    if(explode("/", $_SERVER["REQUEST_URI"])[5] != null) {
    $username = explode("/", $_SERVER["REQUEST_URI"])[5];
    $isOther = true;
    }
    $count = 0;
    $tryNext = true;
    $first=true;
    $limit=12;
    include("api.php");
    $use = new instagram();
    if($isOther) {
        $get = $use->get($username);
    } else {
        $get = $use->get("red.pgm");
    }

    $i = $get['data']['user']['edge_owner_to_timeline_media']['edges'];
    $has_next_page = $get['data']['user']['edge_owner_to_timeline_media']['page_info']['has_next_page'];
    $end_cursor = $get['data']['user']['edge_owner_to_timeline_media']['page_info']['end_cursor'];
    $uid = $get['data']['user']['id'];
    $bio = $get['data']['user']['biography'];
    $followed = $get['data']['user']['edge_followed_by']['count'];
    $follow = $get['data']['user']['edge_follow']['count'];
    $post = $get['data']['user']['edge_owner_to_timeline_media']['count'];
    $profile = $get['data']['user']['profile_pic_url_hd'];
    $full_name = $get['data']['user']['full_name'];
    $username = $get['data']['user']['username'];
    $is_private = $get['data']['user']['is_private'];
    $is_verified = $get['data']['user']['is_verified'];
    $last_post = $get['data']['user']['edge_owner_to_timeline_media']['edges'][0]["node"]["thumbnail_src"];
    $thumnail_src = [];

    foreach ($i as $key => $value) {
        $count++;
        $url = $value['node']['thumbnail_src'];
        array_push($thumnail_src, ["pic" => $url]);
    }

    // while ($tryNext) {
    //     $tryNext = false;
    //     if ($has_next_page) {
    //         $get = $use->has_next_page($uid, $end_cursor, $username);
    //         if($get == null) {
    //             $tryNext = false;
    //             break;
    //         }
    //         $i = $get['data']['user']['edge_owner_to_timeline_media']['edges'];
    //         $hash_next_page = $get['data']['user']['edge_owner_to_timeline_media']['page_info']['hash_next_page'];
    //         $end_cursor = $get['data']['user']['edge_owner_to_timeline_media']['page_info']['end_cursor'];
    //         foreach ($i as $key => $value) {
    //             $count++;
    //             $url = $value['node']['thumbnail_src'];
    //             array_push($thumnail_src, ["pic" => $url]);
    //             if($count==$limit) {
    //                 $tryNext=false;
    //                 break;
    //             }
    //         }
    //         $tryNext=true;
    //         $first=false;
    //     }
    // }

    print_r(json_encode([
        "full_name" => $full_name,
        "username" => $username,
        "uid" => $uid,
        "biography" => $bio,
        "followed" => $followed,
        "follow" => $follow,
        "posts" => $post,
        "is_private" => $is_private,
        "is_verified" => $is_verified,
        "profile" => $profile,
        "edges" => $thumnail_src,
        "has_next_page" => $has_next_page,
        "count" => $count,
        "last_post" => $last_post,
    ]));