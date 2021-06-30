<?php 
/* 
 * File:   QBClassVariable.php
 * Author: Aldian Eka Putra
 *
 * Created on October 1, 2013, 15:21 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class QBClassVariable{
	function get_variable($index_param,$object_param=''){
		$qbvar['limit'] = 20;
		$qbvar['tbl'] =$object_param;
		$qbvar['vw']=$object_param;
		$qbvar['tbl_fields']=$object_param;
		$qbvar['tbl_extraparams_date'] = $object_param;
		$qbvar['json_root']='data';
		$qbvar['col_searched']=$object_param;
		$qbvar['col_id']='id';
		$qbvar['fld_count']=6;
		$qbvar['order_type']=$object_param;
		return $qbvar[$index_param];
	}	
}
