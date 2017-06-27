<?php
class MY_Model extends CI_Model {

	var $table_name="";
	var $row_data= NULL;

	function  __construct(){
		parent::__construct();
	}

	function get( $select = NULL, $filter = array(), $order_by=NULL, $limit = NULL, $offset = NULL, $type = 'object' ){
		if( !empty($select) && is_array( $select )){
			$this->db->select( implode(", ", $select) );
		}

		if( $order_by != NULL ){
			foreach( $order_by as $key => $option )
				$this->db->order_by( $key, $option );
		}

		if( is_array( $filter ) AND count( $filter ) >0 ) {
			$query = $this->db->get_where( $this->table_name, $filter, $limit, $offset );
		} else {
			$query = $this->db->get( $this->table_name, $limit, $offset );
		}

		return( $query->result( $type ) );
	}

	function search( $select = NULL, $filter = array(), $order_by=NULL, $limit = NULL, $offset = NULL, $type = 'object', $joins = array(), $where_default = array(), $group_by = array() ){

		if( !empty($select) && is_array( $select )){
			$this->db->select( implode(", ", $select) );
		}

		if( $order_by != NULL ){
			foreach( $order_by as $key => $option ){
				$this->db->order_by( $key, $option );
			}
		}

		if( is_array( $filter ) AND count( $filter ) > 0 ) {
			$this->db->group_start();
			foreach ($filter as $key => $value) {
				$method = $value['method'];
				$match = $value['match'];
				if(is_callable(array($this->db, $method))){
					if(!is_null($match) || is_numeric($match)){
						$this->db->{$method}($key, $match);
					}else{
						$this->db->{$method}($key);
					}
				}
			}
			$this->db->group_end();
		}

		if( is_array( $where_default ) AND count( $where_default ) > 0 ) {
			if( is_array( $filter ) AND count( $filter ) > 0 ) {
				$this->db->group_start();
			}
			foreach ($where_default as $key => $value) {
				$method = $value['method'];
				$match = $value['match'];
				if(is_callable(array($this->db, $method))){
					if(!is_null($match) || is_numeric($match)){
						$this->db->{$method}($key, $match);
					}else{
						$this->db->{$method}($key);
					}
				}
			}
			if( is_array( $filter ) AND count( $filter ) > 0 ) {
				$this->db->group_end();
			}
		}

		if( is_array( $group_by ) AND count( $group_by ) > 0 ) {
			$this->db->group_by($group_by);
		}

		if( is_array( $joins ) AND count( $joins ) > 0 ) {
			foreach ($joins as $join) {
				if(!empty($join['table']) && !empty($join['cond'])){
					$this->db->join($join['table'],$join['cond'],$join['type'],$join['escape']);
				}
			}
		}


		$query = $this->db->get( $this->table_name, $limit, $offset );

		return( $query->result( $type ) );
	}

	function searchCount( $filter = array(), $joins = array(), $where_default = array(), $group_by = array() ){

		if( is_array( $filter ) AND count( $filter ) > 0 ) {
			foreach ($filter as $key => $value) {
				$method = $value['method'];
				$match = $value['match'];
				if(!is_null($match) || is_numeric($match)){
					$this->db->{$method}($key, $match);
				}else{
					$this->db->{$method}($key);
				}
			}
		}

		if( is_array( $where_default ) AND count( $where_default ) > 0 ) {
			if( is_array( $filter ) AND count( $filter ) > 0 ) {
				$this->db->group_start();
			}
			foreach ($where_default as $key => $value) {
				$method = $value['method'];
				$match = $value['match'];
				if(is_callable(array($this->db, $method))){
					if(!is_null($match) || is_numeric($match)){
						$this->db->{$method}($key, $match);
					}else{
						$this->db->{$method}($key);
					}
				}
			}
			if( is_array( $filter ) AND count( $filter ) > 0 ) {
				$this->db->group_end();
			}
		}

		if( is_array( $joins ) AND count( $joins ) > 0 ) {
			foreach ($joins as $join) {
				if(!empty($join['table']) && !empty($join['cond'])){
					$this->db->join($join['table'],$join['cond'],$join['type'],$join['escape']);
				}
			}
		}

		if( is_array( $group_by ) AND count( $group_by ) > 0 ) {
			$this->db->group_by($group_by);
			$query = $this->db->get( $this->table_name );
			return $query->num_rows();
		}else{
			$this->db->from( $this->table_name );
			return $this->db->count_all_results();
		}
	}

	function get_index( $select = NULL, $where = array(), $order_by = array() ){
		//define page
		$page = 1;
		if( $this->input->get( 'page' ) != "" ){
			$page = abs( $this->input->get( 'page' ) );
		}

		$limit = $this->config->item( 'default_pagination_size' );

		$offset = ( $page - 1 ) * $limit;

		//define search
		if( $this->input->get( "q" ) != "" ){
			$where[ $this->input->get( "search" ) ] = $this->input->get( "q" );
		}

		//Get the query
		$controller = $this->uri->segment(1);
		$method = $this->uri->segment(2);
		if( strlen( $method ) ==0 ){
			$method = "index";
		}

		$temp_get = array();
		if( $this->input->get()!=NULL ){
			foreach( $this->input->get() as $key=>$val ){
				$temp_get[$key] = $val;
			}
			unset( $temp_get['page'] );
		}

		$get = "";
		foreach ( $temp_get as $key => $val ){
			$get .= $key . "=" . $val . "&";
		}

		$base_url = base_url( $controller . "/" . $method . "?" . $get );

		//Query Result
		$data['result'] = $this->get( $select, $where, $order_by, $limit, $offset );
		//Pagination
		$pagination = array();

		$constant_page_display = 5;

		$total_rows = $this->countAll( $where );

		$total_page = $this->round_up( $total_rows / $limit, 0 );
		$mid_page = $this->round_up( $constant_page_display / 2, 0 );
		$first_page = 1;

		if( $page > $total_page ){
			return;
		}

		if( $page < $mid_page + 1 ){
			$first_page = 1;
		}else{
			$first_page = $page - ( $mid_page - 1 );
		}
		$pagination['very_first']['label'] = 1;
		$pagination['very_first']['href'] = $base_url . "page=1";

		if( $page == 1 ){
			$pagination['previous']['label'] = 1;
			$pagination['previous']['href'] = $base_url . "page=1";
		}else{
			$pagination['previous']['label'] = $page - 1;
			$pagination['previous']['href'] = $base_url . "page=1" . ( $page-1 );
		}

		for( $i = 0; $i < $constant_page_display; $i++ ){
			if( ( $first_page + $i ) <= $total_page ){
				$pagination['page'][$i]['label'] = $first_page + $i;
				$pagination['page'][$i]['href'] = $base_url . "page=" . ( $first_page + $i );
			}else{
				break;
			}
		}

		if( $page < $total_page ){
			$pagination['next']['label'] = $page + 1;
			$pagination['next']['href'] = $base_url . "page=" . ( $page + 1 );
		}else{
			$pagination['next']['label'] = $page;
			$pagination['next']['href'] = $base_url."page=".$page;
		}

		$pagination['very_last']['label'] = $total_page;
		$pagination['very_last']['href'] = $base_url."page=".$total_page;

		$data['pagination'] = $pagination;

		return $data;
	}

	private function round_up( $number, $precision = 2 ){
		$fig = (int) str_pad( '1', $precision, '0' );
		return ( ceil( $number * $fig ) / $fig );
	}

	function result_to_array( $result, $to_lower_case = FALSE ){
		if( $to_lower_case ){
			$temp = array();
			if( is_array( $result ) ){
				foreach( $result as $r ){
					$temp[] = array_change_key_case( json_decode( json_encode( $r ), TRUE ), CASE_LOWER );
				}
			}else{
				$temp = array_change_key_case( json_decode( json_encode( $r ), TRUE ), CASE_LOWER );
			}
			return $temp;
		}else{
			return json_decode( json_encode( $result ), TRUE );
		}
	}

	function get_where_in( $key, $value_array ){
		$this->db->where_in( $key, $value_array );
		$query = $this->db->get( $this->table_name );
		return( $query->result() );
	}

	function get_table_field(){
		return $this->db->list_fields( $this->table_name );
	}

	/**
	 * Get Data user by key and value
	 * @param  string $key
	 * @param  string $value
	 * @return object
	 */
	public function get_by( $key, $value ){
		$this->db->where( $key, $value );
		return $this->db->get( $this->table_name )->row();
	}

	function countAll( $data = array() ){
		foreach ($data as $key => $value) {
			if(is_array($value)){
				$this->db->where_in( $key, $value );
			}else{
				$this->db->where( $key, $value );
			}
		}

		$this->db->from( $this->table_name );
		$count = $this->db->count_all_results();
		return $count;
	}

	function sumAll( $select, $data = array() ){
		foreach ($data as $key => $value) {
			if(is_array($value)){
				$this->db->where_in( $key, $value );
			}else{
				$this->db->where( $key, $value );
			}
		}
		$this->db->from( $this->table_name );
		$sum = $this->db->select_sum($select);
		return $sum;
	}


	function insert( $data, $return_id = TRUE ){
		if( $this->db->insert( $this->table_name, $data ) ){
			if( $return_id ){
				return $this->db->insert_id();
			}else{
				return true;
			}
		}else{
			return false;
		}
	}//end of insert

	function insert_batch( $data ){
		return $this->db->insert_batch( $this->table_name, $data );
	}//end of insert_batch


	function update( $data, $where = NULL ){
		if( $where != NULL ){
			return $this->db->update( $this->table_name, $data, $where );
		}else{
			return $this->db->update( $this->table_name, $data );
		}
	}

	function update_using_array( $data, $where ){
		return $this->db->update( $this->table_name, $data, $where );
	}

	function delete( $criteria ){
		return $this->db->delete( $this->table_name, $criteria );
	}//end of delete

	/**
	 * Get the last query to do debugging
	 *
	 * @access public
	 * @author Ivan Kristianto (ivan@ivankristianto.com)
	 * @return string
	 */
	public function last_query( $which = 'master' ) {
		if( $which == 'master'){
			return $this->db->last_query();
		}else{
			return $this->db->last_query();
		}
	}
}
