<?php

/*
  Template Name: Video Watch
 */

//if (isset($_REQUEST['lessonName']) && trim($_REQUEST['lessonName']) != "") {
//    $watchLesson = get_user_meta($_REQUEST['userID'], 'watchLessonVideo');
//    echo '<pre>';
//    print_r($watchLesson[0]);
//    if (isset($watchLesson[0]) && count($watchLesson[0]) > 0) {
//        $found = true;
//        foreach ($watchLesson[0][$_REQUEST['courseName']] as $key => $value) {
//            if ($key  == $_REQUEST['lessonName']) {
//                $watchLesson[0][$_REQUEST['courseName']][$_REQUEST['lessonName']] = $value + 1;
//                print_r($watchLesson[0]);
//                $found = false;
//            }
//        }
//        if ($found) {
//            $watchLesson[0][$_REQUEST['courseName']][$_REQUEST['lessonName']] = 1;
//        }
//    } else {
//        $watchLesson[0][$_REQUEST['courseName']][$_REQUEST['lessonName']] = 1;
//    }
//    update_user_meta($_REQUEST['userID'], 'watchLessonVideo', $watchLesson[0]);
//}
if (isset($_REQUEST['userID']) && trim($_REQUEST['userID']) != "") {
        $user_login_history = get_user_meta($_REQUEST['userID'], 'user_login_history');
        $count = 0;
        if (isset($user_login_history[0]) && count($user_login_history[0]) > 0) {
            $count = count($user_login_history[0]);
        } else {
            
        }
        $currentDate = strtotime($_REQUEST['localTime']);
        if (!in_array($currentDate, $user_login_history[0])) {
            $user_login_history[0][$count] = $currentDate;
            update_user_meta($_REQUEST['userID'], 'user_login_history', $user_login_history[0]);
        }
    }