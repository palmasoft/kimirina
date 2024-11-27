<?php

class panelControlador extends ControllerBase
{


function index()
{
    if(! empty($_POST['id']))
        $id = $_POST['id'];
    elseif(! empty($_GET['id']))
        $id = $_GET['id'];
    else $id = 'panel1';
    $datos['id']=$id;
    $this->view->show("panel.php",$datos);
}
}
?>