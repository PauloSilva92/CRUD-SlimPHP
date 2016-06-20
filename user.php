<?php
    require_once "conect.php";

    class User{

        public function salvar($id,$nome, $email, $senha, $idade){
            $db = Database::conexao();
            $smtp = $db->prepare("INSERT INTO user (id,nome, email) values(:id,:nome,:email)");
            $smtp->execute(array(
                ':id'=>$id,
                ':nome'=>$nome,
                ':email'=>$email
            ));

            if( $smtp->rowCount() == '1'){
              return array('message' => 'Salvo com sucesso' );
            } else {
                return array('error'=> 'Algo de errado aconteceu');
            };
        }

        public function listarTodos(){
              $db = Database::conexao();
              $smtp = $db->prepare("SELECT * FROM user");
              $smtp->execute();

              $result = $smtp->fetchAll();
              return $result;
        }

        public function remove($id){
            $db = Database::conexao();
            $smtp = $db->prepare("DELETE FROM user WHERE id=:id");
            $smtp->execute(array(
                ':id'=>$id
            ));

            if( $smtp->rowCount() == '1'){
              return array('message' => 'Excluído com sucesso');
            } else {
                return array('error'=> 'Algo de errado aconteceu');
            };
        }

    }
?>
