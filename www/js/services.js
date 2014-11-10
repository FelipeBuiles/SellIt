(function(){
  var URL = "http://sellit.apps.medehost.com/app_dev.php/";

  angular.module('sellit.services', [])

  .factory('feedService', function(store, $http, $q, $window, $state){

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
          if(data.message == "The user already was in the database"){
            //$state.go('preferences');
            $state.go('home.feed');
          }else{
            $state.go('preferences');
          }
        },
        error: function(err) {
          if(err.message == "The user already was in the database") {
            $state.go('home.feed');
          } else {
            console.log(err);
          }
        }
      });
    }

    function addPreference(idUsuario, idPreference){
      return $.ajax({
        type: "POST",
        url: URL + 'preferencias/add',
        async: false,
        data: {
          idusuario: idUsuario,
          idcategoria : idPreference
        }
      })
    }

    function addFollower(idUsuario, idFollow){
      return $.ajax({
        type: "POST",
        url: URL + 'seguidores/seguir/post',
        async: false,
        data: {
          idusuario : idUsuario,
          idfollow : idFollow
        }
      })
    }

    function profiles(){
      return $.ajax({
        type: 'GET',
        url: URL+'usuarios/listar',
        async: false
      })
      // var deferred = $q.defer();
      // $http.get('https://api.myjson.com/bins/oysh')
      //   .success(function(data){
      //     deferred.resolve(data);
      //   });
      // return deferred.promise;
    }

    function following(idusuario){
      return $.ajax({
        type: 'GET',
        url: URL+'seguidores/listarseguidos/'+idusuario,
        async: false
      })
    }

    function followers(idusuario){
      return $.ajax({
        type: 'GET',
        url: URL+'seguidores/listarseguidores/'+idusuario,
        async: false
      })
    }

    function publish(id, n, d, p, c, k, i) {
      return $.ajax({
        type: "POST",
        url: URL + 'productos/nuevo',
        async: false,
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
      .always(
        $state.go('home.feed')
      );
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

    function byFollower(id){
      return $.ajax({
        type: 'GET',
        url: URL + 'productos/listarvendedor/'+ id +'/100/0/true/desc',
        async: false
      })
    }

    function preferences(){
      return $.ajax({
        type: 'GET',
        url: URL+'productos/listarcategorias',
        async: false
      })
    }

    function addRating(){
      return $.ajax({
        type: 'POST',
        url: URL +'',
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
      store.set(product, comments);
    }

    function getComments(product){
      var comments = store.get(product);

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
        url: URL + 'productos/listarvendedor/false/'+limit+'/'+offset+'/true/false',
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
      publish: publish,
      addPreference : addPreference,
      addFollower : addFollower,
      byFollower: byFollower,
      addRating : addRating,
      following : following,
      followers : followers
    }
  });
})();
