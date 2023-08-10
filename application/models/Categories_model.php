<?php

Class Categories_Model extends CI_Model {

	// Insert registration data in database
	private $table='packing_materials';
	public function __construct() {
        parent::__construct();
        $this->flag = 0;
    }
	public function packing_material_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "name =" . "'" . $data['name'] . "'";

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert($this->table, $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	function insertStockRegister($data1){
            $this->db->insert('stock_registers', $data1);
			if ($this->db->affected_rows() > 0) {
			return true;
			}
			else { 
			return false;
			}                    
    }

	public function packing_material_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		if($this->db->update($this->table, $data))
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}
	public function packingmaterialsList($category_id=NULL) 
	{
		
		$this->db->select('packing_materials.*,grades.grade as grade,suppliers.supplier_name as supplier');
		$this->db->from($this->table);
		$this->db->join('grades','packing_materials.grade_id=grades.id','left');
		$this->db->join('suppliers','packing_materials.supplier_id=suppliers.id','left');
		$this->db->where(['packing_materials.flag'=>'0','packing_materials.categories_id'=>$category_id]);
		$this->db->order_by("packing_materials.name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}

	public function minimum_inventory_levels_list() 
	{
		
		$this->db->select('packing_materials.id as id,packing_materials.name as name,categories.category_name as category,packing_materials.minimum_inventory_qty as minimum_qty,packing_materials.unit_name as unit_name,grades.grade as grade,suppliers.supplier_name as supplier');
		$this->db->from($this->table);
		$this->db->join('grades','packing_materials.grade_id=grades.id','left');
		$this->db->join('suppliers','packing_materials.supplier_id=suppliers.id','left');
		//$this->db->join('unit','packing_materials.unit_id=unit.id','left');
		$this->db->join('categories','packing_materials.categories_id=categories.id','left');
		$this->db->where(['packing_materials.flag'=>'0','packing_materials.minimum_inventory_qty >'=>'0']);
		$this->db->order_by("packing_materials.name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}

function getPackingMaterialCode($category_id=NULL){
    $count=0;
    $this->db->select('*');
    $this->db->from('packing_materials');
     $this->db->where(['categories_id'=> $category_id]);
    $query=$this->db->get();
    //$query->num_rows();
    $count=$query->num_rows()+1;
    //print_r($count);exit;
    return $count;
   
	}
	
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
	public function pmList($category_id=NULL) 
	{
		
		$this->db->select('packing_materials.*');
		$this->db->from($this->table);
		//$this->db->join('grades','packing_materials.grade_id=grades.id','left');
		//$this->db->join('suppliers','packing_materials.supplier_id=suppliers.id','left');
		$this->db->where(['packing_materials.flag'=>'0','packing_materials.categories_id'=>$category_id]);
		$this->db->order_by("packing_materials.name", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function rawmaterialsList($category_id=NULL) 
	{
		
		$this->db->select('packing_materials.*,grades.grade as grade,suppliers.supplier_name as supplier');
		$this->db->from($this->table);
		$this->db->join('grades','packing_materials.grade_id=grades.id','left');
		$this->db->join('suppliers','packing_materials.supplier_id=suppliers.id','left');
		$this->db->where(['packing_materials.flag'=>'0','packing_materials.categories_id'=>$category_id]);
		$this->db->order_by("packing_materials.name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
   function getMasterCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where('flag','0')->get()->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
       /* $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['category_name']; 
        } 
        */
        return $result; 
    }	
	/* function getSupplierCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','category_type'=>'Supplier'])->get()->result_array(); 
        
        return $result; 
    }*/
	function getSuppliers($categories_id)
    { 
        //$result = $this->db->select('id, supplier_name,vendor_code')->get('suppliers')->result_array(); 
	$result = $this->db->select('id, supplier_name')->from('suppliers')->where(['flag'=>'0','categories_id'=>$categories_id])->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
        /*$suppliername = array(); 
        $suppliername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $suppliername[$r['id']] = $r['supplier_name'].'('.$r['vendor_code'].')'; 
        } */
        return $result; 
    }
	   public function getList($categories_id){
        $this->db->select('packing_materials.*,suppliers.supplier_name as supplier,categories.category_name as category');
        $this->db->from('packing_materials');
        $this->db->join('suppliers', 'packing_materials.supplier_id = suppliers.id', 'left'); 
        $this->db->join('categories', 'packing_materials.categories_id = categories.id', 'left'); 
        $this->db->where(['packing_materials.flag'=>'0','packing_materials.categories_id'=>$categories_id]);
        //$this->db->order_by("rm_codes.grade", "asc");
        $query = $this->db->get();
        //echo var_dump($query->result_array()); //troubleshooting somehting.
        return $query->result_array();

    }

		public function getProductsByCategory($id) { 
       $result = $this->db->select('id, name')->from('packing_materials')->where(['flag'=>'0','categories_id'=>$id])->get()->result_array(); 
        
        return $result; 
    }
		public function export_csv($categories_id)
		{
			$this->db->select('packing_materials.*,suppliers.supplier_name as supplier,categories.category_name as category,grades.grade as grade');
			$this->db->from('packing_materials');
			$this->db->join('suppliers', 'packing_materials.supplier_id = suppliers.id', 'left'); 
			$this->db->join('categories', 'packing_materials.categories_id = categories.id', 'left');
			$this->db->join('grades', 'packing_materials.grade_id = grades.id', 'left');
			$this->db->where(['packing_materials.flag'=>'0','packing_materials.categories_id'=>$categories_id]);
			$this->db->order_by("packing_materials.name", "asc");
			$query =  $this->db->get()->result_array();
	
			return $query;
		
		}	
		function getUnits() { 
	        $result = $this->db->select('id,unit_name')->from('unit')->where('flag','0')->get()->result_array(); 
	        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
	        //print_r($result);exit;
	        //order_by('category_name', 'asc');
	        /*$productname = array(); 
	       // $productname[''] = 'Select Category...'; 
	        foreach($result as $r) { 
	            $productname[$r['id']] = $r['category_name']; 
	        } */
	        
	        return $result; 
    } 
}
 
?>