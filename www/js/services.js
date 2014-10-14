(function(){
  var URL = "http://192.99.168.215/sellit/web/app_dev.php/";

  angular.module('sellit.services', [])

  .factory('feedService', ['$http', '$q', '$window', '$state', function($http, $q, $window, $state){

    function all(){
      var deferred = $q.defer();

      $http.get(URL+'productos/listarvendedor/false/1000/0/true/false')
        .success(function(data){
          deferred.resolve(data);
        });
      return deferred.promise;
    }

    function login(id, n, r) {
      $.ajax({
        type: "POST",
        url: URL + 'usuarios/validar',
        data: { id: id, nombre: n, ruta_avatar: r },
        success: function(data) {
          $state.go('preferences');
        },
        error: function(err) {
          if(err.message == "The user already was in the database") {
            $state.go('preferences');
          } else {
            console.log(err);
          }
        }
      });
    }

    function profiles(){
      var deferred = $q.defer();
      $http.get('https://api.myjson.com/bins/oysh')
        .success(function(data){
          deferred.resolve(data);
        });
      return deferred.promise;
    }

    function publish(id, n, d, p, c, k, i) {
      return $.ajax({
        type: "POST",
        url: URL + 'productos/nuevo',
        data: {
          id: id,
          name: n,
          description: d,
          price: p,
          category: c,
          keywords: k,
          images: i
        }
      })
    }

    function byId(id){
      return $.ajax({
        type: 'GET',
        url: URL+'productos/ver/'+id,
        async: false
      })
    }

    function byUser(id) {
      return $.ajax({
        type: 'GET',
        url: URL+'productos/listarvendedor/'+id+'/1000/0/true/false',
        async: false
      })
    }

    function count(idVendedor) {
      this.idVendedor = idVendedor || null;
      if(this.idVendedor == null) {
        return $.get(URL+'productos/contar');
      } else {
        return $.get(URL+'productos/contar/'+idVendedor);
      }
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

    function range(offset, limit) {
      return $.ajax({
        type: 'GET',
        url: URL+'productos/listarvendedor/false/'+limit+'/'+offset+'/true/false',
        async: false
      })
    }

    return{
      all: all,
      login: login,
      byId: byId,
      profiles: profiles,
      byUser: byUser,
      count: count,
      saveComment: saveComment,
      getComments: getComments,
      range: range,
      publish: publish
    }
  }]);
})();
