<?php 	
	$id=$idshop;
	$sql="SELECT * FROM tbl_shop WHERE id='{$id}'";
	$gt=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($gt);
    $content = $row['css'];
?>
<!--****************************************************************************
*   specific stylesheets
*-->
<link rel="stylesheet" href="/public/templates/quantri/plugins/codemirror/lib/codemirror.css" />
<link rel="stylesheet" href="/public/templates/quantri/plugins/codemirror/addon/hint/show-hint.css" />
<link rel="stylesheet" href="/public/templates/quantri/plugins/codemirror/addon/dialog/dialog.css" />
<link rel="stylesheet" href="/public/templates/quantri/plugins/codemirror/addon/search/matchesonscrollbar.css" />
<!--****************************************************************************
*   CodeMirror Theme Styles
*-->
<link rel="stylesheet" href="/public/templates/quantri/plugins/codemirror/themes/darkpastel.css" />
<!--****************************************************************************
*   specific scripts
*-->
<script src="/public/templates/quantri/plugins/codemirror/lib/codemirror.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/css.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/addon/hint/show-hint.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/addon/hint/css-hint.js"></script>
<!--**** search ****-->
<script src="/public/templates/quantri/plugins/codemirror/addon/dialog/dialog.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/addon/search/searchcursor.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/addon/search/search.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/addon/scroll/annotatescrollbar.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/addon/search/matchesonscrollbar.js"></script>
<!--**** closebrackets ****-->
<script src="/public/templates/quantri/plugins/codemirror/addon/edit/closebrackets.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/addon/edit/matchbrackets.js"></script>
<script src="/public/templates/quantri/plugins/codemirror/selection/active-line.js"></script>
<div class="content" id="styleweb" style="min-height: 530px;">
    <form action="" method="post" enctype="multipart/form-data" name=formdk class="form-horizontal">
        <div class="col-lg-12">
            <div class="form-group">
                <h5>Cấu hình CSS website</h5>
            </div>
            <div class="form-group">
                <textarea name="css" class="form-control" id="code" rows="20"><?=$content;?></textarea>
                <script>
                    var sc = '<div class="alert alert-success alert-dismissible fade in" role="alert" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Lưu thành công !</strong></div>';
                    var wn = '<div class="alert alert-warning alert-dismissible fade in" role="alert" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Lưu thất bại !</strong></div>';
                    var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
                        mode: 'css',
                        theme: 'darkpastel',
                        extraKeys: {
                            "Ctrl-Space": "autocomplete",
                            "Ctrl-F": "findPersistent"
                        },
                        tabSize: 2,
                        lineNumbers: true,
                        lineWrapping: true,
                        styleActiveLine: true,
                        styleSelectedText: true,
                        matchBrackets: true,
                        autoCloseBrackets: true,
                    });

                    function save_(content){
                        $.ajax({
                            url: 'ajax/ajax.php',
                            type: 'POST',
                            data: {'cmd': 'SAVE_CSS', 'css': content, 'id': <?php echo $id ?>},
                        })
                        .done(function(dt){
                            console.log(dt);
                            if (dt==true) {
                                $('.content').append(sc);
                                $('.alert').alert();
                                window.setTimeout(function() { $(".alert").alert('close'); }, 1500);
                                return false;
                            }
                            $('.content').append(wn);
                            $('.alert').alert();
                            window.setTimeout(function() { $(".alert").alert('close'); }, 1500);
                        })
                    }

                    $(document).ready(function() {
                       $('#ok').click(function(event) {
                            var content = editor.getValue();
                            save_(content);
                        });

                        $(document).keydown(function(e) {
                            if ((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
                            {
                                e.preventDefault();
                                $('#ok').trigger('click');
                                return false;
                            }
                            return true;
                        });  
                    });
                </script>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-4 btn-gr">
                    <button type="button" name="them" class="btn btn-default" id="ok">Chấp nhận</button>
                    <button type="button" name="goback" class="btn btn-default" onclick="goBack()">Quay lại</button>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </form>
</div>
<style type="text/css" media="screen">
#styleweb .alert.alert-success {position:fixed;top:40%;left:50%;z-index:10;}
</style>