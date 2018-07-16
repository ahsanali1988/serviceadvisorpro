<?php
/*
  Template Name: Group Limit
 */
get_header();
?>
<style>
    #main-content .container:before {
        display: none;
    }
    #main-content .container {
        padding-top: 0px;
    }
    .manage_wrap {
    }
    .manage_wrap .inner_wrap {
        width: 60%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        padding-bottom: 40px;
    }
    .manage_wrap .inner_wrap h3 {
        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;
        font-weight: bold;
        font-size: 24px;
        color: #139221;
        margin-bottom: 2.75%;
    }
    .manage_wrap .inner_wrap p {
        padding-bottom: 1em;
        font-family: 'Open Sans', Helvetica, Arial, Lucida, sans-serif;
        font-size: 18px;
        color: #000000;
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
        background-color: #c0c0c0;
    }
    .manage_wrap .inner_wrap label {
        font-size: 14px;
        margin-right: 20px;
        display: block;
        text-align: left;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .manage_wrap .inner_wrap input[type="text"], 
    .manage_wrap .inner_wrap select, 
    .manage_wrap .inner_wrap input[type="email"] {
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
        margin-bottom:15px;
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

    .manage_wrap .inner_wrap form p{

        padding-bottom:0px !important;	

    }
    @media (min-width: 992px) and (max-width: 1199px) {
        .manage_wrap .inner_wrap {
            width: 80%;
        }
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .manage_wrap .inner_wrap {
            width: 90%;
        }
    }
    @media (max-width: 767px) {
        .manage_wrap .inner_wrap {
            width: 95%;
        }
    }
    .h3style{
        width: 100%;
        background-color: #139221;
        color: white !important;
        padding: 10px;
    }
</style>
<?php
if (current_user_can('administrator')) {
    $msg = "";
    if (isset($_REQUEST['groupss']) && trim($_REQUEST['groupss']) != "") {

        $group_limit = get_post_meta($_REQUEST['groupss'], 'group_limit');
        $group_leader_id = get_post_meta($_REQUEST['groupss'], 'group_leader_id');
        $member_tags_id = get_user_meta($group_leader_id[0], 'memb_tag_ids');
        $tags = explode(',', $member_tags_id[0]);
        
    }
    if (!isset($group_limit[0]) && trim($group_limit[0]) == "") {
        
        if (in_array(48, $tags)) {
            $group_limit[0] = 6;
        }
        if (in_array(52, $tags)) {
            $group_limit[0] = 12;
        }
        if (in_array(53, $tags)) {
            $group_limit[0] = 18;
        }
    }
    if (isset($_REQUEST['abc']) && $_REQUEST['abc'] == 1) {
        update_post_meta($_REQUEST['postID'], 'group_limit', $_REQUEST['newval']);
        $group_limit = get_post_meta($_REQUEST['postID'], 'group_limit');
        $msg = "Limit chqanged";
    }
    $args = array(
        'post_type' => 'groups',
        'posts_per_page' => 100,
    );
    $posts_array = get_posts($args);
    ?>
    <div id='main-content'>
        <div class='container'>
            <div id='content-area' class='clearfix'>
                <article>
                    <div class='entry-content'>
                        <div class='manage_wrap'>
                            <div class='manage_wrap'>
                                <div class='logo'> <img src='/wp-content/uploads/2017/05/manage_your_team_title_v2.png'> </div>
                                <div class='inner_wrap'>
                                    <h3 style="color: #5A0505">Change Group Limit</h3>
                                    <?php if ((isset($_REQUEST['groupss']) && trim($_REQUEST['groupss']) != "") || $_REQUEST['abc'] == 1) { ?>
                                        <?php if (isset($msg) && trim($msg) != "") { ?>
                                            <h3 class="h3style" style="color: #5A0505 !important"><?php echo $msg; ?></h3>
                                        <?php } ?>
                                        <form action='' method='post' name='gropchng'>
                                            <select name='newval' >
                                                <?php if (!isset($group_limit[0]) && trim($group_limit[0]) == "") { ?>
                                                    <option value="6" selected>6</option>
                                                <?php } else { ?>
                                                    <option value="6" <?php echo $group_limit[0] == 6 ? "selected" : "" ?> >6</option>
                                                <?php } ?>
                                                <option value="7" <?php echo isset($group_limit[0]) && $group_limit[0] == 7 ? "selected" : "" ?>>7</option>
                                                <option value="12" <?php echo isset($group_limit[0]) && $group_limit[0] == 12 ? "selected" : "" ?>>12</option>
                                                <option value="13" <?php echo isset($group_limit[0]) && $group_limit[0] == 13 ? "selected" : "" ?>>13 </option>
                                                <option value="18" <?php echo isset($group_limit[0]) && $group_limit[0] == 18 ? "selected" : "" ?>>18</option>
                                                <option value="19" <?php echo isset($group_limit[0]) && $group_limit[0] == 19 ? "selected" : "" ?>>19</option>
                                                <option value="20" <?php echo isset($group_limit[0]) && $group_limit[0] == 20 ? "selected" : "" ?>>20</option>
                                                <option value="25" <?php echo isset($group_limit[0]) && $group_limit[0] == 25 ? "selected" : "" ?>>25</option>
                                                <option value="30" <?php echo isset($group_limit[0]) && $group_limit[0] == 30 ? "selected" : "" ?>>30</option>
                                                <option value="35" <?php echo isset($group_limit[0]) && $group_limit[0] == 35 ? "selected" : "" ?>>35</option>
                                                <option value="40" <?php echo isset($group_limit[0]) && $group_limit[0] == 40 ? "selected" : "" ?>>40</option>
                                                <option value="50" <?php echo isset($group_limit[0]) && $group_limit[0] == 50 ? "selected" : "" ?>>50</option>
                                                <option value="60" <?php echo isset($group_limit[0]) && $group_limit[0] == 60 ? "selected" : "" ?>>60</option>
                                                <option value="80" <?php echo isset($group_limit[0]) && $group_limit[0] == 80 ? "selected" : "" ?>>80</option>
                                                <option value="100" <?php echo isset($group_limit[0]) && $group_limit[0] == 100 ? "selected" : "" ?>>100</option>
                                            </select>  
                                            <input type="hidden" name="postID" value="<?php echo $_REQUEST['groupss'] ?>">
                                            <input type="hidden" name="abc" value="1">
                                            <input type="submit" value="Change">
                                            <a href="/group-limit/" class="manage_btn">Back</a>
                                        </form>

                                    <?php } else { ?>
                                        <form action='' method='post' name='groupForm'>
                                            <select name='groupss' id='widgetFieldInput'>
                                                <option>Select Group</option>
                                                <?php
                                                foreach ($posts_array as $post) {
                                                    echo "<option value='" . $post->ID . "'>" . $post->post_title . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type='submit' id='frmSub' value='submit' style='display:none'>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function () {
            jQuery('#widgetFieldInput').change(function () {
                jQuery('#frmSub').click();
            });
        });
    </script>
    <?php
} else {
    wp_redirect('http://members.serviceadvisorpro.com/');
    exit;
}
?>
<?php get_footer(); ?>
