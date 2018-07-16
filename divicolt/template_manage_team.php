<?php
/*
  Template Name: Manage Team
 */
require_once("activecampaign-api-php/includes/ActiveCampaign.class.php");
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
global $wpdb;
$ac = new ActiveCampaign("https://gjbishopenterprises.api-us1.com", "c6e59aa5ab9521e73b734892593bf042472abc83bcca9ca0f0a742cc30bd4e44b0a6c6b6");
$action = "";
$args = array(
    'post_type' => 'groups',
    'posts_per_page' => '10000',
);
$posts_array = get_posts($args);
$bool = false;
$boolHome = false;
$gruop_post = array();
$post_users = array();
$count = 0;
$count1 = 0;
$post_owner = "";
foreach ($posts_array as $post) {
    $user_meta = get_user_meta(get_current_user_id(), 'learndash_group_leaders_' . $post->ID);
    if (isset($user_meta[0]) && trim($user_meta[0]) != "") {
        $bool = true;
        $gruop_post[$count] = $user_meta[0];
        $count++;
        $post_owner = $post->ID;
        $post_users = get_post_meta($post->ID, 'learndash_group_users_' . $post->ID);
        break;
    }
}
$InfsID = "";
$user_ID = get_current_user_id();
$usermeta = get_user_meta($user_ID);
if ($usermeta['infusionsoft_user_id'][0]) {
    $InfsID = $usermeta['infusionsoft_user_id'][0];
}
$group_limit = get_post_meta($post_owner, 'group_limit');

if (!isset($group_limit[0]) && trim($group_limit[0]) == "") {

    $tags = explode(',', $usermeta['memb_tag_ids'][0]);

    if (in_array(48, $tags)) {
        $group_limit[0] = 6;
    }
    if (in_array(52, $tags)) {
        $group_limit[0] = 12;
    }
    if (in_array(53, $tags)) {
        $group_limit[0] = 18;
    }

    update_post_meta($post_owner, 'group_limit', $group_limit[0]);
    $group_limit = get_post_meta($post_owner, 'group_limit');
}
$limit = "";
$total_users = count($post_users[0]);
$remaining_limit = "";

if (!isset($group_limit[0]) && trim($group_limit[0]) == "") {
    $remaining_limit = 15 - $total_users;
} else {
    $remaining_limit = $group_limit[0] - $total_users;
}

$limit_full = "";
if ($remaining_limit == 0) {
    $limit_full = "Please contact with admin to increase limit";
}
$access_group = array();
$msg = "";
if (isset($_REQUEST['accessL']) && trim($_REQUEST['accessL']) != "") {
    update_user_meta($_REQUEST['editID'], "wpsd_capabilities", $access_group);
    $add = "";
    $remove = "";
    $string_tags_name = "";
    $string_tags_id = "";
    $user = get_user_by('ID', $_REQUEST['editID']);
    $usermeta_tag_name = get_user_meta($_REQUEST['editID'], "memb_tags");
    $usermeta_tag_id = get_user_meta($_REQUEST['editID'], "memb_tag_ids");
    $automation = "";
    if ($_REQUEST['accessL'] == "owner") {
        $access_group['group_leader'] = true;
        $automation = 23;
        $add = "SAP [Product] Owner 2017";
        $remove = "SAP [Product] Team Member 2017";
        $string_tags_name = str_replace("SAP [Product] Team Member 2017", "SAP [Product] Owner 2017", $usermeta_tag_name[0]);
        $string_tags_id = str_replace("27", "23", $usermeta_tag_id[0]);
    } else if ($_REQUEST['accessL'] == "team") {
        $automation = 29;
        $access_group['subscriber'] = true;
        $add = "SAP [Product] Team Member 2017";
        $remove = "SAP [Product] Owner 2017";
        $string_tags_name = str_replace("SAP [Product] Owner 2017", "SAP [Product] Team Member 2017", $usermeta_tag_name[0]);
        $string_tags_id = str_replace("23", "27", $usermeta_tag_id[0]);
    }
//    $user_tagrem = array(
//        "email" => $user->user_email,
//        "tags" => $remove,
////        "tags" => "SAP [Product] Team Member 2017",
//    );
//    $user_tagadd = array(
//        "email" => $user->user_email,
//        "tags" => $add,
////        "tags" => "SAP [Product] Team Member 2017",
//    );
//    $contact_tag_remove = $ac->api("contact/tag_remove", $user_tagrem);
//    $contact_tag_add = $ac->api("contact/tag_add", $user_tagadd);

    $post_data = array(
        "contact_email" => $user->user_email, // include this or contact_id
        "automation" => $automation, // one or more
    );
    $response = $ac->api("automation/contact/add", $post_data);
    update_user_meta($_REQUEST['editID'], "wpsd_capabilities", $access_group);
    update_user_meta($_REQUEST['editID'], "memb_tags", $string_tags_name);
    update_user_meta($_REQUEST['editID'], "memb_tag_ids", $string_tags_id);
    $msg = "Contact Updated Successfully";
}

if (isset($_REQUEST['action']) && trim($_REQUEST['action']) == "delete" && trim($_REQUEST['user']) != "") {
    $count11 = get_option('counter');
    $foo2 = array();
    require_once(ABSPATH . 'wp-admin/includes/user.php');
    $string_tags_name = "";
    $string_tags_id = "";
    $user = get_user_by('ID', $_REQUEST['user']);
    $usermeta_tag_name = get_user_meta($_REQUEST['user'], "memb_tags");
    $usermeta_tag_id = get_user_meta($_REQUEST['user'], "memb_tag_ids");
    if ($_REQUEST['type'] == "owner") {
        $remove = "SAP [Product] Owner 2017";
        $string_tags_name = str_replace("SAP [Product] Owner 2017", "SAP [Status] User Removed", $usermeta_tag_name[0]);
        $string_tags_id = str_replace("23", "42", $usermeta_tag_id[0]);
    } else if ($_REQUEST['type'] == "team") {
        $remove = "SAP [Product] Team Member 2017";
        $string_tags_name = str_replace("SAP [Product] Team Member 2017", "SAP [Status] User Removed", $usermeta_tag_name[0]);
        $string_tags_id = str_replace("27", "42", $usermeta_tag_id[0]);
    }
    $add = "SAP [Status] User Removed";
    $user_tagrem = array(
        "email" => $user->user_email,
        "tags" => $remove,
//        "tags" => "SAP [Product] Team Member 2017",
    );
    $user_tagadd = array(
        "email" => $user->user_email,
        "tags" => $add,
//        "tags" => "SAP [Product] Team Member 2017",
    );
//    $contact_tag_remove = $ac->api("contact/tag_remove", $user_tagrem);
//    $contact_tag_add = $ac->api("contact/tag_add", $user_tagadd);

    update_user_meta($_REQUEST['user'], "memb_tags", $string_tags_name);
    update_user_meta($_REQUEST['user'], "memb_tag_ids", $string_tags_id);
//    $contact_tag_remove = $ac->api("contact/delete", $user_remove);
//    wp_delete_user($_REQUEST['user']);
//    get_post_meta($post_owner, "learndash_group_users_" . $post_owner, $post_users[0][0]);
    foreach ($post_users[0] as $key => $value) {
        if ($value == $_REQUEST['user']) {
            unset($post_users[0][$key]);
            $foo2 = array_values($post_users[0]);
            update_post_meta($post_owner, "learndash_group_users_" . $post_owner, $foo2);
        }
    }
    $msg = "Contact Deleted Successfully";
    if (isset($gruop_post) && count($gruop_post) > 0) {
        $post_users = get_post_meta($gruop_post[0], 'learndash_group_users_' . $gruop_post[0]);
    }
    $post_data = array(
        "contact_email" => $user->user_email, // include this or contact_id
        "automation" => 41, // one or more
    );
    if ($count11) {
        delete_option('counter');
    } else {
        update_option('counter', 1);
        $response = $ac->api("automation/contact/add", $post_data);
    }
    $total_users = count($post_users[0]);
    if (!isset($group_limit[0]) && trim($group_limit[0]) == "") {
        $remaining_limit = 15 - $total_users;
    } else {
        $remaining_limit = $group_limit[0] - $total_users;
    }

    $limit_full = "";
    if ($remaining_limit == 0) {
        $limit_full = "Please contact with admin to increase limit";
    }
}
if (isset($_REQUEST['action']) && trim($_REQUEST['action']) == "add" && trim($_REQUEST['adduser']) == "1") {
    $list_id = 13;
    $automation = "";

    $tag = "";
    if (isset($_REQUEST['type']) && trim($_REQUEST['type']) == "owner") {
        $automation == 22;
        $access_group['group_leader'] = true;
        $tag = "SAP [Product] Owner 2017";
    }
    if (isset($_REQUEST['type']) && trim($_REQUEST['type']) == "member") {
        $automation == 29;
        $access_group['subscriber'] = true;
        $tag = "SAP [Product] Team Member 2017";
    }
    $contact = array(
        "email" => isset($_REQUEST['account_email']) ? $_REQUEST['account_email'] : "",
        "first_name" => isset($_REQUEST['account_first_name']) ? $_REQUEST['account_first_name'] : "",
        "last_name" => isset($_REQUEST['account_last_name']) ? $_REQUEST['account_last_name'] : "",
        "p[{$list_id}]" => $list_id,
        "status[{$list_id}]" => 1, // "Active" status
    );
    $contact_sync = $ac->api("contact/sync", $contact);
   
   

    $user_tag = array(
        "email" => isset($_REQUEST['account_email']) ? $_REQUEST['account_email'] : "",
        "tags" => isset($_REQUEST['type']) && trim($_REQUEST['type']) == "owner" ? "SAP [Product] Owner 2017" : "SAP [Product] Team Member 2017",
//        "tags" => "SAP [Product] Team Member 2017",
    );
//    $contact_tag = $ac->api("contact/tag_add", $user_tag);
    $post_data = array(
        "contact_email" => isset($_REQUEST['account_email']) ? $_REQUEST['account_email'] : "", // include this or contact_id
        "automation" => isset($_REQUEST['type']) && trim($_REQUEST['type']) == "owner" ? 23 : 29, // one or more
    );
    $response = $ac->api("automation/contact/add", $post_data);
    if ($contact_sync->success) {
        $userarr = reset(get_users(
                        array(
                            'meta_key' => "memberium_ac_contact_id",
                            'meta_value' => $contact_sync->subscriber_id,
                            'number' => 1,
                            'count_total' => false
                        )
        ));
         
        if (isset($_REQUEST['type']) && trim($_REQUEST['type']) == "owner") {
            update_user_meta($userarr->ID, 'learndash_group_leaders_' . $post_owner, $post_owner);
        }
        $userdata1['ID'] = $userarr->ID;
        $userdata1['first_name'] = $_REQUEST['account_first_name'];
        $userdata1['last_name'] = $_REQUEST['account_last_name'];
        wp_update_user($userdata1);
        $post_users[0][count($post_users[0])] = $userarr->ID;
        update_post_meta($post_owner, "learndash_group_users_" . $post_owner, $post_users[0]);
        update_user_meta($userarr->ID, "wpsd_capabilities", $access_group);
        update_user_meta($userarr->ID, "memb_tags", $tag);
        $msg = "Contact Added Successfully";
        $boolHome = true;
        if (isset($gruop_post) && count($gruop_post) > 0) {
            $post_users = get_post_meta($gruop_post[0], 'learndash_group_users_' . $gruop_post[0]);
        }
        $total_users = count($post_users[0]);
        if (!isset($group_limit[0]) && trim($group_limit[0]) == "") {
            $remaining_limit = 15 - $total_users;
        } else {
            $remaining_limit = $group_limit[0] - $total_users;
        }

        $limit_full = "";
        if ($remaining_limit == 0) {
            $limit_full = "Please contact with admin to increase limit";
        }
    }
}
//if (isset($_REQUEST['accessL']) && trim($_REQUEST['accessL']) != "") {
//    if (trim($_REQUEST['accessL'] == "owner")) {
//        $user_tag = array(
//            "email" => isset($_REQUEST['account_email'][0]) ? $_REQUEST['account_email'][0] : "",
//            "tags" => "SAP [Product] Owner 2017",
//        );
//        $contact_tag = $ac->api("contact/tag_add", $user_tag);
//        $user_tag_remove = array(
//            "email" => isset($_REQUEST['account_email'][0]) ? $_REQUEST['account_email'][0] : "",
//            "tags" => "SAP [Product] Team Member 2017",
//        );
//        $contact_tag_remove = $ac->api("contact/tag_remove", $user_tag_remove);
//    }
//    if (trim($_REQUEST['accessL'] == "team")) {
//        $user_tag = array(
//            "email" => isset($_REQUEST['account_email'][0]) ? $_REQUEST['account_email'][0] : "",
//            "tags" => "SAP [Product] Team Member 2017",
//        );
//        $contact_tag = $ac->api("contact/tag_add", $user_tag);
//        $user_tag_remove = array(
//            "email" => isset($_REQUEST['account_email'][0]) ? $_REQUEST['account_email'][0] : "",
//            "tags" => "SAP [Product] Owner 2017",
//        );
//        $contact_tag_remove = $ac->api("contact/tag_remove", $user_tag_remove);
//    }
//}
?>
<?php //echo $count1;?>
<?php if (isset($bool) && $bool) { ?>
    <div id="main-content">
        <div class="container">
            <div id="content-area" class="clearfix">
                <article>
                    <div class="entry-content">
                        <div class="manage_wrap">
                            <div class="logo"> <img style="padding-top: 10px;padding-bottom: 20px;" src="<?php bloginfo('url'); ?>/wp-content/uploads/2017/11/Team-Member-Accounts-Header.png"> </div>
                            <div class="inner_wrap">
                                <?php
                                if (isset($_REQUEST['action']) && trim($_REQUEST['action']) != "") {
                                    $action = $_REQUEST['action'];
                                }
                                if ($action == "add" && $_REQUEST['type'] == "owner" && !$boolHome) {
                                    ?>
                                    <h3 style="color: #5A0505">Add Team Owner</h3>
                                    <?php if (isset($msg) && trim($msg) != "") { ?>
                                        <h3 class="h3style" style="background-color: #5A0505 !important;"><?php echo $msg; ?></h3>
                                    <?php } ?>
                                    <div class="woocommerce-MyAccount-content">
                                        <form class="" action="" method="post">
                                            <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                <label for="account_first_name">First name <span class="required">*</span></label>
                                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="">
                                            </p>
                                            <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                <label for="account_last_name">Last name <span class="required">*</span></label>
                                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="">
                                            </p>
                                            <div class="clear"></div>
                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="account_email">Email address <span class="required">*</span></label>
                                                <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="">
                                            </p>
                                            <div class="clear"></div>
                                            <p>
                                                <input type="hidden" name="adduser" value="1">
                                                <input type="hidden" name="type" value="owner">
                                                <input type="submit" class="woocommerce-Button button" name="save_account_details" value="Add">
                                                <a href="http://members.serviceadvisorpro.com/team-member-accounts/" class="manage_btn">Back</a>
                                            </p>
                                        </form>
                                    </div>
                                <?php } else if ($action == "add" && $_REQUEST['type'] == "team") { ?>
                                    <h3 style="color: #5A0505">Add Team Member</h3>
                                    <?php if (isset($msg) && trim($msg) != "") { ?>
                                        <h3 class="h3style" style="background-color: #5A0505 !important;"><?php echo $msg; ?></h3>
                                    <?php } ?>
                                    <div class="woocommerce-MyAccount-content">
                                        <form class="" action="" method="post">
                                            <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                <label for="account_first_name">First name <span class="required">*</span></label>
                                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo isset($_REQUEST['account_first_name']) && trim($_REQUEST['account_first_name']) != "" ? $_REQUEST['account_first_name'] : "" ?>">
                                            </p>
                                            <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                <label for="account_last_name">Last name <span class="required">*</span></label>
                                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo isset($_REQUEST['account_last_name']) && trim($_REQUEST['account_last_name']) != "" ? $_REQUEST['account_last_name'] : "" ?>">
                                            </p>
                                            <div class="clear"></div>
                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="account_email">Email address <span class="required">*</span></label>
                                                <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo isset($_REQUEST['account_email']) && trim($_REQUEST['account_email']) != "" ? $_REQUEST['account_email'] : "" ?>">
                                            </p>
                                            <div class="clear"></div>
                                            <p>
                                                <input type="hidden" name="adduser" value="1">
                                                <input type="hidden" name="type" value="member">
                                                <input type="submit" class="woocommerce-Button button" name="save_account_details" value="Add">
                                                <a href="http://members.serviceadvisorpro.com/team-member-accounts/" class="manage_btn">Back</a>
                                            </p>
                                        </form>
                                    </div>
                                    <?php
                                } else if (isset($_REQUEST['action']) && trim($_REQUEST['action']) == "edit" && trim($_REQUEST['user']) != "") {

                                    $current_user_meta = get_user_meta($_REQUEST['user'], 'memb_tags');
                                    ?>
                                    <h3 style="color: #5A0505">Update Access Level</h3>
                                    <?php if (isset($msg) && trim($msg) != "") { ?>
                                        <h3 class="h3style" style="background-color: #5A0505 !important;"><?php echo $msg; ?></h3>
                                    <?php } ?>
                                    <form class="" action="" method="post">
                                        <select name="accessL">
                                            <option value="owner" <?php echo strpos($current_user_meta[0], 'Owner') ? "selected" : "" ?>>Manager</option>
                                            <option value="team"<?php echo strpos($current_user_meta[0], 'Team') ? "selected" : "" ?>>Advisor</option>
                                        </select>

                                        <input type="hidden" name="editID" value="<?php echo $_REQUEST['user'] ?>">
                                        <input type="submit" name="edit-user" value="Update">
                                        <a href="http://members.serviceadvisorpro.com/team-member-accounts/" class="manage_btn">Back</a>
                                    </form>
                                <?php } else { ?>
                                    <h3 style="color: #5A0505">You can add <b><?php echo $remaining_limit ?></b> more users. <?php // echo $limit_full              ?></h3>
                                    <?php if (isset($msg) && trim($msg) != "") { ?>
                                        <h3 class="h3style" style="background-color: #5A0505 !important;"><?php echo $msg; ?></h3>
                                    <?php } ?>
                                    <p>Below is a list of people within your organization who have access to Service Advisor Pro. If you need to update the access level for an individual, click on the 'edit' link. Click the 'remove' link to delete a user. Continue below this table to get more information on access levels and to add new users.</p>
                                    <div class="table_wrap">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>Email</td>
                                                    <td>Access Level</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($post_users[0] as $users) {
                                                    $userData = get_user_by('id', $users);
                                                    $current_user_meta = get_user_meta($users, 'memb_tags');
                                                    ?>
                                                    <tr>
                                                        <td style="width: 30%;"><strong><?php echo $userData->first_name . ' ' . $userData->last_name; ?></strong></td>
                                                        <td class="email"><?php echo $userData->user_email ?></td>
                                                        <td class="level"><?php echo strpos($current_user_meta[0], 'Owner') ? "Manager" : "Advisor" ?></td>
                                                        <td style="width: 30%;" class="acton"><a href="<?php bloginfo('url'); ?>/team-member-accounts/?action=edit&user=<?php echo $users; ?>">Edit</a> / <a href="<?php bloginfo('url'); ?>/team-member-accounts/?action=delete&user=<?php echo $users; ?>&type=<?php echo strpos($current_user_meta[0], 'Owner') ? "owner" : "team" ?>" onclick="return confirm('Are you sure?')">Remove</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3 style="color: #5A0505">GIVE ACCESS TO YOUR TEAM</h3>
                                    <p>For other managers and owners who you wish to have access to all modules and trainings, the ability to review reports on your team, access additional resources and have the ability to add more team members, click the "Add a Manager" button.</p>
                                    <p>For service advisors who you wish to have access to the modules and trainings, click the "Add an Advisor" button.</p>
                                    <div class="bottom_link_wrap"> 
                                        <?php if (trim($limit_full) == "") { ?>
                                            <a href="<?php bloginfo('url'); ?>/team-member-accounts/?action=add&type=owner" data-slimstat="5">
                                                <img src="<?php bloginfo('url'); ?>/wp-content/uploads/2017/05/add_a_manager_2.png" alt="">
                                            </a> 
                                            <a href="<?php bloginfo('url'); ?>/team-member-accounts/?action=add&type=team" data-slimstat="5">
                                                <img src="<?php bloginfo('url'); ?>/wp-content/uploads/2017/05/advisor_card.png" alt="">
                                            </a> 
                                        <?php } ?>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <?
} else {
    echo "<div style='padding: 100px;margin-bottom: 200px;'><h2>Secure Content</h2>Your user account does not have access to this page. You can check with any others at your company that have Owner / Executive accounts to either access this page or change your user account to have access this page.
<a href='http://members.serviceadvisorpro.com/my-dashboard/'>Click here</a> to return to the dashboard.</div>";
//    wp_redirect('https://members.nlbformula.com');
//    exit;
}
?>
<?php get_footer(); ?>
