<?php


class Db implements DatabaseDriver
{

	private static $connection;
	private static $statement;
	private static $result;
	private static $lastId;
	private static $env;

	/***
	 * Set operation mode of the server
	 * production of development
	 * @param String $enviroment mode of the current operation (dev/prod)
	 * @return void
	 */

	public static function setEnv($enviroment)
	{
		Db::$env = $enviroment;
	}

	/***
	 * @param string $msg msg to be send to client in development mode
	 */
	public static function sendError($msg)
	{
		if (Db::$env == 'dev') {
			$response = array(
				'status' => 'error',
				'message' => 'MySql Error: ' . $msg,
			);
			echo json_encode($response);
			exit;
		} elseif (Db::$env == 'prod') {
			$response = array(
				'status' => 'error',
				'message' => 'Something went wrong. See API log for more information',
			);
			echo json_encode($response);
			exit;
		}
	}

	public static function connect()
	{

		try {
			Db::$connection = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);
			Db::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			Db::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
			Db::$connection->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			Db::$connection->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);
		} catch (PDOException $e) {
			Log::error($e->getMessage());
			Db::sendError($e->getMessage());
		}
	}

	public static function query($query)
	{
		Db::connect();

		// prepare statement
		try {
			Db::$statement = Db::$connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		} catch (PDOException $e) {
			Log::error($e->getMessage());
			Db::sendError($e->getMessage());
		}
	}

	public static function insertQuery($table, $array)
	{
		Db::connect();

		$fields	= array_keys($array);
		$values	= array_values($array);
		foreach ($array as $column => $value) {
			$field = ':' . $column;
			$formattedFields[] = $field;
			$formattedValues[$field] = $value;
		}

		$query = "INSERT INTO " . $table . " (";
		$query .= implode(", ", $fields) . ") ";
		$query .= "VALUES( ";
		$query .= implode(", ", $formattedFields);
		$query .= ")";

		//echo "$query"; exit();
		// prepare statement
		try {

			Db::$statement = Db::$connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			Db::$statement->execute($formattedValues);
		} catch (PDOException $e) {
			Log::error($e->getMessage());
			Db::sendError($e->getMessage());
		}

		Db::$lastId = Db::$connection->lastInsertId();
	}

	public static function updateQuery($table, $array, $whereCondition)
	{

		Db::connect();
		$fields	= array_keys($array);
		$values	= array_values($array);


		foreach ($array as $column => $value) {
			$field = ':' . $column;
			$formattedFields[] = $field;
			$formattedValues[$field] = $value;
			$formattedKeyValue[] = ' ' . $column . ' = ' . $field;
		}
		/*if($whereCondition != "") {
			$formattedValues = array_merge($formattedValues, $whereCondition['values']);
		}
*/
		$query = "UPDATE " . $table . " SET ";
		$query .= implode(", ", $formattedKeyValue);
		if ($whereCondition != "") {
			$query .= " WHERE " . $whereCondition;
		}

		// echo"<pre>";

		//

		// prepare statement
		try {
			//echo "<pre/>";print_r($formattedValues);exit;

			Db::$statement = Db::$connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			Db::$statement->execute($formattedValues);
		} catch (PDOException $e) {
			Log::error($e->getMessage());
			Db::sendError($e->getMessage());
		}
	}


	public static function executeOnly($variables = NULL)
	{
		try {
			Db::$statement->execute($variables);
		} catch (PDOException $e) {
			Log::error($e->getMessage());
			Db::sendError($e->getMessage());
		}
	}

	public static function execute($variables = NULL, $assoc = true)
	{
		try {

			Db::$statement->execute($variables);
			Db::$result = Db::$statement->fetchAll(PDO::FETCH_ASSOC);


			// If only one result row
			if (!$assoc) {
				if (count(Db::$result) <= 1) {
					Db::$result = end(Db::$result);
				}
			}

			return Db::$result;
		} catch (PDOException $e) {
			Log::error($e->getMessage());
			Db::sendError($e->getMessage());
		}
	}
	//====
	public static function executeOne($variables = NULL, $assoc = false)
	{


		try {

			Db::$statement->execute($variables);
			Db::$result = Db::$statement->fetchAll(PDO::FETCH_ASSOC);


			// If only one result row
			if (!$assoc) {
				if (count(Db::$result) <= 1) {
					Db::$result = end(Db::$result);
				}
			}

			return Db::$result;
		} catch (PDOException $e) {
			Log::error($e->getMessage());
			Db::sendError($e->getMessage());
		}
	}

	//===
	public static function result()
	{

		return Db::$result;
	}
	public static function lastId()
	{
		return Db::$lastId;
	}
	//delete

	public static function DeleteQuery($table, $qry, $whereCondition)
	{

		$query = "DELETE FROM " . $table;
		if ($whereCondition != "") {
			$query .= " WHERE " . $whereCondition;
		}

		try {
			echo $query;
			Db::$statement = Db::$connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			Db::$statement->execute();
		} catch (PDOException $e) {
			Log::error($e->getMessage());
			Db::sendError($e->getMessage());
		}
	}
}
