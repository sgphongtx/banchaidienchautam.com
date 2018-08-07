<div class="widget widget-static-block bg-white">
	<div class="cart-wrap space-base">
		<div class="block-title">
			<div class="h3"><?php echo module_keyword($mang11,$mang22,"viewcart");?></div>
		</div>
		<div class="block-content">
			<div class="shopping-cart-table">
				<?php if (isset($_SESSION['mycart'])) : ?>
				<form method="post" action="" enctype="multipart/form-data">
             	<div class="table-responsive">
              		<table class="table">
							<thead>
								<tr>
									<th class="text-left"><?php echo module_keyword($mang11,$mang22,"name_sp");?></th>
									<th class="text-center"><?php echo module_keyword($mang11,$mang22,"quanty_sp");?></th>
									<th class="text-center"><?php echo module_keyword($mang11,$mang22,"price_sp");?></th>
									<th class="text-center"><?php echo module_keyword($mang11,$mang22,"total_sp");?></th>
									<th class="text-right"> </th>
								</tr>
							</thead>
							<tbody>
								<?php
                         	$cart = $_SESSION['mycart']['cart'];
                         	foreach ($cart as $idSP => $arr_cart) :
                         		$item = $arr_cart;
                        ?>
								<tr>
									<td class="col-md-5 text-left">
										<div class="media">
											<a class="thumbnail pull-left" href="<?=$linkroot?>/<?=$item['link']?>" style="margin-right: 10px;">
												<img class="media-object" src="<?php echo $path_image.$item['url_image']; ?>" alt="<?=$item['name']?>" style="max-width: 100px;" />
											</a>
											<div class="media-body">
												<h4 class="media-heading"><a class="text-info" href="<?=$linkroot?>/<?=$item['link']?>"><?=$item['name'];?></a></h4>
											</div>
										</div>
									</td>
									<td class="col-md-2 text-center">
										<input class="slsp form-control text-center" type="number" name="qty<?=$dem;?>" min="0" max="25" size="6" id="qty<?=$dem;?>" value="<? echo $item['tongsl'];?>"/>
									</td>
									<td class="col-md-2 text-center">
										<strong>
										<?php
                               	if($item['price']!=0) {
                                   	if(preg_match ("/^([0-9]+)$/", $item['price']))
                                    	echo number_format($item['price'],0).' '.$row_shop['tiente'];
                                      	else echo $item['price'];
                               	} else echo av('Liên hệ','Call');
                              ?>
                              </strong>
									</td>
									<td class=" col-md-2 text-center">
										<strong>
										<?php
                               	$tien = $item['price'] * $item['tongsl'];
                               	if(preg_match ("/^([0-9]+)$/", $tien)) echo number_format($tien,0).' '.$row_shop['tiente']; else echo $tien;
                              ?>
                              </strong>
									</td>
									<td class="col-md-1 text-right">
										<button type="button" name="addcart<?=$dem;?>" class="btn btn-success click_cart" data-toggle="tooltip" data-placement="bottom" title="<?=av('Cập nhật','Update')?>" idtin="<?=$idSP;?>" id="addcart<?=$dem;?>">
                               	<span class="fa fa-refresh"></span>
                        		</button>
                              <button type="button" class="btn btn-danger deletet" id="delete<?=$dem?>" data-toggle="tooltip" idtin="<?=$idSP;?>" data-placement="bottom" title="<?=av('Xóa','Remove')?>" value="<?=$dem;?>">
                               	<span class="fa fa-trash"></span>
                           	</button>
										<script> $(function () { $('[data-toggle="tooltip"]').tooltip() }); </script>
									</td>
                        </tr>
                  		<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<td> &nbsp; </td>
									<td> &nbsp; </td>
									<td> &nbsp; </td>
									<td class="text-left">
										<h3><?php echo module_keyword($mang11,$mang22,"totalprice_sp");?></h3>
									</td>
									<td class="text-right">
										<h3>
											<strong>
												<?php
	                                    $tongtien = $_SESSION['mycart']['tongtien'];
	                                    if(preg_match ("/^([0-9]+)$/", $tongtien)) echo number_format($tongtien,0).' '.$row_shop['tiente']; else echo $tongtien;
	                                	?>
											</strong>
                              </h3>
									</td>
								</tr>
								<tr>
									<td> &nbsp; </td>
									<td> &nbsp; </td>
									<td> &nbsp; </td>
									<td class="text-right">
										<a href="view-all/" class="btn btn-default">
											<span class="fa fa-shopping-cart"></span> <?=av('Tiếp tục mua','Shopping continue')?>
										</a>
									</td>
									<td class="text-right">
										<a href="<?php echo $linkroot?>/dat-hang" class="btn btn-success">
											<?=av('Đặt hàng','Checkout')?> <span class="fa fa-play"></span>
										</a>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</form>
				<?php else : ?>
					<?=av('Không có sản phẩm nào trong giỏ hàng của bạn','Your cart is empty')?>
				<?php endif; ?>
	 		</div>
		</div>
	</div>
</div>
