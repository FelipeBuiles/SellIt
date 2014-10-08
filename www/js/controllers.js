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
      {nombre:'Health and Beauty', id: 1},
      {nombre:'Books', id: 2},
      {nombre:'Videogames', id: 3},
      {nombre:'Computers and Electronics', id: 4},
      {nombre:'Home', id: 5},
      {nombre:'Kids', id: 6},
      {nombre:'Clothes and Shoes', id: 7},
      {nombre:'Sports', id: 8}
    ];
  })

  .controller('HomeController', function($scope, $state) {

  })

  .controller('FeedController', function($scope, $state, feedService) {
    $scope.feedProducts = {}
    feedService.all()
      .then(function(data){
        $scope.feedProducts = data;
        console.log($scope.feedProducts);
      });
  })

  .controller('PublishController', function($scope, $state, $cordovaCamera) {
    $scope.picTaken = false;
    $scope.product = {};
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

    $scope.publish = function() {

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
