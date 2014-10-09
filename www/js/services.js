(function(){
  angular.module('sellit.services', [])

  .factory('feedService', ['$http', '$q', function($http, $q){

    function all(){
      var deferred = $q.defer();

      $http.get('https://api.myjson.com/bins/351bd')
        .success(function(data){
          deferred.resolve(data);
        });
      return deferred.promise;
    }

    function one(id) {
      var deferred = $q.defer();

      $http.get('https://api.myjson.com/bins/351bd')
        .success(function(data){
          deferred.resolve(data);
        });
      return deferred.promise[id];
    }

    function range(from, thisMany) {
      var deferred = $q.defer();

      $http.get('https://api.myjson.com/bins/351bd')
        .success(function(data){
          deferred.resolve(data);
        });
      console.log(deferred.promise);
      return deferred.promise;
    }

    return{
      all: all,
      one: one,
      range: range
    }
  }]);
})();
