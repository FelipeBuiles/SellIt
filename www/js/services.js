(function(){
  angular.module("sellit.services", [])

  .factory('feedService', ['$http', '$q', function($http, $q){

    function all(){
      var deferred = $q.defer();

      $http.get('/products.json')
        .success(function(data){
          deferred.resolve(data);
        });
      return deferred.promise;
    }

    return{
      all: all
    };
  }]);
})();
