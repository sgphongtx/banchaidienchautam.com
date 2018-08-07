<?php
switch ($frame){

	case "comment"          : include(PATH_TEMPLATES . "/comment/comment.php");break;
	case "comment_m"        : include(PATH_TEMPLATES . "/comment/comment_m.php");break;
	
	case "question"            : include(PATH_TEMPLATES . "/question/question.php");break;
    case "question_m"          : include(PATH_TEMPLATES . "/question/question_m.php");break;
	
	case "image_gallery"       : include(PATH_TEMPLATES . "/image_gallery/image_gallery.php");break;
	case "watermark"           : include(PATH_TEMPLATES . "/watermark/watermark.php");break;
	
	case "lang"                : include(PATH_TEMPLATES . "/lang/lang.php");break;
	case "lang_m"              : include(PATH_TEMPLATES . "/lang/lang_m.php");break;
	
	case "language"            : include(PATH_TEMPLATES . "/language/language.php");break;
	case "language_m"			   : include(PATH_TEMPLATES . "/language/language_m.php");break;	
	
	case "currency"            : include(PATH_TEMPLATES . "/currency/currency.php");break;
	case "currency_m"			   : include(PATH_TEMPLATES . "/currency/currency_m.php");break;
	case "currency_refresh"		: include(PATH_TEMPLATES . "/currency/refresh.php");break;
	
	//  item_category
	case "item_category"       : include(PATH_TEMPLATES . "/item_category/item_category.php");break;
	case "item_category_m"     : include(PATH_TEMPLATES . "/item_category/item_category_m.php");break;
	
	//  item
	case "item"                : include(PATH_TEMPLATES . "/item/item.php");break;
	case "item_m"              : include(PATH_TEMPLATES . "/item/item_m.php");break;
	
	//  news_category
	case "news_category"       : include(PATH_TEMPLATES . "/news_category/news_category.php");break;
	case "news_category_m"     : include(PATH_TEMPLATES . "/news_category/news_category_m.php");break;
	
	//  news
	case "news"                : include(PATH_TEMPLATES . "/news/news.php");break;
	case "news_m"              : include(PATH_TEMPLATES . "/news/news_m.php");break;
	
	//  auto
	case "auto"                : include(PATH_TEMPLATES . "/auto/auto.php");break;
	case "auto_m"              : include(PATH_TEMPLATES . "/auto/auto_m.php");break;
	
	//  customer
	case "customer"            : include(PATH_TEMPLATES . "/customer/customer.php");break;
	case "customer_m"          : include(PATH_TEMPLATES . "/customer/customer_m.php");break;
	
	//  keyword
	case "keyword"             : include(PATH_TEMPLATES . "/keyword/keyword.php");break;
	case "keyword_m"           : include(PATH_TEMPLATES . "/keyword/keyword_m.php");break;
	
	//  banner
	case "banner"              : include(PATH_TEMPLATES . "/banner/banner.php");break;
	case "banner_m"            : include(PATH_TEMPLATES . "/banner/banner_m.php");break;
	
	//  footer
	case "footer"              : include(PATH_TEMPLATES . "/footer/footer.php");break;
	case "footer_m"            : include(PATH_TEMPLATES . "/footer/footer_m.php");break;
	
	//  contact
	case "contact"             : include(PATH_TEMPLATES . "/contact/contact.php");break;
	case "contact_m"           : include(PATH_TEMPLATES . "/contact/contact_m.php");break;
	
	//  map
	case "map"                 : include(PATH_TEMPLATES . "/map/map.php");break;
	case "map_m"               : include(PATH_TEMPLATES . "/map/map_m.php");break;
    
	case "facebook"			   : include(PATH_TEMPLATES . "/facebook/add_link_facebook.php"); break;
	
	//  email
	case "email"               : include(PATH_TEMPLATES . "/email/email.php");break;
	case "email_m"             : include(PATH_TEMPLATES . "/email/email_m.php");break;
	
	//  adv
	case "adv"                 : include(PATH_TEMPLATES . "/adv/adv.php");break;
	case "adv_m"               : include(PATH_TEMPLATES . "/adv/adv_m.php");break;
	
	//  partner
	case "partner"             : include(PATH_TEMPLATES . "/partner/partner.php");break;
	case "partner_m"           : include(PATH_TEMPLATES . "/partner/partner_m.php");break;
	
	//  link
	case "link"                : include(PATH_TEMPLATES . "/link/link.php");break;
	case "link_m"              : include(PATH_TEMPLATES . "/link/link_m.php");break;
	
	
	//  document
	case "document"            : include(PATH_TEMPLATES . "/document/document.php");break;
	case "document_m"          : include(PATH_TEMPLATES . "/document/document_m.php");break;
	
	//  slider
	case "slider"              : include(PATH_TEMPLATES . "/slider/slider.php");break;
	case "slider_m"            : include(PATH_TEMPLATES . "/slider/slider_m.php");break;	
	
	//  support
	case "support"             : include(PATH_TEMPLATES . "/support/support.php");break;
	case "support_m"           : include(PATH_TEMPLATES . "/support/support_m.php");break;
	
	//  video
	case "video"               : include(PATH_TEMPLATES . "/video/video.php");break;
	case "video_m"             : include(PATH_TEMPLATES . "/video/video_m.php");break;	
	
	//  user
	case "user"                : include(PATH_TEMPLATES . "/user/user.php");break;
	case "user_m"              : include(PATH_TEMPLATES . "/user/user_m.php");break;
	case "user_permiss"        : include(PATH_TEMPLATES . "/user/user_permiss.php");break;	
	
	//  customer
	case "customer"            : include(PATH_TEMPLATES . "/customer/customer.php");break;
	case "customer_m"          : include(PATH_TEMPLATES . "/customer/customer_m.php");break;

	// comment
	case "manage_comment"      : include(PATH_TEMPLATES . "/comment/manager_comment.php");break;
	
	case "web1"                : include(PATH_TEMPLATES . "/config/web1.php");break;
	case "web2"                : include(PATH_TEMPLATES . "/config/web2.php");break;
	
	case "manufacturer"             : include(PATH_TEMPLATES ."factory/factory.php");break;
	case "manufacturer_m"           : include(PATH_TEMPLATES ."factory/factory_m.php");break;

	// order
	case "manage_orders"       : include(PATH_TEMPLATES . "/order/OrderManager.php");break;
	case "order"               : include(PATH_TEMPLATES . "/order/order.php");break;
	case "order_m"             : include(PATH_TEMPLATES . "/order/order_m.php");break;

	case "icons"          	   : include(PATH_TEMPLATES . "/font-icon/icons.php");break;
	
	case "config_shop"         : include(PATH_TEMPLATES . "/config/config_shop.php");break;
	case "config_template"     : include(PATH_TEMPLATES . "/config/config_template.php");break;	
	case "layout_web"       	: include(PATH_TEMPLATES . "/layout_web/layout_web.php");break;
	case "content_web"      	: include(PATH_TEMPLATES . "/contentweb/contentweb.php");break;
	case "elementweb"       	: include(PATH_TEMPLATES . "/elementweb/elementweb.php");break;
	case "multi_lang_trans"  	: include(PATH_TEMPLATES . "/multi_lang_trans/multi_lang_trans.php");break;

	case "nlang"               : include("ajax/lang.php");break;

	case "styleweb"         	: include("styleweb.php");break;
	case "reminder_password"   : include("reminder_password.php");break;
	case "login"               : include("login.php");break;	
	case "logout"           :
		$__token->remove_token();
		$__token->remove_cookie();
		unset($_SESSION['RF']['watermark']);
		header("location:/quantri/");
		break;
		
	//----------------------------------------------------------------------------------------------
	
	case "home"            : include("view/home.php");break;
	default                : include("view/home.php");break;
}
?>