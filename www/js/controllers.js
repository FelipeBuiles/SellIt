(function() {
  angular.module('sellit.controllers',
  ['ionic', 'auth0', 'ionic.rating'])

  .controller('LoginController', function($scope, auth, feedService) {
    auth.signin({
      popup: true,
      standalone: true,
      offline_mode: true,
      device: 'Phone'
    }, function() {
      localStorage.user_id = auth.profile.user_id;
      localStorage.user_name = auth.profile.name;
      feedService.login(auth.profile.user_id, auth.profile.name, auth.profile.picture);
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
    $scope.count = 0;

    $scope.init = function() {
      feedService.count()
      .always(function(data) {
        $scope.count = data.total;
      });

      feedService.range(0,10)
      .always(function(data) {
        $scope.feedProducts = JSON.parse(data.responseText);
      });
      $scope.currentIndex = 10;
    };

    $scope.refresh = function() {
      feedService.range(0,10)
        .always(function(data) {
          $scope.feedProducts = JSON.parse(data.responseText);
          $scope.currentIndex = 10;
          $scope.$broadcast('scroll.refreshComplete');
        });
    };
    $scope.canLoadMore = function(currentIndex) {
      return $scope.currentIndex < $scope.count;
    }
    $scope.more = function() {
      feedService.range($scope.currentIndex, $scope.currentIndex+5)
        .always(function(data) {
          res = JSON.parse(data.responseText);
          if(res.length > 0) {
            $scope.feedProducts = $scope.feedProducts.concat(res)
            $scope.currentIndex += 5;
          }
          $scope.$broadcast('scroll.infiniteScrollComplete');
        });
    }
  })

  .controller('ProductController', function($scope, $stateParams, feedService){
    $scope.idProduct = $stateParams.id;
    $scope.rate = 3;
    $scope.max = 5;
    $scope.profileProd = $stateParams.profile;
    $scope.product = {};
    feedService.byId($scope.idProduct)
      .always(function(data){
        $scope.product = data;
      });
    console.log($scope.product);
  })

  .controller('PublishController', function($scope, $cordovaCamera, feedService) {
    $scope.picTaken = false;
    $scope.product = {};
    $scope.takePicture = function() {
      var options = {
          quality : 75,
          destinationType : Camera.DestinationType.DATA_URL,
          sourceType : Camera.PictureSourceType.CAMERA,
          allowEdit : true,
          targetWidth: 500,
          targetHeight: 500,
          correctOrientation: true,
          encodingType: Camera.EncodingType.JPEG,
          saveToPhotoAlbum: false
      };

      $cordovaCamera.getPicture(options).then(function(imageData) {
        $scope.imgSrc = imageData;
        $scope.picTaken = true;
        console.log(imageData)
      }, function(err) {
        console.log(':(', err);
      });
    }

    $scope.publish = function() {
      feedService.publish(
        localStorage.user_id,
        $scope.product.name,
        $scope.product.description,
        $scope.product.price,
        $scope.product.category,
        $scope.product.tags.split(/[ ,]+/),
        [$scope.imgSrc || "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"]
      )
      .always();
      //console.log($scope.product.tags.split(/[ ,]+/))
    }
  })

  .controller('FollowersController', function($scope, $state, $window,auth, feedService) {
      $scope.followersProfile = {}
        feedService.all()
          .then(function(data){
            $scope.followersProfile = data;
          });
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
