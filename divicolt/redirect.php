<?php

/* Template Name:Redirect */


$InfsID = "";
$user_ID = get_current_user_id();
$usermeta = get_user_meta($user_ID);
if ($usermeta['infusionsoft_user_id'][0]) {
    $InfsID = $usermeta['infusionsoft_user_id'][0];
}


if(memb_hasAnyTags(23,$InfsID))
{
    echo '<script>window.location.href = "http://members.serviceadvisorpro.com/managers-dashboard/"</script>';
    exit;
}
if(memb_hasAnyTags(27,$InfsID))
{
   echo '<script>window.location.href = "http://members.serviceadvisorpro.com/advisors-dashboard/"</script>';
   exit;
}
// window.location.href = "https://members.nlbformula.com/team-dashboard/"
// window.location.href = "https://members.nlbformula.com/owners-dashboard/"