<?php
/**
 * dev file for {@link MMB_Editor} testing
 *
 * @package    Examples
 * @category   Test
 * @author     Michael Müller-Brockhausen <michael@brockhausen.name>
 * @copyright  2006, Michael Müller-Brockhausen
 * @link       http://homepagehelper.berlios.de
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1.0
 * @since      1.0
 */

define('HPH_DIR', '/srv/www/hph/homepagehelper-src-dev');

require_once HPH_DIR.'/lib/mmb/editor.php';
abstract class MMB_Editor_Field_Wrapper extends MMB_Editor_Field {
	/**
	 * adds html attributes to a tag when {@link MMB_Editor_Field::outputInput()} is called
	 * @return  string   html code
	 * @access  public
	 */
	public function getAdditoinalAttributes() {
		return ' class="input" id="'.$this->id.'" ';
	}
	
	
	/**
	 * outputs the field as a whole
	 *
	 * combines the following functions
	 * - {@link MMB_Editor_Field::outputInput()}
	 * - {@link MMB_Editor_Field::outputDescription()}
	 * - {@link MMB_Editor_Field::outputLongDescription()}
	 * and puts them in a user readable context
	 * @return  string   html code
	 * @access  public
	 */
	public function output() {
		$return = $this->outputDescription().'<br />';
		$return .= $this->outputLongDescription().'<br />';
		$return .= $this->outputInput();
		return $return;
	}
	
	
	/**
	 * outputs the {@link MMB_Editor_Field::$description} of the field in a user readable way
	 * @return  string   html code
	 * @access  public
	 */
	public function outputDescription()
	{
		return '<label for="'.$this->getID().'"><b>'.$this->getDescription().'</b></label>';
	}
	
	
	/**
	 * outputs the {@link MMB_Editor_Field::$longDescription} of the field in a user readable way
	 * @return  string   html code
	 * @access  public
	 */
	public function outputLongDescription()
	{
		return '<span style="font-size:13px">'.$this->getLongDescription().'</span>';
	}
}
require_once HPH_DIR.'/lib/mmb/editor/fields.php';

$string = new MMB_Editor_Field_String('test', 'Test', 'Dies ist ein Testfeld');

$string->setValue('<b>test</b>');

echo $string->output();
?>
