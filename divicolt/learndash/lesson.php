<?php
/**
 * Displays a lesson.
 *
 * Available Variables:
 * 
 * $course_id 		: (int) ID of the course
 * $course 		: (object) Post object of the course
 * $course_settings : (array) Settings specific to current course
 * $course_status 	: Course Status
 * $has_access 	: User has access to course or is enrolled.
 * 
 * $courses_options : Options/Settings as configured on Course Options page
 * $lessons_options : Options/Settings as configured on Lessons Options page
 * $quizzes_options : Options/Settings as configured on Quiz Options page
 * 
 * $user_id 		: (object) Current User ID
 * $logged_in 		: (true/false) User is logged in
 * $current_user 	: (object) Currently logged in user object
 * 
 * $quizzes 		: (array) Quizzes Array
 * $post 			: (object) The lesson post object
 * $topics 		: (array) Array of Topics in the current lesson
 * $all_quizzes_completed : (true/false) User has completed all quizzes on the lesson Or, there are no quizzes.
 * $lesson_progression_enabled 	: (true/false)
 * $show_content	: (true/false) true if lesson progression is disabled or if previous lesson is completed. 
 * $previous_lesson_completed 	: (true/false) true if previous lesson is completed
 * $lesson_settings : Settings specific to the current lesson.
 * 
 * @since 2.1.0
 * 
 * @package LearnDash\Lesson
 */
//echo strtotime(date('2017-9-19'));
?>

<style>


    html body.sfwd-lessons-template-default.single #sfwd-mark-complete  .et_pb_button_0{
        background-color: #5a0505 !important;
        margin-right: 7px;
        margin-left: 0px !important;
        color: #fff !important;
        margin-bottom: 10px !important;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        line-height: 1.7em !important;
        box-shadow: none !important;
        padding: 9px 10px !important;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
        font-size: 15px;
        border: none;
        font-weight: 700;
        text-transform: uppercase;

        font-family: 'Open Sans Condensed',Helvetica,Arial,Lucida,sans-serif !important;

    }

    html body.sfwd-lessons-template-default.single .btn_wrap_mark{

        margin-top:30px;

    }

    html body.sfwd-lessons-template-default.single p#learndash_next_prev_link{

        position: static !important;
        margin: 0px !important;
        text-align: center;
        display: block !important;
        width: auto;
        margin-top: 29px !important;
        float: left;
        margin-left: 4px !important;


    }

    html body.sfwd-lessons-template-default.single p#learndash_next_prev_link .prev-link{

        font-family: 'Open Sans Condensed',Helvetica,Arial,Lucida,sans-serif;
        background-color: #c3c3c3 !important;
        color: #020102 !important;
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
        font-size: 15px !important;
        font-weight: 700 !important;
        min-width: 150px;
        text-align: center;
        margin-right: -4px;
        display: inline-block;
        text-transform: uppercase;
        line-height: 1.7em !important;
        padding: 9px 10px !important;
    }


    html body.sfwd-lessons-template-default.single p#learndash_next_prev_link .next-link{
        font-family: 'Open Sans Condensed',Helvetica,Arial,Lucida,sans-serif;
        background-color: #dbdbdb !important;
        color: #020102 !important;
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
        font-size: 15px !important;
        font-weight: 700 !important;
        min-width: 150px;
        text-align: center;
        display: inline-block;
        margin-right: -4px;
        text-transform: uppercase;
        line-height: 1.7em !important;
        padding: 9px 8px !important;

    }

    html body.sfwd-lessons-template-default.single p#learndash_next_prev_link .meta-nav{

        display:none !important;

    }


    #sfwd-mark-complete{

        float:left;	

    }


    @media only screen and (min-width: 1300px){
        html body.sfwd-lessons-template-default.single .et_pb_section{

            padding-bottom: 0px;

        }

        .custom_container{

            width: 90%;
            margin-left: auto;
            margin-right: auto;
            overflow:hidden;

        }

    }
    html body.sfwd-lessons-template-default.single #sfwd-mark-complete  .et_pb_button_0:hover{
        background: #ec9c03 !important;
        color:#fff !important;
    }
    #learndash_mark_incomplete_button{

    }
    #learndash_mark_complete_button:hover{

    }
    .et_pb_gutters3 .et_pb_column_1_4 .et_pb_widget{

        margin-bottom: 10.348%;

    }

    @media (max-width: 976px){
        #sfwd-mark-complete{

            position:static !important;
            margin-left: 20px;	

        }
        #sfwd-mark-complete{

            float:none;	

        }

        html body.sfwd-lessons-template-default.single p#learndash_next_prev_link{

            float:none;	

        }


    }
</style>
<?php
// update_user_meta(get_current_user_id(), "custom_progress_incomp_" . $course_id, array());
// update_user_meta(get_current_user_id(), "custom_progress_" . $course_id, array());
//if ($_SERVER['REMOTE_ADDR'] == "119.152.223.83") {
////  $list_lesson = learndash_get_course_lessons_list($course_id);
//    $usermeta = get_user_meta(get_current_user_id(), "custom_progress_" . $course_id, false);
//    $usermeta_incomp = get_user_meta(get_current_user_id(), "custom_progress_incomp_" . $course_id, false);
//    echo '<pre>';
//    print_r($usermeta);
//    print_r($usermeta_incomp);
//}
// delete_user_meta(get_current_user_id(), 'custom_progress_first_time_' . $post->ID);
// delete_user_meta(get_current_user_id(), 'custom_progress_second_time_' . $post->ID);
// delete_user_meta(get_current_user_id(), 'custom_progress_third_time_' . $post->ID);
$course_pro = get_user_meta($user_id, "_sfwd-course_progress");
//{
//    echo '<pre>';
if (isset($_REQUEST['sfwd_mark_uncomplete']) && trim($_REQUEST['sfwd_mark_uncomplete']) != "") {
    if (isset($course_pro[0][$course_id]['lessons'][$post->ID]) && $course_pro[0][$course_id]['lessons'][$post->ID] != "") {
        unset($course_pro[0][$course_id]['lessons'][$post->ID]);
        if ($course_pro[0][$course_id]['completed'] != 0) {
            $course_pro[0][$course_id]['completed'] = $course_pro[0][$course_id]['completed'] - 1;
            update_user_meta($user_id, "_sfwd-course_progress", $course_pro[0]);
            $progress_unset = get_user_meta($user_id, "custom_progress_" . $course_id, false);
            if (isset($progress_unset) && count($progress_unset) > 0) {
                if (isset($progress_unset[0][$post->ID . "-" . $user_id]) && trim($progress_unset[0][$post->ID . "-" . $user_id]) != "") {
                    $progress_unset[0][$post->ID . "-" . $user_id] = 0;
                    update_user_meta($user_id, "custom_progress_" . $course_id, $progress_unset[0]);
                    delete_user_meta($user_id, 'custom_progress_first_time_' . $post->ID);
                    delete_user_meta($user_id, 'custom_progress_second_time_' . $post->ID);
                    delete_user_meta($user_id, 'custom_progress_third_time_' . $post->ID);
                }
            }
//            update_user_meta($user_id, "custom_progress_".$course_id, $course_pro[0]);


            $custom_progress_incomp = get_user_meta(get_current_user_id(), "custom_progress_incomp_" . $course_id, false);

//            mail("ahsancheema26@gmail.com", 'lessons', print_r($custom_progress_incomp, true));
            if (isset($custom_progress_incomp) && count($custom_progress_incomp) > 0) {
                if (isset($custom_progress_incomp[0][$post->ID . "-" . get_current_user_id()]) && trim($custom_progress_incomp[0][$post->ID . "-" . get_current_user_id()]) == false) {
                    $custom_progress_incomp[0][$post->ID . "-" . get_current_user_id()] = true;
                    update_user_meta(get_current_user_id(), "custom_progress_incomp_" . $course_id, $custom_progress_incomp[0]);
//                    mail("ahsancheema26@gmail.com", 'lessons1', print_r($custom_progress_incomp[0], true));
                } else {
                    $custom_progress_incomp[0][$post->ID . "-" . get_current_user_id()] = true;
                    update_user_meta(get_current_user_id(), "custom_progress_incomp_" . $course_id, $custom_progress_incomp[0]);
//                    mail("ahsancheema26@gmail.com", 'lessons2', print_r($custom_progress_incomp[0], true));
                }
            } else {
                $custom_progress_incomp[0][$post->ID . "-" . get_current_user_id()] = true;
                update_user_meta(get_current_user_id(), "custom_progress_incomp_" . $course_id, $custom_progress_incomp[0]);
            }
        }
    }
    echo "<script>window.location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
//    wp_redirect($_SERVER['HTTP_REFERER']);
    exit;
}
if (isset($_REQUEST['sfwd_mark_complete_again']) && trim($_REQUEST['sfwd_mark_complete_again']) != "") {
    $progress = get_user_meta(get_current_user_id(), "custom_progress_" . $course_id, false);
//    mail("ahsancheema26@gmail.com", 'lessons', print_r($progress,true));
    if (isset($progress) && count($progress) > 0) {
        if (isset($progress[0][$post->ID . "-" . $user_id]) && trim($progress[0][$post->ID . "-" . $user_id]) != "") {
            $progress[0][$post->ID . "-" . $user_id] = $progress[0][$post->ID . "-" . $user_id] + 1;
            if ($progress[0][$post->ID . "-" . $user_id] >= 3) {
                $progress[0][$post->ID . "-" . $user_id] = 3;
                update_user_meta(get_current_user_id(), "custom_progress_third_time_" . $post->ID, strtotime(date('y-m-d')));
            }
            if ($progress[0][$post->ID . "-" . $user_id] == 2) {
                update_user_meta(get_current_user_id(), "custom_progress_second_time_" . $post->ID, strtotime(date('y-m-d')));
            }
            update_user_meta(get_current_user_id(), "custom_progress_" . $course_id, $progress[0]);
//      mail("ahsancheema26@gmail.com", 'lessons', print_r($progress[0],true));
        } else {
            $progress[0][$post->ID . "-" . $user_id] = 1;
            update_user_meta(get_current_user_id(), "custom_progress_" . $course_id, $progress[0]);
            update_user_meta(get_current_user_id(), "custom_progress_first_time_" . $post->ID, strtotime(date('y-m-d')));
        }
    } else {
        $progress[0][$post->ID . "-" . $user_id] = 1;
        update_user_meta(get_current_user_id(), "custom_progress_" . $course_id, $progress[0]);
        update_user_meta(get_current_user_id(), "custom_progress_first_time_" . $post->ID, strtotime(date('y-m-d')));
    }
}
//}
?>
<?php if (@$lesson_progression_enabled && !@$previous_lesson_completed) : ?>
    <span id="learndash_complete_prev_lesson">
        <?php
        $previous_item = learndash_get_previous($post);
        if ((!empty($previous_item) ) && ( $previous_item instanceof WP_Post )) {
            if ($previous_item->post_type == 'sfwd-quiz') {
                echo sprintf(_x('Please go back and complete the previous <a class="learndash-link-previous-incomplete" href="%s">%s</a>.', 'placeholders: quiz URL, quiz label', 'learndash'), get_permalink($previous_item->ID), LearnDash_Custom_Label::label_to_lower('quiz'));
            } else if ($previous_item->post_type == 'sfwd-topic') {
                echo sprintf(_x('Please go back and complete the previous <a class="learndash-link-previous-incomplete" href="%s">%s</a>.', 'placeholders: topic URL, topic label', 'learndash'), get_permalink($previous_item->ID), LearnDash_Custom_Label::label_to_lower('topic'));
            } else {
                echo sprintf(_x('Please go back and complete the previous <a class="learndash-link-previous-incomplete" href="%s">%s</a>.', 'placeholders: lesson URL, lesson label', 'learndash'), get_permalink($previous_item->ID), LearnDash_Custom_Label::label_to_lower('lesson'));
            }
        } else {
            echo sprintf(_x('Please go back and complete the previous %s.', 'placeholder lesson', 'learndash'), LearnDash_Custom_Label::label_to_lower('lesson'));
        }
        ?>
    </span><br />
    <?php add_filter('comments_array', 'learndash_remove_comments', 1, 2); ?>
<?php endif; ?>

<?php if ($show_content) : ?>

    <div class="learndash_content abc"><?php echo $content; ?></div>
    <?php
    /**
     * Lesson Topics
     */
    ?>
    <?php if (!empty($topics)) : ?>
        <div id="learndash_lesson_topics_list" class="learndash_lesson_topics_list">
            <div id='learndash_topic_dots-<?php echo esc_attr($post->ID); ?>' class="learndash_topic_dots type-list">
                <strong><?php printf(_x('%s %s', 'Lesson Topics Label', 'learndash'), LearnDash_Custom_Label::get_label('lesson'), LearnDash_Custom_Label::get_label('topics')); ?></strong>
                <ul>
                    <?php $odd_class = ''; ?>

                    <?php foreach ($topics as $key => $topic) : ?>

                        <?php $odd_class = empty($odd_class) ? 'nth-of-type-odd' : ''; ?>
                        <?php $completed_class = empty($topic->completed) ? 'topic-notcompleted' : 'topic-completed'; ?>

                        <li class='<?php echo esc_attr($odd_class); ?>'>
                            <span class="topic_item">
                                <a class='<?php echo esc_attr($completed_class); ?>' href='<?php echo esc_attr(get_permalink($topic->ID)); ?>' title='<?php echo esc_attr($topic->post_title); ?>'>
                                    <span><?php echo $topic->post_title; ?></span>
                                </a>
                            </span>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    <?php endif; ?>


    <?php
    /**
     * Show Quiz List
     */
    ?>
    <?php if (!empty($quizzes)) : ?>
        <div id="learndash_quizzes" class="learndash_quizzes">
            <div id="quiz_heading"><span><?php echo LearnDash_Custom_Label::get_label('quizzes'); ?></span><span class="right"><?php _e('Status', 'learndash'); ?></span></div>
            <div id="quiz_list" class="quiz_list">

                <?php foreach ($quizzes as $quiz) : ?>
                    <div id='post-<?php echo esc_attr($quiz['post']->ID); ?>' class='<?php echo esc_attr($quiz['sample']); ?>'>
                        <div class="list-count"><?php echo esc_attr($quiz['sno']); ?></div>
                        <h4>
                            <a class='<?php echo esc_attr($quiz['status']); ?>' href='<?php echo esc_attr($quiz['permalink']); ?>'><?php echo $quiz['post']->post_title; ?></a>
                        </h4>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>


    <?php
    /**
     * Display Lesson Assignments
     */
    ?>
    <?php if (( lesson_hasassignments($post) ) && (!empty($user_id) )) : ?>
        <?php $assignments = learndash_get_user_assignments($post->ID, $user_id); ?>

        <div id="learndash_uploaded_assignments" class="learndash_uploaded_assignments">
            <h2><?php _e('Files you have uploaded', 'learndash'); ?></h2>
            <table>
                <?php if (!empty($assignments)) : ?>
                    <?php foreach ($assignments as $assignment) : ?>
                        <tr>
                            <td>
                                <a href='<?php echo esc_attr(get_post_meta($assignment->ID, 'file_link', true)); ?>' target="_blank"><?php echo __('Download', 'learndash') . ' ' . get_post_meta($assignment->ID, 'file_name', true); ?></a>
                                <br />
                                <span class="learndash_uploaded_assignment_points"><?php echo learndash_assignment_points_awarded($assignment->ID); ?></span>
                            </td>
                            <td><a href='<?php echo esc_attr(get_permalink($assignment->ID)); ?>'><?php _e('Comments', 'learndash'); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    <?php endif; ?>


    <?php
    /**
     * Display Mark Complete Button
     */
    ?>
    <?php if ($all_quizzes_completed && $logged_in) : ?>
        <?php
        if (learndash_mark_complete($post)) {
//        echo learndash_mark_complete( $post ); 
            echo "<div class='custom_container'><form id='sfwd-mark-complete' method='post' action=''>
					<input type='hidden' value='" . $post->ID . "' name='post'/>
					<input type='hidden' value='" . wp_create_nonce('sfwd_mark_complete_' . get_current_user_id() . '_' . $post->ID) . "' name='sfwd_mark_complete'/>
                                            <div class='btn_wrap_mark'>
					<input type='submit' value='" . LearnDash_Custom_Label::get_label('button_mark_complete') . "' id='learndash_mark_complete_button' class='et_pb_button_0'/>
                                          <a class='et_pb_button  et_pb_button_0 et_pb_module et_pb_bg_layout_light' href='/module-library/' data-slimstat='5'>return to module library</a>
                                        </div>  
				</form></dv>";
        } else {
            echo '<div class="custom_container">
			 			<form id="sfwd-mark-complete" method="post" action="">
					<input type="hidden" value="' . $post->ID . '" name="post"/>
					<input type="hidden" value="' . wp_create_nonce("sfwd_mark_complete_" . get_current_user_id() . '_' . $post->ID) . '" name="sfwd_mark_complete_again"/>
                                            <div class="btn_wrap_mark">
					<input type="submit" value="Mark Training Complete Again" id="learndash_mark_complete_button" class="et_pb_button_0"/>
                                        </div>  
				</form><form id="sfwd-mark-complete" method="post" action="">
                            <input type="hidden" value="124" name="sfwd_mark_uncomplete">
							<div class="btn_wrap_mark">
								<input type="submit" value="Mark Training Incomplete" id="learndash_mark_incomplete_button" class="et_pb_button_0 ">
								<a class="et_pb_button  et_pb_button_0 et_pb_module et_pb_bg_layout_light" href="/module-library/" data-slimstat="5">return to module library</a>
							</div>
							</form>
			 			';
        }
        ?>
    <?php endif; ?>
    <!--<form id="sfwd-mark-complete" method="post" action="">
                                <input type="hidden" value="124" name="sfwd_mark_complete_again">
                                                            <div class="btn_wrap_mark">
                                                                    <input type="submit" value="Mark Training Complete Again" id="learndash_mark_complete_again" class="et_pb_button_0 ">
                                                            </div>
                                                            </form>-->
<?php endif; ?>


<p id="learndash_next_prev_link"><?php
    echo learndash_previous_post_link();
    echo learndash_next_post_link();
    ?>
    <?php
    /*
     * See details for filter 'learndash_show_next_link' https://bitbucket.org/snippets/learndash/5oAEX
     *
     * @since version 2.3
     */
    ?>
    <?php if (apply_filters('learndash_show_next_link', learndash_is_lesson_complete($user_id, $post->ID), $user_id, $post->ID)) { ?>
        <?php //echo learndash_next_post_link();  ?>
    <?php } ?>
</p>
</div>