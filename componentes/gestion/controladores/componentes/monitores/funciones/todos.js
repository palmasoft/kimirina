/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




    function abrir_soportes(url, title) {
        var left = (screen.width / 2) - ( 600 / 2);
        var top = (screen.height / 2) - ( 400 / 2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=600, height=400, top=' + top + ', left=' + left);
    }
    
    