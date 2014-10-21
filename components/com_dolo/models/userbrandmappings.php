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
class DoloModelUserbrandmappings extends JModelList
{

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'state', 'a.state',
                'created_by', 'a.created_by',
                'user_id', 'a.user_id',
                'brand_id', 'a.brand_id',

            );
        }
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since    1.6
     */
    protected function populateState($ordering = null, $direction = null)
    {

        // Initialise variables.
        $app = JFactory::getApplication();

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        

        
        //Filtering user_id
        $this->setState('filter.user_id', $app->getUserStateFromRequest($this->context.'.filter.user_id', 'filter_user_id', '', 'string'));

        //Filtering brand_id
        $this->setState('filter.brand_id', $app->getUserStateFromRequest($this->context.'.filter.brand_id', 'filter_brand_id', '', 'string'));


        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return    JDatabaseQuery
     * @since    1.6
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query
            ->select(
                $this->getState(
                    'list.select', 'DISTINCT a.*'
                )
            );

        $query->from('`#__dolo_user_brand_mapping` AS a');

        
        // Join over the created by field 'created_by'
        $query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
        // Join over the foreign key 'user_id'
        $query->select('#__users_1506970.name AS users_name_1506970');
        $query->join('LEFT', '#__users AS #__users_1506970 ON #__users_1506970.id = a.user_id');
        

        $userinfo_acc = JFactory::getUser();
        $isAdmin = $userinfo_acc->get('isRoot');
        if(!$isAdmin)
        {
            $query->join('INNER', '#__dolo_account_user_mapping AS cuser ON cuser.user_id = #__users_1506970.id');
        }


        // Join over the foreign key 'brand_id'
        $query->select('#__dolo_brand_1507020.name AS brands_name_1507020');
        $query->join('LEFT', '#__dolo_brand AS #__dolo_brand_1507020 ON #__dolo_brand_1507020.id = a.brand_id');

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int)substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                
            }
        }

        

        //Filtering user_id
        $filter_user_id = $this->state->get("filter.user_id");
        if ($filter_user_id) {
            $query->where("a.user_id = '".$db->escape($filter_user_id)."'");
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

    public function getItems()
    {
        $items = parent::getItems();
        foreach($items as $item){
    

            if (isset($item->user_id) && $item->user_id != '') {
                if(is_object($item->user_id)){
                    $item->user_id = JArrayHelper::fromObject($item->user_id);
                }
                $values = (is_array($item->user_id)) ? $item->user_id : explode(',',$item->user_id);

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

            $item->user_id = !empty($textValue) ? implode(', ', $textValue) : $item->user_id;

            }

            if (isset($item->brand_id) && $item->brand_id != '') {
                if(is_object($item->brand_id)){
                    $item->brand_id = JArrayHelper::fromObject($item->brand_id);
                }
                $values = (is_array($item->brand_id)) ? $item->brand_id : explode(',',$item->brand_id);

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

            $item->brand_id = !empty($textValue) ? implode(', ', $textValue) : $item->brand_id;

            }
}
        return $items;
    }
}