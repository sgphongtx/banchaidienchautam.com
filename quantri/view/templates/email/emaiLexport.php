<?php
// Configuration
include('../../../../systems/database/database.php');

$file_name = "email_recceive_newsletter.xls";
$title_worksheet = "Danh sách email"; // ko quá 20 kí tự
$rowindex_data_begin = 1;
/** PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/../../../../Classes/PHPExcel/IOFactory.php';
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("../export_folder/" . $file_name);
$select = "SELECT * FROM tbl_email";
$result = mysqli_query($conn,$select);
while($row = mysqli_fetch_array($result)){
    $rowindex_data_begin++;    
    
    $id         = $row['id']; 
    $email      = $row['email'];
    $date_added = $row['date_added'];
            
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $rowindex_data_begin, $id)
            ->setCellValue('B' . $rowindex_data_begin, $email)
            ->setCellValue('C' . $rowindex_data_begin, $date_added);
            
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