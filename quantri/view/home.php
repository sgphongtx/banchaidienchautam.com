<div class="content bg-image overflow-hidden" style="background-image: url('images/photo3@2x.jpg');">
    <div class="push-50-t push-15">
        <h1 class="h2 text-white animated zoomIn">Dashboard</h1>
        <h2 class="h5 text-white-op animated zoomIn">Welcome Administrator</h2>
    </div>
</div>
<div class="content bg-white border-b">
    <div class="row items-push text-uppercase">
        <?php require_once PATH_TEMPLATES . 'dashboard/quick_tools.php'; ?>
    </div>
</div>
<div class="content">    
    <?php require_once PATH_TEMPLATES . 'dashboard/orders.php'; ?>
    <div class="row">
        <?php  
            $seo=getRecord("tbl_seo", "idshop=".$idshop);
            if($seo['googleverify']!="") require_once PATH_TEMPLATES . 'dashboard/chart.php'; 
        ?>
    </div>
</div>