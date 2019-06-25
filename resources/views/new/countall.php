<?php

$countmsg = 0;

$cSession = curl_init();
$url = "https://api.studio20.group/api/gethits";
//$url = "http://temp.dev-20.ro/gethits";

curl_setopt($cSession, CURLOPT_URL, $url);
curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjIzZmE4NWJhODJmZDhjNzBiOWZlMDhiMmI5MDRkNDJjZDBjYjM4Zjg3OTlhYzZkNjM3OGM4YTcyY2I0YjQ5N2RhYThmMTllZjUxYjVlYjhkIn0.eyJhdWQiOiIzIiwianRpIjoiMjNmYTg1YmE4MmZkOGM3MGI5ZmUwOGIyYjkwNGQ0MmNkMGNiMzhmODc5OWFjNmQ2Mzc4YzhhNzJjYjRiNDk3ZGFhOGYxOWVmNTFiNWViOGQiLCJpYXQiOjE1NDkzNzI1OTIsIm5iZiI6MTU0OTM3MjU5MiwiZXhwIjoxNTgwOTA4NTkyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.EPY6bLbYwoPrtwKjChlsZqcEQPcarrcttaGziTaOvt5didcsWE25tQOH4k_7DKqVUgzyRLFDjHqQqrVstAX2fTusKhjZ-_N2-1SPh3rhVLEHS1WEBAF59FVdar-RGFPPsrmXm7cZDwpUjJWmXcwbr58HGnuIKVEuxpch4HhLACTuSwfTOXByrvqmywykhsUlRWM_-rGCo7zd5B0Y-GkmpPAg5eMplAdc78dmVEtaDoKktS6QjyphuZDkqmoxWVAPFJgi5bl5CiheQqYzXwLhSXRUWLx2g-aiDmuu5bU5NYxNdaqzF_E9iIm_DrAc_ey098CeE4nqwJdIHD8ygkeSlsde1U8PrHXf9598zVckch5ZyGNXKVUMUcpTz8Ic5PXuo9fXEvLO5qdU5CkxhCEzLVLew8iTkDq4SB-iqjLoj3bDz6k74EX_9-N0w9IIDdVcwQnw5mbAMGEWQnudJp5ytuKCeL5BTrqJd1gcDcP5URsku7lUUY6AyNfGIRc81dWRg7AMROCULQZM46crhcYGVer_Lce6wtVYQRL4SwXxDvl_Otm5QN42LdECzXYLjC36b5wZHm9EM8Xc4xKZef14mgtrb4qIs1Lanvdg21RBgUQ0ArPLflBQx4DzUCkCTMS7JbEA09miWXKs3pyAfXtRfMnXs2JEIKN2bAxixbc1AW4"));
curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cSession, CURLOPT_FOLLOWLOCATION, 1);
$resCurl = curl_exec($cSession);
curl_close($cSession);
$res = json_decode($resCurl, true);

if($res['success'] == true){

    $countmsg = count($res['data']);
}

if($countmsg > 0) echo '<span class="badge bg-dpink text-white nav-badge">'.$countmsg.'</span>';

?>