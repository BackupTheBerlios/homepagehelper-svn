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

define('HPH_DIR', '/srv/www/hph/homepagehelper-src');

require_once HPH_DIR.'/lib/mmb/editor.php';
abstract class MMB_Editor_Wrapper extends MMB_Editor {}
abstract class MMB_Editor_Field_Wrapper extends MMB_Editor_Field
{
	/**
	 * adds html attributes to a tag when {@link MMB_Editor_Field::outputInput()} is called
	 * @return  string   html code
	 * @access  public
	 */
	public function getAdditoinalAttributes()
	{
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
	public function output()
	{
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
require_once HPH_DIR.'/lib/mmb/editor/html.php';
/*
$e = new MMB_Editor_HTML();
$e->setScriptName('index.php');
$e->title = 'Test-Form';

$string = new MMB_Editor_Field_String('test', 'Test', 'Dies ist ein Testfeld');
$string->setValue('<b>test</b>');
$e->addField($string);

$string2 = new MMB_Editor_Field_String('test2', 'Test2', 'Dies ist ein Testfeld2');
$string2->setValue('<b>test2</b>');
$e->addField($string2);

$string3 = new MMB_Editor_Field_String('test3', 'Test3', 'Dies ist ein Testfeld2');
$string3->required = true;
$e->addField($string3);
$e->getField('test3')->setValue('set by using MMB_Editor::getField()');
*/

class MMB_Editor_Test extends MMB_Editor_HTML {
	public function __construct()
	{
		$this->setScriptName('index.php');
		$this->title = 'Test-Form';
		$this->addField(new MMB_Editor_Field_String('test', 'Test', 'Dies ist ein Testfeld'));
		$this->addField(new MMB_Editor_Field_String('test2', 'Test2', 'Dies ist ein Testfeld2'));
		$string3 = new MMB_Editor_Field_String('test3', 'Test3', 'Dies ist ein Testfeld2');
		$string3->required = true;
		$this->addField($string3);
	}
}

$e = new MMB_Editor_Test;

$e->test = 'Test';

$e->handleActions();

echo $e->outputForm();
?>
