<?php
/**
 * contains {@link MMB_Editor_HTML} class
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



class MMB_Editor_HTML extends MMB_Editor_Wrapper
{
	/**
	 * checks the configuration of the {@link MMB_Editor_Wrapper} instance
	 * throws a {@link E_MMB_Editor_Invalid_Config}
	 * @access  public
	 */
	protected function checkConfig()
	{
		parent::checkConfig();
		if (!count($this->buttons)) {
			// adds a submit and a reset button if no other buttns are set
			$this->addButton(new MMB_Editor_Field_Button_Submit('edit'));
			$this->addButton(new MMB_Editor_Field_Button_Reset);
		}
	}
	
	
	/**
	 * handles actions
	 * checks POST and GET for actions which MMB_Editor_Wrapper can handle automatically
	 * @return  bool     returns true if it handled an action
	 * @access  public
	 */
	public function handleActions()
	{
		$this->checkConfig();
		$done = false;
		
		if (isset($_POST['edit'])) {
			// handles a form created by MMB_Editor_Wrapper::outputForm()
			$this->handleEdit();
			$done = true;
		}
		
		if (!$done) {
			$done = parent::handleActions();
		}
		return $done;
	}
	
	
	/**
	 * handles a form created by {@link MMB_Editor_Wrapper::outputForm()
	 * @access  public
	 */
	public function handleEdit()
	{
		foreach ($this->getFieldNames() as $name) {
			try {
				$this->getField($name)->setValue($_POST[$name]);
			} catch (E_MMB_Editor_Field_Invalid_Value $exception) {
				$this->getField($name)->setException($exception);
			}
		}
	}
	
	
	
	/**
	 * creates a user readable output for the fields
	 * @return  string   html code
	 * @access  public
	 */
	public function outputForm()
	{
		parent::outputForm();
		echo '<form action="'.$this->scriptName.'" method="'.$this->method.'">';
		echo '<table>';
		echo '<tr><th colspan="2">'.$this->title.'</th></tr>';
		
		foreach ($this->fields as $field) {
			$exception = $field->getException();
			echo '<tr><td>';
			if ($exception) {
				echo '<span style="color:#FF0000;>';
			}
			echo $field->outputDescription();
			if ($field->required) {
				echo '*';
			}
			echo ':<br />';
			echo $field->outputLongDescription();
			if ($exception) {
				if  (($msg = $exception->getMessage()) && $msg) {
					echo '<br />';
					echo $msg;
				}
				echo '</span>';
			}
			echo '</td>';
			echo '<td>';
			echo $field->outputInput();
			echo '</td></tr>';
		}
		
		echo '<tr><td>&nbsp;</td><td>';
		
		foreach ($this->buttons as $button) {
			echo $button->outputInput();
			echo ' ';
		}
		
		echo '</td></tr>';
		echo '</table>';
		echo '</form>';
	}
}


abstract class MMB_Editor_Field_Wrapper_HTML extends MMB_Editor_Field
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
?>
