<?php
/**
 * contains the following child classes
 * of {@link MMB_Editor_Field_Wrapper} ({@link MMB_Editor_Field})
 * 
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael M�ller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael M�ller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */

/**
 * MMB_Editor_Field_String class
 * 
 * this class is a string field for {@link MMB_Editor}
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael M�ller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael M�ller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */
class MMB_Editor_Field_String extends MMB_Editor_Field_Wrapper
{
	/**
	 * if this option is enabled the html output will decode html tags and special chars
	 * this option influences for example the method {@link MMB_Editor_Field_String::show()}
	 * @var     bool
	 * @access  public
	 */
	public $decodeHTML = false;
	
	
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
		if ($this->decodeHTML) {
			return htmlspecialchars($this->value);
		} else {
			return $this->value;
		}
	}
	
	
	/**
	 * outputs the input field for editing the field
	 * @return  string   html code
	 * @access  public
	 */
	public function outputInput()
	{
		return '<input name="'.$this->name.'" type="text" value="'.$this->getValue().'"'.$this->getAdditoinalAttributes().'/>';
	}
	
	
	/**
	 * returns a default value for the field
	 * @return  string   default value
	 * @access  private
	 */
	protected function getDefaultValue()
	{
		return '';
	}
	
	
	/**
	 * validates the value of the field
	 * is called by {@link MMB_Editor_Field_String::setValue()}
	 * rises an {@link E_MMB_Editor_Field_Invalid_Value} if the value is not valid
	 * @return  bool     valide value
	 * @access  public
	 */
	protected function validate($value)
	{
		if (!is_string((string) $value)) {
			throw new E_MMB_Editor_Field_Invalid_Value($value);
		}
		if ($this->required && !$value) {
			throw new E_MMB_Editor_Field_Invalid_Value($value);
		}
		return true;
	}
}


/**
 * MMB_Editor_Field_Button class
 * 
 * this class is a button for {@link MMB_Editor}
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael M�ller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael M�ller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */
class MMB_Editor_Field_Button extends MMB_Editor_Field_Wrapper
{
	/**
	 * saves the value of the field
	 * is set by {@link MMB_Editor_Field_Button::__construct()}
	 * @var     mixed
	 * @access  protected
	 */
	protected $type = '';
	
	
	/**
	 * creates an object of the MMB_Editor_Field_Button class
	 * @param   string   $name   field name
	 * @param   string   $value  description
	 * @param   string   $type   type, default: button
	 * @access  public
	 */
	public function __construct($name, $value, $type = 'button')
	{
		parent::__construct($name, '', '');
		$this->setValue($value);
		$this->type = $type;
	}
	
	
	/**
	 * outputs the button for edition the field
	 * @return  string   html code
	 * @access  public
	 */
	public function outputInput()
	{
		return '<input name="'.$this->name.'" type="'.$this->type.'" value="'.$this->getValue().'"'.$this->getAdditoinalAttributes().'/>';
	}
	
	
	/**
	 * validates the value of the field
	 * @return  bool     valide value
	 * @access  public
	 */
	protected function validate($value)
	{
		return true;
	}
}


/**
 * MMB_Editor_Field_Button_Submit class
 * 
 * this class is a submit button for {@link MMB_Editor}
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael M�ller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael M�ller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */
class MMB_Editor_Field_Button_Submit extends MMB_Editor_Field_Button
{
	/**
	 * creates an object of the MMB_Editor_Field_Button_Submit class
	 * @param   string   $name   field name, default: submit
	 * @param   string   $value  value, default: 'OK'
	 * @access  public
	 */
	public function __construct($name = 'submit', $value = 'OK')
	{
		parent::__construct($name, $value, 'submit');
	}
}


/**
 * MMB_Editor_Field_Button_Reset class
 * 
 * this class is a reset button for {@link MMB_Editor}
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael M�ller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael M�ller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */
class MMB_Editor_Field_Button_Reset extends MMB_Editor_Field_Button
{
	/**
	 * creates an object of the MMB_Editor_Field_Button_Reset class
	 * @param   string   $name   field name, default: submit
	 * @param   string   $value  value, default: 'OK'
	 * @access  public
	 */
	public function __construct($name = 'reset', $value = 'Reset')
	{
		parent::__construct($name, $value, 'reset');
	}
}


/**
 * MMB_Editor_Field_Button_Hidden class
 * 
 * this class is a hidden button for {@link MMB_Editor}
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael M�ller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael M�ller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */
class MMB_Editor_Field_Button_Hidden extends MMB_Editor_Field_Button
{
	/**
	 * creates an object of the MMB_Editor_Field_Button_Hidden class
	 * @param   string   $name   field name
	 * @param   string   $value  value
	 * @access  public
	 */
	public function __construct($name, $value)
	{
		parent::__construct($name, $value, 'hidden');
	}
}


/**
 * E_MMB_Editor_Field_Invalid_Value exception
 * 
 * this an exception for invalid values set to a field
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael M�ller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael M�ller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */
class E_MMB_Editor_Field_Invalid_Value extends E_MMB_Editor
{
	/**
	 * saves the value of the field
	 * is set by {@link E_MMB_Editor_Field_Invalid_Value::__construct()}
	 * @var     mixed
	 * @access  protected
	 */
	protected $value = NULL;
	
	
	/**
	 * creates an E_MMB_Editor_Field_Invalid_Value exception
	 * @param   string   $value     value
	 * @param   string   $message   message
	 * @access  public
	 */
	public function __construct($value, $message = '')
	{
		$this->value = $value;
	}
	
	
	/**
	 * returns the value of the field
	 * @return  mxied    value
	 * @access  public
	 */
	public function getValue()
	{
		return $this->value;
	}
}
?>
