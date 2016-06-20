(function(){
    angular.module('crud')
        .factory('userService', userService);

        userService.$inject = ['$http'];

        function userService($http){
            const URL = "http://orcamento.app/";

            const save = (user)=> $http.post(URL+'/user',user);
            const listAll = ()=> $http.get(URL+'/users');

            return {
                save,
                listAll
            }
        }

})();
