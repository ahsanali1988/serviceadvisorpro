<?php

/*

  DiviColt Functions

 */

function divicolt_enqueue_styles() {

    $parent_style = 'divi-style';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'divicolt_enqueue_styles');



include('inc/builder.php'); // Enable The Builder for All Custom Post Types

/* Comment the following line if you want to enable only the builder */

include('inc/box.php'); // Enable Divi Settings for All Custom Post Type

require_once("activecampaign-api-php/includes/ActiveCampaign.class.php");

/* Add your custom functions after this line */

function my_et_builder_post_types($post_types) {

    $post_types[] = 'sfwd-courses';

    $post_types[] = 'sfwd-lessons';

    $post_types[] = 'sfwd-topic';

    $post_types[] = 'sfwd-quiz';

    $post_types[] = 'sfwd-certificates';

    $post_types[] = 'sfwd-assignment';



    return $post_types;
}

add_filter('et_builder_post_types', 'my_et_builder_post_types');

function rkk_widgets_init() {



    register_sidebar(array(
        'name' => __('bbPress Sidebar', 'rkk'),
        'id' => 'bbp-sidebar',
        'description' => __('A sidebar that only appears on bbPress pages', 'rkk'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'rkk_widgets_init');

add_action("learndash_lesson_completed", function($data) {
//    $data['user']->ID
    $progress = get_user_meta(get_current_user_id(), "custom_progress_" . $data['course']->ID, false);

    if (isset($progress) && count($progress) > 0) {
        if (isset($progress[0][$data['lesson']->ID . "-" . $data['user']->ID]) && trim($progress[0][$data['lesson']->ID . "-" . $data['user']->ID]) != "") {
            $progress[0][$data['lesson']->ID . "-" . $data['user']->ID] = $progress[0][$data['lesson']->ID . "-" . $data['user']->ID] + 1;
            if ($progress[0][$data['lesson']->ID . "-" . $data['user']->ID] >= 3) {
                $progress[0][$data['lesson']->ID . "-" . $data['user']->ID] = 3;
                update_user_meta(get_current_user_id(), "custom_progress_third_time_" . $data['lesson']->ID, strtotime(date('y-m-d')));
            }
            if ($progress[0][$data['lesson']->ID . "-" . $data['user']->ID] == 2) {
                update_user_meta(get_current_user_id(), "custom_progress_second_time_" . $data['lesson']->ID, strtotime(date('y-m-d')));
            }
            update_user_meta(get_current_user_id(), "custom_progress_" . $data['course']->ID, $progress[0]);
//      mail("ahsancheema26@gmail.com", 'lessons', print_r($progress[0],true));
        } else {
            $progress[0][$data['lesson']->ID . "-" . $data['user']->ID] = 1;

            update_user_meta(get_current_user_id(), "custom_progress_" . $data['course']->ID, $progress[0]);
            update_user_meta(get_current_user_id(), "custom_progress_first_time_" . $data['lesson']->ID, strtotime(date('y-m-d')));
        }
    } else {
        $progress[0][$data['lesson']->ID . "-" . $data['user']->ID] = 1;
        update_user_meta(get_current_user_id(), "custom_progress_" . $data['course']->ID, $progress[0]);
        update_user_meta(get_current_user_id(), "custom_progress_first_time_" . $data['lesson']->ID, strtotime(date('y-m-d')));
    }
    $custom_progress_incomp = get_user_meta(get_current_user_id(), "custom_progress_incomp_" . $data['course']->ID, false);
    if (isset($custom_progress_incomp) && count($custom_progress_incomp) > 0) {
        if (isset($custom_progress_incomp[0][$data['lesson']->ID . "-" . get_current_user_id()]) && trim($custom_progress_incomp[0][$data['lesson']->ID . "-" . get_current_user_id()]) == true) {
            $custom_progress_incomp[0][$data['lesson']->ID . "-" . get_current_user_id()] = false;
            update_user_meta(get_current_user_id(), "custom_progress_incomp_" . $data['course']->ID, $custom_progress_incomp[0]);
//      mail("ahsancheema26@gmail.com", 'lessons_function', print_r($custom_progress_incomp[0],true));
        } else {
            $custom_progress_incomp[0][$data['lesson']->ID . "-" . get_current_user_id()] = false;
            update_user_meta(get_current_user_id(), "custom_progress_incomp_" . $data['course']->ID, $custom_progress_incomp[0]);
        }
    }
}, 5, 1);

function your_function($user_login, $user) {
//    mail('ahsancheema26@gmail.com', 'courses access', print_r($user, true));
//    $first_time = get_user_meta($user->ID, 'custom_progress_first_time_' . 118348);
//     mail('ahsancheema26@gmail.com', 'temp array', print_r($first_time, true));
    if (isset($user) && trim($user->ID) != "") {
        $user_courses = learndash_user_get_enrolled_courses($user->ID);
//        mail('ahsancheema26@gmail.com', 'courses access inner', print_r($user_courses, true));
        $temp = array();
        $bool = array();
        foreach ($user_courses as $course) {
            $list_lesson = learndash_get_course_lessons_list($course);
            foreach ($list_lesson as $lessons) {
                $first_time = get_user_meta($user->ID, 'custom_progress_first_time_' . $lessons['post']->ID);
                $second_time = get_user_meta($user->ID, 'custom_progress_second_time_' . $lessons['post']->ID);
                $third_time = get_user_meta($user->ID, 'custom_progress_third_time_' . $lessons['post']->ID);

                $today = strtotime(date('y-m-d'));
                if (isset($first_time[0])) {
                    $days_between_first_lesson_interval = abs($today - $first_time[0]);
                    $days_between_first_lesson = round($days_between_first_lesson_interval / 86400);
                } else {
                    $days_between_first_lesson = 0;
                }
                if (isset($second_time[0])) {
                    $days_between_second_lesson_interval = abs($today - $second_time[0]);
                    $days_between_second_lesson = round($days_between_second_lesson_interval / 86400);
                } else {
                    $days_between_second_lesson = 0;
                }
                if (isset($third_time[0])) {
                    $days_between_third_lesson_interval = abs($today - $third_time[0]);
                    $days_between_third_lesson = round($days_between_third_lesson_interval / 86400);
                } else {
                    $days_between_third_lesson = 0;
                }

                if ($days_between_first_lesson >= 120) {
                    $progress = get_user_meta($user->ID, "custom_progress_" . $course, false);
                    $progress[0][$lessons['post']->ID . "-" . $user->ID] = $progress[0][$lessons['post']->ID . "-" . $user->ID] - 1;
                    update_user_meta($user->ID, "custom_progress_" . $course, $progress[0]);
                    delete_user_meta($user->ID, 'custom_progress_first_time_' . $lessons['post']->ID);
                    $temp[] = $days_between_first_lesson;
                }
                if ($days_between_second_lesson >= 120) {
                    $progress = get_user_meta($user->ID, "custom_progress_" . $course, false);
                    $progress[0][$lessons['post']->ID . "-" . $user->ID] = $progress[0][$lessons['post']->ID . "-" . $user->ID] - 1;
                    update_user_meta($user->ID, "custom_progress_" . $course, $progress[0]);
                    delete_user_meta($user->ID, 'custom_progress_second_time_' . $lessons['post']->ID);
                    $temp[] = $days_between_second_lesson;
                }
                if ($days_between_third_lesson >= 120) {
                    $progress = get_user_meta($user->ID, "custom_progress_" . $course, false);
                    $progress[0][$lessons['post']->ID . "-" . $user->ID] = $progress[0][$lessons['post']->ID . "-" . $user->ID] - 1;
                    update_user_meta($user->ID, "custom_progress_" . $course, $progress[0]);
                    delete_user_meta($user->ID, 'custom_progress_third_time_' . $lessons['post']->ID);
                    $temp[] = $days_between_third_lesson;
                }
//                break;
            }
        }
    }
}

add_action('wp_login', 'your_function', 10, 2);

add_action('user_register', 'myplugin_registration_save', 10, 1);

function myplugin_registration_save($user_id) {
    if (isset($_REQUEST['contact']['tags']) && strpos($_REQUEST['contact']['tags'], 'SAP-Main Owner')) {

        $userData = get_user_by('email', $_REQUEST['contact']['email']);
        $groupleaders = learndash_all_group_leaders();
        $temp = true;
        foreach ($groupleaders as $users) {
            if ($userData->ID == $users->ID) {
                $temp = false;
            }
        }
        if ($temp) {
            $access_group['group_leader'] = true;
            $id = wp_insert_post(array('post_title' => 'SAP Owner-' . $_REQUEST['contact']['id'], 'post_status' => 'publish', 'post_type' => 'groups'));
            update_post_meta($id, 'group_leader_id', $user_id);
            update_user_meta($userData->ID, "wps8_capabilities", $access_group);
            update_user_meta($userData->ID, 'learndash_group_leaders_' . $id, $id);
            $groupUsers[0] = $user_id;
            update_post_meta($id, 'learndash_group_users_' . $id, $groupUsers);

            $postdub = get_post($id);
            if ($postdub->post_name == 'sap-owner-' . $_REQUEST['contact']['id'] . '-2') {
                wp_delete_post($id);
            } else {
                ld_update_course_group_access(118061, $id);
                ld_update_course_group_access(118362, $id);
                ld_update_course_group_access(118401, $id);
                ld_update_course_group_access(118436, $id);
                ld_update_course_group_access(118455, $id);
                ld_update_course_group_access(118455, $id);
                ld_update_course_group_access(118486, $id);
            }
        } else {
//            
        }
    }
}

add_action('password_reset', 'my_password_reset', 10, 2);

function my_password_reset($user, $new_pass) {
    $ac = new ActiveCampaign("https://gjbishopenterprises.api-us1.com", "c6e59aa5ab9521e73b734892593bf042472abc83bcca9ca0f0a742cc30bd4e44b0a6c6b6");
    $list_id = 13;
    if (isset($user->ID) && trim($new_pass) != "") {
        $userID = $user->ID;
        $user = get_user_meta($userID);
        $userData = get_user_by('ID', $userID);
//    echo '<pre>';
//    print_r($user['memberium_ac_contact_id'][0]);
//    print_r($userData->user_email);
        $contact = array(
            "id" => isset($user['memberium_ac_contact_id'][0]) ? $user['memberium_ac_contact_id'][0] : "",
            "email" => isset($userData->user_email) ? $userData->user_email : "",
            "field[%SAPPASSWORD%,0]" => $new_pass,
            "p[{$list_id}]" => $list_id,
            "status[{$list_id}]" => 1, // "Active" status
        );
        $contact_sync = $ac->api("contact/edit", $contact);
    }
//    mail('ahsancheema26@gmail.com', 'password change hook user', print_r($contact_sync, true));
//    mail('ahsancheema26@gmail.com', 'password change hook password', print_r($new_pass, true));
}
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}