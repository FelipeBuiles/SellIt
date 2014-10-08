(function(){
  angular.module('sellit.services', [])

  .factory('feedService', ['$http', '$q', function($http, $q){

    function all(){
      var deferred = $q.defer();

      $http.get('http://192.168.1.10:8100/products.json')
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
