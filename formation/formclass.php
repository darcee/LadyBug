 
<?php

/*  this will be in a seperate Class file */
abstract class FormInput {
	public $required;
	public $validate;
	public $style;
	public function __construct($name) {
		$this->name = $name;
	}
	public function isRequired($required) {
		if ($required){
		$this->required = 'required';
		}
	}
	public function setValidate($validate) {
		if ($validate){
			$this->validate = $validate;
		}
	}
    public function validate() {
		return $this->validate;
		}
    public function name() {
		return $this->name;
		}
	public function value($value) {
		if(isset($_POST[$this->name])){
			$this->value =$_POST[$this->name];
		}else{
		$this->value = $value;
		}
	}
	public function label($label) {
		$this->label = $label;
	}
	public function radioArray($radioArray) {
		$this->radioArray = $radioArray;
	}	
	public function style($style) {
		$this->style = $style;
	}
}
class textInput extends FormInput {
	function displayInput(){
	    $label = '';
	    $error = '';
		if (isset($this->label)){
			$label = "<label for='$this->name'>$this->label: </label>";
		}
		if ((isset($this->feedback))&&($this->feedback=='error')){
			$error = "<div class='invalid-feedback'>This is error text.</div><br>";
		}elseif ((isset($this->feedback))&&($this->feedback=='valid')){
			$error = "<div class='valid-feedback'>Looks good!</div>";
		}		
		return $label."<input type='text' id='$this->name' name='$this->name' value='$this->value' class='$this->style' $this->required><br>".$error;

	}
}
class passwordInput extends FormInput {
	function displayInput(){
	  	$label = '';
	    $error = '';
		if (isset($this->label)){
			$label = "<label for='$this->name'>$this->label: </label>";
		}
		if ((isset($this->feedback))&&($this->feedback=='error')){
			$error = "<div class='invalid-feedback'>This is error text.</div><br>";
		}elseif ((isset($this->feedback))&&($this->feedback=='valid')){
			$error = "<div class='valid-feedback'>Looks good!</div>";
		}		
		return $label."<input type='password' id='$this->name' name='$this->name' value='$this->value' class='$this->style' $this->required><br>".$error;
	}
}

class radioInput extends FormInput {
	function displayInput(){
		$inputs ='';
	    $label = '';
	    $error = '';;
	    foreach ($this->radioArray as $key => $value) {
	    	 $inputs =  $inputs . "<input type='radio' id='$this->name' name='$key' value='$value'> <label for='$key'>$key</label><br>";
	    }
		if (isset($this->label)){
			$label = "<label for='$this->name'>$this->label: </label><br>";
		}
		if ((isset($this->feedback))&&($this->feedback=='error')){
			$error = "<div class='invalid-feedback'>This is error text.</div><br>";
		}elseif ((isset($this->feedback))&&($this->feedback=='valid')){
			$error = "<div class='valid-feedback'>Looks good!</div>";
		}
		return $label.$inputs.$error;
	}
}

/* from input array is created with the class and the methods set the form input variables this is done in the php file  Custome styles can be set in the .css file and called here using a method */

$firstName = new textInput('fName');
$firstName->isRequired(true);
$firstName->value('First Name');
$firstName->label('First Name');
$firstName->style('form_style');
$firstName->setValidate('text');


$lastName = new textInput('lName');
$lastName->isRequired(false);
$lastName->value('Last Name');
$lastName->label('Last Name');
$lastName->setValidate('text');


$password = new passwordInput('password');
$password->isRequired(true);
$password->value('Password');
$password->label('Password');
$password->setValidate('password');

$radioArray = [
	'option1'=> 1,
	'option2'=> 2,
	'option3'=> 3	
];
$radio = new radioInput('radio');
$radio->isRequired(true);
$radio->value('radio');
$radio->label('radio');
$radio->radioArray($radioArray);
$radio->setValidate('radio');

$feilds = array($firstName, $lastName, $password, $radio);


/* the HTML is created with a loop */
?>





<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<?php
foreach($feilds as $feild) {
	print_r($feild->displayInput());
}

?>
  <br><input type="submit" value="Submit">
</form> 
<?php

/* Validation for all feilds with the validation method set happens here */


foreach($feilds as $feild) {
	if($feild->validate() != null) {
		echo "validate this feild ".$feild->name." we are validating it useing the method for this type: ".$feild->validate() ."<br>";
	}
}
?>