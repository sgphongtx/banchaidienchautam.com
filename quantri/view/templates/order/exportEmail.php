<?php
// Configuration
include('../../../../systems/database/database.php');

$view = isset($_GET['view']) ? $_GET['view'] : 0;
$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

$and = '';
if($view == 2) :
    $today = date("d/m/Y");
    $t = date('N');
    $start_date = split_date(date('d-m-Y', (strtotime(date('d-m-Y')) * 1000 - (date('N') - 1) * 60 * 60 * 24 * 1000) / 1000));
    $end_date = split_date(date('d-m-Y', (strtotime(date('d-m-Y')) * 1000 - (date('N') - 7) * 60 * 60 * 24 * 1000) / 1000));
    $and = " AND ThoiDiemDatHang BETWEEN '$start_date' AND '$end_date'";
elseif($view == 3) :
    $arr_month = explode('-', $month);
    $and = ' AND MONTH(ThoiDiemDatHang)='.$arr_month[0].' AND YEAR(ThoiDiemDatHang)='.$arr_month[1];
elseif($view == 4) :
    $and = ' AND YEAR(ThoiDiemDatHang)='.($year != '' ? $year : date('Y'));
endif;

$file_name = "order.xls";
$title_worksheet = "Danh sách đơn hàng"; // ko quá 20 kí tự
$rowindex_data_begin = 1;
/** PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/../../../../Classes/PHPExcel/IOFactory.php';
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("../export_folder/" . $file_name);
$select = "SELECT *,DATE_FORMAT(ThoiDiemDatHang, '%h:%m %d/%m/%Y') AS ThoiDiemDatHang1 FROM tbl_donhang WHERE 1=1 ".$and;
$result = mysqli_query($conn,$select);
function split_date($string) {
    $list = explode("-",$string);
    $replace_cpl = $list[2]."-".$list[1]."-".$list[0];
    return $replace_cpl;
}
function getStatusOrderAbc($status){
    if($status == 1) return "Chờ xử lí";
    if($status == 4) return "Chờ xuất hàng";
    if($status == 7) return "Hoàn thành";
    if($status == 9) return "Huỷ đơn hàng";
    if($status == 10) return "Từ chối đơn hàng";
    if($status == 11) return "Hoàn trả đơn hàng";
    if($status == 12) return "Đã tiếp nhận";
}
$objPHPExcel->setActiveSheetIndex(0);
while($row = mysqli_fetch_array($result)){
    $rowindex_data_begin++;
    $rs_order_detail = mysqli_query($conn,"SELECT * FROM tbl_donhangchitiet WHERE idDH=".$row['id']);
    $count = mysqli_num_rows($rs_order_detail);
    if($count > 1) {
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowindex_data_begin.':A'.($rowindex_data_begin + $count - 1));
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowindex_data_begin.':B'.($rowindex_data_begin + $count - 1));
        $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowindex_data_begin.':C'.($rowindex_data_begin + $count - 1));
        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowindex_data_begin.':D'.($rowindex_data_begin + $count - 1));
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowindex_data_begin.':E'.($rowindex_data_begin + $count - 1));
        $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowindex_data_begin.':F'.($rowindex_data_begin + $count - 1));
        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowindex_data_begin.':G'.($rowindex_data_begin + $count - 1));
        $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowindex_data_begin.':H'.($rowindex_data_begin + $count - 1));
        $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowindex_data_begin.':I'.($rowindex_data_begin + $count - 1));
    }

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowindex_data_begin, $row['id']);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowindex_data_begin, $row['TenNguoiNhan']);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowindex_data_begin, $row['ThoiDiemDatHang1']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowindex_data_begin, $row['soDT']);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowindex_data_begin, $row['DiaChi']);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowindex_data_begin, $row['yahoo']);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowindex_data_begin, $row['GhiChu']);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowindex_data_begin, number_format($row['price'], 0));
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $rowindex_data_begin, getStatusOrderAbc($row['status']));
    if($count > 0) {
        $rowindex_data_begin--;
        while($row_order_detail = mysqli_fetch_assoc($rs_order_detail)) {
            $rowindex_data_begin++;
            $row_item = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM tbl_item WHERE id=".$row_order_detail['idSP']));
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $rowindex_data_begin, $row_item['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $rowindex_data_begin, number_format($row_order_detail['SoLuong'], 0));
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $rowindex_data_begin, number_format($row_order_detail['DonGia'], 0));
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $rowindex_data_begin, number_format($row_order_detail['SoLuong'] * $row_order_detail['DonGia'], 0));
        }
    }
}
// $objPHPExcel->getActiveSheet()->setCellValue('A' . ($rowindex_data_begin + 1), $select);
$objPHPExcel->getActiveSheet()->getStyle("A1:M".$rowindex_data_begin)->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
        )
    )
);
$objPHPExcel->getActiveSheet()->getStyle("A1:I".$rowindex_data_begin)->applyFromArray(
    array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        )
    )
);
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