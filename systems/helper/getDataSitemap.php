<?php
   $cate1 = get_records("tbl_item_category","cate=1 and status=1","id ASC"," ",$lang);
   $cate2 = get_records("tbl_item_category","cate=2 and status=1","id ASC"," ",$lang);
   $item = get_records("tbl_item","cate=1 or cate=2 and status=1","id DESC"," ",$lang);

   $output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" . "\n";
   $output .= "
   <urlset
      xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
      xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
      xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">" . "\n";

   $output .= '
      <url>
         <loc>'.$linkroot.'/</loc>
         <changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>';

	$output .= '
   	<url>
   		<loc>'.$linkroot.'/view-all/</loc>
   		<changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>';

	while ($row_cate1 = mysqli_fetch_assoc($cate1)) :
	$output .= '
   	<url>
   		<loc>'.$linkroot.'/'.$row_cate1['subject'].'/</loc>
   		<changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>';
	endwhile;
	$output .= '
   	<url>
   		<loc>'.$linkroot.'/lien-he.html</loc>
   		<changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>';
	while ($item = @mysqli_fetch_assoc($item)) :
	$output .= '
   	<url>
   		<loc>'.$linkroot.'/'.$item['subject'].'.html</loc>
   		<changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>';
	endwhile;
	while ($row_cate2 = mysqli_fetch_assoc($cate2)) :
	$output .= '
   	<url>
   		<loc>'.$linkroot.'/'.$row_cate2['subject'].'/</loc>
   		<changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>';
	endwhile;
   $output .= '</urlset>';

	$data = $output;

	$target_file = "sitemap.xml";
	$file = fopen($target_file, "w");
 	fwrite($file, $data);
 	fclose($file);
?>