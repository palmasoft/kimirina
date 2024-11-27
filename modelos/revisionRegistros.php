<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RevisionRegistros
 *
 * @author Software
 */
class RevisionRegistros {

    static public function cambiar_registros_a_revision() {

        $formularios = array();
        $totalContactos = RegistroSemanalModel::todos_pendientes_numero();
        $pHsh = intval($totalContactos * (0.05) * (0.6));
        $tmp = RegistroSemanalModel::cinco_porciento_pendientes_HSH(($pHsh == 0) ? 1 : $pHsh );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pTs = intval($totalContactos * 0.05 * 0.2);
        $tmp = RegistroSemanalModel::cinco_porciento_pendientes_TS(($pTs == 0) ? 1 : $pTs );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pTrans = intval($totalContactos * 0.05 * 0.2);
        $tmp = RegistroSemanalModel::cinco_porciento_pendientes_TRANS(($pTrans == 0) ? 1 : $pTrans );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pendientesContactos = $formularios;



        /*
         * para animadores
         */
        $formularios = array();
        $totalAnimadores = ReciboContactoAnimadorModel::todos_pendientes_numero();
        $pHsh = intval($totalAnimadores * 0.05 * 0.6);
        $tmp = ReciboContactoAnimadorModel::cinco_porciento_pendientes_HSH(($pHsh == 0) ? 1 : $pHsh );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pTs = intval($totalAnimadores * 0.05 * 0.2);
        $tmp = ReciboContactoAnimadorModel::cinco_porciento_pendientes_TS(($pTs == 0) ? 1 : $pTs );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pTrans = intval($totalAnimadores * 0.05 * 0.2);
        $tmp = ReciboContactoAnimadorModel::cinco_porciento_pendientes_TRANS(($pTrans == 0) ? 1 : $pTrans );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pPvvs = intval($totalAnimadores * 0.05 * 0.2);
        $tmp = ReciboContactoAnimadorModel::cinco_porciento_pendientes_PVVS(($pPvvs == 0) ? 1 : $pPvvs );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pendientesAnimadores = $formularios;


        /*
         * para Consejeros
         */
        $formularios = array();
        $totalConsejerias = ConsejeriaPvvsModel::todos_pendientes_numero();
        $pHsh = intval($totalConsejerias * 0.05 * 0.6);
        $tmp = ConsejeriaPvvsModel::cinco_porciento_pendientes_HSH(($pHsh == 0) ? 1 : $pHsh );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pTs = intval($totalConsejerias * 0.05 * 0.2);
        $tmp = ConsejeriaPvvsModel::cinco_porciento_pendientes_TS(($pTs == 0) ? 1 : $pTs );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pTrans = intval($totalConsejerias * 0.05 * 0.2);
        $tmp = ConsejeriaPvvsModel::cinco_porciento_pendientes_TRANS(($pTrans == 0) ? 1 : $pTrans );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pPvvs = intval($totalConsejerias * 0.05);
        $tmp = ConsejeriaPvvsModel::cinco_porciento_pendientes_PVVS(($pPvvs == 0) ? 1 : $pPvvs );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pendientesConsejerias = $formularios;





        /*
         * para Atencion en Salud
         */
        $formularios = array();
        $totalAtencionSalud = count(registroAtencionSaludModel::todos_pendientes());
        $pHsh = intval($totalAtencionSalud * 0.05 * 0.6);
        $tmp = registroAtencionSaludModel::cinco_porciento_pendientes_HSH(($pHsh == 0) ? 1 : $pHsh );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pTs = intval($totalAtencionSalud * 0.05 * 0.2);
        $tmp = registroAtencionSaludModel::cinco_porciento_pendientes_TS(($pTs == 0) ? 1 : $pTs );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pTrans = intval($totalAtencionSalud * 0.05 * 0.2);
        $tmp = registroAtencionSaludModel::cinco_porciento_pendientes_TRANS(($pTrans == 0) ? 1 : $pTrans );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pPvvs = intval($totalAtencionSalud * 0.05);
        $tmp = registroAtencionSaludModel::cinco_porciento_pendientes_PVVS(($pPvvs == 0) ? 1 : $pPvvs );
        if (!empty($tmp)) {
            $formularios = array_merge($formularios, $tmp);
        }
        $pendientesAtencionSalud = $formularios;



        if ($pendientesAnimadores) { //si hay formularios pendientes, se ponen en revisión
            foreach ($pendientesAnimadores as $indice => $value) {
                $pendientesAnimadores[$indice]->ID_CONTACTOANIMADOR = ReciboContactoAnimadorModel::update_estado_revision($value->ID_CONTACTOANIMADOR, "EN REVISION");
            }
        }
        if ($pendientesConsejerias) { //si hay formularios pendientes, se ponen en revisión
            foreach ($pendientesConsejerias as $indice => $value) {
                $pendientesConsejerias[$indice]->ID_CONSEJERIA_PVVS = ConsejeriaPvvsModel::update_estado_revision($value->ID_CONSEJERIA_PVVS, "EN REVISION");
            }
        }
        if ($pendientesContactos) { //si hay formularios pendientes, se ponen en revisión
            foreach ($pendientesContactos as $indice => $value) {
                $pendientesContactos[$indice]->ID_REGISTROSEMANAL = RegistroSemanalModel::update_estado_revision($value->ID_REGISTROSEMANAL, "EN REVISION");
            }
        }
        if ($pendientesAtencionSalud) { //si hay formularios pendientes, se ponen en revisión
            foreach ($pendientesAtencionSalud as $indice => $value) {
                $pendientesContactos[$indice]->ID_ATENCION_SALUD = registroAtencionSaludModel::update_estado_revision($value->ID_ATENCION_SALUD);
            }
        }
    }

}
