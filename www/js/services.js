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
            $state.go('preferences');
            //$state.go('home.feed');
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

    function getProfile(idusuario){
      return $.ajax({
        type: 'GET',
        url: URL + 'usuarios/get/' + idusuario,
        async: false
      })
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

    function suggestion(idPreference){
    return $.ajax({
      type: "POST",
      url: URL + 'usuarios/preferencias/sugeridos',
      async: false,
        data: {
          preferencias : idPreference
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

    function getRating(idproducto){
      return $.ajax({
        type: 'GET',
        url: URL +'productos/calificacion/get/'+idproducto,
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

    function getBankInfo(idUsuario) {
      var id = idUsuario.replace('|', '%7C');
      return $.ajax({
        type: 'GET',
        url: URL + 'usuarios/bancaria/get/'+id,
        async: false
      })
    }

    function setBankInfo(params) {
      return $.ajax({
        type: "POST",
        url: URL + 'usuarios/bancaria/post',
        async: false,
        data: params
      })
    }

    function getLocation(idUsuario) {
      var id = idUsuario.replace('|', '%7C');
      return $.ajax({
        type: 'GET',
        url: URL + 'usuarios/geolocalizacion/get/'+id,
        async: false
      })
    }

    function setLocation(params) {
      return $.ajax({
        type: "POST",
        url: URL + 'usuarios/geolocalizacion/post',
        async: false,
        data: params
      })
    }

    return{
      all: all,
      login: login,
      byId: byId,
      getProfile : getProfile,
      profiles: profiles,
      byUser: byUser,
      count: count,
      saveComment: saveComment,
      getComments: getComments,
      range: range,
      publish: publish,
      addPreference : addPreference,
      suggestion : suggestion,
      addFollower : addFollower,
      byFollower: byFollower,
      getRating : getRating,
      following : following,
      followers : followers,
      getBankInfo : getBankInfo,
      setBankInfo : setBankInfo,
      getLocation : getLocation,
      setLocation : setLocation
    }
  });
})();
