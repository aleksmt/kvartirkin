<?php

namespace Kvartirkin\Model\Bot\Users\Base;

use \Exception;
use \PDO;
use Kvartirkin\Model\Bot\Users\BotUsers as ChildBotUsers;
use Kvartirkin\Model\Bot\Users\BotUsersQuery as ChildBotUsersQuery;
use Kvartirkin\Model\Bot\Users\Map\BotUsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'kvartirkin.bot_users' table.
 *
 *
 *
 * @method     ChildBotUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBotUsersQuery orderByTId($order = Criteria::ASC) Order by the t_id column
 * @method     ChildBotUsersQuery orderByTName($order = Criteria::ASC) Order by the t_name column
 * @method     ChildBotUsersQuery orderByTLastMessage($order = Criteria::ASC) Order by the t_last_message column
 * @method     ChildBotUsersQuery orderByTBotActive($order = Criteria::ASC) Order by the t_bot_active column
 * @method     ChildBotUsersQuery orderByTNotifyFromTime($order = Criteria::ASC) Order by the t_from_time column
 * @method     ChildBotUsersQuery orderByTNotifyToTime($order = Criteria::ASC) Order by the t_to_time column
 *
 * @method     ChildBotUsersQuery groupById() Group by the id column
 * @method     ChildBotUsersQuery groupByTId() Group by the t_id column
 * @method     ChildBotUsersQuery groupByTName() Group by the t_name column
 * @method     ChildBotUsersQuery groupByTLastMessage() Group by the t_last_message column
 * @method     ChildBotUsersQuery groupByTBotActive() Group by the t_bot_active column
 * @method     ChildBotUsersQuery groupByTNotifyFromTime() Group by the t_from_time column
 * @method     ChildBotUsersQuery groupByTNotifyToTime() Group by the t_to_time column
 *
 * @method     ChildBotUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBotUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBotUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBotUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBotUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBotUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBotUsers findOne(ConnectionInterface $con = null) Return the first ChildBotUsers matching the query
 * @method     ChildBotUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBotUsers matching the query, or a new ChildBotUsers object populated from the query conditions when no match is found
 *
 * @method     ChildBotUsers findOneById(string $id) Return the first ChildBotUsers filtered by the id column
 * @method     ChildBotUsers findOneByTId(string $t_id) Return the first ChildBotUsers filtered by the t_id column
 * @method     ChildBotUsers findOneByTName(string $t_name) Return the first ChildBotUsers filtered by the t_name column
 * @method     ChildBotUsers findOneByTLastMessage(string $t_last_message) Return the first ChildBotUsers filtered by the t_last_message column
 * @method     ChildBotUsers findOneByTBotActive(boolean $t_bot_active) Return the first ChildBotUsers filtered by the t_bot_active column
 * @method     ChildBotUsers findOneByTNotifyFromTime(string $t_from_time) Return the first ChildBotUsers filtered by the t_from_time column
 * @method     ChildBotUsers findOneByTNotifyToTime(string $t_to_time) Return the first ChildBotUsers filtered by the t_to_time column *

 * @method     ChildBotUsers requirePk($key, ConnectionInterface $con = null) Return the ChildBotUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotUsers requireOne(ConnectionInterface $con = null) Return the first ChildBotUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBotUsers requireOneById(string $id) Return the first ChildBotUsers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotUsers requireOneByTId(string $t_id) Return the first ChildBotUsers filtered by the t_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotUsers requireOneByTName(string $t_name) Return the first ChildBotUsers filtered by the t_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotUsers requireOneByTLastMessage(string $t_last_message) Return the first ChildBotUsers filtered by the t_last_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotUsers requireOneByTBotActive(boolean $t_bot_active) Return the first ChildBotUsers filtered by the t_bot_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotUsers requireOneByTNotifyFromTime(string $t_from_time) Return the first ChildBotUsers filtered by the t_from_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBotUsers requireOneByTNotifyToTime(string $t_to_time) Return the first ChildBotUsers filtered by the t_to_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBotUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBotUsers objects based on current ModelCriteria
 * @method     ChildBotUsers[]|ObjectCollection findById(string $id) Return ChildBotUsers objects filtered by the id column
 * @method     ChildBotUsers[]|ObjectCollection findByTId(string $t_id) Return ChildBotUsers objects filtered by the t_id column
 * @method     ChildBotUsers[]|ObjectCollection findByTName(string $t_name) Return ChildBotUsers objects filtered by the t_name column
 * @method     ChildBotUsers[]|ObjectCollection findByTLastMessage(string $t_last_message) Return ChildBotUsers objects filtered by the t_last_message column
 * @method     ChildBotUsers[]|ObjectCollection findByTBotActive(boolean $t_bot_active) Return ChildBotUsers objects filtered by the t_bot_active column
 * @method     ChildBotUsers[]|ObjectCollection findByTNotifyFromTime(string $t_from_time) Return ChildBotUsers objects filtered by the t_from_time column
 * @method     ChildBotUsers[]|ObjectCollection findByTNotifyToTime(string $t_to_time) Return ChildBotUsers objects filtered by the t_to_time column
 * @method     ChildBotUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BotUsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Kvartirkin\Model\Bot\Users\Base\BotUsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Kvartirkin\\Model\\Bot\\Users\\BotUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBotUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBotUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBotUsersQuery) {
            return $criteria;
        }
        $query = new ChildBotUsersQuery();
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
     * @return ChildBotUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BotUsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BotUsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBotUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, t_id, t_name, t_last_message, t_bot_active, t_from_time, t_to_time FROM kvartirkin.bot_users WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBotUsers $obj */
            $obj = new ChildBotUsers();
            $obj->hydrate($row);
            BotUsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBotUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BotUsersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BotUsersTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BotUsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BotUsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotUsersTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the t_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTId(1234); // WHERE t_id = 1234
     * $query->filterByTId(array(12, 34)); // WHERE t_id IN (12, 34)
     * $query->filterByTId(array('min' => 12)); // WHERE t_id > 12
     * </code>
     *
     * @param     mixed $tId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterByTId($tId = null, $comparison = null)
    {
        if (is_array($tId)) {
            $useMinMax = false;
            if (isset($tId['min'])) {
                $this->addUsingAlias(BotUsersTableMap::COL_T_ID, $tId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tId['max'])) {
                $this->addUsingAlias(BotUsersTableMap::COL_T_ID, $tId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotUsersTableMap::COL_T_ID, $tId, $comparison);
    }

    /**
     * Filter the query on the t_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTName('fooValue');   // WHERE t_name = 'fooValue'
     * $query->filterByTName('%fooValue%', Criteria::LIKE); // WHERE t_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterByTName($tName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotUsersTableMap::COL_T_NAME, $tName, $comparison);
    }

    /**
     * Filter the query on the t_last_message column
     *
     * Example usage:
     * <code>
     * $query->filterByTLastMessage('fooValue');   // WHERE t_last_message = 'fooValue'
     * $query->filterByTLastMessage('%fooValue%', Criteria::LIKE); // WHERE t_last_message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tLastMessage The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterByTLastMessage($tLastMessage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tLastMessage)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotUsersTableMap::COL_T_LAST_MESSAGE, $tLastMessage, $comparison);
    }

    /**
     * Filter the query on the t_bot_active column
     *
     * Example usage:
     * <code>
     * $query->filterByTBotActive(true); // WHERE t_bot_active = true
     * $query->filterByTBotActive('yes'); // WHERE t_bot_active = true
     * </code>
     *
     * @param     boolean|string $tBotActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterByTBotActive($tBotActive = null, $comparison = null)
    {
        if (is_string($tBotActive)) {
            $tBotActive = in_array(strtolower($tBotActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BotUsersTableMap::COL_T_BOT_ACTIVE, $tBotActive, $comparison);
    }

    /**
     * Filter the query on the t_from_time column
     *
     * Example usage:
     * <code>
     * $query->filterByTNotifyFromTime('2011-03-14'); // WHERE t_from_time = '2011-03-14'
     * $query->filterByTNotifyFromTime('now'); // WHERE t_from_time = '2011-03-14'
     * $query->filterByTNotifyFromTime(array('max' => 'yesterday')); // WHERE t_from_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $tNotifyFromTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterByTNotifyFromTime($tNotifyFromTime = null, $comparison = null)
    {
        if (is_array($tNotifyFromTime)) {
            $useMinMax = false;
            if (isset($tNotifyFromTime['min'])) {
                $this->addUsingAlias(BotUsersTableMap::COL_T_FROM_TIME, $tNotifyFromTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tNotifyFromTime['max'])) {
                $this->addUsingAlias(BotUsersTableMap::COL_T_FROM_TIME, $tNotifyFromTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotUsersTableMap::COL_T_FROM_TIME, $tNotifyFromTime, $comparison);
    }

    /**
     * Filter the query on the t_to_time column
     *
     * Example usage:
     * <code>
     * $query->filterByTNotifyToTime('2011-03-14'); // WHERE t_to_time = '2011-03-14'
     * $query->filterByTNotifyToTime('now'); // WHERE t_to_time = '2011-03-14'
     * $query->filterByTNotifyToTime(array('max' => 'yesterday')); // WHERE t_to_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $tNotifyToTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function filterByTNotifyToTime($tNotifyToTime = null, $comparison = null)
    {
        if (is_array($tNotifyToTime)) {
            $useMinMax = false;
            if (isset($tNotifyToTime['min'])) {
                $this->addUsingAlias(BotUsersTableMap::COL_T_TO_TIME, $tNotifyToTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tNotifyToTime['max'])) {
                $this->addUsingAlias(BotUsersTableMap::COL_T_TO_TIME, $tNotifyToTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BotUsersTableMap::COL_T_TO_TIME, $tNotifyToTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBotUsers $botUsers Object to remove from the list of results
     *
     * @return $this|ChildBotUsersQuery The current query, for fluid interface
     */
    public function prune($botUsers = null)
    {
        if ($botUsers) {
            $this->addUsingAlias(BotUsersTableMap::COL_ID, $botUsers->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kvartirkin.bot_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BotUsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BotUsersTableMap::clearInstancePool();
            BotUsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BotUsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BotUsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BotUsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BotUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BotUsersQuery
