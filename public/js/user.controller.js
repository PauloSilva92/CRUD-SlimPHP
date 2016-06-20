(function(){
    angular.module('crud')
        .controller('userController', userController);

        userController.$inject = ['userService', '$window'];

        function userController(userService, $window){
            vm = this;
            vm.users = [];
            vm.save = save;
            vm.remove = remove;

            function save(user){
                userService.save(user).then(
                    (response)=>{
                        user.nome = null;
                        user.email = null;
                        vm.success = response.data.message;
                        listAll();
                    },
                    (response)=>{
                        console.log(response);
                        vm.error = {message: "Erro ao salvar"};
                    }
                )
            }

            function remove(user_id){
                console.log(user_id);
                userService.remove(user_id).then(
                    (response)=>{
                        if(response.data.error){
                            vm.error = {message : "Erro ao deletar"};
                        }else{
                            vm.success = response.data.message;
                            listAll();
                        };
                    },
                    (response)=>{
                        vm.error = {message : "Erro ao deletar"};
                    }
                )
            }

            function listAll(){
                userService.listAll().then(
                    (response)=>{
                        vm.users = response.data;
                    },
                    (response)=>{
                        vm.error = {message: "Não foi possível acessar o servidor"};
                    }
                );
            }

            listAll();


        }
})()
