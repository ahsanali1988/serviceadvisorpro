<?php
/*  Template Name: Password Change */
if(!is_user_logged_in())
    {
    wp_redirect('https://members.serviceadvisorpro.com');
    exit;
    
    }
    require_once("activecampaign-api-php/includes/ActiveCampaign.class.php");
    get_header();?>
<style>    
    #main-content .container:before {        display: none;    }    
    #main-content .container {        padding-top: 0px;    }
    .manage_wrap {    }
    .manage_wrap .inner_wrap {        width: 60%;        margin-left: auto;        margin-right: auto;        text-align: center;        padding-bottom: 40px;    }
    .manage_wrap .inner_wrap h3 {        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;        font-weight: bold;        font-size: 24px;        color: #139221;        margin-bottom: 2.75%;    }
    .manage_wrap .inner_wrap p {        padding-bottom: 1em;        font-family: 'Open Sans', Helvetica, Arial, Lucida, sans-serif;        font-size: 18px;        color: #000000;    }
    .manage_wrap .inner_wrap .table_wrap {        margin-top: 30px;        text-align: left;        margin-bottom: 30px;    }
    #content-area .manage_wrap .inner_wrap .table_wrap thead td {        background-color: #000 !important;        color: #fff !important;        font-family: 'Open Sans Condensed', Helvetica, Arial, Lucida, sans-serif;        font-size: 15px;        font-weight: bold;    }
    #content-area .manage_wrap .inner_wrap .table_wrap table td {        padding: 0.557em .587em;        border: 1px solid #525252;        color: #000;        background-color: #f2f2f2;    }
    #content-area .manage_wrap .inner_wrap .table_wrap table td select {        background-color: transparent;        border: none;        cursor: pointer;        font-family: "Open Sans", Arial, sans-serif;        color: #000;    }
    #content-area table td a {        color: #139221;    }    
    #content-area .manage_wrap .inner_wrap .table_wrap tr:nth-child(odd) td {        background-color: #c0c0c0;    }
    .manage_wrap .inner_wrap label {        font-size: 14px;        margin-right: 20px;        display: block;        text-align: left;        font-weight: 600;        margin-bottom: 5px;    }
    .manage_wrap .inner_wrap input[type="password"],     .manage_wrap .inner_wrap select,     .manage_wrap .inner_wrap input[type="email"] {        height: 35px;        font-size: 13px;        padding: 5px 12px;        font-weight: 400;        line-height: 1.42857143;        color: #3a3a3a;        background-color: #ffffff;        background-image: none;        border: 1px solid #ccc;        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);        -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;        font-family: 'Open Sans', Helvetica, Arial, Lucida, sans-serif;        width: 100%;        margin-bottom:15px;    }
    .manage_wrap .inner_wrap input[type="submit"], .manage_btn {        background-color: #5A0505 !important;        margin-left: 0px;        color: #fff;        line-height: 1;        box-shadow: none;        padding: 11px 10px;        -webkit-transition: all 0.2s;        -moz-transition: all 0.2s;        transition: all 0.2s;        font-size: 17px;        display: inline-block;        min-width: 150px;        border: none;        font-family: 'Open Sans Condensed',Helvetica,Arial,Lucida,sans-serif !important;        font-weight: bold;        font-size: 21px;        cursor: pointer;    }
    .manage_btn:hover {        background: #ff9f00!important;        color: #fff !important;    }
    .manage_wrap .inner_wrap form p{        padding-bottom:0px !important;	    }
    @media (min-width: 992px) and (max-width: 1199px) {        .manage_wrap .inner_wrap {            width: 80%;        }    }
    @media (min-width: 768px) and (max-width: 991px) {        .manage_wrap .inner_wrap {            width: 90%;        }    }
    @media (max-width: 767px) {        .manage_wrap .inner_wrap {            width: 95%;        }    }
    .h3style{        width: 100%;        background-color: #139221;        color: white !important;        padding: 10px;    }
    
</style>
    
    <?php 
    $ac = new ActiveCampaign("https://gjbishopenterprises.api-us1.com", "c6e59aa5ab9521e73b734892593bf042472abc83bcca9ca0f0a742cc30bd4e44b0a6c6b6");
    
    $list_id = 13;
    if (isset($_REQUEST['password'])) {   
        $userID = get_current_user_id();    
        $user = get_user_meta($userID);    
        $userData = get_user_by('ID', $userID);
//    echo '<pre>';
//    print_r($user['memberium_ac_contact_id'][0]);
//    print_r($userData->user_email);
        $contact = array("id" => isset($user['memberium_ac_contact_id'][0]) ? $user['memberium_ac_contact_id'][0] : "", "email" => isset($userData->user_email) ? $userData->user_email : "", "field[%SAPPASSWORD%,0]" => $_REQUEST['password'], "p[{$list_id}]" => $list_id,"status[{$list_id}]" => 1);
        $contact_sync = $ac->api("contact/edit", $contact);    
        if ($contact_sync->result_code) {
            wp_set_password($_REQUEST['password'], $userID);    
            
        }    
        $msg = "Password Changed";
        
        }?>
<div id="main-content">    
    <div class="container">        
        <div id="content-area" class="clearfix">            
            <article>                
                <div class="entry-content">                    
                    <div class="manage_wrap">                        
                        <div class="inner_wrap">                            
                            <div class="woocommerce-MyAccount-content">                                
                                <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">                                    
                                    <div style="width:500px;">                                         
                                        <h3 style="color: #5A0505">Change your password</h3>                                         
                                            <?php if (isset($msg) && trim($msg) != "") { ?>                                        
                                        <h3 class="h3style" style="background-color: #5A0505 !important;"><?php echo $msg; ?></h3>                                    
                                            <?php } ?>                                        
                                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">                                            
                                            <label for="account_first_name">Change Password<span class="required">*</span></label>                                            
                                            <input type="password" pattern=".{6,20}"   required title="Minimum 6 characters allowed" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="newPassword" value="">                                        
                                        </p>                                        
                                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">                                            
                                            <label for="account_first_name">Confirm Password <span class="required">*</span></label>                                            
                                            <input type="password" pattern=".{6,20}"   required title="Minimum 6 characters allowed" class="woocommerce-Input woocommerce-Input--text input-text" name="cpassword" id="confirmPassword" value="">                                        
                                        </p>                                        
                                        <div class="clear"></div>                                        
                                        <p>                                            
                                            <input type="hidden" name="adduser" value="1">                                            
                                            <input type="hidden" name="type" value="owner">                                            
                                            <input type="submit" class="woocommerce-Button button" name="save_account_details" value="Change" onclick="return validatePassword()">                                        
                                        </p>                                    
                                    </div>                            
                            </div>                            
                            </form>                        
                            </div>                    
                    </div>                
                </div>            
            </article>        
        </div>    
    </div>
</div>
<script>    
    function validatePassword() {        
        var newPassword = jQuery("#newPassword").val();        
        var confirmPassword = jQuery("#confirmPassword").val();        
        var output = "";        
        if (!newPassword) {
            jQuery("#newPassword").focus();
            alert("New Password is required");
            output = false;
        } else if (!confirmPassword) {            
            jQuery("#confirmPassword").focus();            
            alert("Confirm Password is required");            
            output = false;        
        } else if (newPassword != confirmPassword) {            
            newPassword = "";            
            confirmPassword = "";            
            jQuery("#newPassword").focus();            
            alert("Passwords are not same");            
            output = false;        
        }        
        return output;    
    }
</script>
 <?php get_footer(); ?>