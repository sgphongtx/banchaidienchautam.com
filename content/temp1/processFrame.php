<?php  
switch ($frame) {

	case "currency"                : include("content/".$template."/currency.php");break;
	case "sitemap"               	 : include("content/".$template."/sitemap.php");break;
	case "chuyenmuc"               : include("content/".$template."/chuyenmuc.php");break;
	case "chuyenmuc_detail"        : include("content/".$template."/chuyenmuc_detail.php");break;
	case "danhmuc"                 : include("content/".$template."/danhmuc.php");break;
	case "product_detail"          : include("content/".$template."/product_detail.php");;break;
	case "search"                  : include("content/".$template."/search.php");break;
	case "products"                : include("content/".$template."/products.php");break;
	case "home"                    : include("content/".$template."/home.php");break;
	case "order"                   : include("content/".$template."/order.php");break;
	case "page404"                 : include("content/".$template."/page404.php");break;
	case "viewcart"                : include("content/".$template."/viewcart.php");break;
	case "listorder"               : include("content/".$template."/listorder.php");break;
	case "vieworder"               : include("content/".$template."/vieworder.php");break;
	case "manager_order"           : include("content/".$template."/manager_acount_order.php");break;
	case "tag"                     : include("content/".$template."/tag.php");break;
	case "contact"                 : include("content/".$template."/contact.php");break;
	case "video"                 : include("content/".$template."/video.php");break;
	case "register"                : include("content/".$template."/register.php");break;
	case "ignorepass"              : include("content/".$template."/ignorepass.php");break;
	case "restorepass"             : include("content/".$template."/restorepass.php");break;
	case "editinfo"                : include("content/".$template."/editinfo.php");break;
	case "editpass"                : include("content/".$template."/editpass.php");break;
	case "add_item"                : include("content/".$template."/adcart.php");break;
	case "login"                	 : include("content/".$template."/login.php");break;	
	case "logout"           :
		unset($_SESSION['kh_shop_login_id']);
		unset($_SESSION['kh_shop_login_username']);
		echo "<script>window.location='".$linkroot."'</script>";
		break;
	
	default                        : include("content/".$template."/home.php");break;
	
}

?>