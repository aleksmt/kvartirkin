<?php

namespace Kvartirkin\Model\Bot\ActiveParsers\Base;

use \Exception;
use \PDO;
use Kvartirkin\Model\Bot\ActiveParsers\BotActiveParsers as ChildBotActiveParsers;
use Kvartirkin\Model\Bot\ActiveParsers\BotActiveParsersQuery as ChildBotActiveParsersQuery;
use Kvartirkin\Model\Bot\ActiveParsers\Map\BotActiveParsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'kvartirkin.bot_active_parsers' table.
 *
 *
 *
 * @method     ChildBotActiveParsersQuery orderByClass($order = Criteria::ASC) Order by the class column
 * @method     ChildBotActiveParsersQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildBotActiveParsersQuery orderBylastRunTs($order = Criteria::ASC) Order by the last_run_ts column
 * @method     ChildBotActiveParsersQuery orderByfromTime($order = Criteria::ASC) Order by the from_time column
 * @method     ChildBotActiveParsersQuery orderBytoTime($order = Criteria::ASC) Order by the to_time column
 *
 * @method     ChildBotActiveParsersQuery groupByClass() Group by the class column
 * @method     ChildBotActiveParsersQuery groupByActive() Group by the active column
 * @method     ChildBotActiveParsersQuery groupBylastRunTs() Group by the last_run_ts column
 * @method     ChildBotActiveParsersQuery groupByfromTime() Group by the from_time column
 * @method     ChildBotActiveParsersQuery groupBytoTime() Group by the to_time column
 *
 * @method     ChildBotActiveParsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBotActiveParsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBotActiveParsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBotActiveParsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBotActiveParsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBotActiveParsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBotActiveParsers findOne(ConnectionInterface $con = null) Return the first ChildBotActiveParsers matching the query
 * @method     ChildBotActiveParsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBotActiveParsers matching the query, or a new ChildBotActiveParsers object populated from the query conditions when no match is found
 *
 * @method     ChildBotActiveParsers findOneByClass(string $class) Return the first ChildBotActiveParsers filtered by the class column
 * @method     ChildBotActiveParsers findOneByActive(boolean $active) Return the first ChildBotActiveParsers filtered by the active column
 * @method     ChildBotActiveParsers findOneBylastRunTs(string $last_run_ts) Return the first ChildBotActiveParsers filtered by the last_run_ts column
 * @method     ChildBotActiveParsers findOneByfromTime(string $from_time) Return the first ChildBotActiveParsers filtered by the from_time column
 * @method     ChildBotActiveParsers findOneBytoTime(string $to_time) Return the first ChildBotActiveParsers filtered by the to_time column *

 * @method     ChildBotActiveParsers requirePk($key, ConnectionInterface $con = null) Return the ChildBotActiveParsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotActiveParsers requireOne(ConnectionInterface $con = null) Return the first ChildBotActiveParsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBotActiveParsers requireOneByClass(string $class) Return the first ChildBotActiveParsers filtered by the class column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotActiveParsers requireOneByActive(boolean $active) Return the first ChildBotActiveParsers filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotActiveParsers requireOneBylastRunTs(string $last_run_ts) Return the first ChildBotActiveParsers filtered by the last_run_ts column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotActiveParsers requireOneByfromTime(string $from_time) Return the first ChildBotActiveParsers filtered by the from_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotActiveParsers requireOneBytoTime(string $to_time) Return the first ChildBotActiveParsers filtered by the to_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBotActiveParsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBotActiveParsers objects based on current ModelCriteria
 * @method     ChildBotActiveParsers[]|ObjectCollection findByClass(string $class) Return ChildBotActiveParsers objects filtered by the class column
 * @method     ChildBotActiveParsers[]|ObjectCollection findByActive(boolean $active) Return ChildBotActiveParsers objects filtered by the active column
 * @method     ChildBotActiveParsers[]|ObjectCollection findBylastRunTs(string $last_run_ts) Return ChildBotActiveParsers objects filtered by the last_run_ts column
 * @method     ChildBotActiveParsers[]|ObjectCollection findByfromTime(string $from_time) Return ChildBotActiveParsers objects filtered by the from_time column
 * @method     ChildBotActiveParsers[]|ObjectCollection findBytoTime(string $to_time) Return ChildBotActiveParsers objects filtered by the to_time column
 * @method     ChildBotActiveParsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BotActiveParsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Kvartirkin\Model\Bot\ActiveParsers\Base\BotActiveParsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Kvartirkin\\Model\\Bot\\ActiveParsers\\BotActiveParsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBotActiveParsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBotActiveParsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBotActiveParsersQuery) {
            return $criteria;
        }
        $query = new ChildBotActiveParsersQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBotActiveParsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BotActiveParsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BotActiveParsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBotActiveParsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT class, active, last_run_ts, from_time, to_time FROM kvartirkin.bot_active_parsers WHERE class = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBotActiveParsers $obj */
            $obj = new ChildBotActiveParsers();
            $obj->hydrate($row);
            BotActiveParsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildBotActiveParsers|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildBotActiveParsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BotActiveParsersTableMap::COL_CLASS, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBotActiveParsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BotActiveParsersTableMap::COL_CLASS, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the class column
     *
     * Example usage:
     * <code>
     * $query->filterByClass('fooValue');   // WHERE class = 'fooValue'
     * $query->filterByClass('%fooValue%', Criteria::LIKE); // WHERE class LIKE '%fooValue%'
     * </code>
     *
     * @param     string $class The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotActiveParsersQuery The current query, for fluid interface
     */
    public function filterByClass($class = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($class)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotActiveParsersTableMap::COL_CLASS, $class, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotActiveParsersQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BotActiveParsersTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the last_run_ts column
     *
     * Example usage:
     * <code>
     * $query->filterBylastRunTs('2011-03-14'); // WHERE last_run_ts = '2011-03-14'
     * $query->filterBylastRunTs('now'); // WHERE last_run_ts = '2011-03-14'
     * $query->filterBylastRunTs(array('max' => 'yesterday')); // WHERE last_run_ts > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastRunTs The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotActiveParsersQuery The current query, for fluid interface
     */
    public function filterBylastRunTs($lastRunTs = null, $comparison = null)
    {
        if (is_array($lastRunTs)) {
            $useMinMax = false;
            if (isset($lastRunTs['min'])) {
                $this->addUsingAlias(BotActiveParsersTableMap::COL_LAST_RUN_TS, $lastRunTs['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastRunTs['max'])) {
                $this->addUsingAlias(BotActiveParsersTableMap::COL_LAST_RUN_TS, $lastRunTs['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotActiveParsersTableMap::COL_LAST_RUN_TS, $lastRunTs, $comparison);
    }

    /**
     * Filter the query on the from_time column
     *
     * Example usage:
     * <code>
     * $query->filterByfromTime('2011-03-14'); // WHERE from_time = '2011-03-14'
     * $query->filterByfromTime('now'); // WHERE from_time = '2011-03-14'
     * $query->filterByfromTime(array('max' => 'yesterday')); // WHERE from_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $fromTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotActiveParsersQuery The current query, for fluid interface
     */
    public function filterByfromTime($fromTime = null, $comparison = null)
    {
        if (is_array($fromTime)) {
            $useMinMax = false;
            if (isset($fromTime['min'])) {
                $this->addUsingAlias(BotActiveParsersTableMap::COL_FROM_TIME, $fromTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fromTime['max'])) {
                $this->addUsingAlias(BotActiveParsersTableMap::COL_FROM_TIME, $fromTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotActiveParsersTableMap::COL_FROM_TIME, $fromTime, $comparison);
    }

    /**
     * Filter the query on the to_time column
     *
     * Example usage:
     * <code>
     * $query->filterBytoTime('2011-03-14'); // WHERE to_time = '2011-03-14'
     * $query->filterBytoTime('now'); // WHERE to_time = '2011-03-14'
     * $query->filterBytoTime(array('max' => 'yesterday')); // WHERE to_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $toTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotActiveParsersQuery The current query, for fluid interface
     */
    public function filterBytoTime($toTime = null, $comparison = null)
    {
        if (is_array($toTime)) {
            $useMinMax = false;
            if (isset($toTime['min'])) {
                $this->addUsingAlias(BotActiveParsersTableMap::COL_TO_TIME, $toTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($toTime['max'])) {
                $this->addUsingAlias(BotActiveParsersTableMap::COL_TO_TIME, $toTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotActiveParsersTableMap::COL_TO_TIME, $toTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBotActiveParsers $botActiveParsers Object to remove from the list of results
     *
     * @return $this|ChildBotActiveParsersQuery The current query, for fluid interface
     */
    public function prune($botActiveParsers = null)
    {
        if ($botActiveParsers) {
            $this->addUsingAlias(BotActiveParsersTableMap::COL_CLASS, $botActiveParsers->getClass(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kvartirkin.bot_active_parsers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BotActiveParsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BotActiveParsersTableMap::clearInstancePool();
            BotActiveParsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BotActiveParsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BotActiveParsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BotActiveParsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BotActiveParsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BotActiveParsersQuery
