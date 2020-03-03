<?php
	class connection
	{
		private $conn;
		public $error;

		function connect()
		{
			try 
			{
				$this->conn = new PDO("mysql:host=localhost;dbname=contador_de_faltas", "mysql", "mysql1234");
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return true;
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return false;
			}
		}

		function getRows($table, $columns, ...$where)
		{
			try
			{
				if(count($where) == 0)
				{
					$resultado = $this->conn->query("SELECT $columns FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
				}
				else
				{
					$resultado = $this->conn->query("SELECT $columns FROM `$table` WHERE $where[0]")->fetchAll(PDO::FETCH_ASSOC);
				}

				return $resultado;
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return null;
			}
		}

		function tableSize($table)
		{
			try
			{
				$resultado = (int)$this->conn->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
				return $resultado;
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return null;			
			}
		}

		function getConnection()
		{
			return $this->conn;
		}

		function insert($table, $order, ...$values)
		{
			try
			{
				$sql = "INSERT INTO `$table`($order) VALUES(\"$values[0]\"";
				array_shift($values);
				foreach ($values as $value) 
				{
					$sql .= ", \"$value\"";
				}

				$sql .= ")";

				$this->conn->exec($sql);
				return true;
			}
			catch(Exception  $e)
			{
				$this->error = $e->getMessage();
				return false;
			}
		}

		function createTable($table, ...$columns)
		{
			try
			{
				$sql = "CREATE TABLE `$table`($columns[0]";
				array_shift($columns);

				foreach($columns as $column)
				{
					$sql .= ", $column";
				}

				$sql .= ")";

				$this->conn->exec($sql);

				return true;
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return false;
			}
		}

		function autoIncrement($table, $column)
		{
			if($this->tableSize($table) === 0)
			{
				return 1;
			}
			else
			{
				$id = 1;

				$query = $this->getRows($table, $column);

				if($query)
				{
					foreach ($query as $row)
					{
						if($id < $row['ID'])
						{
							break;
						}

						$id = $row['ID'] + 1;
					}

					return $id;
				}
				else
				{
					return null;
				}
			}
		}

		function update($table, $update, ...$where)
		{
			if(count($where) == 0)
			{
				try
				{
					$this->conn->exec("UPDATE `$table` SET $update");
					return true;
				}
				catch(Exception $e)
				{
					$this->error = $e->getMessage();
					return false;
				}
			}
			else
			{
				try
				{
					$this->conn->exec("UPDATE `$table` SET $update WHERE $where[0]");
					return true;
				}
				catch(Exception $e)
				{
					$this->error = $e->getMessage();
					return false;
				}
			}
		}

		function existsTable($table)
		{
			try
			{
        $result = $this->conn->query("SHOW TABLES LIKE '$table'")->fetchAll(PDO::FETCH_NUM);

				if(count($result) > 0)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return false;
			}
		}

		function existsItem($table, $column, $item)
		{
			try
			{
				$result = $this->conn->query("SELECT $column FROM `$table` WHERE $column = '$item'")->fetch(PDO::FETCH_NUM);

				if($result[0][0])
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return false;
			}
		}

		function getTables($table)
		{
			try
			{
				$result = $this->conn->query("SHOW TABLES LIKE '$table'")->fetchAll(PDO::FETCH_NUM);

				if($result[0][0])
				{
					return $result;
				}
				else
				{
					return null;
				}
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return null;
			}
		}

		function getItem($table, $column, ...$where)
		{
			try
			{
				if(count($where) === 0)
				{
					$result = $this->conn->query("SELECT $column FROM `$table`")->fetchAll(PDO::FETCH_NUM);
				}
				else
				{
					$result = $this->conn->query("SELECT $column FROM `$table` WHERE $where[0]")->fetchAll(PDO::FETCH_NUM);
				}

				if($result[0][0])
				{
					return $result;
				}

				else
				{
					return null;
				}
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return null;
			}
		}

		function renameTable($table, $newTable)
		{
			try
			{
				$this->conn->exec("ALTER TABLE `$table` RENAME TO `$newTable`");
			}
			catch(Exception $e)
			{
				$this->error = $e->getMessage();
				return false;
			}
		}
	}
?>