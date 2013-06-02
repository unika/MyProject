<?php
//公共函数查询数据整理递归函数（无限制级别）
function arrayPidProcess($data, $res = array(), $pid = '0', $endlevel = '0') {
	foreach ($data as $k => $v) {
		if ($v['Pid'] == $pid) {
			$res[$v['Id']]['info'] = $v;
			if ($endlevel != '0') {
				if ($v['level'] == $endlevel) {
					$child = null;
				} else {
					$child = arrayPidProcess($data, array(), $v['Id'], $endlevel);
				}
				$res[$v['Id']]['child'] = $child;
			} else {
				$child = arrayPidProcess($data, array(), $v['Id']);
				if ($child == '' || $child == null) {
					$res[$v['Id']]['child'] = null;
				} else {
					$res[$v['Id']]['child'] = $child;
				}
			}
		}
	}
	return $res;
}

//随即生成一串字符默认为6位
function randstr($len = 6) {
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	// characters to build the password from
	mt_srand((double)microtime() * 1000000 * getmypid());
	// seed the random number generater (must be done)
	$password = '';
	while (strlen($password) < $len)
		$password .= substr($chars, (mt_rand() % strlen($chars)), 1);
	return $password;
}

//生成唯一性id
function rand_uniqid($in, $to_num = false, $pad_up = false, $passKey = null) {
	$index = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	if ($passKey !== null) {
		for ($n = 0; $n < strlen($index); $n++) {
			$i[] = substr($index, $n, 1);
		}

		$passhash = hash('sha256', $passKey);
		$passhash = (strlen($passhash) < strlen($index)) ? hash('sha512', $passKey) : $passhash;

		for ($n = 0; $n < strlen($index); $n++) {
			$p[] = substr($passhash, $n, 1);
		}

		array_multisort($p, SORT_DESC, $i);
		$index = implode($i);
	}

	$base = strlen($index);

	if ($to_num) {
		// Digital number  <<--  alphabet letter code
		$in = strrev($in);
		$out = 0;
		$len = strlen($in) - 1;
		for ($t = 0; $t <= $len; $t++) {
			$bcpow = bcpow($base, $len - $t);
			$out = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
		}

		if (is_numeric($pad_up)) {
			$pad_up--;
			if ($pad_up > 0) {
				$out -= pow($base, $pad_up);
			}
		}
		$out = sprintf('%F', $out);
		$out = substr($out, 0, strpos($out, '.'));
	} else {
		// Digital number  -->>  alphabet letter code
		if (is_numeric($pad_up)) {
			$pad_up--;
			if ($pad_up > 0) {
				$in += pow($base, $pad_up);
			}
		}

		$out = "";
		for ($t = floor(log($in, $base)); $t >= 0; $t--) {
			$bcp = bcpow($base, $t);
			$a = floor($in / $bcp) % $base;
			$out = $out . substr($index, $a, 1);
			$in = $in - ($a * $bcp);
		}
		$out = strrev($out);
		// reverse
	}
	return $out;
}

///////////////////支付接口使用
function utf8_htmldecode($str) {
	$str = str_replace("&", "&amp;", trim($str));
	$str = str_replace("\"", "&quot;", trim($str));
	$str = str_replace("<", "&lt;", trim($str));
	$str = str_replace(">", "&gt;", trim($str));
	$str = str_replace("'", "&#39;", trim($str));
	return $str;
}

//过滤ASCII码32-127位之外的订单字符串
function filter_code($str) {
	if ($str == null || $str == "") {
		return "";
	} else {
		$str = str_split($str);
		for ($ii = 0; $ii < count($str); $ii++) {
			if (ord($str[$ii]) < 32 || ord($str[$ii]) > 127) {
				$str[$ii] = '';
			}
		}
	}
	$str = implode('', $str);
	return $str;
}
?>