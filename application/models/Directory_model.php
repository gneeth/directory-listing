<?php
class Directory_Model extends CI_Model {

	public function GetData($tableName,$options1=array(),$options=array())
	{
		if(isset($options))
		{
			$this->db->where($options,$options);
		}
		if(isset($options1['like']) && isset($options1['or_like']))
		{
			$this->db->group_start();
			$this->db->like( $options1['like'],$options1['value'],'both');
			$this->db->or_like( $options1['or_like'],$options1['or_value'],'both');
			$this->db->group_end();
		}
		if(isset($options1['wherein']) && isset($options1['whereinvalue']))
		{
			$this->db->where_in($options1['wherein'],$options1['whereinvalue']);
			
		}		
		if(isset($options1['limit']) && isset($options1['offset']))
		{
			$this->db->limit($options1['limit'],$options1['offset']);
		}
		else if(isset($options1['limit']))
		{
			$this->db->limit($options1['limit']);
		}
		if(isset($options1['sortBy'])&& isset($options1['sortDirection']))
		{
			$this->db->order_by($options1['sortBy'],$options1['sortDirection']);
		}
		else
		{
			$this->db->order_by($options1['sortBy'],'desc');
		}
		$query=$this->db->get($tableName);
	
		return $query->result();

	}

	public function AddData($tableName,$options=array())
	{
		if(isset($options))
		{
			$this->db->set($options,$options);
		}
		$this->db->insert($tableName);
		return $this->db->insert_id();
	}


	public function UpdateData($tableName,$options1=array(),$options=array())
	{
		if(isset($options))
		{
			$this->db->set($options,$options);
		}
		$this->db->where($options1,$options1);
			
		$this->db->update($tableName);
		return $this->db->affected_rows();
	}
}