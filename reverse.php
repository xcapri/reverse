<?php

@system("clear");

//$blue="\033[1;34m";
//$cyan="\033[1;36m";
$ijo="\033[92m";
//$lightgreen="\033[1;32m";
$white="\033[1;37m";
//$purple="\033[1;35m";
$red="\033[1;31m";
//$yellow="\033[1;33m";

//th to [NBA NoobBisaApa] <3 - Akazh - and you all
//$STDIN = fopen('php://STDIN', 'r');

function banner() {
	$out = "
---------------------------------------------------
 _  _  ____    __     /\/\    ___  _____  ____  ____  ____ 
( \( )(  _ \  /__\    ||||   / __)(  _  )(  _ \( ___)(  _ \
 )  (  ) _ < /(__)\   ||||  ( (__  )(_)(  )(_) ))__)  )   /
(_)\_)(____/(__)(__)  \/\/   \___)(_____)(____/(____)(_)\_)
NoobBisaApa ( yang lain bisa kenapa kita nggak ? )
---------------------------------------------------".PHP_EOL;
	return $out;
}
echo banner();


echo "$red [1] $white Reverse IP \n";
echo "$red [2] $white Reverse path from Site \n";
echo "$red [3] $white Reverse path from list \n";
echo "$red [4] $white Find subdomains \n\n";
//echo "$red [5] $white next time v: \n";
echo "$ijo [0] Select > $white";
$selection = trim(fgets(STDIN));
// selection
if ($selection == 1) {
	//excute 
	@system("clear");
	echo "[Reverse IP] \n";
	echo "$ijo Enter domain > $white ";
	$domain = trim(fgets(STDIN));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://api.hackertarget.com/reverseiplookup/?q='.$domain.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
	$headers = array();
	$headers[] = 'Connection: keep-alive';
	$headers[] = 'Cache-Control: max-age=0';
	$headers[] = 'Dnt: 1';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.75 Safari/537.36';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
	$headers[] = 'Accept-Encoding: gzip, deflate';
	$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if ($info == '200') {
		$site = "$domain.txt";		
		file_put_contents($site, $result.PHP_EOL, FILE_APPEND);
		echo "$red Done!  $white \n\n";
	}
}
if ($selection == 2) {
	//excute 
	@system("clear");
	echo "[Reverse PATH from site] \n";
	echo "$ijo Enter domain > $white ";
	$domain = trim(fgets(STDIN));
	echo "$ijo Enter path > $white ";
	$path = trim(fgets(STDIN));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://api.hackertarget.com/reverseiplookup/?q='.$domain.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');	
	$headers = array();
	$headers[] = 'Connection: keep-alive';
	$headers[] = 'Cache-Control: max-age=0';
	$headers[] = 'Dnt: 1';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.75 Safari/537.36';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
	$headers[] = 'Accept-Encoding: gzip, deflate';
	$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if ($info == '200') {
		$from = "$domain.txt";
		file_put_contents($from, $result.PHP_EOL, FILE_APPEND);
		$list = file_get_contents($from);
		$asw = explode("\n", $list);
		$i = 0;
		echo "\n\n";
		foreach ($asw as $line) {
			$i++;
			$fullurl = "$line$path";
			if ($fullurl) {
				$http = "http://$fullurl";
				$ch = 
				curl_init($http);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, true);  
				curl_setopt($ch, CURLOPT_NOBODY, true);
				curl_setopt($ch, CURLOPT_TIMEOUT,30);
				$exec = curl_exec($ch);
				$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if ($info == '200') {
					file_put_contents("200OK.txt", $http.PHP_EOL, FILE_APPEND);
					echo "$ijo [✔] $white 200OK $http \n";
				}else {
					$https = "https://$fullurl";
					$chs = 
					curl_init($https);
					curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($chs, CURLOPT_HEADER, true);  
					curl_setopt($chs, CURLOPT_NOBODY, true);
					curl_setopt($chs, CURLOPT_TIMEOUT,30);
					$exec = curl_exec($chs);
					$infos = curl_getinfo($chs, CURLINFO_HTTP_CODE);
					curl_close($chs);
					if ($infos == '200') {
						file_put_contents("200OK.txt", $https.PHP_EOL, FILE_APPEND);
						echo "$ijo [✔] $white 200OK $https \n";
					}else{
						file_put_contents("notconnect.txt", $https.PHP_EOL, FILE_APPEND);
						echo "$red [✖] $white Gagal Terhubung Ke ".$https." \n";
					}   
				} 
			}
		}
	}else {
		echo "$red [✔] REVERSE IP FAILED \n";
	}	
}
if ($selection == 3) {
	//excute
	@system("clear");
	echo "[Reverse PATH from list] \n";
	echo "$ijo Enter list > $white";
	$list = trim(fgets(STDIN));
	echo "$ijo Enter path > $white";
	$path = trim(fgets(STDIN));
	$file_lines = file_get_contents($list);
	$asw = explode("\r\n", $file_lines);
/*if (!$file_lines){
   echo "ERROr : Unable Open ".$list."\n";
   exit();
}
echo "\n\n! Cek Jumlah URL";
sleep(1);
echo " •";
sleep(1);
echo "•";
sleep(1);
echo "•";
$no = 0;
foreach ($asw as $line) {
    $no++;
}
sleep(1);
echo "•\n";
sleep(1);
echo "/•\ Total URL List : ".$no."\n\n\n";*/
$i = 0;
echo "\n\n";
foreach ($asw as $line) {
	$i++;
	$exploding = explode("://", $line);
	$fullurl = "$line$path";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $fullurl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, true);  
	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$result = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ($info == '200') {
		file_put_contents("200ok.txt", $fullurl.PHP_EOL, FILE_APPEND);
		echo "$ijo [✔] $white 200OK $fullurl \n";
	}else{
		file_put_contents("notconnect.txt", $fullurl.PHP_EOL, FILE_APPEND);
		echo "$red [✖] $white Gagal Terhubung Ke ".$fullurl." \n";
	}
}
}
if ($selection == 4) {
	//thx Akazh
	@system("clear");
	echo "[Find Subdomains] \n";	
	echo "$ijo Enter domain > $white";
	$domain = trim(fgets(STDIN));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.indoxploit.or.id/domain/'.$domain.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$headers = array();
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.75 Safari/537.36';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,/;q=0.8,application/signed-exchange;v=b3';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	$jsub = json_decode($result, true);
	$subdo = $jsub["data"]["subdomains"];
	foreach($subdo as $ok){
		$domain =  "$ok \n";
		echo $domain;
    // simpan 
		$f = "subdomain.txt";
		touch($f);
		$w = fopen($f, "a");
		fwrite($w, $ok."\n");
		fclose($w);
	}
}
//else {
	//echo "$red Not selected";
//}

?>