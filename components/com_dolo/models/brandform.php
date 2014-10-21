<?php
/**
 * @version     1.0.0
 * @package     com_dolo
 * @copyright   
 * @license     
 * @author       <> - 
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

/**
 * Dolo model.
 */
class DoloModelBrandForm extends JModelForm
{
    
    var $_item = null;
    
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('com_dolo');

		// Load state from the request userState on edit or from the passed variable on default
        if (JFactory::getApplication()->input->get('layout') == 'edit') {
            $id = JFactory::getApplication()->getUserState('com_dolo.edit.brand.id');
        } else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_dolo.edit.brand.id', $id);
        }
		$this->setState('brand.id', $id);

		// Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if(isset($params_array['item_id'])){
            $this->setState('brand.id', $params_array['item_id']);
        }
		$this->setState('params', $params);

	}
        

	/**
	 * Method to get an ojbect.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function &getData($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id)) {
				$id = $this->getState('brand.id');
			}

			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id))
			{
                
                $user = JFactory::getUser();
                $id = $table->id;
                $canEdit = $user->authorise('core.edit', 'com_dolo') || $user->authorise('core.create', 'com_dolo');
                if (!$canEdit && $user->authorise('core.edit.own', 'com_dolo')) {
                    $canEdit = $user->id == $table->created_by;
                }

                if (!$canEdit) {
                    JError::raiseError('500', JText::_('JERROR_ALERTNOAUTHOR'));
                }
                
				// Check published state.
				if ($published = $this->getState('filter.published'))
				{
					if ($table->state != $published) {
						return $this->_item;
					}
				}

				// Convert the JTable to a clean JObject.
				$properties = $table->getProperties(1);
				$this->_item = JArrayHelper::toObject($properties, 'JObject');
			} elseif ($error = $table->getError()) {
				$this->setError($error);
			}
		}

		return $this->_item;
	}
    
	public function getTable($type = 'Brand', $prefix = 'DoloTable', $config = array())
	{   
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
	}     

    
	/**
	 * Method to check in an item.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkin($id = null)
	{
		// Get the id.
		$id = (!empty($id)) ? $id : (int)$this->getState('brand.id');

		if ($id) {
            
			// Initialise the table
			$table = $this->getTable();

			// Attempt to check the row in.
            if (method_exists($table, 'checkin')) {
                if (!$table->checkin($id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
		}

		return true;
	}

	/**
	 * Method to check out an item for editing.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkout($id = null)
	{
		// Get the user id.
		$id = (!empty($id)) ? $id : (int)$this->getState('brand.id');

		if ($id) {
            
			// Initialise the table
			$table = $this->getTable();

			// Get the current user object.
			$user = JFactory::getUser();

			// Attempt to check the row out.
            if (method_exists($table, 'checkout')) {
                if (!$table->checkout($user->get('id'), $id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
		}

		return true;
	}    
    
	/**
	 * Method to get the profile form.
	 *
	 * The base form is loaded from XML 
     * 
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_dolo.brand', 'brandform', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_dolo.edit.brand.data', array());
        if (empty($data)) {
            $data = $this->getData();
        }
        
        return $data;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function save($data)
	{
		$id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('brand.id');
        $state = (!empty($data['state'])) ? 1 : 0;
        $user = JFactory::getUser();

        if($id) {
            //Check the user can edit this item
            $authorised = $user->authorise('core.edit', 'com_dolo') || $authorised = $user->authorise('core.edit.own', 'com_dolo');
            if($user->authorise('core.edit.state', 'com_dolo') !== true && $state == 1){ //The user cannot edit the state of the item.
                $data['state'] = 0;
            }
        } else {
            //Check the user can create new items in this section
            $authorised = $user->authorise('core.create', 'com_dolo');
            if($user->authorise('core.edit.state', 'com_dolo') !== true && $state == 1){ //The user cannot edit the state of the item.
                $data['state'] = 0;
            }
        }

        if ($authorised !== true) {
            JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return false;
        }
        
        $table = $this->getTable();
        if ($table->save($data) === true) {


        	//Custom code to get user
		   $userinfo_acc = JFactory::getUser();
		   //Group checking for UMS for company administrator
		   $userId = $userinfo_acc->id;
		   $isAdmin = $userinfo_acc->get('isRoot');
		   foreach ($userinfo_acc->groups as $groupId => $value){
		   $db = JFactory::getDbo();
		   $db->setQuery(
		   'SELECT `title`' .
		   ' FROM `#__usergroups`' .
		   ' WHERE `id` = '. (int) $groupId
		   );
		   }
		   $groupNames = $db->loadResult();
		   //Group checking for UMS for company administrator ends here  

		   if ($groupNames=='ums') {  
		   
		   // User Account Mapping custom code
		   $acc_brand_id = $table->id;
		   $current_user_acc = $userinfo_acc->id;
		   $account_info = "SELECT account_id FROM ".$db->quoteName('#__dolo_account_user_mapping')." WHERE user_id='".$current_user_acc."'";
		   $db->setQuery($account_info);
		   $account_result = $db->loadRow();
		   $accid = $account_result[0];
		   $state_upt = 1;
		   $sql_account = "INSERT INTO ".$db->quoteName('#__dolo_account_brand_mapping')." SET
		   ".$db->quoteName('account_id')."        = ".$db->quote($accid).",
		   ".$db->quoteName('brand_id')."         = ".$db->quote($acc_brand_id)."
		   ";
		   $db->setQuery($sql_account);
		   $db->query();
		   // User Account Mapping custom code

		   // User assignment to brands

		   $brandidnew = $table->id;


		   // Insertion process for collaborators
		         require_once("./configuration.php");
		   $jconfig = new JConfig();
		   $db_error = "I am sorry! There is an error in db connection.";
		   $db_config = mysql_connect( $jconfig->host, $jconfig->user, $jconfig->password ) or die( $db_error );
		   mysql_select_db( $jconfig->db, $db_config ) or die( $db_error );

		   $del_operation = mysql_query("DELETE FROM ".$jconfig->dbprefix."dolo_user_brand_mapping WHERE brand_id='".$brandidnew."'");


		   foreach ($data[user_id] as $cb){
		  
		          $insert_operation = mysql_query("INSERT INTO ".$jconfig->dbprefix."dolo_user_brand_mapping VALUES ('','1','".$data[created_by]."','".$cb."','".$brandidnew."')");

		   } 
		}
		   // User assignment ends here




            return $table->id;
        } else {
            return false;
        }
        
	}
    
     function delete($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('brand.id');
        if(JFactory::getUser()->authorise('core.delete', 'com_dolo') !== true){
            JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return false;
        }
        $table = $this->getTable();
        if ($table->delete($data['id']) === true) {

        	  // Deletion process for user brands
		      require_once("./configuration.php");
		      $jconfig = new JConfig();
		      $db_error = "I am sorry! There is an error in db connection.";
		      $db_config = mysql_connect( $jconfig->host, $jconfig->user, $jconfig->password ) or die( $db_error );
		      mysql_select_db( $jconfig->db, $db_config ) or die( $db_error );
		      $del_operation = mysql_query("DELETE FROM ".$jconfig->dbprefix."dolo_user_brand_mapping WHERE brand_id='".$id."'");
		      // Deleting user assignment


            return $id;
        } else {
            return false;
        }
        
        return true;
    }
    
}