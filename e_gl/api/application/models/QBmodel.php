<?php 
/* 
 * File:   qbmodel.php
 * Author: Aldian Eka Putra
 *
 * Created on October 1, 2013, 09:21 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class QBmodel extends CI_Model {
	// private $tbl_person;
	private $tbl;
	private $vw;
	function __construct(){
		parent::__construct();
	}	
	// SAVE ROW TO DATABASE
	function save($tbl,$data){
		$this->db->insert($tbl, $data);
		return $this->db->insert_id();
	}
	// UPDATE ROW TO DATABASE
	function update($tbl,$col_name,$id,$data){
		$this->db->where($col_name, $id);
		$this->db->update($tbl, $data);
	}
	// DELETE ROW TO DATABASE
	function delete($tbl,$col_name,$id){
		$this->db->where($col_name, $id);
		$this->db->delete($tbl);
	}
	// PARAMETER SEARCH
	public function parameter_search_model($field_param){
		if(isset($_GET['query']) and $_GET['query']!=''){
			$this->db->like($field_param, $_GET['query']);
		}
	}
	// LIMIT DATA
	public function limit_data($limit, $start){
		$this->db->limit($limit, $start);
	}
	// SET SELECT TABLE
	public function set_select_table($table){
		$this->db->select($table.'.*');
        $this->db->from($table);
	}
	// ORDER BY DATA
	public function order_by_data($field_sort,$type_sort){
		$this->db->order_by($field_sort,$type_sort);
	}
	// REF TABLE
	function get_ref_table($vw=''){
		return $this->db->get($vw);
	}
	// GOT ROW COUNT TABLE
	public function row_data($table,$field_like,$params_where='',$params_where_not_in=''){
		if(!empty($params_where)){
			$this->get_data_by_id($params_where);
		}
		if(!empty($params_where_not_in)){
			$this->where_no_in($params_where_not_in['FIELD'],$params_where_not_in['VALUES']);
		}
		$this->parameter_search_model($field_like);
		$this->set_select_table($table);
		$query_row = $this->get_ref_table();
		$rows=$query_row->num_rows();
		return $rows;
	}
	// GET ONE BY ID
	public function get_data_by_id($params){
		$this->db->where($params);
	}
	// WHERE NOT IN
	public function where_no_in($field,$params){
		$this->db->where_not_in($field,$params);
	}
	// QUERY BLOCKS
	public function query_bloks($query){
		return $this->db->query($query);
	}
	// SAVE ROW BATCH TO DATABASE
	function save_batch($tbl,$data){
		return $this->db->insert_batch($tbl, $data);
	}
}

/* End of file qbmodel.php */
