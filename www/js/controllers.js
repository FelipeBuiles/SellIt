(function() {
  angular.module('sellit.controllers',
  ['ionic', 'auth0'])

  .controller('LoginController', function($scope, auth, $state) {
    auth.signin({
      popup: true,
      standalone: true,
      offline_mode: true,
      device: 'Phone'
    }, function() {
      $state.go('home.feed');
    }, function(error) {
      console.log(":( ", error);
    });
  })

  .controller('HomeController', function($scope, $state) {

  })

  .controller('FeedController', function($scope, $state) {

  })

  .controller('PublishController', function($scope, $state, $cordovaCamera) {
    $scope.taken = false;
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
        $scope.taken = true;
      }, function(err) {
        console.log(':(', err);
      });
    }
  })

  .controller('ProfileController', function($scope, $state, auth) {
    $scope.profile = auth.profile;
  })

})();
