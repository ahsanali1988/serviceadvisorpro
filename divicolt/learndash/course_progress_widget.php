<?php
/**
 * Displays the course progress widget.
 * 
 * @since 2.1.0
 * 
 * @package LearnDash\Course
 */
//if ($_SERVER['REMOTE_ADDR'] == "182.190.14.93") {
//    echo '<pre>';
$course_id = learndash_get_course_id();
$markComlete = get_user_meta(get_current_user_id(), "custom_progress_" . $course_id, false);
$lmsmarkComleted = get_user_meta(get_current_user_id(), "_sfwd-course_progress");
$custom_progress_incomp = get_user_meta(get_current_user_id(), "custom_progress_incomp_" . $course_id, false);
$list_lesson = learndash_get_course_lessons_list($course_id);
$total_lessons = count($list_lesson);
$sections = 100 / $total_lessons;
$user_id = get_current_user_id();
$progress = learndash_course_progress(array("user_id" => $user_id, "course_id" => $course_id, "array" => true));
//    print_r($progress);
?>
<dd class="course_progress" title='<?php echo sprintf(__('%s out of %s steps completed', 'learndash'), $completed, $total); ?>'>
    <?php
    $completed = 0;
    foreach ($list_lesson as $lessons) {
        $background_color = "";
        $test = "";
        if (isset($markComlete[0][$lessons['post']->ID . "-" . $user_id]) && trim($markComlete[0][$lessons['post']->ID . "-" . $user_id]) == "1") {
            $background_color = "#5A0505";
            $test = "a";
            $completed++;
        }
        if (isset($markComlete[0][$lessons['post']->ID . "-" . $user_id]) && trim($markComlete[0][$lessons['post']->ID . "-" . $user_id]) == "2") {
            $background_color = "#8c8c8c";
            $test = "b";
            $completed++;
        }
        if (isset($markComlete[0][$lessons['post']->ID . "-" . $user_id]) && trim($markComlete[0][$lessons['post']->ID . "-" . $user_id]) >= "3") {
            $background_color = "#ED9D03";
            $test = "c";
            $completed++;
        }
        if (isset($custom_progress_incomp[0][$lessons['post']->ID . "-" . $user_id]) && $custom_progress_incomp[0][$lessons['post']->ID . "-" . $user_id] == true) {
            $background_color = "#F5F5F5";
            $test = "d";
        }
        if (isset($markComlete[0][$lessons['post']->ID . "-" . $user_id]) && count($markComlete[0][$lessons['post']->ID . "-" . $user_id]) > 0) {
            echo "<div class='course_progress_blue " . $test . "' style='background-color:" . $background_color . "; width: " . $sections . "%;'></div>";
        } else {
            if (isset($lmsmarkComleted[0][$course_id]['lessons'][$lessons['post']->ID]) && $lmsmarkComleted[0][$course_id]['lessons'][$lessons['post']->ID] == 1) {
                $progress2 = get_user_meta($user_id, "custom_progress_" . $course_id);
                $progress2[0][$lessons['post']->ID . "-" . $user_id] = 1;
                update_user_meta($user_id, "custom_progress_" . $course_id, $progress2[0]);
                echo "<div class='" . $lessons['post']->ID . " here course_progress_blue " . $test . "' style='background-color:#90EE90 !important; width: " . $sections . "%;'></div>";
                $completed++;
            } else {
                echo "<div class='course_progress_blue " . $test . "' style='background-color:#F5F5F5; width: " . $sections . "%;'></div>";
            }
        }
    }
    $percentage = intVal($completed * 100 / $total_lessons);
    $percentage = ( $percentage > 100 ) ? 100 : $percentage;
//    }
    ?>


</dd>
<p class="course_progress_text" style="text-align: center;
   font-family: 'Open Sans Condensed',Helvetica,Arial,Lucida,sans-serif;
   font-size: 16px;
   color: #5a0505;
   font-weight: 700;
   text-transform: uppercase;
   margin-top: -5px;"><?php echo sprintf(__("%s%% Complete", "learndash"), $percentage) ?></p>

<div class="progress_squre">
    <h2>Progress Reporting Key</h2>
    <ul>
        <li class="squre_box">Training completed 1 time in the past 120 days</li>
        <li class="squre_box2">Training completed 2 times in the past 120 days</li>
        <li class="squre_box3">Training completed 3 or more times in the past 120 days</li>
        <li class="squre_box4">Training completed more than 120 days ago</li>
    </ul>
</div>
<style type="text/css" media="screen">
    .progress_squre {
        border: 1px solid #eee;
        margin: 40px -20px 40px -10px;
    }
    .progress_squre h2 {
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;
        color: #5a0505;
        text-transform: uppercase;
        background-color: #f4f4f4;
        padding: 10px 15px;
        font-weight: bold;
        font-size: 16px;
        text-align: center;
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
        top: 5px;
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
    @media (max-width: 769px) {
        .progress_squre {
            margin: 40px 0px 40px 0px;
        }
    }
</style>