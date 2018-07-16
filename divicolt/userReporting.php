<?php
/*
  Template Name: User Reporting
 */
get_header();
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
?>
<style>
    .progress_squre {
        border: 1px solid #eee;
        margin: 100px 0px 100px 20px;
    }
    .progress_squre h2 {
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;
        color: #5a0505;
        text-transform: uppercase;
        background-color: #f4f4f4;
        padding: 10px 15px;
        font-weight: bold;
        font-size: 22px;
    }
    .progress_squre ul {
        margin: 0;
        padding: 20px;
        list-style: none;
    }
    .progress_squre ul li {
        position: relative;
        padding-left: 25px;
        line-height: 1.3;
        padding-bottom: 20px;
        font-size: 12px;
        color: #000;
    }
    .progress_squre ul li:before {
        content: "";
        width: 15px;
        height: 15px;
        background-color: #8d8e8d;
        position: absolute;
        left: 0;
        top: 0;
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .progress_squre ul li.squre_box:before {
        background-color: #5a0f0c;
    }
    .progress_squre ul li.squre_box2:before {
        background-color: #8d8e8d;
    }
    .progress_squre ul li.squre_box3:before {
        background-color: #efa020;
    }
    .progress_squre ul li.squre_box4:before {
        background-color: #5CB85C;
    }
    #main-content .container:before {
        display: none;
    }
    #main-content .container {
        padding-top: 0px;
    }
    .manage_wrap {
    }
    .manage_wrap .inner_wrap {
        width: auto;
        padding-bottom: 40px;
    }
    .manage_wrap .inner_wrap h3 {
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;
        font-weight: bold;
        font-size: 24px;
        color: #590c0a;
        margin-bottom: 2.75%;
    }
    .manage_wrap .inner_wrap h3.expand {
        font-size: 30px;
        position: relative;
        padding-left: 35px;
    }
    .manage_wrap .inner_wrap h3.expand:after {
        content: "";
        position: absolute;
        top: 5px;
        left: 0;
        background:url(<?php bloginfo('url');
?>/wp-content/uploads/2017/09/normal_aero.png) no-repeat;
        width: 20px;
        height: 23px;
    }
    .manage_wrap .inner_wrap h3.expand.active:after {
        background:url(<?php bloginfo('url');
?>/wp-content/uploads/2017/09/normal_aero_active.png) no-repeat;
        width: 23px;
        height: 20px;
    }
    .manage_wrap .inner_wrap p {
        padding-bottom: 0;
        font-family: 'Open Sans', Helvetica, Arial, Lucida, sans-serif;
        font-size: 18px;
        color: #590c0a;
    }
    .manage_wrap .inner_wrap .table_wrap {
        margin-top: 30px;
        text-align: left;
        margin-bottom: 30px;
    }
    #content-area .manage_wrap .inner_wrap .table_wrap thead td {
        background-color: #000 !important;
        color: #fff !important;
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;
        font-size: 15px;
        font-weight: bold;
    }
    #content-area .manage_wrap .inner_wrap .table_wrap table td {
        padding: 0.557em .587em;
        border: 1px solid #525252;
        color: #000;
        background-color: #f2f2f2;
    }
    #content-area .manage_wrap .inner_wrap .table_wrap table td select {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-family: "Open Sans", Arial, sans-serif;
        color: #000;
    }
    #content-area table td a {
        color: #139221;
    }
    #content-area .manage_wrap .inner_wrap .table_wrap tr:nth-child(odd) td {
        background-color: #FFFFFF;
    }
    .manage_wrap .inner_wrap label {
        font-size: 14px;
        margin-right: 20px;
        display: block;
        text-align: left;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .manage_wrap .inner_wrap input[type="text"], .manage_wrap .inner_wrap select, .manage_wrap .inner_wrap input[type="email"] {
        height: 35px;
        font-size: 13px;
        padding: 5px 12px;
        font-weight: 400;
        line-height: 1.42857143;
        color: #3a3a3a;
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #ccc;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        font-family: 'Open Sans', Helvetica, Arial, Lucida, sans-serif;
        width: 100%;
        margin-bottom: 15px;
    }
    .manage_wrap .inner_wrap input[type="submit"], .manage_btn {
        background-color: #5A0505 !important;
        margin-left: 0px;
        color: #fff;
        line-height: 1;
        box-shadow: none;
        padding: 11px 10px;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
        font-size: 17px;
        display: inline-block;
        min-width: 150px;
        border: none;
        font-family: 'Open Sans Condensed',Helvetica,Arial,Lucida,sans-serif !important;
        font-weight: bold;
        font-size: 21px;
        cursor: pointer;
    }
    .manage_wrap .inner_wrap input[type="submit"]:hover, .manage_btn:hover {
        background: #ff9f00!important;
        color: #fff !important;
    }
    .manage_wrap .inner_wrap form p {
        padding-bottom: 0px !important;
    }
    .expandable {
        display: none;
    }
    .custom_width {
        width: 50%;
        float: left;
    }
    /*@media (min-width: 992px) and (max-width: 1199px) {
        .manage_wrap .inner_wrap {
            width: 80%;
        }
    }*/
    @media (min-width: 768px) and (max-width: 991px) {
        .manage_wrap .inner_wrap {
            width: 90%;
        }
        .progress_squre {
            margin: 50px 0px 50px 0px
        }
    }
    @media (max-width: 769px) {
        .manage_wrap .inner_wrap {
            width: 95%;
        }
        .progress_squre {
            margin: 50px 0px 50px 0px
        }
    }
    .h3style {
        width: 100%;
        background-color: #139221;
        color: white !important;
        padding: 10px;
    }
    #content-area .manage_wrap .table_wrap table td {
        padding: 0.557em .587em;
        border: 3px solid #525252;
        color: #000;
        text-align: center;
        vertical-align: top;
        font-size: 14px;
        vertical-align: top;
        line-height: 1.2;
        text-transform: uppercase;
        font-weight: 600;
    }
    #content-area table td a {
        color: #139221;
    }
    .login_user_c {
        position: relative;
        display: none;
        border-top: 1px solid #525252;
        display: block;
        margin: 0px -10px;
        margin-top: 6px;
        padding-top: 6px;
    }
    .login_user_dummy {
        position: relative;
        display: none;
        border-top: 1px solid #525252;
        display: block;
        margin: 0px -10px;
        margin-top: 6px;
        padding-top: 6px;
    }
    .login_user_dummy:after {
        content: "";
        position: absolute;
        top: 0px;
        left: 4px;
        width: 54px;
        height: 54px;
        border: 4px solid #fff200;
        border-radius: 50%;
        display: none;
    }
    h1.entry-title {
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;
        font-weight: bold;
        color: red;
        margin-bottom: 2.75%;
    }
    .table_title {
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;
        color: #f7931d;
        font-weight: 600;
        font-size: 17px;
        margin-bottom: 0;
        margin-top: 33px;
        word-wrap: break-word;
    }
    .col-sm-3 .table_title {
        margin: 0px;
        padding-bottom: 0;
    }
    .progress_title {
        font-weight: 600;
        font-size: 25px;
        margin-top: 30px;
        margin-bottom: 25px;
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;
        color: #5a0505;
        text-transform: uppercase;
        padding-bottom: 0;
    }
    .inner_wrap {
        clear: both;
    }
    .inner_wrap * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .inner_wrap .row {
        margin: 0px -15px;
        overflow: hidden;
    }
    .inner_wrap .row [class*="col-"] {
        float: left;
        padding: 0px 15px;
        min-height: 1px;
    }
    .inner_wrap .row .col-sm-5 {
        width: 43%;
    }
    .inner_wrap .row .col-sm-2 {
        width: 14%;
    }
    .inner_wrap .row .col-sm-3 {
        width: 25%;
    }
    .inner_wrap .row .col-sm-6 {
        width: 50%;
    }
    dd.course_progress {
        margin: 0px !important;
        width: 100%;
        margin-right: 0px !important;
    }
    .course_progress_text {
        text-align: left;
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif !important;
        font-size: 14px !important;
        color: #5a0505 !important;
        font-weight: 700;
        text-transform: uppercase;
        display: block;
        margin-left: -30px;
    }
    .custom_width .row {
        margin-bottom: 20px;
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .custom_width {
            width: 80%;
        }
        .inner_wrap .row .col-sm-2, .inner_wrap .row .col-sm-5 {
            width: auto;
            float: none;
        }
        .manage_wrap .inner_wrap {
            width: 100%;
        }
        .table_title {
            margin-top: 0px;
        }
    }
    @media (max-width: 767px) {
        .manage_wrap {
        }
        .manage_wrap .inner_wrap {
            width: 100%;
        }
        .custom_width {
            width: auto;
        }
        .inner_wrap .row [class*="col-"] {
            width: auto !important;
            float: none;
        }
        .course_progress_text {
            margin-left: 0px;
        }
        .col-sm-3 .table_title {
            margin-bottom: 10px;
        }
        .custom_width .row {
            margin-bottom: 30px;
        }
        .table_title {
            margin-top: 0px;
        }
    }
    @media (max-width: 600px) {
        .manage_wrap {
            width: auto;
        }
        #content-area .manage_wrap .table_wrap table td {
            min-width: inherit;
        }
        #content-area .manage_wrap .table_wrap table td {
            font-size: 11px;
        }
        .login_user_dummy img, .login_user_c img {
            width: 30px;
        }
        .manage_wrap .inner_wrap h3.expand {
            font-size: 22px;
        }
        .login_user_dummy, .login_user_c {
            margin: 0px -5px;
        }
    }

    @media (max-width: 450px) {
        #content-area .manage_wrap .inner_wrap .table_wrap table td{
            padding: 0.557em .317em;

        }

        .login_user_dummy img, .login_user_c img {
            width: 18px;
        }

    }
    #main-content{
        min-height: 482px !important;
        background-color: #fff !important;
    }
</style>

<div id='main-content'>
    <div class='container'>
        <div id='content-area' class='clearfix'>
            <article>
                <div class='entry-content'>
                    <div class='manage_wrap'>
                        <div class='manage_wrap'>
                            <div class='logo'> <img style="padding-top: 30px;padding-bottom: 20px;" src='<?php bloginfo('url'); ?>/wp-content/uploads/2017/11/Team-Member-Reports-Header.png'> </div>
                            <div class='inner_wrap'>
                                <?php
                                $gruop_post = array();
                                $post_users = array();
                                $post_owner = "";
                                $bool = true;
                                $args = array(
                                    'post_type' => 'groups',
                                    'posts_per_page' => '10000',
                                    'orderby' => 'publish_date',
                                    'order' => 'ASC',
                                );
                                $posts_array = get_posts($args);
//                                $course_array = get_posts($args_course);
//                                $course_array = learndash_user_get_enrolled_courses(get_current_user_id(), array(), true);
                                foreach ($posts_array as $post) {
                                    $user_meta = get_user_meta(get_current_user_id(), 'learndash_group_leaders_' . $post->ID);
                                    if (isset($user_meta[0]) && trim($user_meta[0]) != "") {
                                        $bool = true;
                                        $gruop_post[$count] = $user_meta[0];
                                        $count++;
                                        $post_owner = $post->ID;
                                        break;
                                    }
                                }
//                                echo $post_owner;
                                $course_array = learndash_group_enrolled_courses($post_owner);
//                                echo '<pre>';
//                                print_r($course_array);
                                if (trim($post_owner) == "") {
                                    echo "<script> window.location.href = 'https://members.serviceadvisorpro.com/my-dashboard/'</script>";
                                    echo "You don't have any group";
                                    exit;
                                }
                                $count = 0;
                                if (isset($gruop_post) && count($gruop_post) > 0) {
                                    foreach ($gruop_post as $gPost) {
                                        $post_users[] = get_post_meta($gPost, 'learndash_group_users_' . $gPost);
                                    }
                                }
                                ?>
                                <h3 class="expand" id="expand-2" style="color: #5A0505">Login Tracking</h3>
                                <div class="clearfix expandable" id="expandable-2">
                                    <p>View active account access by team member for the past two weeks:</p>
                                    <article>
                                        <?php
                                        $current_monday = date("Y-m-d", strtotime('monday this week'));
                                        $current_saturday = date("Y-m-d", strtotime('sunday this week'));
                                        $prev_monday = date("Y-m-d", strtotime('monday previous week'));
                                        $prev_saturday = date("Y-m-d", strtotime('sunday previous week'));
                                        $prev_arr = array();
                                        $current_arr = array();
                                        for ($i = 0; $i < 7; $i++) {
                                            $prev_arr[$i] = date('Y-m-d', strtotime($prev_monday . ' +' . $i . ' day'));
                                            $current_arr[$i] = date('Y-m-d', strtotime($current_monday . ' +' . $i . ' day'));
                                        }
                                        ?>
                                        <?php
                                        foreach ($post_users[0][0] as $val) {
//                                            if($val == get_current_user_id())
//                                            {
//                                                continue;
//                                            }
                                            $userData = get_user_by('ID', $val);
                                            $name = "";

                                            if (isset($userData->first_name) && trim($userData->first_name) != "") {
                                                $name = $userData->first_name . ' ' . $userData->last_name;
                                            } else {
                                                $name = $userData->user_login;
                                            }

                                            $user_login_history = get_user_meta($val, 'user_login_history');
                                            ?>
                                            <?php ?>
                                            <div class="entry-content">
                                                <div class="manage_wrap">
                                                    <div class="table_wrap">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <h1 class="table_title"><?php echo $name ?></h1>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <table class="table table-bordered table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <?php foreach ($prev_arr as $value) { ?>
                                                                                <td><?php echo date('D', strtotime($value)) . "<br>" . date("m", strtotime($value)) . "/" . date('d', strtotime($value)); ?> <span class="<?php echo in_array(strtotime($value), $user_login_history[0]) ? "login_user_c " : " login_user_dummy " ?>"><?php echo in_array(strtotime($value), $user_login_history[0]) ? "<img src='/wp-content/uploads/2017/09/user_check_icon.png'>" : "<img src='/wp-content/uploads/2017/09/user_check_icon_dummy.png'>" ?></span></td>
                                                                            <?php }
                                                                            ?>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <table class="table table-bordered table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <?php foreach ($current_arr as $value1) { ?>
                                                                                <td><?php
                                                                                    echo date('D', strtotime($value1)) . "<br>" . date("m", strtotime($value1)) . "/" . date('d', strtotime($value1));
                                                                                    ;
                                                                                    ?>
                                                                                    <span class="<?php echo in_array(strtotime($value1), $user_login_history[0]) ? "login_user_c " : " login_user_dummy" ?><?php echo strtotime(date('y-m-d')) == strtotime($value1) ? "" : "" ?>"><?php echo in_array(strtotime($value1), $user_login_history[0]) ? "<img src='/wp-content/uploads/2017/09/user_check_icon.png'>" : "<img src='/wp-content/uploads/2017/09/user_check_icon_dummy.png'>" ?></span></td>
                                                                            <?php }
                                                                            ?>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </article>
                                </div>
                                <h3 class="expand" id="expand-1" style="color: #5A0505">Module Progression</h3>
                                <div class="entry-content expandable" id="expandable-1">
                                    <p style="padding-bottom: 1.5em;">View progress for each team member by module:</p>
                                    <div class="custom_width">
                                        <?php
                                        foreach ($course_array as $course) {
                                            if (sfwd_lms_has_access($course, get_current_user_id())) {
                                                ?>
                                                <h1 class="progress_title"><?php echo get_the_title($course) ?></h1>
                                                <?php
                                                $meta = get_post_meta($course, '_sfwd-courses', true);
                                                $course_access_list = array();
                                                if (!empty($meta['sfwd-courses_course_access_list'])) {
                                                    $course_access_list = explode(',', $meta['sfwd-courses_course_access_list']);
                                                }
//                                    echo '<pre>';
//                                    print_r($course_access_list);
                                                foreach ($post_users[0][0] as $access_users) {
                                                    $tags = wp_get_post_tags($course);
//                                                    echo '<pre>';
//                                                    print_r($tags[0]->name);
                                                    $userData = get_user_by('ID', $access_users);
                                                    if ($userData->user_login == "") {
                                                        continue;
                                                    }
                                                    if (sfwd_lms_has_access($course, $userData->ID)) {
                                                        $name2 = "";
                                                        if (isset($userData->first_name) && trim($userData->first_name) != "") {
                                                            $name2 = $userData->first_name . ' ' . $userData->last_name;
                                                        } else {
                                                            $name2 = $userData->user_login;
                                                        }
                                                        $course_id = $course;
                                                        $user_id = $access_users;
                                                        $markComlete = get_user_meta($user_id, "custom_progress_" . $course_id, false);
                                                        $custom_progress_incomp = get_user_meta($user_id, "custom_progress_incomp_" . $course_id, false);
                                                        $lmsmarkComleted = get_user_meta(get_current_user_id(), "_sfwd-course_progress");
                                                        $list_lesson = learndash_get_course_lessons_list($course_id);
                                                        $total_lessons = count($list_lesson);
                                                        $sections = 100 / $total_lessons;

                                                        $progress = learndash_course_progress(array("user_id" => $user_id, "course_id" => $course_id, "array" => true));
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h1 class="table_title"><?php echo $name2 ?></h1>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <dd class="course_progress">
                                                                    <?php
                                                                    $completed = 0;
                                                                    foreach ($list_lesson as $lessons) {
                                                                        $background_color = "";
                                                                        $test = "";
                                                                        if (isset($markComlete[0][$lessons['post']->ID . "-" . $user_id]) && trim($markComlete[0][$lessons['post']->ID . "-" . $user_id]) == "1") {
                                                                            $background_color = "#5A0505 !important";
                                                                            $test = "a";
                                                                            $completed++;
                                                                        }
                                                                        if (isset($markComlete[0][$lessons['post']->ID . "-" . $user_id]) && trim($markComlete[0][$lessons['post']->ID . "-" . $user_id]) == "2") {
                                                                            $background_color = "#8c8c8c !important";
                                                                            $test = "b";
                                                                            $completed++;
                                                                        }
                                                                        if (isset($markComlete[0][$lessons['post']->ID . "-" . $user_id]) && trim($markComlete[0][$lessons['post']->ID . "-" . $user_id]) >= "3") {
                                                                            $background_color = "#ED9D03 !important";
                                                                            $test = "c";
                                                                            $completed++;
                                                                        }
                                                                        if (isset($custom_progress_incomp[0][$lessons['post']->ID . "-" . $user_id]) && $custom_progress_incomp[0][$lessons['post']->ID . "-" . $user_id] == true) {
                                                                            $background_color = "#F5F5F5 !important";
                                                                            $test = "d";
                                                                        }
                                                                        if (isset($markComlete[0][$lessons['post']->ID . "-" . $user_id]) && count($markComlete[0][$lessons['post']->ID . "-" . $user_id]) > 0) {
                                                                            echo "<div class='course_progress_blue " . $test . "' style='background-color:" . $background_color . "; width: " . $sections . "%;'></div>";
                                                                        } else {
//                                                                        if (isset($lmsmarkComleted[0][$course_id]['lessons'][$lessons['post']->ID]) && $lmsmarkComleted[0][$course_id]['lessons'][$lessons['post']->ID] == 1) {
//                                                                            $progress2 = get_user_meta($user_id, "custom_progress_" . $course_id);
//                                                                            $progress2[0][$lessons['post']->ID . "-" . $user_id] = 1;
////                                                                            update_user_meta($user_id, "custom_progress_" . $course_id, $progress2[0]);
//                                                                            echo "<div class='" . $lessons['post']->ID . " here course_progress_blue " . $test . "' style='background-color:#5A0505 !important; width: " . $sections . "%;'></div>";
////                                                                            $completed++;
//                                                                        } else {
                                                                            echo "<div class='course_progress_blue " . $test . "' style='background-color:#F5F5F5 !important; width: " . $sections . "%;'></div>";
//                                                                        }
                                                                        }
                                                                    }
//    }                                                    
                                                                    $percentage = intVal($completed * 100 / $total_lessons);
                                                                    $percentage = ( $percentage > 100 ) ? 100 : $percentage;
                                                                    ?>
                                                                </dd>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <p class="course_progress_text"><?php echo sprintf(__("%s%% Complete", "learndash"), $percentage) ?></p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                   if($tags[0]->name == "manager")
                                                   {
//                                                       echo 'there';
                                                       break;  
                                                   }
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="custom_width">
                                        <div class="progress_squre">
                                            <h2>Progress Reporting Key</h2>
                                            <ul>
                                                <li class="squre_box">Training completed 1 time in the past 120 days</li>
                                                <li class="squre_box2">Training completed 2 times in the past 120 days</li>
                                                <li class="squre_box3">Training completed 3 or more times in the past 120 days</li>
                                                <li class="squre_box4">Training completed more than 120 days ago</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    jQuery(document).ready(function () {


        jQuery('.expand').click(function () {

            jQuery(this).next().slideToggle('fast');
            jQuery(".expandable").not(jQuery(this).next()).slideUp('fast');

        });


        jQuery('.abc').live('click', function () {
            console.log('here');

            jQuery(this).removeClass('active');
            jQuery(this).removeClass('abc');
        });
        jQuery('#expand-1').click(function () {
            console.log('here111');
            jQuery(this).toggleClass("active")
            jQuery('#expand-2').removeClass('active');

        });


        jQuery('#expand-2').click(function () {
            jQuery(this).toggleClass("active")
            jQuery('#expand-1').removeClass('active');

        });

        /*			
         
         
         
         
         jQuery('.expand').click(function(){
         jQuery(this).toggleClass('active');
         target_num = jQuery(this).attr('id').split('-')[1];
         content_id = '#expandable-'.concat(target_num);
         jQuery(content_id).slideToggle('fast');
         });*/
    });


</script>