(function(){
  angular.module('sellit.services', [])

  .factory('feedService', ['$http', '$q', function($http, $q){

    function all(){
      var deferred = $q.defer();

      $http.get('https://api.myjson.com/bins/595a9')
        .success(function(data){
          deferred.resolve(data);
        });
      return deferred.promise;
    }

    function byId(id){
      var deferred = $q.defer();
      all().then(function(data){
        var results = data.filter(function(products){
          return products.id == id;
        });
        if(results.length > 0){
          deferred.resolve(results[0]);
        }else{
          deferred.reject();
        }
      });
      return deferred.promise;
    }

    function one(id) {
      var deferred = $q.defer();

      $http.get('https://api.myjson.com/bins/595a9')
        .success(function(data){
          deferred.resolve(data);
        });
      return deferred.promise[id];
    }

    function range(from, thisMany) {
      var deferred = $q.defer();

      $http.get('https://api.myjson.com/bins/595a9')
        .success(function(data){
          deferred.resolve(data);
        });
      console.log(deferred.promise);
      return deferred.promise;
    }

    return{
      all: all,
      byId: byId,
      one: one,
      range: range
    }
  }]);
})();
