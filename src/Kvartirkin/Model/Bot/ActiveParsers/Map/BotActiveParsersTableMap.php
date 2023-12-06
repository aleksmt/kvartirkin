<?php

namespace Kvartirkin\Model\Bot\ActiveParsers\Map;

use Kvartirkin\Model\Bot\ActiveParsers\BotActiveParsers;
use Kvartirkin\Model\Bot\ActiveParsers\BotActiveParsersQuery;
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
 * This class defines the structure of the 'kvartirkin.bot_active_parsers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BotActiveParsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Kvartirkin.Model.Bot.ActiveParsers.Map.BotActiveParsersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kvartirkin.bot_active_parsers';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Kvartirkin\\Model\\Bot\\ActiveParsers\\BotActiveParsers';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Kvartirkin.Model.Bot.ActiveParsers.BotActiveParsers';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the class field
     */
    const COL_CLASS = 'kvartirkin.bot_active_parsers.class';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'kvartirkin.bot_active_parsers.active';

    /**
     * the column name for the last_run_ts field
     */
    const COL_LAST_RUN_TS = 'kvartirkin.bot_active_parsers.last_run_ts';

    /**
     * the column name for the from_time field
     */
    const COL_FROM_TIME = 'kvartirkin.bot_active_parsers.from_time';

    /**
     * the column name for the to_time field
     */
    const COL_TO_TIME = 'kvartirkin.bot_active_parsers.to_time';

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
        self::TYPE_PHPNAME       => array('Class', 'Active', 'lastRunTs', 'fromTime', 'toTime', ),
        self::TYPE_CAMELNAME     => array('class', 'active', 'lastRunTs', 'fromTime', 'toTime', ),
        self::TYPE_COLNAME       => array(BotActiveParsersTableMap::COL_CLASS, BotActiveParsersTableMap::COL_ACTIVE, BotActiveParsersTableMap::COL_LAST_RUN_TS, BotActiveParsersTableMap::COL_FROM_TIME, BotActiveParsersTableMap::COL_TO_TIME, ),
        self::TYPE_FIELDNAME     => array('class', 'active', 'last_run_ts', 'from_time', 'to_time', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Class' => 0, 'Active' => 1, 'lastRunTs' => 2, 'fromTime' => 3, 'toTime' => 4, ),
        self::TYPE_CAMELNAME     => array('class' => 0, 'active' => 1, 'lastRunTs' => 2, 'fromTime' => 3, 'toTime' => 4, ),
        self::TYPE_COLNAME       => array(BotActiveParsersTableMap::COL_CLASS => 0, BotActiveParsersTableMap::COL_ACTIVE => 1, BotActiveParsersTableMap::COL_LAST_RUN_TS => 2, BotActiveParsersTableMap::COL_FROM_TIME => 3, BotActiveParsersTableMap::COL_TO_TIME => 4, ),
        self::TYPE_FIELDNAME     => array('class' => 0, 'active' => 1, 'last_run_ts' => 2, 'from_time' => 3, 'to_time' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('kvartirkin.bot_active_parsers');
        $this->setPhpName('BotActiveParsers');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Kvartirkin\\Model\\Bot\\ActiveParsers\\BotActiveParsers');
        $this->setPackage('Kvartirkin.Model.Bot.ActiveParsers');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('class', 'Class', 'LONGVARCHAR', true, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, null, false);
        $this->addColumn('last_run_ts', 'lastRunTs', 'TIMESTAMP', false, null, '1970-01-01 00:00:00');
        $this->addColumn('from_time', 'fromTime', 'TIME', false, null, '10:00:00');
        $this->addColumn('to_time', 'toTime', 'TIME', false, null, '22:00:00');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BotActiveParsersTableMap::CLASS_DEFAULT : BotActiveParsersTableMap::OM_CLASS;
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
     * @return array           (BotActiveParsers object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BotActiveParsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BotActiveParsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BotActiveParsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BotActiveParsersTableMap::OM_CLASS;
            /** @var BotActiveParsers $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BotActiveParsersTableMap::addInstanceToPool($obj, $key);
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
            $key = BotActiveParsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BotActiveParsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BotActiveParsers $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BotActiveParsersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BotActiveParsersTableMap::COL_CLASS);
            $criteria->addSelectColumn(BotActiveParsersTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(BotActiveParsersTableMap::COL_LAST_RUN_TS);
            $criteria->addSelectColumn(BotActiveParsersTableMap::COL_FROM_TIME);
            $criteria->addSelectColumn(BotActiveParsersTableMap::COL_TO_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.class');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.last_run_ts');
            $criteria->addSelectColumn($alias . '.from_time');
            $criteria->addSelectColumn($alias . '.to_time');
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
        return Propel::getServiceContainer()->getDatabaseMap(BotActiveParsersTableMap::DATABASE_NAME)->getTable(BotActiveParsersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BotActiveParsersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BotActiveParsersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BotActiveParsersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a BotActiveParsers or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or BotActiveParsers object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BotActiveParsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Kvartirkin\Model\Bot\ActiveParsers\BotActiveParsers) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BotActiveParsersTableMap::DATABASE_NAME);
            $criteria->add(BotActiveParsersTableMap::COL_CLASS, (array) $values, Criteria::IN);
        }

        $query = BotActiveParsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BotActiveParsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BotActiveParsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kvartirkin.bot_active_parsers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BotActiveParsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BotActiveParsers or Criteria object.
     *
     * @param mixed               $criteria Criteria or BotActiveParsers object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BotActiveParsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BotActiveParsers object
        }


        // Set the correct dbName
        $query = BotActiveParsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BotActiveParsersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BotActiveParsersTableMap::buildTableMap();
