<?php
include_once('../dao/conexao.php');
include_once('../model/Projetos.php');

class ProjetoDAO
{
    
    public static function getConnMysql()
    {
        if (!isset(self::$instance)) {
            self::$instance = new ProjetoDAO();
            return self::$instance;
        }
    }
    
    public function localizarProjeto($codigo, $nome)
    {
        if (!empty($codigo)) {
            $query = Conexao::getConnMysql()->prepare('SELECT * FROM projetos WHERE id=(:codigo)');
            $query->bindValue(":codigo", $codigo, PDO::PARAM_INT);
        } else if (!empty($nome)) {
            $query = Conexao::getConnMysql()->prepare('SELECT * FROM projetos WHERE nome LIKE :nome');
            $query->bindValue(':nome', '%' . $nome . '%');
        } else {
            $query = Conexao::getConnMysql()->prepare('SELECT * FROM projetos');
        }
        $query->execute();
        return $this->processResults($query);
    }
	
	public function localizarProjetoPorStatus($nome)
    {
        $query = Conexao::getConnMysql()->prepare('select pj.* from projetos as pj join status as st on (st.id = pj.status) 
		where st.nome = (:nome) ORDER BY data_termino_real LIMIT 5');
		$query->bindValue(":nome", $nome);
        $query->execute();
        return $this->processResults($query);
    }
	
	public function deletaProjeto($codigo)
    {
        $query = Conexao::getConnMysql()->prepare('DELETE FROM projetos WHERE id= (:codigo)');
		$query->bindValue(":codigo", $codigo);
        $query->execute();
		return true;
    }
    
    public function localizarProjetoDetalhado($id)
    {
        $query = Conexao::getConnMysql()->prepare('
			SELECT pj.id , pj.nome, pj.orcamento_total, pj.descricao, pj.data_inicio, pj.data_termino, pj.data_termino_real, cl.id as idClass, cl.nome as classificacao, 
			gp.id as idGP ,gp.nome as gerente_responsavel, st.id as idST ,st.nome as status 
			FROM projetos as pj 
			LEFT JOIN classificacao as cl on (cl.id = pj.classificacao) 
			LEFT JOIN gerente_responsavel as gp on (gp.id = pj.gerente_responsavel) 
			LEFT JOIN status as st on (st.id = pj.status) 
			WHERE pj.id = :id');
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
        return $this->processResult($query);
    }
    
    public function updateProjeto(Projetos $projeto)
    {
        try {
            $sql    = 'UPDATE projetos 
				SET nome=(:nome),
				orcamento_total=(:orc_total),
				descricao=(:desc),
				data_inicio=(:dtInc),
				data_termino=(:dtTer),
				data_termino_real=(:dtTerR),
				classificacao=(:classf),
				gerente_responsavel=(:gp),
				status=(:st)
				WHERE id=(:id)';
            $update = Conexao::getConnMysql()->prepare($sql);
            $update->bindValue(":nome", $projeto->getProjeto_Nome()); 
            $update->bindValue(":orc_total", $projeto->getProjeto_Orcamento_total());
            $update->bindValue(":desc", $projeto->getProjeto_Descricao());
            $update->bindValue(":dtInc", $projeto->getProjeto_Data_inicio());
            $update->bindValue(":dtTer", $projeto->getProjeto_Data_termino());
            $update->bindValue(":dtTerR", $projeto->getProjeto_Data_termino_real());
            $update->bindValue(":classf", $projeto->getProjeto_Classificacao());
            $update->bindValue(":gp", $projeto->getProjeto_Gerente_responsavel());
            $update->bindValue(":st", $projeto->getProjeto_Status());
            $update->bindValue(":id", $projeto->getProjeto_Id());
            return $update->execute();
        }
        catch (Exception $e) {
            print "Erro ao tentar atualizar informações do projeto" . $e->getMessage();
            return false;
        }
    }

    public function pesquisaProjetoRelatorioIndicadores(){
        $query = Conexao::getConnMysql()->prepare('select p.* from projetos as p join status as st on(p.status = st.id) where st.nome != "Cancelado" AND st.nome != "Encerrado"');
        $query->execute();
        return $this->processResults($query);
    }

     public function pesquisaProjetoRelatorioIndicadoresBusca($idProjeto, $nomeProjeto){
        if($idProjeto != null){
            $query = Conexao::getConnMysql()->prepare('select p.* from projetos as p join status as st on(p.status = st.id) 
                    where st.nome != "Cancelado" AND st.nome != "Encerrado" AND p.id = (:idProjeto)');
            $query->bindValue(":idProjeto", $idProjeto);
        }
        else if ($nomeProjeto != null){
            $query = Conexao::getConnMysql()->prepare('select p.* from projetos as p join status as st on(p.status = st.id) 
                    where st.nome != "Cancelado" AND st.nome != "Encerrado" AND p.nome LIKE (:nome)');
            $query->bindValue(":nome", '%'. $nomeProjeto . '%');
        }else{
            $query = Conexao::getConnMysql()->prepare('select p.* from projetos as p join status as st on(p.status = st.id) 
                    where st.nome != "Cancelado" AND st.nome != "Encerrado"');
        }
        $query->execute();
        return $this->processResults($query);
    }

     public function updateStatusProjeto(Projetos $projeto)
    {
        try {
            $sql    = 'UPDATE projetos 
				SET 
				status=(:st)
				WHERE id=(:id)';
            $update = Conexao::getConnMysql()->prepare($sql);
            $update->bindValue(":st", $projeto->getProjeto_Status());
            $update->bindValue(":id", $projeto->getProjeto_Id());
            return $update->execute();
        }
        catch (Exception $e) {
            print "Erro ao tentar atualizar status do projeto" . $e->getMessage();
            return false;
        }
    }
    
    public function insertProjeto(Projetos $projeto)
    {
        try {
            
            $sql    = 'INSERT INTO projetos 
		     (nome, orcamento_total, descricao, data_inicio, data_termino, data_termino_real, classificacao, gerente_responsavel, status)
			 VALUES (:nome,:orc_total,:desc,:dtInc,:dtTer,:dtTerR,:classf,:gp,:st)';
            $update = Conexao::getConnMysql()->prepare($sql);
            $update->bindValue(":nome", $projeto->getProjeto_Nome());
            $update->bindValue(":orc_total", $projeto->getProjeto_Orcamento_total());
            $update->bindValue(":desc", $projeto->getProjeto_Descricao());
            $update->bindValue(":dtInc", $projeto->getProjeto_Data_inicio());
            $update->bindValue(":dtTer", $projeto->getProjeto_Data_termino());
            $update->bindValue(":dtTerR", $projeto->getProjeto_Data_termino_real());
            $update->bindValue(":classf", $projeto->getProjeto_Classificacao());
            $update->bindValue(":gp", $projeto->getProjeto_Gerente_responsavel());
            $update->bindValue(":st", $projeto->getProjeto_Status());
            return $update->execute();
        }
        catch (Exception $e) {
            print "Erro ao tentar inserir informações do projeto" . $e->getMessage();
            return false;
        }
    }
    
    
    private function processResult($statement)
    {
        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $projetos = new Projetos();
                $projetos->setProjeto_Id($row->id);
                $projetos->setProjeto_Nome($row->nome);
                $projetos->setProjeto_Orcamento_total($row->orcamento_total);
                $projetos->setProjeto_Descricao($row->descricao);
                $projetos->setProjeto_Data_inicio($row->data_inicio);
                $projetos->setProjeto_Data_termino($row->data_termino);
                $projetos->setProjeto_Data_termino_real($row->data_termino_real);
                $projetos->setProjeto_Classificacao($row->classificacao);
                $projetos->setProjeto_Gerente_responsavel($row->gerente_responsavel);
                $projetos->setProjeto_Status($row->status);
                $projetos->setProjeto_IdCL($row->idClass);
                $projetos->setProjeto_IdST($row->idST);
                $projetos->setProjeto_IdGP($row->idGP);
                return $projetos;
            }
        }
    }
    
    private function processResults($statement)
    {
        $results = array();
        
        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $projetos = new Projetos();
                $projetos->setProjeto_Id($row->id);
                $projetos->setProjeto_Nome($row->nome);
                $projetos->setProjeto_Orcamento_total($row->orcamento_total);
                $projetos->setProjeto_Descricao($row->descricao);
                $projetos->setProjeto_Data_inicio($row->data_inicio);
                $projetos->setProjeto_Data_termino($row->data_termino);
                $projetos->setProjeto_Data_termino_real($row->data_termino_real);
                $projetos->setProjeto_Classificacao($row->classificacao);
                $projetos->setProjeto_Gerente_responsavel($row->gerente_responsavel);
                $projetos->setProjeto_Status($row->status);
                $results[] = $projetos;
            }
        }
        
        return $results;
    }
}
?>