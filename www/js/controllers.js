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
      $state.go('preferences');
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
    $scope.currentIndex = 0;
    $scope.init = function() {
      feedService.all()
        .then(function(data) {
          $scope.feedProducts = data.slice(0, 4);
          $scope.currentIndex = 4;
        });
    };
    $scope.refresh = function() {
      feedService.all()
        .then(function(data) {
          $scope.feedProducts = data.slice(0, 4);
          $scope.currentIndex = 4;
        })
        .finally(function() {
          $scope.$broadcast('scroll.refreshComplete');
        });
    };
    $scope.canLoadMore = function(currentIndex) {
      return $scope.currentIndex < 16;
    }
    $scope.more = function() {
      feedService.all()
        .then(function(data) {
          $scope.feedProducts = $scope.feedProducts
          .concat(data.slice($scope.currentIndex, $scope.currentIndex+4));
          $scope.currentIndex += 4;
        })
        .finally(function() {
          $scope.$broadcast('scroll.infiniteScrollComplete');
        });
    }
  })

  .controller('ProductController', ['$scope', '$stateParams', 'feedService',function($scope, $stateParams, feedService, auth){
    $scope.idProduct = $stateParams.id;
    console.log($scope.idProduct);
    $scope.profileProd = $stateParams.profile;
    $scope.products = {};
    feedService.byId($scope.idProduct)
      .then(function(data){
        $scope.products = data;
      });

  }])

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

  .controller('ProfileController', function($scope, $state, auth) {
    $scope.profile = auth.profile;
  })

})();
