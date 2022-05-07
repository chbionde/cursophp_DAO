<?php

class Sql extends PDO {

    private $connection;

    public function __construct(){
        $this->connection = new PDO("mysql:dbname=dbphp;host=localhost", "root", "");
    }

    /**
     * DEFINE O PARAMETRO
     * @param object    $statement  Objeto de conexão com o banco
     * @param string    $key        Chave do array
     * @param string    $value      Valor do array
     */
    private function setParam ($statement, $key, $value){
        $statement->bindParam($key,$value);
    }

    /**
     * MONTA PARAMETROS DO bindParams DO PDO
     * @param object    $statement  Objeto de conexão com o banco
     * @param array     $parameters Array de parametros para o bindParams
     */
    private function buildParams ($statement, $parameters = []){
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    /**
     * EXECUTA A QUERY
     * @param string    $rawQuery   Query que será executada
     * @param array     $params     Array de parametros para o bindParams
     * @return object   $stmt       Objeto de conexão com o banco
     */
    public function execQuery($rawQuery, $params = []){
        $stmt = $this->connection->prepare($rawQuery);
        $this->buildParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    /**
     * EXECUTANDO QUERY DE SELECT
     * @param string    $rawQuery   Query que será executada
     * @param array     $params     Array de parametros para o bindParams
     * @return array    $stmt       Resultado do SELECT 
     */
    public function select($rawQuery, $params = []):array{
        $stmt   = $this->execQuery($rawQuery, $params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}