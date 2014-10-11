(function(){
  angular.module('sellit.services', [])

  .factory('feedService', ['$http', '$q', '$window', function($http, $q, $window){

    function all(){
      var deferred = $q.defer();

      $http.get('https://api.myjson.com/bins/3q29d')
        .success(function(data){
          deferred.resolve(data);
        });
      return deferred.promise;
    }

    function profiles(){
      var deferred = $q.defer();
      $http.get('https://api.myjson.com/bins/oysh')
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

    function saveComment(product, comment){
      var comments = getComments(product);

      comments.push(comment);
      localStorage.setItem(product, JSON.stringify(comments));
    }

    function getComments(product){
      var comments = localStorage.getItem(product);

      if(!comments){
        comments = [];
      }else{
        comments = JSON.parse(comments);
      }

      return comments;
    }

    function range(from, thisMany) {
      var deferred = $q.defer();

      $http.get('https://api.myjson.com/bins/3q29d')
        .success(function(data){
          deferred.resolve(data);
        });
      console.log(deferred.promise);
      return deferred.promise;
    }

    return{
      all: all,
      profiles: profiles,
      byId: byId,
      saveComment: saveComment,
      getComments: getComments,
      range: range
    }
  }]);
})();
