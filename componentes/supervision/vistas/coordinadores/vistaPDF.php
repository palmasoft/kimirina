
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i>Informe PDF<br>
        <small>Informe PDF</small></h1>
</div>
<!-- END Pre Page Content -->
<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Coordinadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Vista PDF</a></li>
    </ul>

<?php if(isset($RUTA)){
                ?>
<div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title=" Vista PDF"><i class="icon-arrow-up"></i></a>  Vista PDF<small></small></h4>
        </div>
        <div class="block-content text-center" style="padding: 0px;">    
            
            <iframe style="width: 100%; height: 100%" src="<?php echo $RUTA ?>">  </iframe>

               
        </div>
    </div>

<?php
               } ?>
</div>
