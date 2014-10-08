(function() {
  angular.module('sellit.controllers',
  ['ionic', 'auth0'])

  .controller('LoginController', function($scope, auth, $state, $window) {
    var sessionStogare = $window.sessionStogare;

    auth.signin({
      popup: true,
      standalone: true,
      offline_mode: true,
      device: 'Phone'
    }, function(data) {
      $state.go('preferences');
      sessionStorage.userInfo = JSON.stringify(data);
    }, function(error) {
      console.log(":( ", error);
    });
  })
  .controller('PreferencesController', function($scope, $state){
    $scope.preferences = [
      {nombre:'Salud y belleza', id: 1},
      {nombre:'Libros', id: 2},
      {nombre:'Videojuegos', id: 3},
      {nombre:'Electronicos y computación', id: 4},
      {nombre:'Hogar', id: 5},
      {nombre:'Juguetes, Niños y Bebes', id: 6},
      {nombre:'Ropa y Zapatos', id: 7},
      {nombre:'Deportes', id: 8}
    ];
  })

  .controller('HomeController', function($scope, $state) {

  })

  .controller('FeedController', function($scope, $state, feedService) {
    $scope.feedProducts = {}
    feedService.all()
      .then(function(data){
        $scope.feedProducts = data;
      });
  })

  .controller('PublishController', function($scope, $state, $cordovaCamera) {
    $scope.picTaken = false;
    $scope.takePicture = function() {
      var options = {
          quality : 75,
          destinationType : Camera.DestinationType.FILE_URI,
          sourceType : Camera.PictureSourceType.CAMERA,
          allowEdit : true,
          targetWidth: 400,
          targetHeight: 400,
          correctOrientation: true,
          encodingType: Camera.EncodingType.JPEG,
          saveToPhotoAlbum: false
      };

      $cordovaCamera.getPicture(options).then(function(imageData) {
        $scope.imgSrc = imageData;
        $scope.picTaken = true;
      }, function(err) {
        console.log(':(', err);
      });
    }
  })

  .controller('ProfileController', function($scope, $state, $window, auth, feedService) {
    if(auth.profile === undefined){
      $scope.profile = JSON.parse($window.sessionStorage.userInfo)
    }else{
      $scope.profile = auth.profile;
    }
    $scope.productos = {}
    feedService.all()
      .then(function(data){
        $scope.productos = data;
      });
  })

})();
