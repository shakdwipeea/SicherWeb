<?php
class StatusInfo {
		
	private $login = NULL;
	public $cname = NULL;
	public $contact_info=NULL;
	

	private $UKeys = NULL;
	public $UEmail = NULL;
	public $UName = NULL;
	public $softwares = NULL;
	public $software = NULL;
	public $kH = "";
	public $keyType = "Secure"; //"Secure"  || "Simple"
	
	public function StatusInfo() {
				
			$this->kH = array();	
			array_push($this->kH,"NNNNN");
			
			//2 Capitals Letters
			array_push($this->kH, "AANNN");
			array_push($this->kH, "ANANN");
			array_push($this->kH, "ANNAN");
			array_push($this->kH, "ANNNA");
			array_push($this->kH, "NAANN");
			array_push($this->kH, "NANAN");
			array_push($this->kH, "NANNA");
			array_push($this->kH, "NNAAN");
			array_push($this->kH, "NNANA");
			array_push($this->kH, "NNNAA");
			
			
			//3 Capital Letters
			array_push($this->kH, "AAANN");
			array_push($this->kH, "AANAN");
			array_push($this->kH, "AANNA");
			array_push($this->kH, "ANAAN");
			array_push($this->kH, "ANANA");
			array_push($this->kH, "NAAAN");
			array_push($this->kH, "NAANA");
			array_push($this->kH, "NANAA");
			
			//4 Capital Letters
			array_push($this->kH, "AAAAN");
			array_push($this->kH, "AAANA");
			array_push($this->kH, "ANAAA");
			array_push($this->kH, "NAAAA");

			//2 Small Letters
			array_push($this->kH, "aaNNN");
			array_push($this->kH, "aNaNN");
			array_push($this->kH, "aNNaN");
			array_push($this->kH, "aNNNa");
			array_push($this->kH, "NaaNN");
			array_push($this->kH, "NaNaN");
			array_push($this->kH, "NaNNa");
			array_push($this->kH, "NNaaN");
			array_push($this->kH, "NNaNa");
			array_push($this->kH, "NNNaa");
			
			
			//3 Small Letters
			array_push($this->kH, "aaaNN");
			array_push($this->kH, "aaNaN");
			array_push($this->kH, "aaNNa");
			array_push($this->kH, "aNaaN");
			array_push($this->kH, "aNaNa");
			array_push($this->kH, "NaaaN");
			array_push($this->kH, "NaaNa");
			array_push($this->kH, "NaNaa");
			
			//4 Small Letters
			array_push($this->kH, "aaaaN");
			array_push($this->kH, "aaaNa");
			array_push($this->kH, "aNaaa");
			array_push($this->kH, "Naaaa");
	}
	


	function setInfo($cname,$lname,$contact_info) {
		$this -> login = $lname;
		$this->cname = $cname;
		$this->contact_info = $contact_info;
	}
	
	function setSoftwares($slist)
	{
		$this->softwares = $slist;
	}
	
	function addKey($key,$x)
	{
		//echo"Key: $key<br>";
		$this->UKeys[$x] = $key;
	}
	
	function addEmail($name,$email)
	{
		$this->UEmail = $email;
		$this->UName = $name;
	}
	
	function getKeys()
	{
		return $this->UKeys;
	}
	

	}
	
?>