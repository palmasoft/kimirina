<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-text_underline themed-color"></i> Textareas &amp; WYSIWYG<br><small>Your elements for large text!</small></h1>
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
        <li class="active"><a href="">Textareas &amp; WYSIWYG</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Textareas Block -->
    <div class="block block-themed block-last">
        <!-- Textareas Title -->
        <div class="block-title">
            <h4>Textareas &amp; WYSIWYG <small>Just by adding a class to a textarea, you get extra functionality and options</small></h4>
        </div>
        <!-- END Textareas Title -->

        <!-- Textareas Content -->
        <div class="block-content">
            <form action="page_forms_textareas_wysiwyg.php" method="post" class="form-horizontal" onsubmit="return false;">
                <h4 class="sub-header">Simple</h4>
                <div class="control-group">
                    <label class="control-label" for="textarea-default">Default</label>
                    <div class="controls">
                        <textarea id="textarea-default" name="textarea-default" rows="4">...</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Disabled</label>
                    <div class="controls">
                        <textarea id="textarea-uneditable" name="textarea-uneditable" class="uneditable-textarea" rows="4" disabled>Disabled content!</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="textarea-medium">Medium</label>
                    <div class="controls">
                        <textarea id="textarea-medium" name="textarea-medium" class="textarea-medium" rows="6">...</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="textarea-large">Large</label>
                    <div class="controls">
                        <textarea id="textarea-large" name="textarea-large" class="textarea-large" rows="10">...</textarea>
                    </div>
                </div>
                <h4 class="sub-header">Advanced</h4>
                <div class="control-group">
                    <label class="control-label" for="textarea-editor">WYSIWYG Editor</label>
                    <div class="controls">
                        <textarea id="textarea-editor" name="textarea-editor" class="textarea-editor textarea-large" rows="10">...</textarea>
                        <span class="help-block">Just add the <code>.textarea-editor</code> class and the textarea will be transformed into a wysiwyg editor</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="textarea-elastic">Elastic</label>
                    <div class="controls">
                        <textarea id="textarea-elastic" name="textarea-elastic" class="textarea-elastic" rows="3">...</textarea>
                        <span class="help-block">Just add the <code>.textarea-elastic</code> class and the textarea will auto expand as you write</span>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-save"></i> Save</button>
                </div>
            </form>
        </div>
        <!-- END Textareas Content -->
    </div>
    <!-- END Textareas Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>