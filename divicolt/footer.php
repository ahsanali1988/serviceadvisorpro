<?php if ('on' == et_get_option('divi_back_to_top', 'false')) : ?>

    <span class="et_pb_scroll_top et-pb-icon"></span>

<?php
endif;

if (!is_page_template('page-template-blank.php')) :
    ?>

    <footer id="main-footer">
    <?php get_sidebar('footer'); ?>


    <?php if (has_nav_menu('footer-menu')) : ?>

            <div id="et-footer-nav">
                <div class="container">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'depth' => '1',
                        'menu_class' => 'bottom-nav',
                        'container' => '',
                        'fallback_cb' => '',
                    ));
                    ?>
                </div>
            </div> <!-- #et-footer-nav -->

    <?php endif; ?>

        <div id="footer-bottom">
            <div class="container clearfix">
                <?php
                if (false !== et_get_option('show_footer_social_icons', true)) {
                    get_template_part('includes/social_icons', 'footer');
                }

                echo et_get_footer_credits();
                ?>
            </div>	<!-- .container -->
        </div>
    </footer> <!-- #main-footer -->
    </div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' )  ?>

</div> <!-- #page-container -->
<script>

    jQuery(document).ready(function () {
        jQuery('.et_pb_forgot_password a').attr('href', "/lost-password/")
        var currentdate = new Date();
        var datetime = currentdate.getFullYear() + "-" + (currentdate.getMonth() + 1) + "-" + currentdate.getDate();
        jQuery('.logo_container a').attr('href', 'https://members.serviceadvisorpro.com/my-dashboard/');



        var wistia_id = jQuery("#wistia_id").val();
        console.log(wistia_id);
        setTimeout(function () {
            if (jQuery.trim(wistia_id) != "")

            {

                var video = Wistia.api(jQuery("#wistia_id").val());

                video.bind("play", function () {

                    var courseName = jQuery("#course_name").val();

                    var lessonName = jQuery("#LD_Lesson_Name").val();

                    var userID = jQuery("#userID").val();

                    jQuery.ajax({
                        url: "/save-video-info/",
                        type: "post",
                        data: {localTime: datetime, lessonName: lessonName, courseName: courseName, userID: userID},
                        success: function (response) {

                            // you will get response from your php page (what you echo or print)                 



                        }





                    });

                });



            }
        }, 5000)


        jQuery(".audioClick a").attr('onclick', 'return sentU();');



    });

    function sentU() {



        var courseName = jQuery("#course_name").val();

        var lessonName = jQuery("#LD_Lesson_Name").val();

        var userID = jQuery("#userID").val();

        jQuery.ajax({
            url: "/save-video-info/",
            type: "post",
            data: {localTime: datetime, lessonName: lessonName, courseName: courseName, userID: userID},
            success: function (response) {

                // you will get response from your php page (what you echo or print)                 



            }





        });

    }

</script>

<?php wp_footer(); ?>
</body>
</html>