<?php
global $naam;
function valid_naam ($str)
{
    return (ereg('^[A-Za-z -]+$', $str));
}
global $adres;
function valid_adres($adres)
{
    return (ereg('^[A-Za-z -]+[0-9]+[a-z -]*$',$adres));    
}
global $postcode;
function valid_postcode($postcode)
{
    return (ereg('^[1-9][0-9]{3}[]?[A-Za-z]{2}$',$postcode));
}
global $woonplaats;
function valid_woonPlaats($woonplaats)
{
    return (ereg('^[A-Za-z-]+$',$woonplaats));
}
global $telefoon;
function valid_telefoon($telefoon)
{
    return (ereg('^[0-9]{10}$',$telefoon));
}
global $email;
function valid_email($email)
{
    return (ereg('(^[0-9a-zA-Z_\.-]{1,}@[0-9a-zA-Z_\-]{1,}\.)+[0-9a-zA-Z_\-]{2,}$)',$email));
}
/*
global $email;
function check_email($email) { // return TRUE or FALSE
  $patroon = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@([a-z0-9_-]{2,}\.)+([a-z0-9_-]{2,})$/i";
  return preg_match($patroon, $email);
}    */
