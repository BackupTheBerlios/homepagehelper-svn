<?php
/**
 * contains {@link MMB_Editor} class
 * 
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael Müller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael Müller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */

 
/**
 * MMB_Editor class
 * 
 * this class is the base for data editing
 * MMB_Editor is an abstract class
 * several classes for all kinds of differnt purposes are derived from MMB_Editor
 * 
 * ATTENTION: this class should not be inherited directly:
 * the wrapper class MMB_Editor_Wrapper should be inherited instead
 * this opens the opportunity to change basic functionality wihtout a need to change
 * the original source file
 * 
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael Müller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael Müller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 * @abstract
 */
abstract class MMB_Editor
{
	/**
	 * saves all instances of children of MMB_Editor_Field_Button
	 * fields can be added using {@link MMB_Editor::addButton()}
	 * the field array can be returned by {@link MMB_Editor::getButtons()}
	 * single instances can be called using {@link MMB_Editor::getButton()}
	 * the array has the name of the field as key
	 * @var     array
	 * @access  protected
	 */
	protected $buttons = array();
	
	/**
	 * indicates wether the configuration of the instance was done and valid
	 * is set by {@link MMB_Editor::checkConfig()}
	 * @var     bool
	 * @access  protected
	 */
	protected $configCheck = false;
	
	
	/**
	 * saves all instances of children of MMB_Editor_Field
	 * fields can be added using {@link MMB_Editor::addField()}
	 * the field array can be returned by {@link MMB_Editor::getFields()}
	 * single instances can be called using {@link MMB_Editor::getField()}
	 * the array has the name of the field as key
	 * @var     array
	 * @access  protected
	 */
	protected $fields = array();
	
	
	/**
	 * saves the method which the form uses
	 * either 'post' or 'get'
	 * @var     string
	 * @access  public
	 */
	public $method = '';
	
	
	/**
	 * saves the script name which is used
	 * is set by the function {@link MMB_Editor::setScriptName()}
	 * @var     string
	 * @access  protected
	 */
	protected $scriptName = '';
	
	
	/**
	 * saves the title of the form
	 * @var     string
	 * @access  public
	 */
	public $title = '';
	
	
	
	/**
	 * adds a button to {@link MMB_Editor::$buttons}
	 * @param   object   $object  instance of a child of MMB_Editor_Field_Button
	 * @access  public
	 */
	public function addButton(MMB_Editor_Field_Button $object)
	{
		$this->buttons[$object->getName()] = $object;
	}
	
	
	/**
	 * adds a field to {@link MMB_Editor::$fields}
	 * @param   object   $object  instance of a child of MMB_Editor_Field
	 * @access  public
	 */
	public function addField(MMB_Editor_Field $object)
	{
		$this->fields[$object->getName()] = $object;
	}
	
	
	/**
	 * checks the configuration of the {@link MMB_Editor} instance
	 * throws a {@link E_MMB_Editor_Invalid_Config}
	 * 
	 * ATTENTION: it is highly recommended to redeclare this function
	 * in a child class
	 * @access  public
	 */
	protected function checkConfig()
	{
		if (!$this->scriptName) {
			throw new E_MMB_Editor_Invalid_Config('No Scriptname set');
		}
		if (!$this->title) {
			throw new E_MMB_Editor_Invalid_Config('No Title set');
		}
		if (!$this->method) {
			$this->method = 'post';
		}
		$this->configCheck = true;
	}
	
	
	/**
	 * returns a button from {@link MMB_Editor::$buttons}
	 * @param   string   $name  button name
	 * @return  object   field
	 * @access  public
	 */
	public function getButton($name)
	{
		if (!isset($this->buttons[$name])) {
			throw new E_MMB_Editor_No_Button;
		}
		return $this->buttons[$name];
	}
	
	
	/**
	 * returns the button names as an array
	 * @return  array    button names
	 * @access  public
	 */
	public function getButtonNames()
	{
		return array_keys($this->buttons);
	}
	
	
	/**
	 * returns {@link MMB_Editor::$buttons}
	 * @return  array    {@link MMB_Editor::$buttons}
	 * @access  public
	 */
	public function getButtons()
	{
		return $this->buttons;
	}
	
	
	/**
	 * returns a field from {@link MMB_Editor::$fields}
	 * @param   string   $name  field name
	 * @return  object   field
	 * @access  public
	 */
	public function getField($name)
	{
		if (!isset($this->fields[$name])) {
			throw new E_MMB_Editor_No_Field;
		}
		return $this->fields[$name];
	}
	
	
	/**
	 * returns an array with all field names
	 * @return  array    field names
	 * @access  public
	 */
	public function getFieldNames()
	{
		return array_keys($this->fields);
	}
	
	
	
	/**
	 * returns {@link MMB_Editor::$fields}
	 * @return  array    {@link MMB_Editor::$fields}
	 * @access  public
	 */
	public function getFields()
	{
		return $this->fields;
	}
	
	
	/**
	 * handles actions
	 * checks POST and GET for actions which MMB_Editor can handle automatically
	 * 
	 * ATTENTION: it is highly recommended to redeclare this function
	 * in a child class
	 * @return  bool     returns true if it handled an action
	 * @access  public
	 */
	public function handleActions()
	{
		$done = false;
		
		
		return $done;
	}
	
	
	/**
	 * creates a user readable output for the fields
	 * @return  string   html code
	 * @access  public
	 */
	public function outputForm()
	{
		$this->checkConfig();
	}
	
	
	/**
	 * creates the table head
	 * @param   string   $name  file name
	 * @return  bool     returns false if {@link MMB_Editor::$scriptName} already has a value
	 * @access  public
	 */
	public function setScriptName($name)
	{
		if (!$this->scriptName) {
			$this->scriptName = $name;
			return true;
		} else {
			return false;
		}
	}
}




/**
 * MMB_Editor_Field class
 * 
 * this class is the base for MMB_Editor fields
 * MMB_Editor_Field is an abstract class
 * several dervied classes from MMB_Editor_Field serve for all kinds of different purposes
 * there are fields for strings, integers, textareas, dates, files, etc.
 * 
 * ATTENTION: this class should not be inherited directly:
 * the wrapper class MMB_Editor_Field_Wrapper should be inherited instead
 * this opens the opportunity to change basic functionality wihtout a need to change
 * the original source file
 * 
 * child classes are encouraged to redeclare at least the following functions:
 * - {@link MMB_Editor_Field::getAdditoinalAttributes()}
 * - {@link MMB_Editor_Field::outputInput()}
 * - {@link MMB_Editor_Field::show()}
 * - {@link MMB_Editor_Field::getDefaultValue()}
 * - {@link MMB_Editor_Field::validate()}
 * 
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael Müller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael Müller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 * @abstract
 */
abstract class MMB_Editor_Field
{
	/**
	 * saves the description of the field
	 * is set by the constructor {@link MMB_Editor_Field::__construct()}
	 * @var     string
	 * @access  protected
	 */
	protected $description = '';
	
	/**
	 * saves an exception
	 * @var     object
	 * @access  protected
	 */
	protected $exception = NULL;
	
	/**
	 * saves the id for the html tag
	 * @var     string
	 * @access  protected
	 */
	protected $id = '';
	
	/**
	 * saves the amount of instances of any child class of {@link MMB_Editor_Field}
	 * is used and increased by {@link MMB_Editor_Field::setID()}
	 * @var     integer
	 * @access  protected
	 */
	protected static $idIndex = 0;
	
	/**
	 * saves the long description of the field
	 * is set by the constructor {@link MMB_Editor_Field::__construct()}
	 * @var     string
	 * @access  protected
	 */
	protected $longDescription = '';
	
	/**
	 * saves the name of the field
	 * is set by the constructor {@link MMB_Editor_Field::__construct()}
	 * @var     string
	 * @access  protected
	 */
	protected $name = '';
	
	/**
	 * determines wether the field is required for editing or not
	 * @var     bool
	 * @access  public
	 */
	public $required = false;
	
	/**
	 * saves the value of the field
	 * is set by {@link MMB_Editor_Field::setValue()}
	 * @var     mixed
	 * @access  protected
	 */
	protected $value = NULL;
	
	
	
	/**
	 * creates an object of the MMB_Editor_Field class
	 * @param   string   $name              field name
	 * @param   string   $description       description
	 * @param   string   $longDescription   long description
	 * @access  public
	 */
	public function __construct($name, $description, $longDescription)
	{
		$this->name             = $name;
		$this->description      = $description;
		$this->longDescription  = $longDescription;
		$this->setID();
	}
	
	
	/**
	 * adds html attributes to a tag when {@link MMB_Editor_Field::outputInput()} is called
	 * 
	 * ATTENTION: it is highly recommended to redeclare this function
	 * in a child class
	 * @return  string   html code
	 * @access  public
	 */
	public function getAdditoinalAttributes()
	{
		 return ' id="'.$this->id.'" ';
	}
	
	
	/**
	 * returns a default value for the field
	 * @return  mixed    default value
	 * @access  private
	 */
	protected function getDefaultValue()
	{
		// contains no code in an abstract class
	}
	
	
	/**
	 * returns the {@link MMB_Editor_Field::$description} of the field
	 * as it is stored in the variable
	 * @return  string   html code
	 * @access  public
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	
	/**
	 * returns the {@link MMB_Editor_Field::$exception}
	 * returns false if no exception is set
	 * @param   object   exception object
	 * @access  public
	 */
	public function getException()
	{
		if ($this->exception) {
			return $this->exception;
		} else {
			return false;
		}
	}
	
	
	/**
	 * return the id of the field as it is needed for html tag output
	 * @return  string   id
	 * @access  public
	 */
	public function getID()
	{
		return $this->id;
	}
	
	
	/**
	 * returns the {@link MMB_Editor_Field::$longDescription} of the field
	 * as it is stored in the variable
	 * @return  string   html code
	 * @access  public
	 */
	public function getLongDescription()
	{
		return $this->longDescription;
	}
	
	
	/**
	 * returns the name of the field stored in {@link MMB_Editor_Field::$name}
	 * @return  mxied    value
	 * @access  public
	 */
	public function getName()
	{
		return $this->name;
	}
	
	
	/**
	 * returns the value of the field as it is needed for example for database entries
	 * @param   bool     $ignoreException  if set on true and the field has an exception,
	 *                        the value of the field is returned instead of the value of the
	 *                        exception
	 * @return  mxied    value
	 * @access  public
	 */
	public function getValue($ignoreException = false)
	{
		if (!$ignoreException && $this->exception) {
			return $this->exception->getValue();
		} else {
			return $this->value;
		}
	}
	
	
	/**
	 * outputs the field as a whole
	 *
	 * combines the following functions
	 * - {@link MMB_Editor_Field::outputInput()}
	 * - {@link MMB_Editor_Field::outputDescription()}
	 * - {@link MMB_Editor_Field::outputLongDescription()}
	 * and puts them in a user readable context
	 * 
	 * ATTENTION: it is highly recommended to redeclare this function
	 * in a child class
	 * @return  string   html code
	 * @access  public
	 */
	public function output()
	{
		// contains no code in an abstract class
	}
	
	
	/**
	 * outputs the {@link MMB_Editor_Field::$description} of the field in a user readable way
	 * 
	 * ATTENTION: it is highly recommended to redeclare this function
	 * in a child class
	 * @return  string   html code
	 * @access  public
	 */
	public function outputDescription()
	{
		return $this->getDescription();
	}
	
	
	/**
	 * outputs the input field for editing the field
	 * 
	 * ATTENTION: it is highly recommended to redeclare this function
	 * in a child class
	 * @return  string   html code
	 * @access  public
	 */
	public function outputInput()
	{
		// contains no code in an abstract class
	}
	
	
	/**
	 * outputs the {@link MMB_Editor_Field::$longDescription} of the field in a user readable way
	 * 
	 * ATTENTION: it is highly recommended to redeclare this function
	 * in a child class
	 * @return  string   html code
	 * @access  public
	 */
	public function outputLongDescription()
	{
		return $this->getLongDescription();
	}
	
	
	/**
	 * sets an exception
	 * @param   object   $exception  exception object
	 * @access  public
	 */
	public function setException(E_MMB_Editor $exception)
	{
		$this->exception = $exception;
	}
	
	
	/**
	 * sets the id of the field
	 * @return  bool     returns true if the value was validated
	 * @access  protected
	 */
	protected function setID()
	{
		if ($this->id) {
			return false;
		} else {
			self::$idIndex++;
			$this->id = 'mmb_editor_field_'.self::$idIndex;
			return true;
		}
	}
	
	
	/**
	 * sets the value for the field
	 * the value is validated by {@link MMB_Editor_Field::validate()}
	 * @return  bool     returns true if the value was validated
	 * @access  public
	 */
	public function setValue($value)
	{
		$this->validate($value);
		return ($this->value = $value);
	}
	
	
	/**
	 * outputs the value of the field in a user readable way
	 * 
	 * ATTENTION: it is highly recommended to redeclare this function
	 * in a child class
	 * @return  string   html code
	 * @access  public
	 */
	public function show()
	{
		return $this->value;
	}
	
	
	/**
	 * validates the value of the field
	 * is called by {@link MMB_Editor_Field::setValue()}
	 * rises an {@link E_MMB_Editor_Field_Invalid_Value} if the value is not valid
	 * @return  bool     valide value
	 * @access  protected
	 */
	protected function validate($value)
	{
		// contains no code in an abstract class
	}
}

/**
 * wrapper class for an MMB_Editor exception
 * 
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael Müller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael Müller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 * @abstract
 */
abstract class E_MMB_Editor extends Exception /*  E_Wrapper */
{
	
}
?>
