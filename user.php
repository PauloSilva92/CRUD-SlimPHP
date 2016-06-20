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
                return array('erro'=> 'Algo de errado aconteceu');
            }
        }

        public function listarTodos(){
              $db = Database::conexao();
              $smtp = $db->prepare("SELECT * FROM user");
              $smtp->execute();

              $result = $smtp->fetchAll();
              return $result;
        }

    }
?>
