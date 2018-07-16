<?php
/*
  Template Name: Login Tracking
 */
get_header();

if (isset($_REQUEST['email']) && trim($_REQUEST['email']) != "") {
    $user = get_user_by('email', $_REQUEST['email']);
  
    if (count($user) == 0 || empty($user)) {
        $msg = 'No record found';
    } else {
        $user_login_history = get_user_meta($user->ID, 'user_login_history');
//        echo '<pre>';
//        print_r($user_login_history);
        
        $count = 0;
        if (isset($user_login_history[0]) && count($user_login_history[0]) > 0) {
            $count = count($user_login_history[0]);
        } else {
            
        }
//        echo $_REQUEST['date'];
       
        $currentDate = strtotime($_REQUEST['date']);
        
        if (!in_array($currentDate, $user_login_history[0])) {
            $user_login_history[0][$count] = $currentDate;
            update_user_meta($user->ID, 'user_login_history', $user_login_history[0]);
            $msg = 'Information Updated';
        }
    }
}
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

    .manage_btn:hover {

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

                                        <h3 style="color: #5A0505">Add Login Tracking</h3>

<?php if (isset($msg) && trim($msg) != "") { ?>

                                            <h3 class="h3style" style="background-color: #5A0505 !important;"><?php echo $msg; ?></h3>

<?php } ?>

                                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">

                                            <label for="account_first_name">User Email<span class="required">*</span></label>

                                            <input type="text"  required  class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="email" value="">

                                        </p>

                                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">

                                            <label for="account_first_name">Pick Date <span class="required">*</span></label>

                                            <select name="date">
<?php
$pre_monday = date('Y-m-d', strtotime('monday last week'));
//                                                $current_monday = date('Y-m-d', strtotime('monday this week'));

for ($i = 0; $i <= 13; $i++) {
    $newdate = strtotime('+' . $i . ' day', strtotime($pre_monday));
    $newdate = date('Y-m-d', $newdate);
    ?>
                                                    <option value="<?php echo $newdate ?>"><?php echo $newdate ?></option>
                                                <? }
                                                ?>   
                                            </select>   

                                        </p>

                                        <div class="clear"></div>

                                        <p>

                                            <input type="hidden" name="adduser" value="1">

                                            <input type="hidden" name="type" value="owner">

                                            <input type="submit" class="woocommerce-Button button" name="save_account_details" value="Add" onclick="return validatePassword()">



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
<?php get_footer(); ?>