(function() {
  angular.module('sellit.controllers',
  ['ionic', 'auth0', 'ionic.rating'])

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
  .controller('SuggestionsController', function($scope, $state, feedService){
    $scope.profiles = {};
    feedService.profiles()
      .then(function(data){
        $scope.profiles = data;
      });
  })
  .controller('PreferencesController', function($scope, $state){
    $scope.preferences = [
      {nombre:'Health and Beauty', id: 1, value: false},
      {nombre:'Books', id: 2, value: false},
      {nombre:'Videogames', id: 3, value: false},
      {nombre:'Computers and Electronics', id: 4, value: false},
      {nombre:'Home', id: 5, value: false},
      {nombre:'Kids', id: 6, value: false},
      {nombre:'Clothes and Shoes', id: 7, value: false},
      {nombre:'Sports', id: 8, value: false}
    ];

    $scope.array = [];
    $scope.selected = function(){
      for(var i = 0; i < $scope.preferences.length; i++){
        if($scope.preferences[i].value === true){
          $scope.array[$scope.array.length] = $scope.preferences[i];
        }
      }
    };
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
    $scope.rate = 3;
    $scope.max = 5;
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

  .controller('ProfileController', function($scope, $state, $window,auth, feedService) {
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
