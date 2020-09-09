 
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
	public function style($style) {
		$this->style = $style;
	}
}
class textInput extends FormInput {
	function displayInput(){
	    $label='';
		if (isset($this->label)){
			$label = "<label for='$this->name'>$this->label: </label>";
		}
		return $label."<input type='text' id='$this->name' name='$this->name' value='$this->value' class='$this->style' $this->required><br>";
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
$lastName->setValidate('date');


$feilds = array($firstName, $lastName);


/* the HTML is created with a loop */
?>





<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<?php
foreach($feilds as $feild) {
	print_r($feild->displayInput());
}

?>
  <input type="submit" value="Submit">
</form> 
<?php

/* Validation for all feilds with the validation method set happens here */

var_dump($_POST);
foreach($feilds as $feild) {
	if($feild->validate() != null) {
		echo "validate this feild ".$feild->name." we are validating it useing the method for this type: ".$feild->validate() ."<br>";
	}
}
?>