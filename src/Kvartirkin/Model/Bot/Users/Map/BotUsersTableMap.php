<?php

namespace Kvartirkin\Model\Bot\Users\Map;

use Kvartirkin\Model\Bot\Users\BotUsers;
use Kvartirkin\Model\Bot\Users\BotUsersQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'kvartirkin.bot_users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BotUsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Kvartirkin.Model.Bot.Users.Map.BotUsersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kvartirkin.bot_users';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Kvartirkin\\Model\\Bot\\Users\\BotUsers';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Kvartirkin.Model.Bot.Users.BotUsers';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kvartirkin.bot_users.id';

    /**
     * the column name for the t_id field
     */
    const COL_T_ID = 'kvartirkin.bot_users.t_id';

    /**
     * the column name for the t_name field
     */
    const COL_T_NAME = 'kvartirkin.bot_users.t_name';

    /**
     * the column name for the t_last_message field
     */
    const COL_T_LAST_MESSAGE = 'kvartirkin.bot_users.t_last_message';

    /**
     * the column name for the t_bot_active field
     */
    const COL_T_BOT_ACTIVE = 'kvartirkin.bot_users.t_bot_active';

    /**
     * the column name for the t_from_time field
     */
    const COL_T_FROM_TIME = 'kvartirkin.bot_users.t_from_time';

    /**
     * the column name for the t_to_time field
     */
    const COL_T_TO_TIME = 'kvartirkin.bot_users.t_to_time';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'TId', 'TName', 'TLastMessage', 'TBotActive', 'TNotifyFromTime', 'TNotifyToTime', ),
        self::TYPE_CAMELNAME     => array('id', 'tId', 'tName', 'tLastMessage', 'tBotActive', 'tNotifyFromTime', 'tNotifyToTime', ),
        self::TYPE_COLNAME       => array(BotUsersTableMap::COL_ID, BotUsersTableMap::COL_T_ID, BotUsersTableMap::COL_T_NAME, BotUsersTableMap::COL_T_LAST_MESSAGE, BotUsersTableMap::COL_T_BOT_ACTIVE, BotUsersTableMap::COL_T_FROM_TIME, BotUsersTableMap::COL_T_TO_TIME, ),
        self::TYPE_FIELDNAME     => array('id', 't_id', 't_name', 't_last_message', 't_bot_active', 't_from_time', 't_to_time', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'TId' => 1, 'TName' => 2, 'TLastMessage' => 3, 'TBotActive' => 4, 'TNotifyFromTime' => 5, 'TNotifyToTime' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'tId' => 1, 'tName' => 2, 'tLastMessage' => 3, 'tBotActive' => 4, 'tNotifyFromTime' => 5, 'tNotifyToTime' => 6, ),
        self::TYPE_COLNAME       => array(BotUsersTableMap::COL_ID => 0, BotUsersTableMap::COL_T_ID => 1, BotUsersTableMap::COL_T_NAME => 2, BotUsersTableMap::COL_T_LAST_MESSAGE => 3, BotUsersTableMap::COL_T_BOT_ACTIVE => 4, BotUsersTableMap::COL_T_FROM_TIME => 5, BotUsersTableMap::COL_T_TO_TIME => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 't_id' => 1, 't_name' => 2, 't_last_message' => 3, 't_bot_active' => 4, 't_from_time' => 5, 't_to_time' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('kvartirkin.bot_users');
        $this->setPhpName('BotUsers');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Kvartirkin\\Model\\Bot\\Users\\BotUsers');
        $this->setPackage('Kvartirkin.Model.Bot.Users');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('kvartirkin.bot_users_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addColumn('t_id', 'TId', 'BIGINT', true, null, null);
        $this->addColumn('t_name', 'TName', 'LONGVARCHAR', false, null, null);
        $this->addColumn('t_last_message', 'TLastMessage', 'VARCHAR', false, null, null);
        $this->addColumn('t_bot_active', 'TBotActive', 'BOOLEAN', false, null, true);
        $this->addColumn('t_from_time', 'TNotifyFromTime', 'TIME', false, null, '10:00:00');
        $this->addColumn('t_to_time', 'TNotifyToTime', 'TIME', false, null, '22:00:00');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? BotUsersTableMap::CLASS_DEFAULT : BotUsersTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (BotUsers object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BotUsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BotUsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BotUsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BotUsersTableMap::OM_CLASS;
            /** @var BotUsers $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BotUsersTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = BotUsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BotUsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BotUsers $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BotUsersTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(BotUsersTableMap::COL_ID);
            $criteria->addSelectColumn(BotUsersTableMap::COL_T_ID);
            $criteria->addSelectColumn(BotUsersTableMap::COL_T_NAME);
            $criteria->addSelectColumn(BotUsersTableMap::COL_T_LAST_MESSAGE);
            $criteria->addSelectColumn(BotUsersTableMap::COL_T_BOT_ACTIVE);
            $criteria->addSelectColumn(BotUsersTableMap::COL_T_FROM_TIME);
            $criteria->addSelectColumn(BotUsersTableMap::COL_T_TO_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.t_id');
            $criteria->addSelectColumn($alias . '.t_name');
            $criteria->addSelectColumn($alias . '.t_last_message');
            $criteria->addSelectColumn($alias . '.t_bot_active');
            $criteria->addSelectColumn($alias . '.t_from_time');
            $criteria->addSelectColumn($alias . '.t_to_time');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(BotUsersTableMap::DATABASE_NAME)->getTable(BotUsersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BotUsersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BotUsersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BotUsersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a BotUsers or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or BotUsers object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BotUsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Kvartirkin\Model\Bot\Users\BotUsers) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BotUsersTableMap::DATABASE_NAME);
            $criteria->add(BotUsersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = BotUsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BotUsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BotUsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kvartirkin.bot_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BotUsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BotUsers or Criteria object.
     *
     * @param mixed               $criteria Criteria or BotUsers object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BotUsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BotUsers object
        }

        if ($criteria->containsKey(BotUsersTableMap::COL_ID) && $criteria->keyContainsValue(BotUsersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BotUsersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = BotUsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BotUsersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BotUsersTableMap::buildTableMap();
