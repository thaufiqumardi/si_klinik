<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_crud extends CI_Model {

	function _insert($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	function _update($table, $id, $where, $data)
	{
		$this->db->where($id, $where);
		return $this->db->update($table, $data);
	}

	function _delete($table, $id, $where)
	{
		$this->db->where($id, $where);
		$this->db->delete($table);
	}

	function check_table($table, $where, $name, $where2 = NULL, $name2 = NULL, $where3 = NULL, $name3 = NULL,
			$where4 = NULL, $name4 = NULL, $where5 = NULL, $name5 = NULL, $where6 = NULL, $name6 = NULL,
			$where7 = NULL, $name7 = NULL, $where8 = NULL, $name8 = NULL)
	{
		$this->db->from($table);
		$this->db->where($where, strtoupper($name));
		if (!is_null($name2)){
			$this->db->where($where2, strtoupper($name2));
		}
		if (!is_null($name3)){
			$this->db->where($where3, strtoupper($name3));
		}
		if (!is_null($name4)){
			$this->db->where($where4, strtoupper($name4));
		}
		if (!is_null($name5)){
			$this->db->where($where5, strtoupper($name5));
		}
		if (!is_null($name6)){
			$this->db->where($where6, strtoupper($name6));
		}
		if (!is_null($name7)){
			$this->db->where($where7, strtoupper($name7));
		}
		if (!is_null($name8)){
			$this->db->where($where8, strtoupper($name8));
		}

		$query = $this->db->get();
		return $query->row();
	}

	function _custom_query($mysql_query)
	{
		$query = $this->db->query($mysql_query);
		return $query;
	}

	function count_where($table, $column, $param)
	{
		$this->db->where($column, $param);
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function count_all($table)
	{
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function get_select_to_array($select, $from, $join1 = NULL, $where = NULL, $where1 = NULL, $param1 = NULL, $where2 = NULL, $param2 = NULL, $order = NULL)
	{
		$this->db->select($select);
		$this->db->from($from);
		if(!is_null($join1)){
			$this->db->join($join1, $where);
		}
		if(!is_null($where1)){
			$this->db->where($where1, $param1);
		}
		if(!is_null($where2)){
			$this->db->where($where2, $param2);
		}
		if (!is_null($order)){
			$this->db->order_by($order, 'asc');
		}

		$query = $this->db->get();
		return $query->result();
	}

	function get_select_no_join_to_array($select, $from, $where, $param)
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where, $param);

		$query = $this->db->get();
		return $query->result();
	}

	function get_by_id($table, $where1, $param1, $where2 = NULL, $param2 = NULL)
	{
		$this->db->from($table);
		$this->db->where($where1, $param1);
		if(!is_null($where2))
		{
			$this->db->where($where2, $param2);
		}

		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_param($table, $where1, $param1, $where2 = NULL, $param2 = NULL)
	{
		$this->db->from($table);
		$this->db->where($where1, $param1);
		if(!is_null($where2)){
			$this->db->where($where2, $param2);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function get_by_param_to_array($table, $where1, $param1, $where2 = NULL, $param2 = NULL)
	{
		$this->db->from($table);
		$this->db->where($where1, $param1);
		if(!is_null($where2)){
			$this->db->where($where2, $param2);
		}

		$query = $this->db->get();
		return $query->result();
	}
	function get_select_to_row($select, $from, $join1 = NULL, $where = NULL, $where1 = NULL, $param1 = NULL, $where2 = NULL, $param2 = NULL, $order = NULL)
	{
		$this->db->select($select);
		$this->db->from($from);
		if(!is_null($join1)){
			$this->db->join($join1, $where);
		}
		if(!is_null($where1)){
			$this->db->where($where1, $param1);
		}
		if(!is_null($where2)){
			$this->db->where($where2, $param2);
		}
		if (!is_null($order)){
			$this->db->order_by($order, 'asc');
		}
		$query = $this->db->get();
		return $query->row();
	}

}
