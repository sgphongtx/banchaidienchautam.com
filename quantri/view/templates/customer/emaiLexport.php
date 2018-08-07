<?php
// Configuration
include('../../../../systems/database/database.php');

$file_name = "customer_shop.xls";
$title_worksheet = "Danh sách thành viên"; // ko quá 20 kí tự
$rowindex_data_begin = 1;
require_once dirname(__FILE__) . '/../../../../Classes/PHPExcel/IOFactory.php';
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("../export_folder/" . $file_name);
$select = "SELECT *,DATE_FORMAT(birthday,'%d/%m/%Y') AS dob,DATE_FORMAT(date_added,'%d/%m/%Y') AS dateAdded FROM tbl_customer_shop ORDER BY id ASC";
$result = mysqli_query($conn,$select);
while($row = mysqli_fetch_array($result)){
    $rowindex_data_begin++;    
    
    $id         = $row['id'];
    $name       = $row['name'];
    $email      = $row['email'];
    $birthday   = $row['dob'];
    $address    = $row['address']; 
    $mobile     = $row['mobile']; 
    $date_added = $row['dateAdded'];
    if ($row['sex']==1) $sex='Nam';
    elseif ($row['sex']==2) $sex='Nữ';
    else $sex='Unknow';
            
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $rowindex_data_begin, $id)
            ->setCellValue('B' . $rowindex_data_begin, $name)
            ->setCellValue('C' . $rowindex_data_begin, $email)
            ->setCellValue('D' . $rowindex_data_begin, $birthday)
            ->setCellValue('E' . $rowindex_data_begin, $sex)
            ->setCellValue('F' . $rowindex_data_begin, $address)
            ->setCellValue('G' . $rowindex_data_begin, $mobile)
            ->setCellValue('H' . $rowindex_data_begin, $date_added);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($title_worksheet);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'. $file_name .'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>