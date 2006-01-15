<?php
/**
 * contains the following child classes
 * of {@link MMB_Editor_Field_Wrapper} ({@link MMB_Editor_Field})
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
 * MMB_Editor_Field_String class
 * 
 * this class is a string field for {@link MMB_Editor}
 * @package    HomePageHelper
 * @category   MMB_Editor
 * @author     Michael Müller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael Müller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */
class MMB_Editor_Field_String extends MMB_Editor_Field_Wrapper {
	/**
	 * if this option is enabled the html output will decode html tags and special chars
	 * this option influences for example the method {@link MMB_Editor_Field_String::show()}
	 * @var     bool
	 * @access  public
	 */
	public $decodeHTML = false;
	
	/**
	 * this option determines whether the string can be empty or not
	 * @var     bool
	 * @access  public
	 */
	public $canBeEmpty = true;
	
	
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
	 * outputs the input field for edition the field
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
			throw E_MMB_Editor_Field_Invalid_Value;
		}
		if (!$this->canBeEmpty && !$value) {
			throw E_MMB_Editor_Field_Invalid_Value;
		}
		return true;
	}
}
?>
