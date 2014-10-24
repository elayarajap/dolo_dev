<?php

/**
 * @version     1.0.0
 * @package     com_dolo
 * @copyright   
 * @license     
 * @author       <> - 
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Dolo records.
 */
class DoloModelCampaigns extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'created_by', 'a.created_by',
                'name', 'a.name',
                'start_date', 'a.start_date',
                'end_date', 'a.end_date',
                'brandid', 'a.brandid',
                'campaigntype_id', 'a.campaigntype_id',
                'campaignstatus_id', 'a.campaignstatus_id',
                'impressions', 'a.impressions',
                'hero_images', 'a.hero_images',
                'keywords', 'a.keywords',
                'collaborators', 'a.collaborators',
                'state', 'a.state',

            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);

        
		//Filtering brandid
		$this->setState('filter.brandid', $app->getUserStateFromRequest($this->context.'.filter.brandid', 'filter_brandid', '', 'string'));

		//Filtering campaignstatus_id
		$this->setState('filter.campaignstatus_id', $app->getUserStateFromRequest($this->context.'.filter.campaignstatus_id', 'filter_campaignstatus_id', '', 'string'));


        // Load the parameters.
        $params = JComponentHelper::getParams('com_dolo');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.name', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');
        $id.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'DISTINCT a.*'
                )
        );
        $query->from('`#__dolo_campaign` AS a');

        
		// Join over the user field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
		// Join over the foreign key 'brandid'
		$query->select('#__dolo_brand_1489316.name AS brands_name_1489316');
		$query->join('LEFT', '#__dolo_brand AS #__dolo_brand_1489316 ON #__dolo_brand_1489316.id = a.brandid');
		// Join over the foreign key 'campaigntype_id'
		$query->select('#__dolo_campaigntype_1489318.type AS campaigntypes_type_1489318');
		$query->join('LEFT', '#__dolo_campaigntype AS #__dolo_campaigntype_1489318 ON #__dolo_campaigntype_1489318.id = a.campaigntype_id');
		// Join over the foreign key 'campaignstatus_id'
		$query->select('#__dolo_campaignstatus_1489322.status AS campaignstatuss_status_1489322');
		$query->join('LEFT', '#__dolo_campaignstatus AS #__dolo_campaignstatus_1489322 ON #__dolo_campaignstatus_1489322.id = a.campaignstatus_id');
		// Join over the foreign key 'collaborators'
		$query->select('#__users_1516408.name AS users_name_1516408');
		$query->join('LEFT', '#__users AS #__users_1516408 ON #__users_1516408.id = a.collaborators');

        

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('a.state = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(a.state IN (0, 1))');
		}

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.name LIKE '.$search.'  OR  a.start_date LIKE '.$search.'  OR  a.end_date LIKE '.$search.'  OR  a.brandid LIKE '.$search.'  OR  a.campaignstatus_id LIKE '.$search.' )');
            }
        }

        

		//Filtering brandid
		$filter_brandid = $this->state->get("filter.brandid");
		if ($filter_brandid) {
			$query->where("a.brandid = '".$db->escape($filter_brandid)."'");
		}

		//Filtering campaignstatus_id
		$filter_campaignstatus_id = $this->state->get("filter.campaignstatus_id");
		if ($filter_campaignstatus_id) {
			$query->where("a.campaignstatus_id = '".$db->escape($filter_campaignstatus_id)."'");
		}


        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems();
        
		foreach ($items as $oneItem) {

			if (isset($oneItem->brandid)) {
				$values = explode(',', $oneItem->brandid);

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

			$oneItem->brandid = !empty($textValue) ? implode(', ', $textValue) : $oneItem->brandid;

			}

			if (isset($oneItem->campaigntype_id)) {
				$values = explode(',', $oneItem->campaigntype_id);

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

			$oneItem->campaigntype_id = !empty($textValue) ? implode(', ', $textValue) : $oneItem->campaigntype_id;

			}

			if (isset($oneItem->campaignstatus_id)) {
				$values = explode(',', $oneItem->campaignstatus_id);

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

			$oneItem->campaignstatus_id = !empty($textValue) ? implode(', ', $textValue) : $oneItem->campaignstatus_id;

			}

			if ( isset($oneItem->hero_images) ) {
				// Catch the item tags (string with ',' coma glue)
				$tags = explode(",",$oneItem->hero_images);

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
					$oneItem->hero_images = !empty($namedTags) ? implode(', ',$namedTags) : $oneItem->hero_images;
				}


			if ( isset($oneItem->keywords) ) {
				// Catch the item tags (string with ',' coma glue)
				$tags = explode(",",$oneItem->keywords);

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
					$oneItem->keywords = !empty($namedTags) ? implode(', ',$namedTags) : $oneItem->keywords;
				}
					

			if (isset($oneItem->collaborators)) {
				$values = explode(',', $oneItem->collaborators);

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

			$oneItem->collaborators = !empty($textValue) ? implode(', ', $textValue) : $oneItem->collaborators;

			}
		}
        return $items;
    }

}
