<?php
require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDAO {
    private $pdo;
    
    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function create(Usuario $u){
        $sql = $this->pdo->prepare("INSERT INTO usuarios (NOME, EMAIL) VALUES (:NOME, :EMAIL)");
        $sql->bindValue(':NOME', $u->getNome());
        $sql->bindValue(':EMAIL', $u->getEmail());
        $sql->execute();

        $u->setId($this->pdo->lastInsertId());
        return $u;
    }

    public function findAll(){
        $array = [];
        $sql = $this->pdo->query("SELECT * FROM usuarios");
        
        if ($sql->rowCount() > 0) {
            $registrosUs = $sql->fetchAll();

            foreach ($registrosUs as $usuario) {
                $u = new Usuario();
                $u->setId($usuario['ID']);
                $u->setNome($usuario['NOME']); // Correção aqui
                $u->setEmail($usuario['EMAIL']); // Correção aqui
                $array[] = $u;
            }
        }
        return $array;
    }

    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE ID = :ID");
        $sql->bindValue(':ID', $id); // Correção aqui
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            
            $u = new Usuario();
            $u->setId($data['ID']);
            $u->setNome($data['NOME']); // Correção aqui
            $u->setEmail($data['EMAIL']); // Correção aqui
            return $u;
        } else {
            return false;
        }
    }

    public function findByEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE EMAIL = :EMAIL");
        $sql->bindValue(':EMAIL', $email); // Correção aqui
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            
            $u = new Usuario();
            $u->setId($data['ID']);
            $u->setNome($data['NOME']); // Correção aqui
            $u->setEmail($data['EMAIL']); // Correção aqui
            return $u;
        } else {
            return false;
        }
    }

    public function update(Usuario $u){
        $sql = $this->pdo->prepare("UPDATE usuarios SET NOME = :NOME, EMAIL = :EMAIL WHERE ID = :ID");
        $sql->bindValue(':NOME', $u->getNome());
        $sql->bindValue(':EMAIL', $u->getEmail());
        $sql->bindValue(':ID', $u->getId());
        $sql->execute();
        return true;
    }

    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE ID = :ID");
        $sql->bindValue('ID', $id);
        $sql->execute();
    }
}
