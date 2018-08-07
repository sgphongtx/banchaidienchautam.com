<?php
include('../../systems/database/database.php');
include('../../systems/core/func.php');

$cmd = $_POST['cmd'];
$value = $_POST['value'];
$table = $_POST['table'];

switch ($cmd) {
	case 'SAVE_CSS':
		$css = trim($_POST['css']);
		$id  = $_POST['id'];
		$sql = "UPDATE tbl_shop SET css='{$css}' WHERE id='{$id}'";
		$result = mysqli_query($conn,$sql);
		if ($result) echo true;
		else echo false;
		return;
		break;

	case 'CRE_ALIAS':
		if (isset($value) && $value != '') {
			$subject_temp = cat_kytu_dacbiet($value,1,1,0,1,1);
	    	$subject = $subject_temp;
	    	if (isset($_POST['id']) && $_POST['id'] != null) {
	        	$row_id = get_one_row($table,"id=".$_POST['id'],"");
	        	if($row_id['name']==$value) {
					$subject       = $row_id['subject'];
					$subject_temp  = $row_id['subject_temp'];
					$subject_final = $subject;
	        	} else {
		         if (count_record($table,"subject_temp='".$subject_temp."' and id!=".$_POST['id'],"","","")>0) {
						/*$subject_temp       = $subject_temp."-".count_record($table,"subject_temp='".$subject_temp."'","","","");
						$subject_final = $subject_temp;*/
                  $subject_final = $subject_temp."-".count_record($table,"subject_temp='".$subject_temp."'","","","");
		         } else $subject_final = $subject;
		      }
	 		} else {
				if (count_record($table,"subject_temp='".$subject_temp."'","","","")>0) {
					/*$subject_temp       = $subject_temp."-".count_record($table,"subject_temp='".$subject_temp."'","","","");
					$subject_final = $subject_temp;*/
               $subject_final = $subject_temp."-".count_record($table,"subject_temp='".$subject_temp."'","","","");
				} else $subject_final = $subject;
	    	}
		}
		echo json_encode(array("subject"=>$subject_final,"subject_temp"=>$subject_temp));
		break;

	case 'BTN_ACTIVE_STAT':
		if(isset($_POST['data'])) {
			$item   = $_POST['data']['item'];
			$action = $_POST['data']['action'];
			$field  = $_POST['data']['field'];
			$table  = $_POST['data']['table'];
			$sql = 'update '.$table.' set '.$field.' = IF('.$field.'=1, 0, 1) where id = '.$item;
			$run =  mysqli_query($conn,$sql);
			if($run)  {echo '1';return;}
			echo '0';
			return;
		}
		break;

	case 'CMT_ON':
		$status = $_POST['status'];
		$idsp = $_POST['idsp'];
	 	mysqli_query($conn,"update product_comment set status=".$status." where id_comment=".$idsp);
		break;

	case 'CMT_OFF':
	case 'CMT_DEL':
		$idsp = $_POST['idsp'];
		mysqli_query($conn,"delete from product_comment where id_comment=".$idsp);
		break;

	case 'DEL_IMG_GAL':
		$id = $_POST['id'];
		$sql = "DELETE FROM tbl_image_gallery WHERE id='$id'";
		if (mysqli_query($conn,$sql)) return 0;
		else return 1;
		break;

	case 'EDIT_IMG_GAL':
		$id = $_POST['id'];
		$html = '';
		$query = mysqli_query($conn,"SELECT * FROM tbl_image_gallery WHERE id='$id'");
		$result = mysqli_fetch_assoc($query);
		$html .= '<br/><div class="col-md-3><label>Tiêu đề</label><input name="txtname" class="form-control" value="'.$result['name'].'" required/><input type="hidden" name="idImg" value="'.$id.'"></div>';
		$html .= '<div class="col-md-6"><label>Hình ảnh</label><div class="input-group">';
		$html .= '<input type="text" name="txtImage" id="fieldID" class="form-control" value="'.$result['image'].'">';
		$html .= '<span class="input-group-addon" style="background-color: #3c7ac9; border-color: #295995;">';
		$html .= '<a class="iframe-btn" href="../filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=1" style="color: #fff;">';
		$html .= '<i class="fa fa-folder-open"></i> Browse...</a></span>';
		$html .= '<span class="input-group-addon" style="background-color: #c94d3c; border-color: #953629;">';
		$html .= '<a onclick="delete_file_document(\'fieldID\')" href="javascript:void(0)" title="Xóa file có sẵn" style="color: #fff;">';
		$html .= '<i class="fa fa-trash"></i> </a> </span> </div> </div>';
		$html .= '<div class="clearfix"></div>';
		echo $html;
		break;

	default:
		header("Location:/quantri");
		break;
}
?>