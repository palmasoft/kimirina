<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-magnet themed-color"></i> Dynamic Tables<br><small>Full DataTables Integration!</small></h1>
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
            <a href="#">Tables</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Dynamic</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Dynamic Tables Section -->
    <div class="block-section">
        <table id="example-datatables" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="span1 text-center hidden-phone">#</th>
                    <th><i class="icon-user"></i> Username</th>
                    <th class="hidden-phone hidden-tablet"><i class="icon-envelope-alt"></i> Email</th>
                    <th class="span2 hidden-phone">Status</th>
                    <th class="span1 text-center"><i class="icon-bolt"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $labels['0']['class'] = "";
                $labels['0']['text'] = "Inactive";
                $labels['1']['class'] = "label-success";
                $labels['1']['text'] = "Approved!";
                $labels['2']['class'] = "label-important";
                $labels['2']['text'] = "Unapproved";
                $labels['3']['class'] = "label-warning";
                $labels['3']['text'] = "Pending..";
                $labels['4']['class'] = "label-info";
                $labels['4']['text'] = "Manual Approval";
                $labels['5']['class'] = "label-inverse";
                $labels['5']['text'] = "Spam Account";
                ?>
                <?php for($i=1; $i<31; $i++) { ?>
                <tr>
                    <td class="span1 text-center hidden-phone"><?php echo $i; ?></td>
                    <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                    <td class="hidden-phone hidden-tablet">user<?php echo $i; ?>@example.com</td>
                    <?php $rand = rand(0, 5); ?>
                    <td class="span2 hidden-phone"><span class="label<?php echo ($labels[$rand]['class']) ? " " . $labels[$rand]['class'] : ""; ?>"><?php echo $labels[$rand]['text'] ?></span></td>
                    <td class="span1 text-center">
                        <div class="btn-group">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END Dynamic Tables Section -->

    <!-- Dynamic Tables in the Grid -->
    <h4 class="page-header">Dynamic Tables <small>In the grid</small></h4>

    <!-- Dynamic Tables in the Grid Content -->

    <!-- div.row-fluid -->
    <div class="row-fluid row-items">
        <!-- Datatables Example 1 -->
        <div class="span6">
            <table id="example-datatables2" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="span1 text-center">#</th>
                        <th><i class="icon-user"></i> Username</th>
                        <th class="span3 hidden-phone">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $labels['0']['class'] = "";
                    $labels['0']['text'] = "Inactive";
                    $labels['1']['class'] = "label-success";
                    $labels['1']['text'] = "Approved!";
                    $labels['2']['class'] = "label-important";
                    $labels['2']['text'] = "Unapproved";
                    $labels['3']['class'] = "label-warning";
                    $labels['3']['text'] = "Pending..";
                    $labels['4']['class'] = "label-info";
                    $labels['4']['text'] = "Manual Approval";
                    $labels['5']['class'] = "label-inverse";
                    $labels['5']['text'] = "Spam Account";
                    ?>
                    <?php for($i=1; $i<21; $i++) { ?>
                    <tr>
                        <td class="span1 text-center"><?php echo $i; ?></td>
                        <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                        <?php $rand = rand(0, 5); ?>
                        <td class="span3 hidden-phone"><span class="label<?php echo ($labels[$rand]['class']) ? " " . $labels[$rand]['class'] : ""; ?>"><?php echo $labels[$rand]['text'] ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- END Datatables Example 1 -->

        <!-- Datatables Example 2 -->
        <div class="span6">
            <table id="example-datatables3" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="span1 text-center">#</th>
                        <th><i class="icon-user"></i> Username</th>
                        <th class="span3 hidden-phone">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $labels['0']['class'] = "";
                    $labels['0']['text'] = "Inactive";
                    $labels['1']['class'] = "label-success";
                    $labels['1']['text'] = "Approved!";
                    $labels['2']['class'] = "label-important";
                    $labels['2']['text'] = "Unapproved";
                    $labels['3']['class'] = "label-warning";
                    $labels['3']['text'] = "Pending..";
                    $labels['4']['class'] = "label-info";
                    $labels['4']['text'] = "Manual Approval";
                    $labels['5']['class'] = "label-inverse";
                    $labels['5']['text'] = "Spam Account";
                    ?>
                    <?php for($i=1; $i<21; $i++) { ?>
                    <tr>
                        <td class="span1 text-center"><?php echo $i; ?></td>
                        <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                        <?php $rand = rand(0, 5); ?>
                        <td class="span3 hidden-phone"><span class="label<?php echo ($labels[$rand]['class']) ? " " . $labels[$rand]['class'] : ""; ?>"><?php echo $labels[$rand]['text'] ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- END Datatables Example 1 -->
    </div>
    <!-- END div.row-fluid -->
    <!-- END Dynamic Tables in the Grid -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        /* Initialize Datatables */
        $('#example-datatables').dataTable({ "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 4 ] } ] });
        $('#example-datatables2').dataTable();
        $('#example-datatables3').dataTable();
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>