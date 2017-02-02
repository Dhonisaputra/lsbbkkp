<?php

@session_start();


// ======================== data akses =========================
class Dataakses
{

	private $DB_HOST = 'localhost';
	private $DB_USER = 'root';
	private $DB_PASS = 'toor';
	private $DB_DATA = 'yoqa';
	private $DB_PORT = '';
	protected $mysqli;
	public $status_connection = '';
	protected $mysqli_result;

	public function __construct($db = array())
	{
		$ci =& get_instance();
		$this->DB_HOST = isset($db['host'])? $db['host'] : $ci->db->hostname;
		$this->DB_USER = isset($db['username'])? $db['username'] : $ci->db->username;
		$this->DB_PASS = isset($db['password'])? $db['password'] : $ci->db->password;
		$this->DB_DATA = isset($db['database'])? $db['database'] : $ci->db->database;
		$this->DB_PORT = isset($db['port'])? $db['port'] : $this->DB_PORT;

		$this->connect();
    }

    protected function connect()
    {
        $this->mysqli = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_DATA); 
        if ($this->mysqli->connect_errno) {
		    $this->status_connection = "Connect failed: %s\n". $this->mysqli->connect_error;
		    exit();
		}else
		{
			$this->status_connection = 'Successfully Connected!';
		}
    }


    function flat_arr($array,&$result){
	  foreach($array as $v){
	    if(is_array($v)){
	      self::flat_arr($v,$result);
	    }else{
	      $result[]=$v;
	    }
	  }
	  return $result;
	}

	/*
		- to run SQL 
		e.g
		#insert
		$this->mysqli->SQL('insert into users values (?,?,?,?)', 'isss' , null, '123.456.789','1234','10');

		#selecting
		$c = $mysqli->SQL('select * from users ');
		
		#updating
		$mysqli->SQL('Update users set username = "aku" where id_users = 3 ');

		#removing
		$mysqli->SQL('delete from users where id_users = 2');

	*/
	function SQL(){

		// get all arguments
		$args=func_get_args();

		// jika argument ke-0 ada
		if (isset($args[0])) {

			// initialize this->mysqli
			$stmt = mysqli_stmt_init($this->mysqli);

			if ($stmt->prepare($args[0])) {
				
				if(isset($args[1])){
					
					// baca tanda ? pada arguments ke-0
					$x = substr_count($args[0],'?');

					// isikan array dengan nilai "" mulai dari array ke-0 sampai $x
					$y = array_fill(0,$x,"");
					
					
					if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
					{
					    foreach($y as $key=>$value) {
					       @$param[$key] = &$y[$key];
					    }
					}else{
						$param=$y;
					}


					call_user_func_array("mysqli_stmt_bind_param",array_merge(array($stmt),array($args[1]),$param));
					unset($x,$y,$refs,$i);
					$x=array_slice($args,2);
					//flattening the array
					self::flat_arr($x,$flat_arr);
					foreach ($flat_arr as $value) {
			            $y[]=$value;							
			        }
			        $i = 0;
			        foreach($param as $key=>$value) {
		               $param[$key] = $y[$i];
		               $i++;
		            }
				}
				$stmt->execute();
				$x = $stmt->field_count;
				// print_r($args);
				// echo $x;
				// return$x;
				if($x>0){
					$stmt->store_result();
					$meta = $stmt->result_metadata();
					
					// print_r($meta->fetch_field());
					// $field = 
				 	while($field = $meta->fetch_field()){
				 		// echo $field->name."\n";
				 		$result[$field->name] = &$refs[$field->name]; // original
				 		// $result[] = &$refs[$field->name];
				 	}
					call_user_func_array("mysqli_stmt_bind_result",array_merge(array($stmt),$result));
					$i=0;
					while ($stmt->fetch()) {
						foreach ($result as $key => $value) {
							$data[$i][$key]=$value;
						}
						$i++;
				 	}
					$stmt->free_result();
					$stmt->close();

					$this->mysqli_result = !empty($data)?$data:[];

					return $result = $this->mysqli_result;
				}				
	            $stmt->close();
			}

		}
	}
	function mysqliSQL($sql)
	{

	}

	function mysqli_error()
	{
		return $this->mysqli->error;
	}

	function beginTransaction()
	{
		$this->mysqli->begin_transaction();
	}
	public function commitOff()
    {
        $this->mysqli->autocommit(FALSE);
    }
    public function rollback()
    {
		$this->mysqli->rollback();
    }
    public function commitOn()
    {
        if (!$this->mysqli->commit()){
            return 0;
        }else{
            return 1;
        };
    }
    public function insert_id()
    {
        return $this->mysqli->insert_id;
    }
    public function affectedRows()
    {
        return $this->mysqli->affected_rows;
    }
    public function close()
    {
    	$this->mysqli->close();
    }
    function __destruct()
    {
        $this->mysqli->close();
    }

    public function row_array($index = 0)
    {
    	if( count($this->mysqli_result) > 0 )
    	{
    		return $this->mysqli_result[$index];
    	}else
    	{
    		return [];
    	}
    }

    public function is_found()
    {
    	return (count($this->mysqli_result) > 0)? true : false;
    }

    public function result_array()
    {
		return  $this->mysqli_result;
    	
    	// if( count($this->mysqli_result) > 0 )
    	// {
    	// }else
    	// {
    	// 	return [];
    	// }
    }

    public function get_enum($table, $field)
    {
    	$this->SQL( "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table."' AND COLUMN_NAME = '".$field."'" );
    	$type = $this->row_array();
	    
	    preg_match("/^enum\(\'(.*)\'\)$/", $type['COLUMN_TYPE'], $matches);
	    $enum = explode("','", $matches[1]);
	    return $enum;
    }

} // end Dataakses


?>