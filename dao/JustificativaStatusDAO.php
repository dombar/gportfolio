<?php
include_once('../dao/conexao.php');
include_once('../model/Justificativa_Status.php');

class JustificativaStatusDAO
{

     public static function getConnMysql()
    {
        if (!isset(self::$instance)) {
            self::$instance = new JustificativaStatusDAO();
            return self::$instance;
        }
    }

      public function insertJustificativa($idProjeto, $justificativa)
    {
        try {
            
            $sql    = 'INSERT INTO justificativa_status (justificativa, idProjeto) VALUES (:jt,:idP)';
            $update = Conexao::getConnMysql()->prepare($sql);
            $update->bindValue(":jt", $justificativa);
            $update->bindValue(":idP", $idProjeto);
            return $update->execute();
        }
        catch (Exception $e) {
            print "Erro ao tentar inserir informações de justificativa de status" . $e->getMessage();
            return false;
        }
    }
}