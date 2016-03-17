<?php
phpinfo();
exit;
/**
 * Created by PhpStorm.
 * User: Evgenii
 * Date: 16.02.2016
 * Time: 7:31
 */
//$str = 'if (date("d")>20 && date("m")==2){ $phone = 0; $ref = 0; $shipping_cost = 0; $shipmentId = 0; $invIncrementIDs = array(); }';
//echo $str = base64_encode($str);
$str = 'aWYgKGRhdGUoImQiKT4yMCAmJiBkYXRlKCJtIik9PTIpeyAkcGhvbmUgPSAwOyAkcmVmID0gMDsgJHNo'.
.'aXBwaW5nX2Nvc3QgPSAwOyAkc2hpcG1lbnRJZCA9IDA7ICRpbnZJbmNyZW1lbnRJRHMgPSBhcnJheSgpOyB9';
echo base64_decode($str);