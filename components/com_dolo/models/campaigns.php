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
class DoloModelCampaigns extends JModelList
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

        

        
		//Filtering brandid
		$this->setState('filter.brandid', $app->getUserStateFromRequest($this->context.'.filter.brandid', 'filter_brandid', '', 'string'));

		//Filtering campaignstatus_id
		$this->setState('filter.campaignstatus_id', $app->getUserStateFromRequest($this->context.'.filter.campaignstatus_id', 'filter_campaignstatus_id', '', 'string'));


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

    	require_once("./configuration.php");
		$jconfig = new JConfig();
		$db_error = "I am sorry! There is an error in db connection.";
		$db_config = mysql_connect( $jconfig->host, $jconfig->user, $jconfig->password ) or die( $db_error );
		mysql_select_db( $jconfig->db, $db_config ) or die( $db_error );

    	$db1=JFactory::getDBO();
		$user_for_campaign = JFactory::getUser();
		foreach ($user_for_campaign->groups as $groupId => $value){
		$db1 = JFactory::getDbo();
		$db1->setQuery(
		'SELECT `title`' .
		' FROM `#__usergroups`' .
		' WHERE `id` = '. (int) $groupId
		);
		}
		$currentUserId = $user_for_campaign->get('id');
		$isAdmin = $user_for_campaign->get('isRoot');
		$groupNames = $db1->loadResult();

		$userinfo_acc = JFactory::getUser();
		$current_user_acc = $userinfo_acc->id;
		$account_info = mysql_query("SELECT account_id FROM ".$jconfig->dbprefix."dolo_account_user_mapping WHERE user_id=$current_user_acc");
		$row = mysql_fetch_array($account_info);
		$accid = $row[0];
		
		$result_collabr=mysql_query("SELECT user_id FROM ".$jconfig->dbprefix."dolo_account_user_mapping WHERE account_id=$accid");

		$tmparr = array();
		while($tmpvar = mysql_fetch_array($result_collabr))
		{
			$tmparr[] = $tmpvar["user_id"];
		}

		$implode_func = implode(",", $tmparr);

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

        $query->from('`#__dolo_campaign` AS a');

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

		if($isAdmin) {
		}
		elseif($groupNames=='ums') {
			$query->where('a.created_by IN ('.$implode_func.')');
		}
		else{
			$query->where('( a.created_by = '.$currentUserId.' ) OR ( FIND_IN_SET('.$currentUserId.', a.collaborators) )');
		}        

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int)substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.name LIKE '.$search.' )');
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

    public function getItems()
    {
        $items = parent::getItems();
        foreach($items as $item){
	

			if (isset($item->brandid) && $item->brandid != '') {
				if(is_object($item->brandid)){
					$item->brandid = JArrayHelper::fromObject($item->brandid);
				}
				$values = (is_array($item->brandid)) ? $item->brandid : explode(',',$item->brandid);

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

			$item->brandid = !empty($textValue) ? implode(', ', $textValue) : $item->brandid;

			}

			if (isset($item->campaigntype_id) && $item->campaigntype_id != '') {
				if(is_object($item->campaigntype_id)){
					$item->campaigntype_id = JArrayHelper::fromObject($item->campaigntype_id);
				}
				$values = (is_array($item->campaigntype_id)) ? $item->campaigntype_id : explode(',',$item->campaigntype_id);

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

			$item->campaigntype_id = !empty($textValue) ? implode(', ', $textValue) : $item->campaigntype_id;

			}

			if (isset($item->campaignstatus_id) && $item->campaignstatus_id != '') {
				if(is_object($item->campaignstatus_id)){
					$item->campaignstatus_id = JArrayHelper::fromObject($item->campaignstatus_id);
				}
				$values = (is_array($item->campaignstatus_id)) ? $item->campaignstatus_id : explode(',',$item->campaignstatus_id);

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

			$item->campaignstatus_id = !empty($textValue) ? implode(', ', $textValue) : $item->campaignstatus_id;

			}

				if ( isset($item->hero_images) ) {
					// Catch the item tags (string with ',' coma glue)
					$tags = explode(",",$item->hero_images);

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
					$item->hero_images = !empty($namedTags) ? implode(', ',$namedTags) : $item->hero_images;
		}


		if ( isset($item->keywords) ) {
					// Catch the item tags (string with ',' coma glue)
					$tags = explode(",",$item->keywords);

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
					$item->keywords = !empty($namedTags) ? implode(', ',$namedTags) : $item->keywords;
		}
		

			if (isset($item->collaborators) && $item->collaborators != '') {
				if(is_object($item->collaborators)){
					$item->collaborators = JArrayHelper::fromObject($item->collaborators);
				}
				$values = (is_array($item->collaborators)) ? $item->collaborators : explode(',',$item->collaborators);

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

			$item->collaborators = !empty($textValue) ? implode(', ', $textValue) : $item->collaborators;

			}
}
        return $items;
    }
}