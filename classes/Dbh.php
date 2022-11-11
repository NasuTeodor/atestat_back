<?php
class Dbh
{
    private static $_instance = null;
    private $_pdo, $_query, $_result, $_count;

    public function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=sql300.epizy.com;dbname=epiz_32971166_atestat', 'epiz_32971166', 'EP05cRI0pHmfS4Z');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {

        if (!isset(self::$_instance)) {
            self::$_instance = new Dbh();
        }
        return self::$_instance;
    }

    public function query($sql, $params)
    {

        if ($this->_query = $this->_pdo->prepare($sql)) {
            if (count($params)) {
                $x = 1;

                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }
        }

        return $this;
    }

    public function insert($table, $data = array())
    {

        if (count($data)) {
            $keys = array_keys($data);
            $values = "";
            $x = 1;

            foreach ($data as $field) {
                $values .= "?";

                if ($x < count($data)) {
                    $values .= ", ";
                }

                $x++;
            }

            $sql = "INSERT INTO " . $table . " (`" . implode('`, `', $keys) . "` ) VALUES (" . $values . ");";
            $this->query($sql, $data);
            return $this;
        }
    }

    public function select($table, $where = array())
    {

        if (count($where) == 3) {
            $operators = array("=", ">", "<", "<=", ">=");
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "SELECT * FROM {$table} WHERE {$field} {$operator} ?";
                $this->query($sql, array($value));
            }
            return $this;
        }
    }

    public function select_order($table, $where = array())
    {

        if (count($where) == 3) {
            $operators = array("=", ">", "<", "<=", ">=");
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "SELECT * FROM {$table} WHERE {$field} {$operator} ? ORDER BY timp DESC";
                $this->query($sql, array($value));
            }
            return $this;
        }
    }

    public function update($table, $id, $fields = array())
    {

        if (count($fields)) {
            $set = "";
            $x = 1;
            foreach ($fields as $name => $value) {
                $set .= "${name} = ?";

                if ($x < count($fields)) {
                    $set .= ", ";
                }
                $x++;
            }

            // $sql = "UPDATE " . $table . " SET " . $set . " WHERE id=${name}";
            $sql = "UPDATE " . $table . " SET " . $set . " WHERE id=${id}";
            echo $sql . " <br> " . $fields; 
            $this->query($sql, $fields);
        }
        return $this;
    }

    public function delete($table, $where = array())
    {

        if (count($where) == 3) {

            $operators = array("=", ">", "<", "<=", ">=");
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "DELETE FROM {$table} WHERE {$field} {$operator} ?";
                $this->query($sql, array($value));
            }
        }

        return $this;
    }

    //asta este mai dubioasa pentru User

    public function truncate($table)
    {

        $sql = "TRUNCATE TABLE {$table}";
        $this->query($sql, $none = array());
    }


    public function special_query($sql)
    {
        $this->_query = $this->_pdo->prepare($sql);
        try{
            if($this->_query->execute())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function results()
    {
        return $this->_results;
    }
}
