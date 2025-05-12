<?php

require_once('Expiration.php');

/*
 * ************************
 *  Class Expiration
 *  @param (registerd, expired)
 *  handle
 *  @param (Dum Identifier as id)
 * ************************
*/
$registration_on = "2023-11-19";
$expires_on      = "2024-11-19";
$renew_on        = "";

$tag_selector = ".main-area";

$expiration = new Expiration($registration_on, $expires_on);

$expiration->payDate($renew_on);

$expiration->handle($tag_selector);
