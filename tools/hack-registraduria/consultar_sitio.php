<?php
$urlInterface = 'http://www.corporacionregistrocivil.gov.ec/OnLine/find_cedula.asp';
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL, $urlInterface);
$query = curl_exec($curl_handle);
curl_close($curl_handle);
?>