(function(){
    angular.module('crud')
        .controller('userController', userController);

        userController.$inject = ['userService'];

        function userController(userService){
            vm = this;
            vm.users = [];
            vm.save = save;

            function save(user){
                userService.save(user).then(
                    (response)=>{
                        alert(response.data.message);
                    },
                    (response)=>{
                        console.log(response);
                        vm.error = {message: "Erro ao salvar"};
                    }
                )
            }

            (function listAll(){
                userService.listAll().then(
                    (response)=>{
                        vm.users = response.data;
                        console.log(vm.users);
                    },
                    (response)=>{
                        vm.error = {message: "Não foi possível acessar o servidor"};
                    }
                );
            })();


        }
})()
