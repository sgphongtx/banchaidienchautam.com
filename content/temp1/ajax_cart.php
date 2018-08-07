<?php
	include('config_ajax.php');

	$id = $_POST['idsp']; $qty = $_POST['qty']; 
	$update = isset($_POST['update']) ? $_POST['update'] : 0;
	$delete = isset($_POST['delete']) ? $_POST['delete'] : 0;

	$sql    = "SELECT * FROM tbl_item WHERE id=".$id;
	$query  = mysqli_query($conn,$sql);
	$result = mysqli_fetch_array($query);
	print_r($result);

	$price   = $result['pricekm']!=0 ? $result['pricekm'] : $result['price'];
	$soluong = (isset($qty)==true) ? $qty : 1;

/*
[mycart]=array(
    [cart]=>array(
        [id]=>array(
            [link]=>'link',
            [name]=>'name',
            [url_image]=>'url_image',
            [price]=>'price',
            [trademark]=>'trademark',
            [masp]=>'masp',
            [tongsl]=>'tongsl'
        )
    ),
    [tongsl]=>'tongsl',
    [tongtien]=>'tongtien'
)
 */

	if ($id>0) {
		if (!isset($_SESSION['mycart'])) {
			// giỏ hàng rỗng => khởi tạo giỏ hàng
			$_SESSION['mycart'] = array(
													'cart'     => array(),
													'tongsl'   => 0,
													'tongtien' => 0
												);
		}

		if (!isset($_SESSION['mycart']['cart'][$id])) {
			// chưa tồn tại id trong giỏ hàng
			if ($soluong>0) {
				// thêm id vào giỏ hàng
				$_SESSION['mycart']['tongsl']   += $soluong;
				$_SESSION['mycart']['tongtien'] += $soluong*(int)$price;
				$_SESSION['mycart']['cart'][$id] = array(
																		'link'      => $result['subject'].'.html',
																		'name'      => $result['name'],
																		'url_image' => $result['image'],
																		'price'     => $price,
																		'masp'      => $result['code'],
																		'tongsl'    => $soluong
																	);
			}
		} else {
			// đã tồn tại id trong giỏ hàng
			if ($delete==1) {
				$_SESSION['mycart']['tongsl'] -= $_SESSION['mycart']['cart'][$id]['tongsl'];
				$_SESSION['mycart']['tongtien'] -= $_SESSION['mycart']['cart'][$id]['tongsl']*(int)$price;
				unset($_SESSION['mycart']['cart'][$id]);
			} elseif ($update==1) {
				// update giỏ hàng
				if ($soluong>0) {
					$_SESSION['mycart']['tongsl'] += $soluong - $_SESSION['mycart']['cart'][$id]['tongsl'];
					$_SESSION['mycart']['tongtien'] += ($soluong - $_SESSION['mycart']['cart'][$id]['tongsl']) * (int)$price;
					$_SESSION['mycart']['cart'][$id]['tongsl'] = $soluong;
				} else {
					$_SESSION['mycart']['tongsl'] -= $_SESSION['mycart']['cart'][$id];
					$_SESSION['mycart']['tongtien'] -= $_SESSION['mycart']['cart'][$id]*(int)$price;
					unset($_SESSION['mycart']['cart'][$id]);
				}
			} else {
				if ($soluong>0) {
					$_SESSION['mycart']['tongsl'] += $soluong;
					$_SESSION['mycart']['tongtien'] += $soluong * (int)$price;
					$_SESSION['mycart']['cart'][$id]['tongsl'] += $soluong;
				}
			}
		}

		print_r($_SESSION['mycart']);
		if (count($_SESSION['mycart']['cart'])<=0) {
			unset($_SESSION['mycart']);
		}
	}