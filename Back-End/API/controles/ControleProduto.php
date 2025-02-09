<?php
require_once './conexao/Conexao.php';
class ControleProduto {
    
    public function listar() {
        $sql = 'select * from produto';
        $todos = [];
        $preparado = Conexao::preparaComando($sql);
        if($preparado->execute()){
            $todos = $preparado->fetchAll(PDO::FETCH_ASSOC);
        }
        return $todos;
    }

    public function um() {
        $sql = 'select * from produto where id = ?';
        $id = filter_input(INPUT_POST, 'id');
        $um = [];
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $id);
        if($preparado->execute()){
            $um = $preparado->fetch(PDO::FETCH_ASSOC);
        }
        return $um;
    }

    public function inserir() {
        $sql = 
        'insert into produto (nome, preço, quantidade)
        values (?, ?, ?)';
        $nome = filter_input(INPUT_POST, 'nome');
        $preço = filter_input(INPUT_POST, 'preço');
        $quantidade = filter_input(INPUT_POST, 'quantidade');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $nome);
        $preparado->bindValue(2, $preço);
        $preparado->bindValue(3, $quantidade);
        if($preparado->execute()){
            return ['status' => 'Gravou'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }        
    }

    public function editar() {
        $sql = 
        'update produto set nome = ?, preço = ?, quantidade = ?
        where id = ?;';
        $id = filter_input(INPUT_POST, 'id');
        $nome = filter_input(INPUT_POST, 'nome');
        $preço = filter_input(INPUT_POST, 'preço');
        $quantidade = filter_input(INPUT_POST, 'quantidade');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $nome);
        $preparado->bindValue(2, $preço);
        $preparado->bindValue(3, $quantidade);
        $preparado->bindValue(4, $id);
        if($preparado->execute()){
            return ['status' => 'Editou'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }        
    }

    public function excluir() {
        $sql = 'delete from produto where id = ?';
        $id = filter_input(INPUT_POST, 'id');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $id);
        if($preparado->execute()){
            return ['status' => 'Apagou'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }        
    }

}