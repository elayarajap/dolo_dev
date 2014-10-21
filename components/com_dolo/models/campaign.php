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

jimport('joomla.application.component.modelitem');
jimport('joomla.event.dispatcher');

/**
 * Dolo model.
 */
class DoloModelCampaign extends JModelItem {

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState() {
        $app = JFactory::getApplication('com_dolo');

        // Load state from the request userState on edit or from the passed variable on default
        if (JFactory::getApplication()->input->get('layout') == 'edit') {
            $id = JFactory::getApplication()->getUserState('com_dolo.edit.campaign.id');
        } else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_dolo.edit.campaign.id', $id);
        }
        $this->setState('campaign.id', $id);

        // Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if (isset($params_array['item_id'])) {
            $this->setState('campaign.id', $params_array['item_id']);
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
    public function &getData($id = null) {
        if ($this->_item === null) {
            $this->_item = false;

            if (empty($id)) {
                $id = $this->getState('campaign.id');
            }

            // Get a level row instance.
            $table = $this->getTable();

            // Attempt to load the row.
            if ($table->load($id)) {
                // Check published state.
                if ($published = $this->getState('filter.published')) {
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

        
		if ( isset($this->_item->created_by) ) {
			$this->_item->created_by_name = JFactory::getUser($this->_item->created_by)->name;
		}

			if (isset($this->_item->brandid) && $this->_item->brandid != '') {
				if(is_object($this->_item->brandid)){
					$this->_item->brandid = JArrayHelper::fromObject($this->_item->brandid);
				}
				$values = (is_array($this->_item->brandid)) ? $this->_item->brandid : explode(',',$this->_item->brandid);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('name')
							->from('`#__dolo_brand`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$this->_item->brandid = !empty($textValue) ? implode(', ', $textValue) : $this->_item->brandid;

			}

			if (isset($this->_item->campaigntype_id) && $this->_item->campaigntype_id != '') {
				if(is_object($this->_item->campaigntype_id)){
					$this->_item->campaigntype_id = JArrayHelper::fromObject($this->_item->campaigntype_id);
				}
				$values = (is_array($this->_item->campaigntype_id)) ? $this->_item->campaigntype_id : explode(',',$this->_item->campaigntype_id);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('type')
							->from('`#__dolo_campaigntype`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->type;
					}
				}

			$this->_item->campaigntype_id = !empty($textValue) ? implode(', ', $textValue) : $this->_item->campaigntype_id;

			}

			if (isset($this->_item->campaignstatus_id) && $this->_item->campaignstatus_id != '') {
				if(is_object($this->_item->campaignstatus_id)){
					$this->_item->campaignstatus_id = JArrayHelper::fromObject($this->_item->campaignstatus_id);
				}
				$values = (is_array($this->_item->campaignstatus_id)) ? $this->_item->campaignstatus_id : explode(',',$this->_item->campaignstatus_id);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('status')
							->from('`#__dolo_campaignstatus`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->status;
					}
				}

			$this->_item->campaignstatus_id = !empty($textValue) ? implode(', ', $textValue) : $this->_item->campaignstatus_id;

			}

				if ( isset($this->_item->hero_images) ) {
					// Catch the item tags (string with ',' coma glue)
					$tags = explode(",",$this->_item->hero_images);

					$db = JFactory::getDbo();
					$namedTags = array(); // Cleaning and initalization of named tags array

					// Get the tag names of each tag id
					foreach ($tags as $tag) {

						$query = $db->getQuery(true);
						$query->select("title");
						$query->from('`#__tags`');
						$query->where( "id=" . intval($tag) );

						$db->setQuery($query);
						$row = $db->loadObjectList();

						// Read the row and get the tag name (title)
						if (!is_null($row)) {
							foreach ($row as $value) {
								if ( $value && isset($value->title) ) {
									$namedTags[] = trim($value->title);
								}
							}
						}

					}

					// Finally replace the data object with proper information
					$this->_item->hero_images = !empty($namedTags) ? implode(', ',$namedTags) : $this->_item->my_tags;
		}


        if ( isset($this->_item->keywords) ) {
                    // Catch the item tags (string with ',' coma glue)
                    $tags = explode(",",$this->_item->keywords);

                    $db = JFactory::getDbo();
                    $namedTags = array(); // Cleaning and initalization of named tags array

                    // Get the tag names of each tag id
                    foreach ($tags as $tag) {

                        $query = $db->getQuery(true);
                        $query->select("title");
                        $query->from('`#__tags`');
                        $query->where( "id=" . intval($tag) );

                        $db->setQuery($query);
                        $row = $db->loadObjectList();

                        // Read the row and get the tag name (title)
                        if (!is_null($row)) {
                            foreach ($row as $value) {
                                if ( $value && isset($value->title) ) {
                                    $namedTags[] = trim($value->title);
                                }
                            }
                        }

                    }

                    // Finally replace the data object with proper information
                    $this->_item->keywords = !empty($namedTags) ? implode(', ',$namedTags) : $this->_item->my_tags;
        }
        

			if (isset($this->_item->collaborators) && $this->_item->collaborators != '') {
				if(is_object($this->_item->collaborators)){
					$this->_item->collaborators = JArrayHelper::fromObject($this->_item->collaborators);
				}
				$values = (is_array($this->_item->collaborators)) ? $this->_item->collaborators : explode(',',$this->_item->collaborators);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('name')
							->from('`#__users`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$this->_item->collaborators = !empty($textValue) ? implode(', ', $textValue) : $this->_item->collaborators;

			}

        return $this->_item;
    }

    public function getTable($type = 'Campaign', $prefix = 'DoloTable', $config = array()) {
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables');
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to check in an item.
     *
     * @param	integer		The id of the row to check out.
     * @return	boolean		True on success, false on failure.
     * @since	1.6
     */
    public function checkin($id = null) {
        // Get the id.
        $id = (!empty($id)) ? $id : (int) $this->getState('campaign.id');

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
    public function checkout($id = null) {
        // Get the user id.
        $id = (!empty($id)) ? $id : (int) $this->getState('campaign.id');

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

    public function getCategoryName($id) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
                ->select('title')
                ->from('#__categories')
                ->where('id = ' . $id);
        $db->setQuery($query);
        return $db->loadObject();
    }

    public function publish($id, $state) {
        $table = $this->getTable();
        $table->load($id);
        $table->state = $state;
        return $table->store();
    }

    public function delete($id) {
        $table = $this->getTable();
        return $table->delete($id);
    }

}
