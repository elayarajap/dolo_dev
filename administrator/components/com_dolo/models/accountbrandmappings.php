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
class DoloModelAccountbrandmappings extends JModelList {

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
                'account_id', 'a.account_id',
                'brand_id', 'a.brand_id',
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

        
		//Filtering account_id
		$this->setState('filter.account_id', $app->getUserStateFromRequest($this->context.'.filter.account_id', 'filter_account_id', '', 'string'));

		//Filtering brand_id
		$this->setState('filter.brand_id', $app->getUserStateFromRequest($this->context.'.filter.brand_id', 'filter_brand_id', '', 'string'));


        // Load the parameters.
        $params = JComponentHelper::getParams('com_dolo');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.account_id', 'asc');
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
        $query->from('`#__dolo_account_brand_mapping` AS a');

        
		// Join over the user field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
		// Join over the foreign key 'account_id'
		$query->select('#__dolo_account_1491158.name AS accounts_name_1491158');
		$query->join('LEFT', '#__dolo_account AS #__dolo_account_1491158 ON #__dolo_account_1491158.id = a.account_id');
		// Join over the foreign key 'brand_id'
		$query->select('#__dolo_brand_1491159.name AS brands_name_1491159');
		$query->join('LEFT', '#__dolo_brand AS #__dolo_brand_1491159 ON #__dolo_brand_1491159.id = a.brand_id');

        

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
                $query->where('( a.account_id LIKE '.$search.'  OR  a.brand_id LIKE '.$search.' )');
            }
        }

        

		//Filtering account_id
		$filter_account_id = $this->state->get("filter.account_id");
		if ($filter_account_id) {
			$query->where("a.account_id = '".$db->escape($filter_account_id)."'");
		}

		//Filtering brand_id
		$filter_brand_id = $this->state->get("filter.brand_id");
		if ($filter_brand_id) {
			$query->where("a.brand_id = '".$db->escape($filter_brand_id)."'");
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

			if (isset($oneItem->account_id)) {
				$values = explode(',', $oneItem->account_id);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('name')
							->from('`#__dolo_account`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$oneItem->account_id = !empty($textValue) ? implode(', ', $textValue) : $oneItem->account_id;

			}

			if (isset($oneItem->brand_id)) {
				$values = explode(',', $oneItem->brand_id);

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

			$oneItem->brand_id = !empty($textValue) ? implode(', ', $textValue) : $oneItem->brand_id;

			}
		}
        return $items;
    }

}
