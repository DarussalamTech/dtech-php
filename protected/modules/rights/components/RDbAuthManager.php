<?php

/**
 * Rights authorization manager class file.
 *
 * @author Christoffer Niska <cniska@live.com>
 * @copyright Copyright &copy; 2010 Christoffer Niska
 * @since 0.9.7
 */
class RDbAuthManager extends CDbAuthManager {

    public $rightsTable = 'rights';
    private $_items = array();
    private $_itemChildren = array();

    /**
     * @var string the name of the table storing authorization items. Defaults to 'AuthItem'.
     */
    public $itemTable = 'authitem';

    /**
     * @var string the name of the table storing authorization item hierarchy. Defaults to 'AuthItemChild'.
     */
    public $itemChildTable = 'authitemchild';

    /**
     * @var string the name of the table storing authorization item assignments. Defaults to 'AuthAssignment'.
     */
    public $assignmentTable = 'authassignment';

    /**
     * PCM will be used to handle conditions
     * applied on for filtering
     * @var type 
     */
    public $_roleModel;

    /**
     * Adds an item as a child of another item.
     * Overloads the parent method to make sure that
     * we do not add already existing children.
     * @param string the child item name.
     * @param string $childName the child item name.
     * @throws CException if either parent or child doesn't exist or if a loop has been detected.
     */
    public function addItemChild($itemName, $childName) {
        // Make sure that the item doesn't already have this child.
        if ($this->hasItemChild($itemName, $childName) === false)
            return parent::addItemChild($itemName, $childName);
    }

    /**
     * Assigns an authorization item to a user making sure that
     * the user doesn't already have this assignment.
     * Overloads the parent method to make sure that
     * we do not assign already assigned items.
     * @param string the item name.
     * @param mixed the user ID (see {@link IWebUser::getId})
     * @param string the business rule to be executed when {@link checkAccess} is called
     * for this particular authorization item.
     * @param mixed additional data associated with this assignment.
     * @return CAuthAssignment the authorization assignment information.
     * @throws CException if the item does not exist or if the item has already been assigned to the user.
     */
    public function assign($itemName, $userId, $bizRule = null, $data = null) {
        // Make sure that this user doesn't already have this assignment.
        if ($this->getAuthAssignment($itemName, $userId) === null)
            return parent::assign($itemName, $userId, $bizRule, $data);
    }

    /**
     * Returns the authorization item with the specified name.
     * Overloads the parent method to allow for runtime caching.
     * @param string the name of the item.
     * @param boolean whether to accept cached data.
     * @return CAuthItem the authorization item. Null if the item cannot be found.
     */
    public function getAuthItem($name, $allowCaching = true) {
        // Get all items if necessary and cache them.
        if ($allowCaching && $this->_items === array())
            $this->_items = $this->getAuthItems();

        // Get the items from cache if possible.
        if ($allowCaching && isset($this->_items[$name])) {
            return $this->_items[$name];
        }
        // Attempt to get the item.
        else if (($item = parent::getAuthItem($name)) !== null) {
            return $item;
        }

        // Item does not exist.
        return null;
    }

    /**
     * Returns the specified authorization items.
     * @param array the names of the authorization items to get.
     * @param boolean whether to nest the items by type.
     * @return array the authorization items.
     */
    public function getAuthItemsByNames($names, $nested = false) {
        // Get all items if necessary and cache them.
        if ($this->_items === array())
            $this->_items = $this->getAuthItems();

        // Collect the items we want.
        $items = array();
        foreach ($this->_items as $name => $item) {
            if (in_array($name, $names)) {
                if ($nested === true)
                    $items[$item->getType()][$name] = $item;
                else
                    $items[$name] = $item;
            }
        }

        return $items;
    }

    /**
     * Returns the authorization items of the specific type and user.
     * Overloads the parent method to allow for sorting.
     * @param integer the item type (0: operation, 1: task, 2: role). Defaults to null,
     * meaning returning all items regardless of their type.
     * @param mixed the user ID. Defaults to null, meaning returning all items even if
     * they are not assigned to a user.
     * @param boolean whether to sort the items according to their weights.
     * @param Object of model to filtering the roles and authitem that will be requried to you.
     * @return array the authorization items of the specific type.
     */
    public function getAuthItems($type = null, $userId = null, $sort = true) {
        // We need to sort the items.
        
        if ($sort === true) {
            if ($type === null && $userId === null) {
                $sql = "SELECT name,t1.type,description,t1.bizrule,t1.data,weight
					FROM {$this->itemTable} t1
					LEFT JOIN {$this->rightsTable} t2 ON name=itemname
					ORDER BY t1.type DESC, weight ASC";
                $command = $this->db->createCommand($sql);
            } else if ($userId === null) {


                /**
                 * PCM customized code
                 */
                $cond = " ";
                
                if (($type == 0 || $type == 1)) {
                    if (!empty($this->_roleModel->auth_item)) {
                        $autItem = str_replace(".*", "", $this->_roleModel->auth_item);
                        $cond = " AND ( name  Like '%" . $autItem . "%') ";
                    }
                } else if ($type == 2) {
                    if (!empty($this->_roleModel->role)) {
                       
                        $cond = " AND ( name  = '".$this->_roleModel->role."') ";
                       
                    }
                }


                $sql = "SELECT name,t1.type,description,t1.bizrule,t1.data,weight
					FROM {$this->itemTable} t1
					LEFT JOIN {$this->rightsTable} t2 ON name=itemname
					WHERE t1.type=:type " . $cond . " 
                                        
					ORDER BY t1.name, t1.type DESC, weight ASC";


                $command = $this->db->createCommand($sql);

                $command->bindValue(':type', $type);
            } else if ($type === null) {
                $sql = "SELECT name,t1.type,description,t1.bizrule,t1.data,weight
					FROM {$this->itemTable} t1
					LEFT JOIN {$this->assignmentTable} t2 ON name=t2.itemname
					LEFT JOIN {$this->rightsTable} t3 ON name=t3.itemname
					WHERE userid=:userid 
					ORDER BY t1.type DESC, weight ASC";
                $command = $this->db->createCommand($sql);
                $command->bindValue(':userid', $userId);
            } else {
                $sql = "SELECT name,t1.type,description,t1.bizrule,t1.data,weight
					FROM {$this->itemTable} t1
					LEFT JOIN {$this->assignmentTable} t2 ON name=t2.itemname
					LEFT JOIN {$this->rightsTable} t3 ON name=t3.itemname
					WHERE t1.type=:type AND userid=:userid 
                                        
					ORDER BY t1.type DESC, weight ASC";
                $command = $this->db->createCommand($sql);
                $command->bindValue(':type', $type);
                $command->bindValue(':userid', $userId);
            }


            $items = array();
            foreach ($command->queryAll() as $row)
                $items[$row['name']] = new CAuthItem($this, $row['name'], $row['type'], $row['description'], $row['bizrule'], unserialize($row['data']));
        }
        // No sorting required.
        else {
            $items = parent::getAuthItems($type, $userId);
        }

        return $items;
    }

    /**
     * Returns the children of the specified item.
     * Overloads the parent method to allow for caching.
     * @param mixed $names the parent item name. This can be either a string or an array.
     * The latter represents a list of item names (available since version 1.0.5).
     * @param boolean whether to accept cached data.
     * @return array all child items of the parent
     */
    public function getItemChildren($names, $allowCaching = true) {
        // Resolve the key for runtime caching.
        $key = $names === (array) $names ? implode('|', $names) : $names;

        // Get the children from cache if possible.
        if ($allowCaching && isset($this->_itemChildren[$key]) === true) {
            return $this->_itemChildren[$key];
        }
        // Children not cached or cached data is not accepted.
        else {
            // We only have one name.
            if (is_string($names)) {
                $condition = 'parent=' . $this->db->quoteValue($names);
            }
            // We have multiple names.
            else if ($names === (array) $names && $names !== array()) {
                foreach ($names as &$name)
                    $name = $this->db->quoteValue($name);

                $condition = 'parent IN (' . implode(', ', $names) . ')';
            }

            $sql = "SELECT name, type, description, bizrule, data FROM {$this->itemTable}, {$this->itemChildTable} WHERE $condition AND name=child";
            $children = array();
            foreach ($this->db->createCommand($sql)->queryAll() as $row) {
                if (($data = @unserialize($row['data'])) === false)
                    $data = null;

                $children[$row['name']] = new CAuthItem($this, $row['name'], $row['type'], $row['description'], $row['bizrule'], $data);
            }

            // Attach the authorization item behavior.
            $children = Rights::getAuthorizer()->attachAuthItemBehavior($children);

            // Cache the result.
            return $this->_itemChildren[$key] = $children;
        }
    }

    /**
     * Updates the authorization items weight.
     * @param array the result returned from jui-sortable.
     */
    public function updateItemWeight($result) {
        foreach ($result as $weight => $itemname) {
            $sql = "SELECT COUNT(*) FROM {$this->rightsTable}
				WHERE itemname=:itemname";
            $command = $this->db->createCommand($sql);
            $command->bindValue(':itemname', $itemname);

            // Check if the item already has a weight.
            if ($command->queryScalar() > 0) {
                $sql = "UPDATE {$this->rightsTable}
					SET weight=:weight
					WHERE itemname=:itemname";
                $command = $this->db->createCommand($sql);
                $command->bindValue(':weight', $weight);
                $command->bindValue(':itemname', $itemname);
                $command->execute();
            }
            // Item does not have a weight, insert it.
            else {
                if (($item = $this->getAuthItem($itemname)) !== null) {
                    $sql = "INSERT INTO {$this->rightsTable} (itemname, type, weight)
						VALUES (:itemname, :type, :weight)";
                    $command = $this->db->createCommand($sql);
                    $command->bindValue(':itemname', $itemname);
                    $command->bindValue(':type', $item->getType());
                    $command->bindValue(':weight', $weight);
                    $command->execute();
                }
            }
        }
    }

}
