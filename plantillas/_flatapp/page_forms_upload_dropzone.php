<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-cloud-upload themed-color"></i> File Upload &amp; Dropzone<br><small>Upload files with style!</small></h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Forms</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">File Upload &amp; Dropzone</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Default File Upload Block -->
    <div class="block block-themed">
        <!-- Default File Upload Title -->
        <div class="block-title">
            <h4>Default File Upload</h4>
        </div>
        <!-- END Default File Upload Title -->

        <!-- Default File Upload Content -->
        <div class="block-content">
            <form action="page_forms_upload_dropzone.php" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">
                <h4 class="sub-header">Single file</h4>
                <div class="control-group">
                    <label class="control-label" for="file">Select a file</label>
                    <div class="controls">
                        <input type="file" id="file" name="file">
                    </div>
                </div>
                <h4 class="sub-header">Multiple files</h4>
                <div class="control-group">
                    <label class="control-label" for="file2">Select multiple files</label>
                    <div class="controls">
                        <input type="file" id="file2" name="file2" multiple>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="icon-cloud-upload"></i> Upload</button>
                </div>
            </form>
        </div>
        <!-- END Default File Upload Content -->
    </div>
    <!-- END Default File Upload Block -->

    <!-- Dropzone Block -->
    <div class="block block-themed block-last">
        <!-- Dropzone Title -->
        <div class="block-title">
            <h4>Dropzone - Advanced File Upload <small>Just add <code>.dropzone</code> class to a form! On unsupported browsers it will fall back to default! Handle the uploads as usual!</small></h4>
        </div>
        <!-- END Dropzone Title -->

        <!-- Dropzone Content -->
        <div class="block-content">
            <form action="page_forms_upload_dropzone.php" class="dropzone">
                <div class="fallback">
                    <input type="file" id="file3" name="file3" multiple>
                </div>
            </form>
        </div>
        <!-- END Dropzone Content -->
    </div>
    <!-- END Dropzone Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>