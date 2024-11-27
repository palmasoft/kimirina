<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-edit themed-color"></i> Editable Tables<br><small>Flexible, easy to set up and responsive!</small></h1>
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
        <li class="active"><a href="">Editable</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Features -->
    <div class="block-section">
        <h4 class="sub-header">Features</h4>
        <ul class="icons-ul list">
            <li><i class="icon-li icon-ok text-success"></i> Just click a cell to edit its data</li>
            <li><i class="icon-li icon-ok text-success"></i> Make editable only the cells you want by adding the <code>.editable-td</code> class</li>
            <li><i class="icon-li icon-ok text-success"></i> Add new editable rows to the table</li>
            <li><i class="icon-li icon-ok text-success"></i> Delete any row you want</li>
            <li><i class="icon-li icon-ok text-success"></i> Still responsive! Hide any cell on mobiles or tablets without affecting the functionality</li>
            <li><i class="icon-li icon-arrow-right text-black"></i> Easily set up your rows</li>
            <li><i class="icon-li icon-arrow-right text-black"></i> The data is ready to be sent and handled in your backend when
                <ul class="icons-ul list">
                    <li><i class="icon-li icon-ok text-success"></i> Deleting a row</li>
                    <li><i class="icon-li icon-ok text-success"></i> Adding a new row</li>
                    <li><i class="icon-li icon-ok text-success"></i> Editing a cell</li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- END Features -->

    <!-- Table Options -->
    <div class="clearfix">
        <div class="btn-group pull-right">
            <button class="btn" data-toggle="tooltip" title="Table Settings"><i class="icon-cog"></i></button>
            <button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-angle-down"></i></button>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0)"><i class="icon-print"></i> Print</a></li>
                <li><a href="javascript:void(0)"><i class="icon-file-alt"></i> Save as PDF</a></li>
                <li class="divider"></li>
                <li><a href="javascript:void(0)"><i class="icon-external-link"></i> Export</a></li>
            </ul>
        </div>
        <button id="addRow" class="btn btn-success"><i class="icon-plus"></i> Add New Product</button>
    </div>
    <!-- END Table Options -->

    <!-- Table -->
    <table id="example-editable-datatables" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="span1 text-center">#</th>
                <th><i class="icon-tag"></i> Product Name</th>
                <th class="hidden-phone">Quantity</th>
                <th class="hidden-phone">Year</th>
                <th class="span1"></th>
            </tr>
        </thead>
        <tbody>
            <!-- Add ids to tr and td, so that you can use them to handle the data in your backend -->
            <!-- Make sure to add the .editable-td class to the inputs you would like to be editable! -->
            <!-- Also make sure to set up the cells you add here in the addHandle() function accordingly -->
            <?php for($i=1; $i<21; $i++) { ?>
            <tr id="<?php echo $i; ?>">
                <td id="id<?php echo $i; ?>" class="span1 text-center"><?php echo $i; ?></td>
                <td id="product<?php echo $i; ?>" class="editable-td">Product<?php echo $i; ?></td>
                <td id="quantity<?php echo $i; ?>" class="editable-td hidden-phone"><?php echo $i + rand(0, 100); ?></td>
                <td id="year<?php echo $i; ?>" class="editable-td hidden-phone"><?php echo rand(2010, 2013); ?></td>
                <td class="span1 text-center">
                    <a href="javascript:void(0)" id="delRow<?php echo $i; ?>" class="btn btn-mini btn-danger delRow"><i class="icon-remove"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- END Table -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        // Hold our table to a variable
        var exampleDatatable = $('#example-editable-datatables');

        /*
         * Function for handing the data after a cell has been edited
         *
         * From here you can send the data with ajax (for example) to handle in your backend
         *
         */
        var reqHandle = function(value, settings){

            // this, the edited td element
            console.log(this);

            // $(this).attr('id'), get the id of the edited td
            console.log($(this).attr('id'));

            // $(this).parent('tr').attr('id'), get the id of the row
            console.log($(this).parent('tr').attr('id'));

            // value, the new value the user submitted
            console.log(value);

            // settings, the settings of jEditable
            console.log(settings);

            // Here you can send and handle the data in your backend
            // ...

            // For this example, just return the data the user submitted
            return(value);
        };

        /*
         * Function for initializing jEditable handlers to the table
         *
         * For advance usage you can check http://www.appelsiini.net/projects/jeditable
         *
         */
        var initEditable = function(rowID){

            // Hold the elements that the jEditable with be initialized
            var elements;

            // If we don't have a rowID apply to all td elements with .editable-td class
            if (!rowID)
                elements = $('td.editable-td', editableTable.fnGetNodes());
            else
                elements = $('td.editable-td', editableTable.fnGetNodes(rowID));

            elements.editable(reqHandle, {
                "callback": function( sValue, y ) {
                    // Update the table cell after the edit has been processed
                    var aPos = editableTable.fnGetPosition(this);
                    editableTable.fnUpdate(sValue, aPos[0], aPos[1]);

                    // Little fix for responsive table after edit
                    exampleDatatable.css('width', '100%');
                },
                "submitdata": function ( value, settings ) {
                    // Sent some extra data
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": editableTable.fnGetPosition(this)[2]
                    };
                },
                indicator : '<i class="icon-spinner icon-spin"></i>',
                cssclass : 'remove-margin',
                submit: 'Ok',
                cancel: 'Cancel'
            });
        };

        /*
         * Function for deleting table row
         *
         */
        var delHandle = function(){

            // When the user clicks on a delete button
            $('body').on('click','a.delRow', function(){
                var aPos = editableTable.fnGetPosition(this.parentNode);
                var aData = editableTable.fnGetData(aPos[0]);
                var rowID = $(this).parents('tr').attr('id');

                // Here you can handle the deletion of the row in your backend
                // ...

                // Delete row if success with the backend
                editableTable.fnDeleteRow(aPos[0]);
            });
        };

        /*
         * Function for adding table row
         *
         */
        var addHandle = function(){

            // When the user clicks on the 'Add New User' button
            $("#addRow").click(function(){

                // Here you can handle your backend data (eg: adding a row to database and return the id of the row)

                // ..

                // Create a new row and set it up
                var rowID = editableTable.fnAddData(['', '', '', '', '']);

                // Example id, here you should add the one you created in your backend
                var id = rowID[0] + 1;

                // Update the id cell, so that our table redraw and resort (new row goes first in datatable)
                editableTable.fnUpdate(id, rowID[0], 0);

                // Get the new row
                var nRow = editableTable.fnGetNodes(rowID[0]);

                /*
                 * In the following section you should set up your cells
                 */
                // Add id to tr element
                $(nRow).attr('id', id);

                // Setup first cell (id)
                $(nRow)
                    .children('td:nth-child(1)')
                    .attr('id', 'id' + id)
                    .addClass('span1')
                    .addClass('text-center');

                // Setup second cell (Product name)
                $(nRow)
                    .children('td:nth-child(2)')
                    .addClass('editable-td')
                    .attr('id', 'product' + id);

                // Setup third cell (Quantity)
                $(nRow)
                    .children('td:nth-child(3)')
                    .addClass('editable-td')
                    .addClass('hidden-phone')
                    .attr('id', 'quantity' + id);

                // Setup fourth cell (Year)
                $(nRow)
                    .children('td:nth-child(4)')
                    .addClass('editable-td')
                    .addClass('hidden-phone')
                    .attr('id', 'year' + id);

                // Setup fifth cell (delete button)
                $(nRow)
                    .children('td:nth-child(5)')
                    .addClass('text-center')
                    .html('<a href="javascript:void(0)" id="delRow' + id + '" class="btn btn-mini btn-danger delRow"><i class="icon-remove"></i></a>');

                // Setup your other cells the same way (if you have more)
                // ...

                // Initialize jEditable to the new row
                initEditable(rowID[0]);

                // Little fix for responsive table after adding a new row
                exampleDatatable.css('width', '100%');
            });
        };

        // Initialize Datatables
        var editableTable = exampleDatatable.dataTable({
            "aaSorting": [[ 0, 'desc' ]],
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [4]
            }]
        });

        // Initialize jEditable
	initEditable();

        // Handle rows deletion
        delHandle();

        // Handle new rows
        addHandle();
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>