<?php /*********************************************************************************************************/
 /***************************************** Check PHP Version *********************************************/
 /*echo 'Current PHP version: ' . phpversion(); /*if (phpversion()< "4.1.0") { $_GET = $HTTP_GET_VARS; $_POST = $HTTP_POST_VARS; $_SERVER = $HTTP_SERVER_VARS; } /*********************************************************************************************************/

function shoppermiss ($str,$q){
    $array = explode(",", $str);
    foreach($array as $key => $var){
        if($var==$q) return true;
    }
    return false;
}

function module_keyword($a,$b,$x){
    foreach($a as $key => $var){
        if($var==$x) return $b[$key];
    }
}

function vietdecode($value)
{
    $value = str_replace('“', '', $value);
    $value = str_replace('”', '', $value);
    $value = str_replace("'", '', $value);
    $value = str_replace("á", "a", $value);
    $value = str_replace("à", "a", $value);
    $value = str_replace("ả", "a", $value);
    $value = str_replace("ã", "a", $value);
    $value = str_replace("ạ", "a", $value);
    $value = str_replace("â", "a", $value);
    $value = str_replace("ă", "a", $value);
    $value = str_replace("Á", "a", $value);
    $value = str_replace("À", "a", $value);
    $value = str_replace("Ả", "a", $value);
    $value = str_replace("Ã", "a", $value);
    $value = str_replace("Ạ", "a", $value);
    $value = str_replace("Â", "a", $value);
    $value = str_replace("Ă", "a", $value);
    $value = str_replace("ấ", "a", $value);
    $value = str_replace("ầ", "a", $value);
    $value = str_replace("ẩ", "a", $value);
    $value = str_replace("ẫ", "a", $value);
    $value = str_replace("ậ", "a", $value);
    $value = str_replace("Ấ", "a", $value);
    $value = str_replace("Ầ", "a", $value);
    $value = str_replace("Ẩ", "a", $value);
    $value = str_replace("Ẫ", "a", $value);
    $value = str_replace("Ậ", "a", $value);
    $value = str_replace("ắ", "a", $value);
    $value = str_replace("ằ", "a", $value);
    $value = str_replace("ẳ", "a", $value);
    $value = str_replace("ẵ", "a", $value);
    $value = str_replace("ặ", "a", $value);
    $value = str_replace("Ắ", "a", $value);
    $value = str_replace("Ằ", "a", $value);
    $value = str_replace("Ẳ", "a", $value);
    $value = str_replace("Ẵ", "a", $value);
    $value = str_replace("Ặ", "a", $value);
    $value = str_replace("é", "e", $value);
    $value = str_replace("è", "e", $value);
    $value = str_replace("ẻ", "e", $value);
    $value = str_replace("ẽ", "e", $value);
    $value = str_replace("ẹ", "e", $value);
    $value = str_replace("ê", "e", $value);
    $value = str_replace("É", "e", $value);
    $value = str_replace("È", "e", $value);
    $value = str_replace("Ẻ", "e", $value);
    $value = str_replace("Ẽ", "e", $value);
    $value = str_replace("Ẹ", "e", $value);
    $value = str_replace("Ê", "e", $value);
    $value = str_replace("ế", "e", $value);
    $value = str_replace("ề", "e", $value);
    $value = str_replace("ể", "e", $value);
    $value = str_replace("ễ", "e", $value);
    $value = str_replace("ệ", "e", $value);
    $value = str_replace("Ế", "e", $value);
    $value = str_replace("Ề", "e", $value);
    $value = str_replace("Ể", "e", $value);
    $value = str_replace("Ễ", "e", $value);
    $value = str_replace("Ệ", "e", $value);
    $value = str_replace("í", "i", $value);
    $value = str_replace("ì", "i", $value);
    $value = str_replace("ỉ", "i", $value);
    $value = str_replace("ĩ", "i", $value);
    $value = str_replace("ị", "i", $value);
    $value = str_replace("Í", "i", $value);
    $value = str_replace("Ì", "i", $value);
    $value = str_replace("Ỉ", "i", $value);
    $value = str_replace("Ĩ", "i", $value);
    $value = str_replace("Ị", "i", $value);
    $value = str_replace("ố", "o", $value);
    $value = str_replace("ồ", "o", $value);
    $value = str_replace("ổ", "o", $value);
    $value = str_replace("ỗ", "o", $value);
    $value = str_replace("ộ", "o", $value);
    $value = str_replace("Ố", "o", $value);
    $value = str_replace("Ồ", "o", $value);
    $value = str_replace("Ổ", "o", $value);
    $value = str_replace("Ô", "o", $value);
    $value = str_replace("Ộ", "o", $value);
    $value = str_replace("ớ", "o", $value);
    $value = str_replace("ờ", "o", $value);
    $value = str_replace("ở", "o", $value);
    $value = str_replace("ỡ", "o", $value);
    $value = str_replace("ợ", "o", $value);
    $value = str_replace("Ớ", "o", $value);
    $value = str_replace("Ờ", "o", $value);
    $value = str_replace("Ở", "o", $value);
    $value = str_replace("Ỡ", "o", $value);
    $value = str_replace("Ợ", "o", $value);
    $value = str_replace("ứ", "u", $value);
    $value = str_replace("ừ", "u", $value);
    $value = str_replace("ử", "u", $value);
    $value = str_replace("ữ", "u", $value);
    $value = str_replace("ự", "u", $value);
    $value = str_replace("Ứ", "u", $value);
    $value = str_replace("Ừ", "u", $value);
    $value = str_replace("Ử", "u", $value);
    $value = str_replace("Ữ", "u", $value);
    $value = str_replace("Ự", "u", $value);
    $value = str_replace("ý", "y", $value);
    $value = str_replace("ỳ", "y", $value);
    $value = str_replace("ỷ", "y", $value);
    $value = str_replace("ỹ", "y", $value);
    $value = str_replace("ỵ", "y", $value);
    $value = str_replace("Ý", "y", $value);
    $value = str_replace("Ỳ", "y", $value);
    $value = str_replace("Ỷ", "y", $value);
    $value = str_replace("Ỹ", "y", $value);
    $value = str_replace("Ỵ", "y", $value);
    $value = str_replace("Đ", "d", $value);
    $value = str_replace("Đ", "d", $value);
    $value = str_replace("đ", "d", $value);
    $value = str_replace("ó", "o", $value);
    $value = str_replace("ò", "o", $value);
    $value = str_replace("ỏ", "o", $value);
    $value = str_replace("õ", "o", $value);
    $value = str_replace("ọ", "o", $value);
    $value = str_replace("ô", "o", $value);
    $value = str_replace("ơ", "o", $value);
    $value = str_replace("Ó", "o", $value);
    $value = str_replace("Ò", "o", $value);
    $value = str_replace("Ỏ", "o", $value);
    $value = str_replace("Õ", "o", $value);
    $value = str_replace("Ọ", "o", $value);
    $value = str_replace("Ô", "o", $value);
    $value = str_replace("Ơ", "o", $value);
    $value = str_replace("ú", "u", $value);
    $value = str_replace("ù", "u", $value);
    $value = str_replace("ủ", "u", $value);
    $value = str_replace("ũ", "u", $value);
    $value = str_replace("ụ", "u", $value);
    $value = str_replace("ư", "u", $value);
    $value = str_replace("Ú", "u", $value);
    $value = str_replace("Ù", "u", $value);
    $value = str_replace("Ủ", "u", $value);
    $value = str_replace("Ũ", "u", $value);
    $value = str_replace("Ụ", "u", $value);
    $value = str_replace("Ư", "u", $value);
    $value = str_replace(".", " ", $value);
    $value = str_replace(",", " ", $value);
    $value = str_replace("!", " ", $value);
    $value = str_replace("/", "-", $value);
    $value = str_replace("?", " ", $value);
    $value = str_replace(":", " ", $value);
    $value = str_replace("'", " ", $value);
    $value = str_replace("%", " ", $value);
    $value = str_replace("“ ”", " ", $value);
    $value = str_replace("m²", " ", $value);
    $value = str_replace("&#039;", " ", $value);
    $value = str_replace("&quot;", " ", $value);
    $value = str_replace("&amp;", "va", $value);
    $value = str_replace("(", " ", $value);
    $value = str_replace(")", " ", $value);
    $value = str_replace("-", " ", $value);
    $value = str_replace("   ", " ", $value);
    $value = str_replace("  ", " ", $value);
    return strtolower(str_replace(" ", "-", trim($value)));
}
function vietdecode_v2($value)
{
    $value = str_replace('“', '', $value);
    $value = str_replace('”', '', $value);
    $value = str_replace("'", '', $value);
    $value = str_replace("á", "a", $value);
    $value = str_replace("à", "a", $value);
    $value = str_replace("ả", "a", $value);
    $value = str_replace("ã", "a", $value);
    $value = str_replace("ạ", "a", $value);
    $value = str_replace("â", "a", $value);
    $value = str_replace("ă", "a", $value);
    $value = str_replace("Á", "a", $value);
    $value = str_replace("À", "a", $value);
    $value = str_replace("Ả", "a", $value);
    $value = str_replace("Ã", "a", $value);
    $value = str_replace("Ạ", "a", $value);
    $value = str_replace("Â", "a", $value);
    $value = str_replace("Ă", "a", $value);
    $value = str_replace("ấ", "a", $value);
    $value = str_replace("ầ", "a", $value);
    $value = str_replace("ẩ", "a", $value);
    $value = str_replace("ẫ", "a", $value);
    $value = str_replace("ậ", "a", $value);
    $value = str_replace("Ấ", "a", $value);
    $value = str_replace("Ầ", "a", $value);
    $value = str_replace("Ẩ", "a", $value);
    $value = str_replace("Ẫ", "a", $value);
    $value = str_replace("Ậ", "a", $value);
    $value = str_replace("ắ", "a", $value);
    $value = str_replace("ằ", "a", $value);
    $value = str_replace("ẳ", "a", $value);
    $value = str_replace("ẵ", "a", $value);
    $value = str_replace("ặ", "a", $value);
    $value = str_replace("Ắ", "a", $value);
    $value = str_replace("Ằ", "a", $value);
    $value = str_replace("Ẳ", "a", $value);
    $value = str_replace("Ẵ", "a", $value);
    $value = str_replace("Ặ", "a", $value);
    $value = str_replace("é", "e", $value);
    $value = str_replace("è", "e", $value);
    $value = str_replace("ẻ", "e", $value);
    $value = str_replace("ẽ", "e", $value);
    $value = str_replace("ẹ", "e", $value);
    $value = str_replace("ê", "e", $value);
    $value = str_replace("É", "e", $value);
    $value = str_replace("È", "e", $value);
    $value = str_replace("Ẻ", "e", $value);
    $value = str_replace("Ẽ", "e", $value);
    $value = str_replace("Ẹ", "e", $value);
    $value = str_replace("Ê", "e", $value);
    $value = str_replace("ế", "e", $value);
    $value = str_replace("ề", "e", $value);
    $value = str_replace("ể", "e", $value);
    $value = str_replace("ễ", "e", $value);
    $value = str_replace("ệ", "e", $value);
    $value = str_replace("Ế", "e", $value);
    $value = str_replace("Ề", "e", $value);
    $value = str_replace("Ể", "e", $value);
    $value = str_replace("Ễ", "e", $value);
    $value = str_replace("Ệ", "e", $value);
    $value = str_replace("í", "i", $value);
    $value = str_replace("ì", "i", $value);
    $value = str_replace("ỉ", "i", $value);
    $value = str_replace("ĩ", "i", $value);
    $value = str_replace("ị", "i", $value);
    $value = str_replace("Í", "i", $value);
    $value = str_replace("Ì", "i", $value);
    $value = str_replace("Ỉ", "i", $value);
    $value = str_replace("Ĩ", "i", $value);
    $value = str_replace("Ị", "i", $value);
    $value = str_replace("ố", "o", $value);
    $value = str_replace("ồ", "o", $value);
    $value = str_replace("ổ", "o", $value);
    $value = str_replace("ỗ", "o", $value);
    $value = str_replace("ộ", "o", $value);
    $value = str_replace("Ố", "o", $value);
    $value = str_replace("Ồ", "o", $value);
    $value = str_replace("Ổ", "o", $value);
    $value = str_replace("Ô", "o", $value);
    $value = str_replace("Ộ", "o", $value);
    $value = str_replace("ớ", "o", $value);
    $value = str_replace("ờ", "o", $value);
    $value = str_replace("ở", "o", $value);
    $value = str_replace("ỡ", "o", $value);
    $value = str_replace("ợ", "o", $value);
    $value = str_replace("Ớ", "o", $value);
    $value = str_replace("Ờ", "o", $value);
    $value = str_replace("Ở", "o", $value);
    $value = str_replace("Ỡ", "o", $value);
    $value = str_replace("Ợ", "o", $value);
    $value = str_replace("ứ", "u", $value);
    $value = str_replace("ừ", "u", $value);
    $value = str_replace("ử", "u", $value);
    $value = str_replace("ữ", "u", $value);
    $value = str_replace("ự", "u", $value);
    $value = str_replace("Ứ", "u", $value);
    $value = str_replace("Ừ", "u", $value);
    $value = str_replace("Ử", "u", $value);
    $value = str_replace("Ữ", "u", $value);
    $value = str_replace("Ự", "u", $value);
    $value = str_replace("ý", "y", $value);
    $value = str_replace("ỳ", "y", $value);
    $value = str_replace("ỷ", "y", $value);
    $value = str_replace("ỹ", "y", $value);
    $value = str_replace("ỵ", "y", $value);
    $value = str_replace("Ý", "y", $value);
    $value = str_replace("Ỳ", "y", $value);
    $value = str_replace("Ỷ", "y", $value);
    $value = str_replace("Ỹ", "y", $value);
    $value = str_replace("Ỵ", "y", $value);
    $value = str_replace("Đ", "d", $value);
    $value = str_replace("Đ", "d", $value);
    $value = str_replace("đ", "d", $value);
    $value = str_replace("ó", "o", $value);
    $value = str_replace("ò", "o", $value);
    $value = str_replace("ỏ", "o", $value);
    $value = str_replace("õ", "o", $value);
    $value = str_replace("ọ", "o", $value);
    $value = str_replace("ô", "o", $value);
    $value = str_replace("ơ", "o", $value);
    $value = str_replace("Ó", "o", $value);
    $value = str_replace("Ò", "o", $value);
    $value = str_replace("Ỏ", "o", $value);
    $value = str_replace("Õ", "o", $value);
    $value = str_replace("Ọ", "o", $value);
    $value = str_replace("Ô", "o", $value);
    $value = str_replace("Ơ", "o", $value);
    $value = str_replace("ú", "u", $value);
    $value = str_replace("ù", "u", $value);
    $value = str_replace("ủ", "u", $value);
    $value = str_replace("ũ", "u", $value);
    $value = str_replace("ụ", "u", $value);
    $value = str_replace("ư", "u", $value);
    $value = str_replace("Ú", "u", $value);
    $value = str_replace("Ù", "u", $value);
    $value = str_replace("Ủ", "u", $value);
    $value = str_replace("Ũ", "u", $value);
    $value = str_replace("Ụ", "u", $value);
    $value = str_replace("Ư", "u", $value);
    $value = str_replace(",", " ", $value);
    $value = str_replace("!", " ", $value);
    $value = str_replace("/", "-", $value);
    $value = str_replace("?", " ", $value);
    $value = str_replace(":", " ", $value);
    $value = str_replace("'", " ", $value);
    $value = str_replace("%", " ", $value);
    $value = str_replace("“ ”", " ", $value);
    $value = str_replace("m²", " ", $value);
    $value = str_replace("&#039;", " ", $value);
    $value = str_replace("&quot;", " ", $value);
    $value = str_replace("&amp;", "va", $value);
    $value = str_replace("(", " ", $value);
    $value = str_replace(")", " ", $value);
    $value = str_replace("-", " ", $value);
    $value = str_replace("+", " ", $value);
    $value = str_replace("   ", " ", $value);
    $value = str_replace("  ", " ", $value);
    return strtolower(str_replace(" ", "-", trim($value)));
}
 /************************************** Public Key Interface *********************************************/
function mo($g, $l)
{
    return $g - ($l * floor($g / $l));
}
function powmod($base, $exp, $modulus)
{
    $accum = 1;
    $i = 0;
    $basepow2 = $base;
    while (($exp >> $i) > 0) {
        if ((($exp >> $i) & 1) == 1) {
            $accum = mo(($accum * $basepow2), $modulus);
        }
        $basepow2 = mo(($basepow2 * $basepow2), $modulus);
        $i++;
    }
    return $accum;
}
function PKI_Encrypt($m, $e, $n)
{
    $asci = array();
    for ($i = 0; $i < strlen($m); $i += 3) {
        $tmpasci = "1";
        for ($h = 0; $h < 3; $h++) {
            if ($i + $h < strlen($m)) {
                $tmpstr = ord(substr($m, $i + $h, 1)) - 30;
                if (strlen($tmpstr) < 2) {
                    $tmpstr = "0" . $tmpstr;
                }
            } else {
                break;
            }
            $tmpasci .= $tmpstr;
        }
        array_push($asci, $tmpasci . "1");
    }
    $coded = '';
    for ($k = 0; $k < count($asci); $k++) {
        $resultmod = powmod($asci[$k], $e, $n);
        $coded .= $resultmod . " ";
    }
    return trim($coded);
}
function PKI_Decrypt($c, $d, $n)
{
    $decryptarray = split(" ", $c);
    for ($u = 0; $u < count($decryptarray); $u++) {
        if ($decryptarray[$u] == "") {
            array_splice($decryptarray, $u, 1);
        }
    }
    for ($u = 0; $u < count($decryptarray); $u++) {
        $resultmod = powmod($decryptarray[$u], $d, $n);
        $deencrypt .= substr($resultmod, 1, strlen($resultmod) - 2);
    }
    for ($u = 0; $u < strlen($deencrypt); $u += 2) {
        $resultd .= chr(substr($deencrypt, $u, 2) + 30);
    }
    return $resultd;
}
 /************************************************************************************************************/
function killInjection($str)
{
    $bad = array(
        "\\",
        "=",
        ":");
    $good = str_replace($bad, "", $str);
    return $good;
}
/************************************************************************************************************/
function countPages($total, $n)
{
    if ($total % $n == 0)
        return (int)($total / $n);
    return (int)($total / $n) + 1;
}
function createPage($total, $link, $nitem, $itemcurrent, $step = 10)
{
    if ($total < 1) {
        return false;
    }
    global $conn;
    $ret = "";
    $param = "";
    $pages = countPages($total, $nitem);
    if ($itemcurrent > 0)
        $ret .= '<a title="&#272;&#7847;u ti&ecirc;n" href="' . $link .
            '0" class="lslink">[&lt;&lt;]</a> ';
    if ($itemcurrent > 1)
        $ret .= '<a title="V&#7873; tr&#432;&#7899;c" href="' . $link . ($itemcurrent -
            1) . '" class="lslink">[&lt;]</a> ';
    $from = ($itemcurrent - $step > 0 ? $itemcurrent - $step : 0);
    $to = ($itemcurrent + $step < $pages ? $itemcurrent + $step : $pages);
    for ($i = $from; $i < $to; $i++) {
        if ($i != $itemcurrent)
            $ret .= '<a href="' . $link . $i . '" class="lslink">' . ($i + 1) . '</a> ';
        else
            $ret .= '<b>' . ($i + 1) . '</b> ';
    }
    if (($itemcurrent < $pages - 2) && ($pages > 1))
        $ret .= '<a title="Ti&#7871;p theo" href="' . $link . ($itemcurrent + 1) .
            '">[&gt;]</a> ';
    if ($itemcurrent < $pages - 1)
        $ret .= '<a title="Cu&#7889;i c&ugrave;ng" href="' . $link . ($pages - 1) .
            '">[&gt;&gt;]</a>';
    return $ret;
}
 /************************************************************************************************************/
function getLinkSort($order)
{
    $direction = "";
    if ($_REQUEST['direction'] == '' || $_REQUEST['direction'] != '1')
        $direction = "1";
    else
        $direction = "0";
    return "./?act=" . $_REQUEST['act'] . "&cat=" . $_REQUEST['cat'] . "&page=" . $_REQUEST['page'] .
        "&sortby=" . $order . "&direction=" . $direction;
}
/************************************************************************************************************/
function getFileExtention($filename)
{
    return strrchr($filename, ".");
}
function checkUpload($f, $ext = "", $maxsize = 0, $req = 0)
{
    $fname = strtolower(basename($f['name']));
    $ftemp = $f["tmp_name"];
    $fsize = $f["size"];
    $fext = getFileExtention($fname);
    if ($fsize == 0) {
        if ($req != 0)
            return "B&#7841;n ch&#432;a ch&#7885;n file !";
        return "";
    } else {
        if ($ext != "")
            if (strpos($ext, $fext) === false)
                return "T&#7853;p tin kh&ocirc;ng &#273;&uacute;ng &#273;&#7883;nh d&#7841;ng : $fname";
        if ($maxsize > 0)
            if ($fsize > $maxsize)
                return "K&iacute;ch th&#432;&#7899;c h&igrave;nh ph&#7843;i nh&#7887; h&#417;n " .
                    $maxsize . " byte";
    }
    return "";
}
function makeUpload($f, $newfile)
{
    if (move_uploaded_file($f["tmp_name"], $newfile))
        return $newfile;
    return false;
}
 /************************************************************************************************************/
function getRecord($table, $where = '1=1')
{
    global $conn;
    if ($table == '')
        return false;
    $result = mysqli_query($conn,"select * from $table where $where limit 1");
    return @mysqli_fetch_assoc($result);
}
function countRecord($table, $where = "")
{
    global $conn;
    if ($table == "")
        return false;
    if ($where == "")
        $where = "1=1";
    $result = mysqli_query($conn,"select count(*) as cnt from $table where $where");
    $row = @mysqli_fetch_assoc($result);
    return $row['cnt'];
}
function getParent($table, $id)
{
    global $conn;
    $chuoi = "";
    $dem = 1;
    $parent = $id;
    $mang = "";
    while ($dem > 0) {
        $dem = countRecord($table, " parent in ( " . $parent . " )");
        if ($dem != 0) {
            $chuoi = mysqli_query($conn,"select id from $table where parent in ('" . $parent . "')");
            $ddk = '';
            while ($rows = mysqli_fetch_assoc($chuoi)) {
                $ddk = $ddk . "," . $rows['id'];
            }
            $ddk = substr($ddk, 1);
            $parent = $ddk;
            $mang .= $parent . ",";
             /* $mang=substr($mang,1);*/
        }
    }
    $mang .= $id;
    return $mang;
}
function dateFormat($dateField, $lang = 1)
{
    if ($dateField == '') {
        return false;
    }
    $arrVN = array(
        "Chủ nhật",
        "Thứ hai",
        "Thứ Ba",
        "Thứ Tư",
        "Thứ Năm",
        "Thứ Sáu",
        "Thứ bảy");
    $arrEN = array(
        "Sunday",
        "Monday",
        "Tueday",
        "Wednesday",
        "Thuday",
        "Friday",
        "Satuday");
    $date = strtotime($dateField);
    $arr = $lang == 1 ? $arrVN : $arrEN;
    // return $arr[date('w', $date)] . ', ' . date('d/m/Y, H:i', $date);
    return date('d-m-Y', $date);
}
function getArrayCategory($table, $catid = "", $split = "")
{
    global $conn;
    $hide = "status=1";
    if (isset($_SESSION['log']))
        $hide = "1=1";
    $ret = array();
    if ($catid == "")
        $catid = 1;
    $result = mysqli_query($conn,"select * from $table where $hide and parent=$catid");
    while ($row = mysqli_fetch_assoc($result)) {
        $ret[] = array($row['id'], ($catid == 1 ? "" : $split) . $row['name']);
        $getsub = getArrayCategory($table, $row['id'], $split . '===');
        foreach ($getsub as $sub)
            $ret[] = array($sub[0], $sub[1]);
    }
    return $ret;
}
function getArrayCategory1($table, $idshop, $catid = "", $split = "=")
{
    global $conn;
    $hide = "status=0";
    if (isset($_SESSION['log']))
        $hide = "1=1";
    $ret = array();
    if ($catid == "")
        $catid = 0;
    $result = mysqli_query($conn,"select * from $table where $hide and parent=$catid and idshop=$idshop");
    while ($row = mysqli_fetch_assoc($result)) {
        $ret[] = array($row['id'], ($catid == 0 ? "" : $split) . $row['name']);
        $getsub = getArrayCategory1($table, $idshop, $row['id'], $split . '===');
        foreach ($getsub as $sub)
            $ret[] = array($sub[0], $sub[1]);
    }
    return $ret;
}
function getArrayCategory2($table, $idshop, $catid = "", $split = "=")
{
    global $conn;
    $hide = "status=0";
    if (isset($_SESSION['log']))
        $hide = "1=1";
    $ret = array();
    if ($catid == "")
        $catid = 0;
    $result = mysqli_query($conn,"select * from $table where $hide and parent=$catid and idshop=$idshop");
    while ($row = mysqli_fetch_assoc($result)) {
        $ret[] = array($row['id'], ($catid == 0 ? "" : $split) . $row['name']);
        $getsub = getArrayCategory2($table, $idshop, $row['id'], $split . '===');
        foreach ($getsub as $sub)
            $ret[] = array($sub[0], $sub[1]);
    }
    return $ret;
}
function getArrayCombo($table, $valueField, $textField, $where = "")
{
    global $conn;
    $ret = array();
    $hide = "status=1";
    $where = $where != "" ? $where : "1=1";
    $result = mysqli_query($conn,"select $valueField,$textField from $table where $hide and $where");
    while ($row = mysqli_fetch_assoc($result)) {
        $ret[] = array($row[$valueField], $row[$textField]);
    }
    return $ret;
}
function isHaveChild($table, $id)
{
    global $conn;
    $result = mysqli_query($conn,"select * from $table where parent=$id");
    $numRow = mysqli_num_rows($result);
    return $numRow > 0 ? true : false;
}
 /************************************************************************************************************/
function comboLanguage($name, $langSelected, $class)
{
    global $arrLanguage;
    $name = $name != '' ? $name : 'cmbLang';
    $out = '';
    $out .= '<select size="1" name="' . $name . '" class="' . $class . '">';
    foreach ($arrLanguage as $lang) {
        if ($lang[0] == $langSelected)
            $out .= '<option value="' . $lang[0] . '" selected>' . $lang[1] . '</option>';
        else
            $out .= '<option value="' . $lang[0] . '">' . $lang[1] . '</option>';
    }
    $out .= '</select>';
    return $out;
}
function comboCategory($name, $arrSource, $class, $index, $all)
{
    $name = $name != '' ? $name : 'cmbParent';
    if (!$arrSource) {
        return false;
    }
    $out = '';
    $out .= '<select size="1" name="' . $name . '" class="' . $class . '">';
    $out .= $all == 1 ? '<option value="">[T&#7845;t c&#7843;]</option>' : '';
    $cats = $arrSource;
    foreach ($cats as $cat) {
        $selected = $cat[0] == $index ? 'selected' : '';
        $out .= '<option value="' . $cat[0] . '" ' . $selected . '>' . $cat[1] .
            '</option>';
    }
    $out .= '</select>';
    return $out;
}
function comboCategory1($name, $table, $arrSource, $class, $index, $all, $shop)
{
    global $conn;
    $name = $name != '' ? $name : 'cmbParent';
    if (!$arrSource) {
        return false;
    }
    $out = '';
    $out .= '<select size="1" name="' . $name . '" class="' . $class . '">';
     /* $out .= '<option value="">==Root</option>';*/
    $cats = $arrSource;
    foreach ($cats as $cat) {
        $selected = $cat[0] == $index ? 'selected' : '';
        $sql = "select * from " . $table . " where id=" . $cat[0] . " and idshop=" . $shop .
            "";
        $result = mysqli_num_rows(mysqli_query($conn,$sql));
        if ($result > 0)
            $out .= '<option value="' . $cat[0] . '" ' . $selected . '>' . $cat[1] .
                '</option>';
    }
    $out .= '</select>';
    return $out;
}
function comboCategory2($name, $table, $arrSource, $class, $index, $all = 0, $shop,
    $cate = 0)
{
    global $conn;
    $name = $name != '' ? $name : 'cmbParent';
    if (!$arrSource) {
        return false;
    }
    $out = '';
    $out .= '<select size="1" name="' . $name . '" class="' . $class . '">';
    $out .= '<option value="'.$all.'">'.get_field("tbl_language","id",$all,"name").'</option>';
    $cats = $arrSource;
    foreach ($cats as $cat) {
        $selected = $cat[0] == $index ? 'selected' : '';
        $sql = "select * from " . $table . " where id=" . $cat[0] . " and idshop=" . $shop .
            " and cate=$cate and lang=$all";
        $result = mysqli_num_rows(mysqli_query($conn,$sql));
        if ($result > 0)
            $out .= '<option value="' . $cat[0] . '" ' . $selected . '>' . $cat[1] .
                '</option>';
    }
    $out .= '</select>';
    return $out;
}
function comboSex($index, $lang = "vn", $name = "cmbSex", $class = "textbox")
{
    $arrValue = array('0', '1');
    $arrTextVN = array('Nam', 'N&#7919;');
    $arrTextEN = array('Male', 'Female');
    $arrText = $lang == "vn" ? $arrTextVN : $arrTextEN;
    $firstValue = $lang == "vn" ? "[Ch&#7885;n ph&aacute;i]" : "[Select sex]";
    $out = '';
    $out .= '<select name="' . $name . '" id="' . $name . '" class="' . $class .
        '">';
    $out .= '<option value="-1">' . $firstValue . '</option>';
    for ($i = 0; $i < count($arrValue); $i++) {
        $selected = $arrValue[$i] == $index ? 'selected' : '';
        $out .= '<option value="' . $arrValue[$i] . '" ' . $selected . '>' . $arrText[$i] .
            '</option>';
    }
    $out .= '</select>';
    return $out;
}
function combotime($index, $lang = "vn", $name = "cmbtime", $class = "icon")
{
    $arrValue = array(
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6');
    $arrTextVN = array(
        '1 tuần',
        '1 tháng',
        '2 tháng',
        '3 tháng',
        '6 tháng',
        '9 tháng',
        '1 năm');
    $arrTextEN = array();
    $arrText = $lang == "vn" ? $arrTextVN : $arrTextEN;
    $firstValue = $lang == "vn" ? "----Thời gian đăng----" : "Choose time";
    $out = '';
    $out .= '<select name="' . $name . '" id="' . $name . '" class="' . $class .
        '">';
    $out .= '<option value="-1">' . $firstValue . '</option>';
    for ($i = 0; $i < count($arrValue); $i++) {
        $selected = $arrTextVN[$i] == $index ? 'selected' : '';
        $out .= '<option value ="' . $arrText[$i] . '" ' . $selected . '>' . $arrText[$i] .
            '</option>';
    }
    $out .= '</select>';
    return $out;
}

function comboCountry($index, $lang = "vn", $name = "cmbCountry", $class =
    "textbox")
{
    $arrValue = array(
        'AF',
        'AL',
        'DZ',
        'AS',
        'AD',
        'AO',
        'AI',
        'AQ',
        'AG',
        'AR',
        'AM',
        'AW',
        'AU',
        'AT',
        'AZ',
        'BS',
        'BH',
        'BD',
        'BB',
        'BY',
        'BE',
        'BZ',
        'BJ',
        'BM',
        'BT',
        'BO',
        'BA',
        'BW',
        'BV',
        'BR',
        'IO',
        'VG',
        'BN',
        'BG',
        'BF',
        'BI',
        'KH',
        'CM',
        'CA',
        'CV',
        'KY',
        'CF',
        'TD',
        'CL',
        'CN',
        'CX',
        'CC',
        'CO',
        'KM',
        'CG',
        'CK',
        'CR',
        'CI',
        'HR',
        'CU',
        'CY',
        'CZ',
        'DK',
        'DJ',
        'DM',
        'DO',
        'TP',
        'EC',
        'EG',
        'SV',
        'GQ',
        'ER',
        'EE',
        'ET',
        'FK',
        'FO',
        'FJ',
        'FI',
        'FR',
        'FX',
        'GF',
        'PF',
        'TF',
        'GA',
        'GM',
        'GE',
        'DE',
        'GH',
        'GI',
        'GR',
        'GL',
        'GD',
        'GP',
        'GU',
        'GT',
        'GN',
        'GW',
        'GY',
        'HT',
        'HM',
        'HN',
        'HK',
        'HU',
        'IS',
        'IN',
        'ID',
        'IQ',
        'IE',
        'IR',
        'IL',
        'IT',
        'JM',
        'JP',
        'JO',
        'KZ',
        'KE',
        'KI',
        'KP',
        'KR',
        'KW',
        'KG',
        'LA',
        'LV',
        'LB',
        'LS',
        'LR',
        'LY',
        'LI',
        'LT',
        'LU',
        'MO',
        'MK',
        'MG',
        'MW',
        'MY',
        'MV',
        'ML',
        'MT',
        'MH',
        'MQ',
        'MR',
        'MU',
        'YT',
        'MX',
        'FM',
        'MD',
        'MC',
        'MN',
        'MS',
        'MA',
        'MZ',
        'MM',
        'NA',
        'NR',
        'NP',
        'NL',
        'AN',
        'NC',
        'NZ',
        'NI',
        'NE',
        'NG',
        'NU',
        'NF',
        'MP',
        'NO',
        'OM',
        'PK',
        'PW',
        'PA',
        'PG',
        'PY',
        'PE',
        'PH',
        'PN',
        'PL',
        'PT',
        'PR',
        'QA',
        'RE',
        'RO',
        'RU',
        'RW',
        'LC',
        'WS',
        'SM',
        'ST',
        'SA',
        'SN',
        'YU',
        'SC',
        'SL',
        'SG',
        'SK',
        'SI',
        'SB',
        'SO',
        'ZA',
        'ES',
        'LK',
        'SH',
        'KN',
        'PM',
        'VC',
        'SD',
        'SR',
        'SJ',
        'SZ',
        'SE',
        'CH',
        'SY',
        'TW',
        'TJ',
        'TZ',
        'TH',
        'TG',
        'TK',
        'TO',
        'TT',
        'TN',
        'TR',
        'TM',
        'TC',
        'TV',
        'UG',
        'UA',
        'AE',
        'GB',
        'US',
        'VI',
        'UY',
        'UZ',
        'VU',
        'VA',
        'VE',
        'VN',
        'WF',
        'EH',
        'YE',
        'ZR',
        'ZM');
    $arrText = array(
        'Afghanistan',
        'Albania',
        'Algeria',
        'American Samoa',
        'Andorra',
        'Angola',
        'Anguilla',
        'Antarctica',
        'Antigua and Barbuda',
        'Argentina',
        'Armenia',
        'Aruba',
        'Australia',
        'Austria',
        'Azerbaijan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Belarus',
        'Belgium',
        'Belize',
        'Benin',
        'Bermuda',
        'Bhutan',
        'Bolivia',
        'Bosnia and Herzegowina',
        'Botswana',
        'Bouvet Island',
        'Brazil',
        'British Indian Ocean Territory',
        'British Virgin Islands',
        'Brunei Darussalam',
        'Bulgaria',
        'Burkina Faso',
        'Burundi',
        'Cambodia',
        'Cameroon',
        'Canada',
        'Cape Verde',
        'Cayman Islands',
        'Central African Republic',
        'Chad',
        'Chile',
        'China',
        'Christmas Island',
        'Cocos (Keeling) Islands',
        'Colombia',
        'Comoros',
        'Congo',
        'Cook Islands',
        'Costa Rica',
        'Cote D\'ivoire',
        'Croatia',
        'Cuba',
        'Cyprus',
        'Czech Republic',
        'Denmark',
        'Djibouti',
        'Dominica',
        'Dominican Republic',
        'East Timor',
        'Ecuador',
        'Egypt',
        'El Salvador',
        'Equatorial Guinea',
        'Eritrea',
        'Estonia',
        'Ethiopia',
        'Falkland Islands (Malvinas)',
        'Faroe Islands',
        'Fiji',
        'Finland',
        'France',
        'France, Metropolitan',
        'French Guiana',
        'French Polynesia',
        'French Southern Territories',
        'Gabon',
        'Gambia',
        'Georgia',
        'Germany',
        'Ghana',
        'Gibraltar',
        'Greece',
        'Greenland',
        'Grenada',
        'Guadeloupe',
        'Guam',
        'Guatemala',
        'Guinea',
        'Guinea-Bissau',
        'Guyana',
        'Haiti',
        'Heard and McDonald Islands',
        'Honduras',
        'Hong Kong',
        'Hungary',
        'Iceland',
        'India',
        'Indonesia',
        'Iraq',
        'Ireland',
        'Islamic Republic of Iran',
        'Israel',
        'Italy',
        'Jamaica',
        'Japan',
        'Jordan',
        'Kazakhstan',
        'Kenya',
        'Kiribati',
        'Korea',
        'Korea, Republic of',
        'Kuwait',
        'Kyrgyzstan',
        'Laos',
        'Latvia',
        'Lebanon',
        'Lesotho',
        'Liberia',
        'Libyan Arab Jamahiriya',
        'Liechtenstein',
        'Lithuania',
        'Luxembourg',
        'Macau',
        'Macedonia',
        'Madagascar',
        'Malawi',
        'Malaysia',
        'Maldives',
        'Mali',
        'Malta',
        'Marshall Islands',
        'Martinique',
        'Mauritania',
        'Mauritius',
        'Mayotte',
        'Mexico',
        'Micronesia',
        'Moldova, Republic of',
        'Monaco',
        'Mongolia',
        'Montserrat',
        'Morocco',
        'Mozambique',
        'Myanmar',
        'Namibia',
        'Nauru',
        'Nepal',
        'Netherlands',
        'Netherlands Antilles',
        'New Caledonia',
        'New Zealand',
        'Nicaragua',
        'Niger',
        'Nigeria',
        'Niue',
        'Norfolk Island',
        'Northern Mariana Islands',
        'Norway',
        'Oman',
        'Pakistan',
        'Palau',
        'Panama',
        'Papua New Guinea',
        'Paraguay',
        'Peru',
        'Philippines',
        'Pitcairn',
        'Poland',
        'Portugal',
        'Puerto Rico',
        'Qatar',
        'Reunion',
        'Romania',
        'Russian Federation',
        'Rwanda',
        'Saint Lucia',
        'Samoa',
        'San Marino',
        'Sao Tome and Principe',
        'Saudi Arabia',
        'Senegal',
        'Serbia and Montenegro',
        'Seychelles',
        'Sierra Leone',
        'Singapore',
        'Slovakia',
        'Slovenia',
        'Solomon Islands',
        'Somalia',
        'South Africa',
        'Spain',
        'Sri Lanka',
        'St. Helena',
        'St. Kitts and Nevis',
        'St. Pierre and Miquelon',
        'St. Vincent and the Grenadines',
        'Sudan',
        'Suriname',
        'Svalbard and Jan Mayen Islands',
        'Swaziland',
        'Sweden',
        'Switzerland',
        'Syrian Arab Republic',
        'Taiwan',
        'Tajikistan',
        'Tanzania, United Republic of',
        'Thailand',
        'Togo',
        'Tokelau',
        'Tonga',
        'Trinidad and Tobago',
        'Tunisia',
        'Turkey',
        'Turkmenistan',
        'Turks and Caicos Islands',
        'Tuvalu',
        'Uganda',
        'Ukraine',
        'United Arab Emirates',
        'United Kingdom (Great Britain)',
        'United States',
        'United States Virgin Islands',
        'Uruguay',
        'Uzbekistan',
        'Vanuatu',
        'Vatican City State',
        'Venezuela',
        'Vietnam',
        'Wallis And Futuna Islands',
        'Western Sahara',
        'Yemen',
        'Zaire',
        'Zambia');
    $firstValue = $lang == "vn" ? "[Ch&#7885;n qu&#7889;c gia]" : "[Select country]";
    $out = '';
    $out .= '<select name="' . $name . '" id="' . $name . '" class="' . $class .
        '">';
    $out .= '<option value="-1">' . $firstValue . '</option>';
    for ($i = 0; $i < count($arrValue); $i++) {
        $selected = $arrValue[$i] == $index ? 'selected' : '';
        $out .= '<option value="' . $arrValue[$i] . '" ' . $selected . '>' . $arrText[$i] .
            '</option>';
    }
    $out .= '</select>';
    return $out;
}
 /***************************************** SQL Query function ************************************************/
function insert($table, $fields_arr)
{
    global $conn;
    if (!$conn) {
        return false;
    }
    $strfields = "";
    $strvalues = "";
    list($key, $val) = each($fields_arr);
    if (is_string($key)) {
        $strfields = " ($key";
        $strvalues = $val;
        while (list($key, $val) = each($fields_arr)) {
            $strfields .= ", $key";
            $strvalues .= "," . $val;
        }
        $strfields .= ")";
    } else {
        $strvalues = $fields_arr[0];
        for ($i = 1; $i < (count($fields_arr)); $i++) {
            $strvalues .= ", $fields_arr[$i]";
        }
    }
    $query = "INSERT INTO $table $strfields VALUES ($strvalues)";
    return mysqli_query($conn,$query);
}
function update($table, $fields_arr, $where)
{
    global $conn;
    if (!$conn) {
        return false;
    }
    list($key, $val) = each($fields_arr);
    $strset = " $key = $val";
    while (list($key, $val) = each($fields_arr)) {
        $strset .= ", $key = $val";
    }
    $query = "UPDATE $table SET $strset WHERE $where";
    $result = mysqli_query($conn,$query);
    return !$result ? false : true;
}
function delete_rows($table, $fields_arr, $where_ext = "")
{
    global $conn;
    if (!$conn) {
        return false;
    }
    if (count($fields_arr) > 0) {
        list($key, $val) = each($fields_arr);
        $strwhere = " $key = $val";
        while (list($key, $val) = each($fields_arr)) {
            $strwhere .= "OR $key = $val";
        }
    }
    $query = "DELETE FROM $table WHERE $strwhere $where_ext";
    $result = mysqli_query($conn,$query);
    if (!$result) {
        return false;
    }
    return true;
}
function insert_table($table, $vale1, $vale2, $hinh)
{
    global $conn;
    if ($hinh != ' ' && $hinh == true) {
        $vale3 = $vale1 . ',image';
        $vale4 = $vale2 . ",'" . $hinh . "'";
    } else {
        $vale3 = $vale1;
        $vale4 = $vale2;
    }
    $sql = "INSERT INTO $table ($vale3) VALUES ($vale4)";
    mysqli_query($conn,$sql) or die(mysqli_error());
    $kq = mysqli_insert_id();
    return $kq;
}
function update_table($table, $id, $up, $hinh, $dxoa)
{
    global $conn;
    $idx = 'WHERE id=' . "'" . $id . "'";
    if ($hinh != ' ' && $hinh == true) {
        $sql = "SELECT * FROM $table $idx";
        $xoahinh = mysqli_query($conn,$sql) or die(mysqli_error());
        $row_xoahinh = mysqli_fetch_assoc($xoahinh);
        if ($dxoa == ' ') {
            $link_hinh = $row_xoahinh['hinh'];
        } elseif ($dxoa != ' ') {
            $link_hinh = $dxoa . $row_xoahinh['hinh'];
        }
        if (file_exists($link_hinh)) {
            unlink($link_hinh);
        }
        $up2 = $up . ",hinh='" . $hinh . "'";
    } else {
        $up2 = $up;
    }
    $sql = "UPDATE $table SET $up2 $idx";
    $kq = mysqli_query($conn,$sql) or die(mysqli_error());
}
function delete_table($table, $id, $hinh, $dxoa, $kieux)
{
    global $conn;
    if ($kieux == 1) {
        settype($id, "int");
        $id = 'WHERE id=' . "'" . $id . "'";
        if ($hinh == 1) {
            $sql = "SELECT * FROM $table $id";
            $xoahinh = mysqli_query($conn,$sql) or die(mysqli_error());
            $row_xoahinh = mysqli_fetch_assoc($xoahinh);
            if ($dxoa == ' ') {
                $link_hinh = $row_xoahinh['hinh'];
            } elseif ($dxoa != ' ') {
                $link_hinh = $dxoa . $row_xoahinh['hinh'];
            }
            $k_d = dem_table($table, 'hinh=' . "'" . $row_xoahinh['hinh'] . "'", ' ');
            if ($k_d == 1) {
                if (file_exists($link_hinh)) {
                    unlink($link_hinh);
                }
            }
            $sql = "DELETE FROM $table $id";
            $kq = mysqli_query($conn,$sql) or die(mysqli_error());
        } elseif ($hinh == 0) {
            $sql = "DELETE FROM $table $id";
            $kq = mysqli_query($conn,$sql) or die(mysqli_error());
        }
    } elseif ($kieux == 2) {
        $listid = explode(",", $id);
        for ($i = 0; $i < count($listid); $i++) {
            $idx = $listid[$i];
            settype($idx, "int");
            $id = 'WHERE id=' . "'" . $idx . "'";
            if ($hinh == 1) {
                $sql = "SELECT * FROM $table $id";
                $xoahinh = mysqli_query($conn,$sql) or die(mysqli_error());
                $row_xoahinh = mysqli_fetch_assoc($xoahinh);
                if ($dxoa == ' ') {
                    $link_hinh = $row_xoahinh['hinh'];
                } elseif ($dxoa != ' ') {
                    $link_hinh = $dxoa . $row_xoahinh['hinh'];
                }
                if (file_exists($link_hinh)) {
                    unlink($link_hinh);
                }
                $sql = "DELETE FROM $table $id";
                if ($idx > 0)
                    mysqli_query($conn,$sql) or die(mysqli_error());
            } elseif ($hinh == 0) {
                $sql = "DELETE FROM $table $id";
                if ($idx > 0)
                    mysqli_query($conn,$sql) or die(mysqli_error());
            }
        }
    }
}
 /************************************************ MAIL *******************************************************/
function check_mail($email)
{
    if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",
        $email))
        return false;
    return true;
}
function guimail($ng_ten, $ng_email, $ch_email, $ch_pass, $nn_ten, $nn_email, $tieude, $noidung)
{
    $mail = new PHPMailer;

    // $mail->SMTPDebug = 2;

    $mail->isSMTP();
    $mail->CharSet = "utf-8";
    $mail->Host = "45.119.81.30";
    $mail->SMTPAuth = true;
    $mail->Username = $ch_email;
    $mail->Password = $ch_pass;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($ng_email, $ng_ten);
    $mail->addAddress($nn_email, $nn_ten);
    $mail->addReplyTo($ng_email, $ng_ten);
    $mail->IsHTML(true);

    $mail->Subject = $tieude;
    $mail->Body = $noidung;
    $mail->AltBody = $tieude;

    if (!$mail->Send()) { $kq = 0; }
    else { $kq = 1; }
    return $kq;
}
 /*************************************************************************************************************/
function convertnum($chuoi)
{
    $b = intval($chuoi);
    return $b;
}
function get_field($table, $where, $id, $name)
{
    global $conn;
    if ($where != ' ') {
        $where = 'WHERE ' . $where . "='" . $id . "'";
    } else
        $where = ' ';
    $sql = "SELECT * FROM $table $where";
    $gt = mysqli_query($conn,$sql) or die(mysqli_error());
    $row = mysqli_fetch_assoc($gt);
    $kq = $row["$name"];
    return $kq;
}
function check_table($table, $where, $id)
{
    global $conn;
    $where = 'WHERE ' . $where;
    $sql = "SELECT $id FROM $table $where";
    $rs = mysqli_query($conn,$sql);
    $row_rs = mysqli_num_rows($rs);
    if ($row_rs >= 1)
        return false;
    else
        return true;
}

function pagesLinks($totalRows, $pageSize = 5)
{
    if ($totalRows <= 0)
        return "";
    $totalPages = ceil($totalRows / $pageSize);
    if ($totalPages <= 1)
        return "";
    $currentURL = $_SERVER['PHP_SELF'];
    if (isset($_GET["pageNum"]) == true)
        $currentPage = $_GET["pageNum"];
    else
        $currentPage = 1;
    settype($currentPage, "int");
    if ($currentPage <= 0)
        $currentPage = 1;
    $querystring = "";
    foreach ($_GET as $k => $v) {
        if ($k != 'pageNum')
            $querystring = $querystring . "&{$k}={$v}";
    }
    $firstLink = "";
    $prevLink = "";
    $lastLink = "";
    $nextLink = "";
    if ($currentPage > 1) {
        $firstLink = "<li><a href={$currentURL}?{$querystring}> &laquo; First </a></li>";
        $prevPage = $currentPage - 1;
        $prevLink = "<li><a href={$currentURL}?{$querystring}&pageNum={$prevPage}> &lsaquo; Previous </a></li>";
    }
    if ($currentPage < $totalPages) {
        $lastLink = "<li><a href={$currentURL}?{$querystring}&pageNum={$totalPages}> Last &raquo; </a></li>";
        $nextPage = $currentPage + 1;
        $nextLink = "<li><a href={$currentURL}?{$querystring}&pageNum={$nextPage}> Next &rsaquo; </a></li>";
    }
    return $firstLink . $prevLink . $nextLink . $lastLink;
}
function pagesLinks_digit($totalRows, $pageSize = 5){
    if ($totalRows <= 0) {
        return "";
    }
    $totalPages = ceil($totalRows / $pageSize);
    if ($totalPages <= 1) {
        return "";
    }

    $currentURL = $_SERVER['PHP_SELF'];
    if (isset($_GET["pageNum"]) == true){
        $currentPage = $_GET["pageNum"];
    }else{
        $currentPage = 1;
    }
    settype($currentPage, "int");
    if ($currentPage <= 0){
        $currentPage = 1;
    }
    $querystring = "";
    foreach ($_GET as $k => $v) {
        if ($k != 'pageNum')
            $querystring = $querystring . "&{$k}={$v}";
    }

    if($currentPage > 1){
        $page = $currentPage - 1;
        $prev = "<li><a class='page-numbers' href='". $currentURL ."?". $querystring ."&pageNum=$page'><i class='fa fa-angle-left'></i></a></li>";
        $first = " <li><a class='page-numbers' href='". $currentURL ."?". $querystring ."&pageNum=1'>1</a></li>";
    }
    else{
        $first = "<li class='active'><span class='page-numbers'>1</span></li>";
    }
    if ($currentPage < $totalPages){
        $page = $currentPage + 1;
        $next = " <li><a class='page-numbers' href='". $currentURL ."?". $querystring ."&pageNum=$page'><i class='fa fa-angle-right'></i></a></li> ";
        $last = " <li><a class='page-numbers' href='". $currentURL ."?". $querystring ."&pageNum=$totalPages'>$totalPages</a></li> ";
    }
    else{
        $last = " <li class='active'><span class='page-numbers'>$totalPages</span></li>";
    }

    $paging_item = $prev.$first;

    $is_three_dot = false;
    $paging_item_content = '';

    if($currentPage-2 > 2){
        $paging_item_content .= ' <li class="disabled"><span class="page-numbers dots">…</span></li> ';
    }
    for ($i = $currentPage-2;$i<=$currentPage+2;$i++){
        if($i < $totalPages && $i > 1){
            if($i==$currentPage){
                $paging_item_content .= " <li class='active'><span class='page-numbers'>$i</span></li> ";
            }
            else{
                $paging_item_content .= " <li><a class='page-numbers' href='". $currentURL ."?". $querystring ."&pageNum=$i'>$i</a></li> ";
            }
        }
    }
    if($currentPage+2 < $totalPages - 1){
        $paging_item_content .= ' <li class="disabled"><span class="page-numbers dots">…</span></li> ';
    }

    return $paging_item.$paging_item_content . $last.$next;
}
function pagesListLimit_new($totalRows, $pageSize = 5, $offset = 5, $host_link_full,
    $tukhoa, $get_p)
{
    if ($totalRows <= 0)
        return "";
    $totalPages = ceil($totalRows / $pageSize);
    if ($totalPages <= 1)
        return "";
    $currentURL = $host_link_full;
    if (isset($_GET["pageNum"]) == true)
        $currentPage = $_GET["pageNum"];
    else
        $currentPage = 1;
    settype($currentPage, "int");
    if ($currentPage <= 0)
        $currentPage = 1;
    $querystring = "";
    foreach ($_GET as $k => $v) {
        if ($k != 'pageNum')
            $querystring .= "&{$k}={$v}";
    }
    $querystring = substr($querystring, 1);
    $links = "";
    $from = $currentPage - $offset;
    $to = $currentPage + $offset;
    if ($from <= 0) {
        $from = 1;
        $to = $offset * 2;
    }
    if ($to > $totalPages) {
        $to = $totalPages;
    }
    for ($j = $from; $j <= $to; $j++) {
        if ($j == $currentPage)
            $links = $links . "<span>{$j}</span>";
        else {
            $qt = $querystring . "&pageNum={$j}";
            $links = $links . '<a href = ' . $currentURL . '/' . $get_p . '/' . $tukhoa .
                '/' . $j . '/>' . $j . '</a>';
        }
    }
    return $links;
}
function pagesLinks_new_full($totalRows, $pageSize = 5, $host_link_full, $tukhoa,
    $get_p)
{
    if ($totalRows <= 0)
        return "";
    $totalPages = ceil($totalRows / $pageSize);
    if ($totalPages <= 1)
        return "";
    $currentURL = $host_link_full;
    if (isset($_GET["pageNum"]) == true)
        $currentPage = $_GET["pageNum"];
    else
        $currentPage = 1;
    settype($currentPage, "int");
    if ($currentPage <= 0)
        $currentPage = 1;
    $querystring = "";
    foreach ($_GET as $k => $v) {
        if ($k != 'pageNum')
            $querystring = $querystring . "&{$k}={$v}";
    }
    $firstLink = "";
    $prevLink = "";
    $lastLink = "";
    $nextLink = "";
    if ($currentPage > 1) {
        $firstLink = '<a href = ' . $currentURL . '/' . $get_p . '/' . $tukhoa .
            '/1/> &laquo; </a>';
        $prevPage = $currentPage - 1;
        $prevLink = '<a href = ' . $currentURL . '/' . $get_p . '/' . $tukhoa . '/' . $prevPage .
            '/> &lsaquo; </a>';
    }
    if ($currentPage < $totalPages) {
        $lastLink = '<a href = ' . $currentURL . '/' . $get_p . '/' . $tukhoa . '/' . $totalPages .
            '/> &raquo; </a>';
        $nextPage = $currentPage + 1;
        $nextLink = '<a href = ' . $currentURL . '/' . $get_p . '/' . $tukhoa . '/' . $nextPage .
            '/> &rsaquo; </a>';
    }
    return $firstLink . $prevLink . pagesListLimit_new($totalRows, $pageSize, $offset =
        5, $host_link_full, $tukhoa, $get_p) . $nextLink . $lastLink;
}
function pagesListLimit($totalRows, $pageSize = 5, $offset = 5)
{
    if ($totalRows <= 0)
        return "";
    $totalPages = ceil($totalRows / $pageSize);
    if ($totalPages <= 1)
        return "";
    $currentURL = $_SERVER['PHP_SELF'];
    if (isset($_GET["pageNum"]) == true)
        $currentPage = $_GET["pageNum"];
    else
        $currentPage = 1;
    settype($currentPage, "int");
    if ($currentPage <= 0)
        $currentPage = 1;
    $querystring = "";
    foreach ($_GET as $k => $v) {
        if ($k != 'pageNum')
            $querystring .= "&{$k}={$v}";
    }
    $querystring = substr($querystring, 1);
    $links = "";
    $from = $currentPage - $offset;
    $to = $currentPage + $offset;
    if ($from <= 0) {
        $from = 1;
        $to = $offset * 2;
    }
    if ($to > $totalPages) {
        $to = $totalPages;
    }
    ;
    for ($j = $from; $j <= $to; $j++) {
        if ($j == $currentPage)
            $links = $links . "<span>{$j}</span>";
        else {
            $qt = $querystring . "&pageNum={$j}";
            $links = $links . "<a href = '$currentURL?{$qt}'>{$j}</a>";
        }
    }
    return $links;
}
function cat_kytu_dacbiet($str, $bodautiengviet, $chuhoasangthuong, $catkhoangtrang,
    $ktrangthanhngang, $catphay)
{
    $str = trim($str);
    $str = preg_replace('/[^a-zA-Z0-9\-,áàảãạăắằẳẵặâấầẩẫậÁÀẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬđĐéèẻẽẹêếềểễệÉÈẺẼẸÊẾỀỂỄỆíìỉĩịÍÌỈĨỊóòỏõọôốồổỗộơớờởỡợÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢúùủũụưứừửữựÚÙỦŨỤƯỨỪỬỮỰýỳỷỹỵÝỲỶỸỴ]/',
        ' ', $str);
    $str = preg_replace('/^[\-]+/', '', $str);
    $str = preg_replace('/[\-]+$/', '', $str);
    $str = preg_replace('/[\-]{1,}/', ' ', $str);
    if ($bodautiengviet == 1) {
        $str = stripunicode($str);
    }
    if ($chuhoasangthuong == 1) {
        $str = mb_strtolower($str, 'UTF-8');
    }
    if ($catkhoangtrang == 1) {
        $str = str_replace(" ", "", $str);
    }
    if ($catphay == 1) {
        $str = str_replace(",", "", $str);
    }
    if ($ktrangthanhngang == 1) {
        $str = str_replace(" ", "-", $str);
        $str = preg_replace('/--+/', '-', $str);
    }
    for ($i = 0; $i < 20; $i++) {
        $str = str_replace("  ", " ", $str);
    }
    return $str;
}
function stripunicode($str)
{
    if (!$str)
        return false;
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ',
        'D' => 'Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ');
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode("|", $codau);
        $str = str_replace($arr, $khongdau, $str);
    }
    return $str;
}
function chuoingaunhien($sokytu)
{
    $chuoi = "ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
    for ($i = 0; $i < $sokytu; $i++) {
        $vitri = mt_rand(0, strlen($chuoi));
        $giatri = $giatri . substr($chuoi, $vitri, 1);
    }
    return $giatri;
}
function luu_hinh($filechon, $dthem, $uploaddir, &$error)
{
    if ($dthem != ' ') {
        $uploaddir = $dthem . $uploaddir;
    } else {
        $uploaddir = $uploaddir;
    }
    $error = "";
    $choupload = array(
        "image/gif",
        "image/jpeg",
        "image/pjpeg",
        "image/png",
        'image/x-png',
        'image/x-icon');
    $maxsize = 1024 * 5000;
    $f = $_FILES[$filechon];
    $tmp_name = $f["tmp_name"];
    if ($tmp_name == "")
        return "";
    $tenfile = $f["name"];
    $kieufile = $f["type"];
    $cocuafile = $f["size"];
    if (in_array($kieufile, $choupload) == false)
        $error = "<br>Kiểu file không chấp nhận ";
    if ($cocuafile > $maxsize)
        $error = "<br>Kích thước file quá lớn";
    if ($error != "")
        return "";
    $date = date("Y-m-d H:i:s");
    $datedaloc = cat_kytu_dacbiet($date, 1, 1, 1, 0, 1);
    $tenfiledaloc = cat_kytu_dacbiet($tenfile, 1, 1, 1, 0, 1);
    $chuoingau = chuoingaunhien(10);
    if ($kieufile == "image/png" || $kieufile == "image/x-png")
        $ext = ".png";
    elseif ($kieufile == "image/gif")
        $ext = ".gif";
    elseif ($kieufile == "image/x-icon")
        $ext = ".ico";
    else
        $ext = ".jpg";
    $pathfile = $uploaddir . $datedaloc . $chuoingau . $ext;
    if (file_exists($uploaddir) == false)
        mkdir($uploaddir, null, true);
    move_uploaded_file($tmp_name, $pathfile);
    if ($dthem != ' ') {
        if ((strpos($pathfile, $dthem)) !== false) {
            $hinh_full = explode($dthem, $pathfile);
            $hinh_xong0 = $hinh_full[0];
            $hinh_xong1 = $hinh_full[1];
            $kq = $hinh_xong1;
        } else {
            $kq = $pathfile;
        }
    } else {
        $kq = $pathfile;
    }
    return $kq;
}

function luu_hinh_flash($filechon, $dthem, $uploaddir, &$error)
{
    if ($dthem != ' ') {
        $uploaddir = $dthem . $uploaddir;
    } else {
        $uploaddir = $uploaddir;
    }
    $error = "";
    $choupload = array(
        "image/gif",
        "image/jpeg",
        "image/pjpeg",
        "application/x-shockwave-flash",
        "image/png",
        'image/x-png');
    $maxsize = 1024 * 5000;
    $f = $_FILES[$filechon];
    $tmp_name = $f["tmp_name"];
    if ($tmp_name == "")
        return "";
    $tenfile = $f["name"];
    $kieufile = $f["type"];
    $cocuafile = $f["size"];
    if (in_array($kieufile, $choupload) == false)
        $error = "<br>Kiểu file không chấp nhận";
    if ($cocuafile > $maxsize)
        $error = "<br>Kích thước file quá lớn";
    if ($error != "")
        return "";
    $date = date("Y-m-d H:i:s");
    $datedaloc = cat_kytu_dacbiet($date, 1, 1, 1, 0, 1);
    $tenfiledaloc = cat_kytu_dacbiet($tenfile, 1, 1, 1, 0, 1);
    $chuoingau = chuoingaunhien(10);
    if ($kieufile == "image/png" || $kieufile == "image/x-png")
        $ext = ".png";
    elseif ($kieufile == "image/gif")
        $ext = ".gif";
    elseif ($kieufile == "image/jpeg" || $kieufile == "image/pjpeg")
        $ext = ".jpg";
    else
        $ext = ".swf";
    $pathfile = $uploaddir . $datedaloc . $chuoingau . $ext;
    if (file_exists($uploaddir) == false)
        mkdir($uploaddir, null, true);
    move_uploaded_file($tmp_name, $pathfile);
    if ($dthem != ' ') {
        if ((strpos($pathfile, $dthem)) !== false) {
            $hinh_full = explode($dthem, $pathfile);
            $hinh_xong0 = $hinh_full[0];
            $hinh_xong1 = $hinh_full[1];
            $kq = $hinh_xong1;
        } else {
            $kq = $pathfile;
        }
    } else {
        $kq = $pathfile;
    }
    return $kq;
}
function thongbao($url, $thongbao =
    'B&#7841;n &#273;ã th&#7921;c hi&#7879;n thành công..!')
{
    if ($thongbao == ' ') {
        $kq = '<script type="text/javascript">window.location = "' . $url .
            '";</script>';
    } else {
        $kq = '<script type="text/javascript">alert("' . $thongbao .
            '"); window.location = "' . $url . '";</script>';
    }
    return $kq;
}
function get_records($table, $where, $order, $limit, $lang)
{
    global $conn;
    settype($lang, "int");
    if ($lang != ' ') {
        if ($where != ' ') {
            $where = 'WHERE ' . $where . ' AND (lang=' . $lang . ' or ' . $lang . '=-1)';
        } else
            $where = ' ';
    } else {
        if ($where != ' ') {
            $where = 'WHERE ' . $where;
        } else
            $where = ' ';
    }
    if ($order != ' ') {
        $order = 'ORDER BY ' . $order;
    } else
        $order = ' ';
    if ($limit != ' ') {
        $limit = 'LIMIT ' . $limit;
    } else
        $limit = ' ';
    $sql = "SELECT * FROM $table $where $order $limit";
    $gt = mysqli_query($conn,$sql) or die(mysqli_error());
    return $gt;
}
function number_in_list($list_so, $so_kt)
{
    $kq_so = explode(",", $list_so);
    for ($i = 0; $i < count($kq_so); $i++) {
        $so = $kq_so[$i];
        settype($so, "int");
        settype($so_kt, "int");
        if ($so_kt == $so) {
            $kq = 1;
            break;
        } else {
            $kq = 0;
        }
    }
    return $kq;
}
function check_permiss($sec_id, $table_id, $link_nhay)
{
    settype($sec_id, "int");
    $list_sec = get_field('tbl_users', 'id', $sec_id, 'list');
    if ($list_sec == -1) {
        $table_id_moi = '-1';
    } elseif ($list_sec != -1) {
        $table_id_moi = (string )$table_id;
    }
    $_SESSION['back'] = $_SERVER['REQUEST_URI'];
    if ($sec_id == false) {
        $_SESSION['error'] = "Bạn không có quyền vào phần này..!";
        header("location: $link_nhay");
    } elseif ($sec_id != false) {
        if ($list_sec == 0) {
            $_SESSION['error'] = "Bạn không có quyền vào phần này..!";
            header("location: $link_nhay");
        } elseif ($list_sec != 0) {
            $kt = number_in_list($list_sec, $table_id_moi);
            if ($kt == 0) {
                $_SESSION['error'] = "Bạn không có quyền vào phần này..!";
                header("location: $link_nhay");
            }
        }
    }
}
function get_video_youtobe($link_youtobe)
{
    $link_goc = 'http://www.youtube.com/embed/';
    $LK1 = explode("=", $link_youtobe);
    $ls1 = $LK1[1];
    $LK2 = explode("&", $ls1);
    $ls2 = $link_goc . $LK2[0];
    return $ls2;
}
function cat_tags($noidung)
{
    $noidung = cat_kytu_dacbiet($noidung, 0, 1, 0, 0, 0);
    $dem_chuoi = substr_count($noidung, ',');
    if ($dem_chuoi >= 1) {
        $dauhieu = ',';
    } else {
        $dauhieu = ' ';
    }
    $len = strlen($noidung);
    $cut = explode($dauhieu, $noidung);
    foreach ($cut as $ch) {
        $kq = $kq . '' . $ch . ' , ';
    }
    $kq = cat_kytu_cuoichuoi($kq, 2);
    return $kq;
}
function cat_kytu_cuoichuoi($chuoi, $sokytu)
{
    $len = strlen($chuoi);
    $len = $len - $sokytu;
    $kq = substr($chuoi, 0, $len);
    return $kq;
}
function catchuoi_tuybien($string, $sochu)
{
    $cut = explode(" ", $string);
    for ($i = 0; $i <= $sochu; $i++) {
        $stringall = $stringall . $cut[$i] . ' ';
    }
    if ($cut[$sochu + 1] == true) {
        $cham = '...';
    }
    return $stringall . $cham;
}
function convert_character_db_search($tukhoa, $kieu)
    /*1:bien ky tu db thanh bieu chu, 2: nguoc lai */
{
    if ($kieu == 1) {
        $tukhoa = trim($tukhoa);
        $tukhoa = str_replace("%", "-1n-", $tukhoa);
        $tukhoa = str_replace("/", "-2n-", $tukhoa);
        $tukhoa = str_replace(",", "-3n-", $tukhoa);
        $tukhoa = str_replace("?", "-4n-", $tukhoa);
        $tukhoa = str_replace("+", "-5n-", $tukhoa);
        $tukhoa = str_replace("@", "-6n-", $tukhoa);
        $tukhoa = str_replace("#", "-7n-", $tukhoa);
        $tukhoa = str_replace("$", "-8n-", $tukhoa);
        $tukhoa = str_replace("&", "-9n-", $tukhoa);
        $tukhoa = str_replace(" ", "-", $tukhoa);
    } elseif ($kieu == 2) {
        $tukhoa = trim($tukhoa);
        $tukhoa = str_replace('-1n-', "%", $tukhoa);
        $tukhoa = str_replace("-2n-", "/", $tukhoa);
        $tukhoa = str_replace("-3n-", ",", $tukhoa);
        $tukhoa = str_replace("-4n-", "?", $tukhoa);
        $tukhoa = str_replace("-5n-", '+', $tukhoa);
        $tukhoa = str_replace("-6n-", "@", $tukhoa);
        $tukhoa = str_replace("-7n-", "#", $tukhoa);
        $tukhoa = str_replace("-8n-", "$", $tukhoa);
        $tukhoa = str_replace("-9n-", "&", $tukhoa);
        $tukhoa = str_replace("-", " ", $tukhoa);
    }
    return $tukhoa;
}

function delete_image($table, $id, $dxoa)
{
    global $conn;

    settype($id, "int");
    $id = "WHERE iditem='" . $id . "'";

    $sql = "SELECT * FROM $table $id";
    $kq = mysqli_query($conn,$sql) or die(mysqli_error());
    while ($row_xoahinh = mysqli_fetch_assoc($kq)) {
        echo $id1 = 'WHERE id=' . "'" . $row_xoahinh['id'] . "'";
        if ($dxoa == ' ') {
            $link_hinh = $row_xoahinh['image'];
        } elseif ($dxoa != ' ') {
            $link_hinh = $dxoa . $row_xoahinh['image'];
        }

        if (file_exists($link_hinh)) {
            unlink($link_hinh);
        }

        $sql = "DELETE FROM $table $id1";
        $kq1 = mysqli_query($conn,$sql) or die(mysqli_error());
    }

}
function char_in_list($list_so, $so_kt)
{
    $kq_so = explode(",", $list_so);
    for ($i = 0; $i < count($kq_so); $i++) {
        $so = $kq_so[$i];
        if ($so_kt == $so) {
            $kq = 1;
            break;
        } else {
            $kq = 0;
        }
    }
    return $kq;
}
function getCurrentPageURL()
{
    $pageURL = 'http';
    if (!empty($_SERVER['HTTPS'])) {
        if ($_SERVER['HTTPS'] == 'on') {
            $pageURL .= "s";
        }
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
function get_result($table, $where, $lang, $limit)
{
    global $conn;
    $sql_get_result = "select * from " . $table;
    if ($where != "")
        $sql_get_result .= " where " . $where;
    if ($lang != "")
        $sql_get_result .= " and lang=" . $lang;
    if ($limit != "")
        $sql_get_result .= " limit " . $limit;
    //echo $sql_get_result;
    return mysqli_query($conn, $sql_get_result);
}
function get_arr_cate_by_parent($table, $id_cate, $arr = null, $lang)
    //De quy lay tat ca product theo id cate truyen vao
{
    if (!$arr)
        $arr = array(); //khoi tao 1 array co ten la arr
    $arr[] = array('id' => $id_cate);
    $sql_get_arr_cate_by_parent = get_result($table, "parent=" . $id_cate, $lang, "");
    while ($row = mysqli_fetch_array($sql_get_arr_cate_by_parent)) {
        $arr = get_arr_cate_by_parent($table, $row['id'], $arr, $lang);
    }
    return $arr;
}
function get_list_parent($table, $id_cate, $lang)
{
    $arr_get_list_parent = get_arr_cate_by_parent($table, $id_cate, $arr1, $lang);
    //print_r($arr_get_list_parent);
    $str_get_list_parent = "";
    foreach ($arr_get_list_parent as $k => $val) {
        $str_get_list_parent .= $val['id'] . ",";
    }
    $len = strlen($str_get_list_parent);
    $str_get_list_parent = substr($str_get_list_parent, 0, $len - 1);
    return $str_get_list_parent;
}
function get_list_parent1($table, $idchild)
{
    $str_list = "";
    $row_child_temp = get_one_row($table, "`id`='" . $idchild . "'", "");
    while ($idchild != "" && $row_child_temp['id'] != "" && $row_child_temp['id'] != 0) {
        $row_child = get_one_row($table, "`id`='" . $idchild . "'", "");
        $str_list = $idchild . "," . $str_list;
        if ($row_child['parent'] != "" && $row_child['parent'] != 0)
            $idchild = $row_child['parent'];
        else
            $idchild = "";
    }
    return substr($str_list, 0, -1);
}

function get_day_by_month($month, $year)
{
    $ts = mktime(0, 0, 0, $month, 1, $year);
    return date("t", $ts);
}
function get_day_by_year($year)
{
    return date("z", mktime(0, 0, 0, 13, 0, $year)) + 1;
}
function get_time($date)
{
    $get_time = 0;
    $arr = split("-", $date);
    $day = $arr[2];
    $mon = $arr[1];
    $yea = $arr[0];

    $now = getdate();
    $day_n = $now["mday"];
    $mon_n = $now["mon"];
    $yea_n = $now["year"];

    $day = (int)$day;
    $mon = (int)$mon;
    $yea = (int)$yea;
    $day_n = (int)$day_n;
    $mon_n = (int)$mon_n;
    $yea_n = (int)$yea_n;

    if ($yea == $yea_n) {
        if ($mon == $mon_n) {
            if ($day < $day_n)
                $get_time = $day_n - $day;
        } else
            if ($mon < $mon_n) {
                for ($i = $mon; $i < $mon_n; $i++) {
                    $get_time += get_day_by_month($i, $yea);
                }
                if ($day < $day_n) {
                    $get_time += $day_n - $day;
                } else {
                    $get_time -= $day - $day_n;
                }
            }
    } else
        if ($yea < $yea_n) {
            for ($i = $yea; $i < $yea_n; $i++) {
                $get_time += get_day_by_year($i);
            }
            if ($mon < $mon_n) {
                for ($i = $mon; $i < $mon_n; $i++) {
                    $get_time += get_day_by_month($i, $yea);
                }
                if ($day < $day_n) {
                    $get_time += $day_n - $day;
                } else {
                    $get_time -= $day - $day_n;
                }
            } else {
                for ($i = $mon_n; $i < $mon; $i++) {
                    $get_time -= get_day_by_month($i, $yea);
                }
                if ($day < $day_n) {
                    $get_time += $day_n - $day;
                } else {
                    $get_time -= $day - $day_n;
                }
            }
        }
    return $get_time;
}
function get_one_row($table, $where, $lang)
{
    $rs_get_one_row = get_result($table, $where, $lang, "0,1");
    return mysqli_fetch_array($rs_get_one_row);
}
function get_one_field($table, $where, $lang, $field)
{
    $row_get_one_field = get_one_row($table, $where, $lang);
    return $row_get_one_field[$field];
}
function update_session_product_view($id)
{
    $br = 0;
    for ($i = 1; $i <= 5; $i++) {
        if ($_SESSION['prod_view'][$i] == $id)
            $br = 1;
    }
    if ($br == 0) {
        if (isset($_SESSION['prod_view']) == false)
            $_SESSION['prod_view'] = array();
        for ($i = 5; $i > 1; $i--) {
            $_SESSION['prod_view'][$i] = $_SESSION['prod_view'][$i - 1];
        }
        $_SESSION['prod_view'][1] = $id;
    }
}
function get_parent_by_child($table, $idchild)
{
    $row_child = get_one_row($table, "`id`='" . $idchild . "'", "");
    if ($row_child['parent'] != "" && $row_child['parent'] != 0)
        return get_parent_by_child($table, $row_child['parent']);
    else
        return $row_child['id'];
}
function replace_title_tag($string)
{
    $str_rpl = str_replace('<title></title>', '', $string);
    return $str_rpl;
}
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array(
        'Version',
        $ub,
        'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern);
}
function get_operating_system() {
    $result = 'Unknown OS';
    $os = array(
        '/windows nt 10.0/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    foreach($os as $regex => $value) {
        if(preg_match($regex, $user_agent)) {
            $result = $value;
            break;
        }
    }
    return $result;
}
function getIpAddress() {
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
      $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
      $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
      $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
      $ip = $_SERVER['REMOTE_ADDR'];
   else
      $ip = "unknown";
   return ($ip);
}
function split_date($string) {
    $list = explode("-",$string);
    $replace_cpl = $list[2]."-".$list[1]."-".$list[0];
    return $replace_cpl;
}
function check_date($date) {
    $arr_date=explode("-",$date);
    $day=$arr_date[2]; $mon=$arr_date[1]; $yea=$arr_date[0];
    $arr_now=getdate();
    $day_n=$arr_now['mday']; $mon_n=$arr_now['mon']; $yea_n=$arr_now['year'];
    if($day==$day_n && $mon==$mon_n && $yea==$yea_n)
    return true;
    else return false;
}
function av($vi, $eng) {
    global $lang;
    if ($lang==1) {
        return $vi;
    }
    return $eng;
}

function watermark_image($file, $destination, $overlay = "../images/watermark/condau.png", $X, $Y){
    // Load the watermark and the photo to apply the watermark to
    $stamp = imagecreatefrompng($overlay);
    $source = getimagesize($file);
    $source_mime = $source['mime'];
    $source_x = $source['width'];
    $source_y = $source['height'];
    if($source_mime == "image/png"){
        $im= imagecreatefrompng($file);
    }else if($source_mime == "image/jpeg"){
        $im = imagecreatefromjpeg($file);
    }else if($source_mime == "image/gif"){
        $im = imagecreatefromgif($file);
    }
    // Set the margins for the stamp and get the height/width of the stamp image
    $marge_right = $X;
    $marge_bottom = $Y;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    // Copy the stamp image onto our photo using the margin offsets and the photo
    // width to calculate positioning of the stamp.
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    if($source_mime == "image/png"){
        imagepng($im, $destination);
    }else if($source_mime == "image/jpeg"){
        imagejpeg($im, $destination);
    }
    // Output and free memory
    imagedestroy($im);
    return $destination;
}
function watermark($img, $wtm, $ratio_ipt=1, $x, $y) {

    // lấy width và height của hình vừa upload
    $arr_img = getimagesize($img);
    $w_img = $arr_img[0];
    $h_img = $arr_img[1];

    // lấy width và height của watermark
    $arr_wtm = getimagesize($wtm);
    $w_wtm = $arr_wtm[0];
    $h_wtm = $arr_wtm[1];

    // lấy tỉ lệ để tạo kích thước file watermark, nếu tỉ lẹ width_file / width_watermark lớn hơn tỉ lệ height_file / height_watermark
    // thì lấy tỉ lệ theo tỉ lệ width_file / width_watermark
    $ratio_w = $w_img / $w_wtm;
    $ratio_h = $h_img / $h_wtm;
    $ratio = $ratio_w > $ratio_h ? $ratio_h : $ratio_w;

    // tạo kích thước mới cho file watermark
    $new_w_wtm = $w_wtm * $ratio * $ratio_ipt;
    $new_h_wtm = $h_wtm * $ratio * $ratio_ipt;

    // load và resize watermark
    $image = imagecreatefrompng($wtm);
    $new_image = imagecreatetruecolor($new_w_wtm, $new_h_wtm);
    imagesavealpha($new_image, true);
    $trans_colour = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
    imagefill($new_image, 0, 0, $trans_colour);

    // tạo và lưu file watermark mới
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_w_wtm, $new_h_wtm, imagesx($image), imagesy($image));
    $new_image_tmp = $new_image;
    imagepng($new_image_tmp,"../images/watermark/condau_2.png");

    // lấy lại file watermark mới
    $overlay = "../images/watermark/condau_2.png";

    // lấy vị trí cho file watermark mới nằm giữa file hình cần đóng dấu
    if($x != '') $X = $x; else $X = ($w_img - $new_w_wtm)/2;
    if($y != '') $Y = $y; else $Y = ($h_img - $new_h_wtm)/2;

    // đóng dấu
    watermark_image($img, $img, $overlay, $X, $Y);

    // xóa file watermark mới
    if(file_exists($overlay)) unlink($overlay);
}
function each_menu($arr,$parent,$bool=false,$show_image=false,$subject='',$has_sub=true){
    foreach ($arr as $k=> $v) :
        $test_field = true;
        if (is_array($bool)) {
            foreach ($bool as $field => $cell) {
                if($v[$field] != $cell) { $test_field = false;break; }
            }
        }
        if ($v['parent'] == $parent && $test_field == true) :
            $num = get_records('tbl_item_category','status = 1 and cate = '.$v['cate'].' and parent='.$v['id'],'sort,id desc',' ',$lang);
            $parent_ = get_parent_by_child('tbl_item_category',$v['id']);
            $link = $v['link']!='' ? $v['link'] : $v['subject'].'/';
            $active = $subject==$parent_?'class="active"':'';
            if($show_image==true) {$background_url = $v['image']?'style="background: transparent url('.$v['image'].') no-repeat left center;background-size: contain"':'';}
            echo "<li ".$active.">";
            echo "<a ".$background_url." href='/".$link."'>".$v['name']." </a>";
            if ($has_sub==true && mysqli_num_rows($num)>0) :
                echo "<ul >";
                each_menu($arr,$v['id']);
                echo "</ul>";
            endif;
            echo "</li>";
        endif;
    endforeach;
}
function price_according_currency($price){
    $currency_curren = getRecord("tbl_currency","id='".$_SESSION["setting"]["currency"]."'");
    $currency        = getRecord("tbl_currency","code='".$_SESSION["currency"]."'");

    if($currency_curren['id']=='' || $currency['code']=='') return number_format($price);

    return $currency["symbol_left"] . " " . number_format(($currency["value"] * $price) / $currency_curren["value"],$currency["decimal_place"]) . " " . $currency["symbol_right"];
}
function getPrice ($price, $pricekm) {
    global $row_shop;
    $string = '';

    if ($price != 0 && $pricekm != 0) {
        $string .= '<p class="old-price">'.number_format($price,0).' '.$row_shop['tiente'].'</p>';
        $string .= '<p class="sell-price">'.number_format($pricekm,0).' '.$row_shop['tiente'].'</p>';
    }
    elseif ($price != 0 && $pricekm == 0) {
        $string .= '<p class="sell-price">'.number_format($price,0).' '.$row_shop['tiente'].'</p>';
    }
    elseif ($price == 0 && $pricekm != 0) {
        $string .= '<p class="sell-price">'.number_format($pricekm,0).' '.$row_shop['tiente'].'</p>';
    }
    elseif ($price == 0 && $pricekm == 0) {
        $string .= '<p class="no-price">'.av('Liên hệ','Call').'</p>';
    }
    return $string;
}
function getPricePageDetail ($price, $pricekm) {
    global $row_shop;
    $string = '';

    if ($price != 0 && $pricekm != 0) {
        $string .= '<div><span class="old-price">'.number_format($price,0).' '.$row_shop['tiente'].'</span></div>';
        $string .= '<div><span class="price">'.number_format($pricekm,0).' '.$row_shop['tiente'].'</span></div>';
    }
    elseif ($price != 0 && $pricekm == 0) {
        $string .= '<div class="price">'.number_format($price,0).' '.$row_shop['tiente'].'</div>';
    }
    elseif ($price == 0 && $pricekm != 0) {
        $string .= '<div class="price">'.number_format($pricekm,0).' '.$row_shop['tiente'].'</div>';
    }
    elseif ($price == 0 && $pricekm == 0) {
        $string .= '<div class="no-price">'.av('Liên hệ','Call').'</div>';
    }
    return $string;
}

function count_record($table,$where,$lang,$limit,$order)
{
    $rs_count_record=get_result($table,$where,$lang,$limit,$order);
    return mysqli_num_rows($rs_count_record);
}
function pagination16($totalRows, $pageSize, $host_link_full, $k, $get_page) {
   if ($totalRows <= 0) {
      return "";
   }
   $totalPages = ceil($totalRows / $pageSize);
   if ($totalPages <= 1) {
      return "";
   }

   $currentURL = $host_link_full;
   if (isset($_GET["pageNum"]) == true) {
      $currentPage = $_GET["pageNum"];
   } else {
      $currentPage = 1;
   }
   settype($currentPage, "int");
   if ($currentPage <= 0) {
      $currentPage = 1;
   }
   $querystring = "";
   foreach($_GET as $k => $v) {
      if ($k != 'pageNum')
         $querystring = $querystring."&{$k}={$v}";
   }

   if ($currentPage > 1) {
      $page = $currentPage - 1;
      $prev = "<li><a class='page-numbers' href='".$currentURL."/".$get_page."/page=$page'><i class='fa fa-angle-left'></i></a></li>";
      $first = " <li><a class='page-numbers' href='".$currentURL."/".$get_page."/page=1'>1</a></li>";
   } else {
      $first = "<li class='active'><span class='page-numbers'>1</span></li>";
   }
   if ($currentPage < $totalPages) {
      $page = $currentPage + 1;
      $next = " <li><a class='page-numbers' href='".$currentURL."/".$get_page."/page=$page'><i class='fa fa-angle-right'></i></a></li> ";
      $last = " <li><a class='page-numbers' href='".$currentURL."/".$get_page."/page=$totalPages'>$totalPages</a></li> ";
   } else {
      $last = " <li class='active'><span class='page-numbers'>$totalPages</span></li>";
   }

   $paging_item = $prev.$first;

   $is_three_dot = false;
   $paging_item_content = '';

   if ($currentPage - 2 > 2) {
      $paging_item_content.= ' <li class="disabled"><span class="page-numbers dots">…</span></li> ';
   }
   for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) {
      if ($i < $totalPages && $i > 1) {
         if ($i == $currentPage) {
            $paging_item_content.= " <li class='active'><span class='page-numbers'>$i</span></li> ";
         } else {
            $paging_item_content.= " <li><a class='page-numbers' href='".$currentURL."/".$get_page."/page=$i'>$i</a></li> ";
         }
      }
   }
   if ($currentPage + 2 < $totalPages - 1) {
      $paging_item_content.= ' <li class="disabled"><span class="page-numbers dots">…</span></li> ';
   }

   return $paging_item.$paging_item_content.$last.$next;
}
function url_direct($mode, $act = null, $prop = "_m", $prop2){
    global $__token;if($act == null) $act = $_GET["act"];
    switch ($mode) {
        case 'add':
            return "/quantri/{$__token->create_link()}&act={$act}{$prop}";
            break;
        case 'edit':
            return "/quantri/{$__token->create_link()}&act={$act}{$prop}{$prop2}";
            break;
        case 'del':
            return "/quantri/{$__token->create_link()}&act={$act}{$prop2}";
            break;
        case 'get':
            $act = str_replace($prop, "", $act);
            return "/quantri/{$__token->create_link()}&act={$act}{$prop2}";
            break;
        default:
            return "/quantri/{$__token->create_link()}";
            break;
    }
}

function show_menu_select($arr, $parent, $list_id, $str = '|--') {
    foreach($arr as $k => $v):
        if ($v['parent'] == $parent) {
            unset($arr[$k]);
            echo '<option value="'.$v['id'].'">'.$str.$v['name'].'</option>';
        if ($arr) { show_menu_select($arr, $v['id'], $list_id, $str.'|--'); }
        }
    endforeach;
}
?>