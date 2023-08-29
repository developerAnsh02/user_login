<?php

Class Login_Database extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {

// Query to check whether username already exist or not
$condition = "email =" . "'" . $data['email'] . "'";

$this->db->select('*');
$this->db->from('employees');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
// Query to insert data in database
$this->db->insert('employees', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else { 
return false;
}
}

// Read data using username and password
public function login($data) {
$status_mode='';
$login_data=[];
$condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
//print_r($condition);exit;
$this->db->select('employees.*,roles.role as role');
$this->db->from('employees');
$this->db->join('roles','employees.role_id=roles.id');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
$login_data=$query->result();


//print_r($login_data);exit;
if ($query->num_rows() == 1) 
	{
		if($login_data['0']->status==0){
			$status_mode='active';
			return $status_mode;
		}else{
			$status_mode='Inactive';
			return $status_mode;
		}
	} 
	else {
	return false;
	}
}

// Read data from database to show data in admin page
public function read_user_information($email) {

$condition = "email =" . "'" . $email . "'";
$this->db->select('employees.*,roles.role as role');
$this->db->from('employees');
$this->db->join('roles','employees.role_id=roles.id');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->result();
} else {
return false;
}
}

// Insert Supplier data in database
public function supplier_insert($data) 
{

	// Query to check whether username already exist or not
	$condition = "vendor_code =" . "'" . $data['vendor_code'] . "'";

	$this->db->select('*');
	$this->db->from('suppliers');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();
	//print_r($data);exit;
	if ($query->num_rows() == 0) {
	// Query to insert data in database
	$this->db->insert('suppliers', $data);
	if ($this->db->affected_rows() > 0) {
	return true;
	}
	} else { 
	return false;
	}
}
	function editSupplier($data, $old_id){
			$this->db->select('*');
			$this->db->from('suppliers');
			$this->db->where('id', $old_id);
			if($this->db->update('suppliers', $data)){
				return true;
			}
		}
		function updateOtp($data,$id){
			$this->db->select('*');
			$this->db->from('employees');
			$this->db->where('id', $id);
			if($this->db->update('employees', $data)){
				return true;
			}
		}
		function updatePassword($email,$data){
			$this->db->select('*');
			$this->db->from('employees');
			$this->db->where('email', $email);
			/*$this->db->limit(1);
			$this->db->get();*/
			if($this->db->update('employees', $data)){
				return true;
			}else{
				return false;
			}
		}
		function myPasswordChange($emp_id,$data){
			//echo $emp_id;exit;
			$this->db->select('*');
			$this->db->from('employees');
			$this->db->where('id', $emp_id);
			//$this->db->limit(1);
			//$this->db->get();
			if($this->db->update('employees', $data)){
				return true;
			}else{
				return false;
			}
		}
		function getSupplierCode(){
    $count=0;
    $this->db->select_max('vendor_code');
    $this->db->from('suppliers');
    $query=$this->db->get()->row_array();
    //print_r($query['vendor_code']);exit;
    $count=$query['vendor_code']+1;
    return $count;
   
	}
		public function export_csv()
		{
			$this->db->select('suppliers.*,categories.category_name as category,countries.name as country,states.state_name as state,cities.city as city');
			$this->db->from('suppliers');
			$this->db->join('categories', 'suppliers.categories_id = categories.id','left'); 
			$this->db->join('countries', 'suppliers.country_id = countries.id','left'); 
			$this->db->join('states', 'suppliers.state_id = states.id','left'); 
			$this->db->join('cities', 'suppliers.city_id = cities.id','left'); 
			//$this->db->where($condition);
			$this->db->where('suppliers.flag','0');
			$this->db->order_by("suppliers.supplier_name", "asc");

			$query =  $this->db->get()->result_array();

			return $query;
		}
		
		public function supplier_list() 
		{
			
			$this->db->select('suppliers.*,categories.category_name as category,countries.name as country,states.state_name as state,cities.city as city');
			$this->db->from('suppliers');
			$this->db->join('categories', 'suppliers.categories_id = categories.id','left'); 
			$this->db->join('countries', 'suppliers.country_id = countries.id','left'); 
			$this->db->join('states', 'suppliers.state_id = states.id','left'); 
			$this->db->join('cities', 'suppliers.city_id = cities.id','left'); 
			//$this->db->where($condition);

			$this->db->where('suppliers.flag','0');
			$this->db->order_by("suppliers.supplier_name", "asc");

			$query =  $this->db->get()->result_array();

			return $query;

		}
		public function supplier_list_by_filter($conditions) 
		{
			//print_r($conditions);echo"<pre>";

			//$conditions['category_of_approval'];
			//$filter_by = "suppliers.id =" . "'" . $conditions['supplier_id'] . "'";
			$this->db->select('suppliers.*,categories.category_name as category,countries.name as country,states.state_name as state,cities.city as city');
			$this->db->from('suppliers');
			$this->db->join('categories', 'suppliers.categories_id = categories.id','left'); 
			$this->db->join('countries', 'suppliers.country_id = countries.id','left'); 
			$this->db->join('states', 'suppliers.state_id = states.id','left'); 
			$this->db->join('cities', 'suppliers.city_id = cities.id','left'); 
			//$this->db->where($condition			
			//$this->db->where(['suppliers.id'=>@$conditions['supplier_id'],'suppliers.categories_id'=>@$conditions['categories_id'],'suppliers.category_of_approval'=>@$conditions['category_of_approval']]);
			if($conditions['supplier_id'] !="0")
		       $this->db->like('suppliers.id',$conditions['supplier_id'],'both');

		    if($conditions['categories_id'] !="0")
		       $this->db->like('suppliers.categories_id',$conditions['categories_id'],'both');
		    if($conditions['category_of_approval'] !="No")
		       $this->db->like('suppliers.category_of_approval', $conditions['category_of_approval'], 'both');
		    if($conditions['from_date']!='1970-01-01')
                $this->db->where('suppliers.reg_date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('suppliers.reg_date <=',$conditions['upto_date']); 
		  //  if($conditions['from_date']!='1970-01-01')
            //    $this->db->where('suppliers.reg_date >=',$conditions['from_date']); 
             //if($conditions['upto_date']!='1970-01-01')
               //$this->db->where('suppliers.reg_date <=',$conditions['upto_date']); 

			$this->db->where('suppliers.flag','0');
			$this->db->order_by("suppliers.supplier_name", "asc");
			//print_r($this->db->last_query());  exit;
			$query =  $this->db->get()->result_array();
			//print_r($this->db->last_query());exit;  
			//print_r($query);exit;
			return $query;

		}

		
		function deleteSupplier($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$data=array('flag'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);

			if($this->db->update('suppliers', $data)){
				return true;
			}
		}
		public function CheckSupplierCode($code)
		{
		    $this->db->select('vendor_code');
		    $this->db->from('suppliers');
		    $this->db->where(['vendor_code'=>$code]);
		    $query=$this->db->get()->num_rows();    
		    return $query;
		   
		}

		
		public function TotalCandidates()
		{
			$this->db->select('*');
			$this->db->from('send_emails');
			$query = $this->db->get();
			return $query->num_rows();
		}
		public function FetchallEmails()
		{
			$this->db->select('email');
			$this->db->from('send_emails');
			$query =  $this->db->get()->result_array();
			return $query;
		}
		
		public function TotalProducts()
		{
			$this->db->select('*');
			$this->db->from('item_masters');
			$this->db->where('flag','0');
			$query = $this->db->get();
			return $query->num_rows();
		}

	

		function getCategories() { 
		$result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','category_type'=>'Supplier'])->get()->result_array(); 
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
     function getCategoriesEditPage() { 
       $result = $this->db->select('id, category_name')->from('categories')->where('flag','0')->get()->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['category_name']] = $r['category_name']; 
        } 
        
        return $productname; 
    }	
    function getCountries() { 
    	//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
        $result = $this->db->select('id, name')->get('countries')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $states = array(); 
        $states[''] = 'Select Country...'; 
        foreach($result as $r) { 
            $states[$r['id']] = $r['name']; 
        } 
        return $states; 
    } 
        function getStates() { 
    	//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
        $result = $this->db->select('id, state_name')->get('states')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $states = array(); 
        $states[''] = 'Select State...'; 
        foreach($result as $r) { 
            $states[$r['id']] = $r['state_name']; 
        } 
        return $states; 
    } 
      function getCities() { 
    	//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
        $result = $this->db->select('id, city')->get('cities')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $states = array(); 
        $states[''] = 'Select City...'; 
        foreach($result as $r) { 
            $states[$r['id']] = $r['city']; 
        } 
        return $states; 
    } 



  	/*public function fetchcatName($id) {
      $this->db->select('category_name');
      	$this->db->from('categories');
		$this->db->where('id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		//print_r($data);exit;
		return $data[0]['category_name'];
        
    }*/
    function get_menu_tree($parent_id) 
	{
		global $con;
		$menu = "";
		$sqlquery = " SELECT * FROM menus where flag='0' and parent_id='" .$parent_id . "' ";
		$res=mysqli_query($con,$sqlquery);
	    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
		{
	           $menu .="<li class='nav-item has-treeview menu-open'><a class='nav-link active' href='".$row['link']."'>".$row['menu_name']."</a>";
			   
			   $menu .= "<ul>".$this->get_menu_tree($row['menu_id'])."</ul>"; //call  recursively
			   
	 		   $menu .= "</li>";
	 
	    }
	    
	    return $menu;
	} 
	public function get_categories(){

        $this->db->select('*');
        $this->db->from('menus');
        $this->db->where('parent_id', 0);
        //Add here role condition
        $parent = $this->db->get();

        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;
    }
    public function sub_categories($id){

        $this->db->select('*');
        $this->db->from('menus');
        $this->db->where('parent_id', $id);
         //add here role condition
        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;       
    }

    public function verify_email($email){
    	$condition = "email =" . "'" . $email . "'";
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
		return $query->result();
		} 
		else {
		return false;
		}
    }
	function getEmployees() { 
        $result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
        return $result; 
    }
    function getSupplierByCategory($id) { 
       $result = $this->db->select('id, supplier_name')->from('suppliers')->where(['flag'=>'0','categories_id'=>$id])->get()->result_array(); 
        return $result; 
    }
     function getSupplierById($id) { 
       $result = $this->db->select('contact_person,address,mobile_no,supplier_type')->from('suppliers')->where(['flag'=>'0','id'=>$id])->get()->row_array(); 
        
        return $result; 
    }
    
    
    function getAllSuppliers() { 
       $result = $this->db->select('id, supplier_name')->from('suppliers')->where(['flag'=>'0'])->get()->result_array(); 
        return $result; 
    }
      public function getById($id){
        $this->db->select('suppliers.*,city1.city as city,state1.state_name as state,county1.name as country,cate.category_name as category');
        $this->db->from('suppliers');
        $this->db->join('categories as cate', 'suppliers.categories_id = cate.id','left'); 
        $this->db->join('countries as county1', 'suppliers.country_id = county1.id','left'); 
        $this->db->join('states as state1', 'suppliers.state_id = state1.id','left'); 
        $this->db->join('cities as city1', 'suppliers.city_id = city1.id','left'); 
        $this->db->where(['suppliers.flag'=>'0','suppliers.id'=>$id]);
        //$this->db->order_by('suppliers.id','ASC');
        $query =  $this->db->get()->row_array();
        //print_r($query);exit;
        return $query;
    }

}

?>