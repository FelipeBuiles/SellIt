(function() {
  angular.module('sellit.controllers',
  ['ionic', 'auth0', 'ionic.rating'])

  .controller('LoginController', function($scope, auth, feedService, store) {
    auth.signin({
      popup: true,
      standalone: true,
      offline_mode: true,
      device: 'Phone'
    }, function(profile, token, accessToken, state, refreshToken) {
      store.set('profile', profile);
      store.set('token', token);
      store.set('refreshToken', refreshToken);
      feedService.login(profile.user_id, profile.name, profile.picture);
    }, function(error) {
      console.log(":( ", error);
    });
  })

  .controller('SuggestionsController', function(store, $scope, $state, $stateParams, auth, feedService, $ionicPopup){
    $scope.profile = auth.profile;
    $scope.profiles = {};
    $scope.suggestions = {};
    $scope.preferences = store.get('listarPreferencias');
    console.log($scope.preferences);
    feedService.suggestion($scope.preferences)
      .always(function(data){
        if(data.error == null){
          $scope.profiles = data;
            for(i = 0 ; i < $scope.profiles.length; i++){
              $scope.profiles[i].followText = "follow";
            }
            console.log(data.error);
          }else{
            var alertPopup = $ionicPopup.alert({
              title: 'we haven&#39t found any profile to match your preferences'
            })
            $state.go('home.feed')
          }
      });

    $scope.follow = function(index){
      $scope.profiles[index].followText = "Following";
      feedService.addFollower(store.get('profile').user_id, $scope.profiles[index].id);
    }
  })
  .controller('PreferencesController', function(store, $scope, $state, feedService, $ionicPopup){
    $scope.preferences = [
      {nombre:'Health and Beauty', id: 1, value: false},
      {nombre:'Books', id: 2, value: false},
      {nombre:'Videogames', id: 3, value: false},
      {nombre:'Computers and Electronics', id: 4, value: false},
      {nombre:'Home', id: 5, value: false},
      {nombre:'Kids', id: 6, value: false},
      {nombre:'Clothes and Shoes', id: 7, value: false},
      {nombre:'Sports', id: 8, value: false},
      {nombre:'Other', id: 9, value: false}
    ];

    $scope.array = [];
    $scope.selected = function(){
      for(var i = 0; i < $scope.preferences.length; i++){
        if($scope.preferences[i].value === true){
          $scope.array[$scope.array.length] = $scope.preferences[i].id;
        }
      }
      if($scope.array.length != 0){
        $state.go('suggestions')
      }else{
        var alertPopup = $ionicPopup.alert({
          title: 'Wait!',
          template: 'you should have at least one preference to continue'
        })
      }

      store.set('listarPreferencias', $scope.array);
      feedService.addPreference(store.get('profile').user_id, $scope.array);

      console.log($scope.array);
    };
  })

  .controller('HomeController', function(store, $scope, $state, auth) {
    $scope.idUser = store.get('profile').user_id;
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
        $scope.feedProducts = data;
      });
      $scope.currentIndex = 10;
    };

    $scope.refresh = function() {
      feedService.range(0,10)
        .always(function(data) {
          $scope.feedProducts = data;
          $scope.currentIndex = 10;
          $scope.$broadcast('scroll.refreshComplete');
        });
    };

    $scope.canLoadMore = function(currentIndex) {
      return $scope.currentIndex < $scope.count;
    };

    $scope.more = function() {
      feedService.range($scope.currentIndex, $scope.currentIndex+5)
        .always(function(data) {
          if(data.length > 0) {
            $scope.feedProducts = $scope.feedProducts.concat(data)
            $scope.currentIndex += 5;
          }
          $scope.$broadcast('scroll.infiniteScrollComplete');
        });
    };
  })

  .controller('ProductController', function(store, $scope, $stateParams,
    $window, auth, feedService, $ionicModal, $ionicPlatform, $location,
    $timeout, $ionicNavBarDelegate, $ionicPopup){
    if(auth.profile === undefined){
      $scope.profile = store.get('profile');
    }else{
      $scope.profile = auth.profile;
    };
    $scope.idProduct = $stateParams.id;
    $scope.max = 5;
    $scope.profileProd = $stateParams.profile;
    $scope.product = {};
    feedService.byId($scope.idProduct)
      .always(function(data){
        $scope.product = data;
        $scope.own = (data.id_usuario.id_front == $scope.profile.user_id);
      });

    feedService.getRating($scope.idProduct)
      .always(function(data){
        $scope.rate = data;
        console.log($scope.rate);
      })

    $scope.addRating = function() {
      feedService.addRating(
        $scope.profile,
        $scope.idProduct,
        $scope.rate)
        .always(
          feedService.getRating($scope.idProduct)
          .always(function(data){
            $scope.enter(data);
          })
        );
    }

    $scope.picked = {};
    $scope.salesmanInfo = {};
    var timeoutId = null;
    $scope.offer = { 'value' : $scope.product.precio };
    $scope.center = { lat: 6.230833, lon: -75.59055599999999 };
    $scope.paymentOptions = [
      {name:'Face to face', id: 1},
      {name:'Bank deposit', id: 2},
      {name:'Haggle', id: 3}
    ];
    $ionicPlatform.ready(function() {
    	navigator.geolocation.getCurrentPosition(function(position) {
        $scope.position=position;
        var c = position.coords;
        $scope.gotoLocation(c.latitude, c.longitude);
        $scope.$apply();
      },
      function(e) {
        console.log("Error retrieving position " + e.code + " " + e.message) });
        $scope.gotoLocation = function (lat, lon) {
          if ($scope.lat != lat || $scope.lon != lon) {
            $scope.center = { lat: lat, lon: lon };
            if (!$scope.$$phase) $scope.$apply("center");
        }
      };

      // some points of interest to show on the map
      // to be user as markers, objects should have "lat", "lon", and "name" properties
      $scope.vendedorLoc = [
          { "name": "Yo!", "lat": $scope.center.lat, "lon": $scope.center.lon },
      ];

    });

    $ionicModal.fromTemplateUrl('templates/buy-modal.html', function($ionicModal) {
        $scope.modal = $ionicModal;
        var id = $scope.product.id_usuario.id_front;
        feedService.getBankInfo(id)
          .always(function(data) {
              $scope.bankInfo = data;
            }
          )
        feedService.getLocation(id)
         .always(function(data) {
           $scope.vendedorLoc = [
             { "name": $scope.product.id_usuario.nombre,
               "lat": data.latitud,
               "lon": data.longitud }
            ];
          })
    }, {
        scope: $scope,
        animation: 'slide-in-up'
    });

    $scope.goBack = function() {
      $ionicNavBarDelegate.back();
    }

    $scope.sendOffer = function() {
      var confirmPopup = $ionicPopup.confirm({
        title: 'Offer confirmation',
        template: 'Are you sure you want to send an offer?'
      });
      confirmPopup.then(function(res) {
        if(res) {
          params = {
            producto : $scope.product.id,
            usuario : $scope.profile.user_id,
            oferta : $scope.offer.value
          };
          if($scope.offer.description) params.comentarios = $scope.offer.description;
          feedService.sendOffer(params)
            .always($scope.modal.hide());
        }
      });
    }
  })

  .controller('PublishController', function(store, $scope, $cordovaCamera, feedService, $ionicPopup) {
    $scope.picTaken = false;
    $scope.product = {};
    $scope.categories =
    [
      {text:'Health and Beauty', id: 1, checked: false, icon: null},
      {text:'Books', id: 2, checked: false, icon: null},
      {text:'Videogames', id: 3, checked: false, icon: null},
      {text:'Computers and Electronics', id: 4, checked: false, icon: null},
      {text:'Home', id: 5, checked: false, icon: null},
      {text:'Kids', id: 6, checked: false, icon: null},
      {text:'Clothes and Shoes', id: 7, checked: false, icon: null},
      {text:'Sports', id: 8, checked: false, icon: null},
      {text:'Other', id: 9, checked: false, icon: null}
    ];
    $scope.product.textCategory = "Category";
    $scope.takePicture = function() {
      var options = {
          quality : 100,
          destinationType : Camera.DestinationType.DATA_URL,
          sourceType : Camera.PictureSourceType.CAMERA,
          allowEdit : true,
          targetWidth: 1000,
          targetHeight: 1000,
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
     var confirmPopup = $ionicPopup.confirm({
       title: 'Publish confirmation',
       template: 'Are you sure you want to publish this product?'
     });
     confirmPopup.then(function(res) {
       if(res) {
         feedService.publish(
           store.get('profile').user_id,
           $scope.product.name,
           $scope.product.description,
           $scope.product.price,
           $scope.product.category,
           $scope.product.tags.split(/[ ,]+/),
           [$scope.imgSrc || "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"]
         )
         .always(
           $state.go('home.feed')
         );
       }
     });
    }
  })

  .controller('FollowersController', function($scope, $state, $window,auth, feedService, $ionicNavBarDelegate) {
    $scope.followers = {};
    feedService.followers($state.params.id)
      .then(function(data){
        $scope.followers = data;
      });

    $scope.goBack = function() {
      $ionicNavBarDelegate.back();
    }
  })

  .controller('FollowingController', function($scope, auth, $state, feedService, $ionicNavBarDelegate){
    $scope.following = {};
    feedService.following($state.params.id)
      .then(function(data){
        $scope.following = data;
      });

    $scope.goBack = function() {
      $ionicNavBarDelegate.back();
    }

  })

  .controller('ProfileController', function(store, $scope, $state, $window,
    auth, feedService, $ionicModal, $ionicPopup, $ionicPlatform, $location) {
    $scope.profile = {};
    if(!auth.profile) auth.profile = store.get('profile');
    if($state.params.id != store.get('profile').user_id){
      feedService.getProfile($state.params.id)
        .then(function(data){
          $scope.profile = data;
        });
    }else{
      $scope.profile.id = auth.profile.user_id;
      $scope.profile.nombre = auth.profile.name;
      $scope.profile.ruta_avatar = auth.profile.picture;
    }
    $scope.picked = {
      value: 1
    };
    $scope.tabOptions = [
      {name:'Products', id: 1},
      {name:'News', id: 2},
    ];

    if(!$scope.profile) $scope.profile = store.get('profile');

    $scope.followersCounter;
    $scope.followingCounter;
    feedService.followers($scope.profile.id)
      .then(function(data){
        $scope.followersCounter = data.length;
      });

    feedService.following($scope.profile.id)
      .then(function(data){
        $scope.followingCounter = data.length;
      });

    $scope.goal;
    feedService.getGoal($scope.profile.id)
      .then(function(data){
        $scope.goal = data;
      });


    $scope.showSection = function(){
      return ((store.get('profile').user_id === $scope.profile.id) || $scope.profile.goal);
    }

    $scope.showButton = function(){
      return store.get('profile').user_id === $scope.profile.id;
    }

    $scope.showGoals = function(){
      console.log($scope.profile.goal != undefined);
      return $scope.profile.goal != undefined;
    }

    $scope.logout = function() {
      auth.signout();
      store.remove('profile');
      store.remove('token');
    }

    $ionicModal.fromTemplateUrl('templates/edit.html', function($ionicModal) {
        $scope.modal = $ionicModal;
    }, {
        scope: $scope,
        animation: 'slide-in-up'
    });

    $ionicModal.fromTemplateUrl('templates/offers.html', function($ionicModal) {
        $scope.offersModal = $ionicModal;
    }, {
        scope: $scope,
        animation: 'slide-in-up'
    });

    $scope.setGoal = function (){
      if($scope.profile.goalDesc && $scope.profile.salesTarget){
        var params = {
          idusuario: $scope.profile.id,
          monto_meta: $scope.profile.salesTarget,
          descripcion: $scope.profile.goalDesc
        };
        feedService.setGoal(params);
      }
    }

    $scope.updateInfo = function (){
      var params = {
        idusuario: $scope.profile.id,
        nombre_banco: $scope.profile.bankName,
        nombre_titular: $scope.profile.accountHolder,
        tipo_cuenta: $scope.profile.accountType,
        numero_cuenta: $scope.profile.accountNumber
      };
      if ($scope.profile.city != "") params.ciudad_titular = $scope.profile.city;
      if ($scope.profile.extraInfo != "") params.informacion_extra = $scope.profile.extraInfo;
      feedService.setBankInfo(params)
       .always(
         $scope.modal.hide()
       );
    }

    $scope.showOffers = function(idProd) {
      feedService.getOffers(idProd)
        .always(function(data) {
          console.log(data);
          $scope.offers = data;
        })
      $scope.offersModal.show();
    }

    $scope.acceptOffer = function(idOffer) {
      feedService.acceptOffer(idOffer)
        .always(
          $scope.offersModal.hide()
        )
    }

    $scope.goTo = function(idProd) {
      $location.path('product/'+idProd);
    }

    $scope.updateLocation = function() {
      $ionicPlatform.ready(function() {
        navigator.geolocation.getCurrentPosition(function(position) {
          $scope.position=position;
          var c = position.coords;
          var params = {
            idusuario : $scope.profile.id,
            latitud : c.latitude,
            longitud : c.longitude
          };
          feedService.setLocation(params)
            .always(
              $scope.modal.hide()
            );
          });
        });
      };

    $scope.products = {}
    feedService.byUser($scope.profile.id)
      .always(function(data){
        $scope.products = data;
      });
  })

})();
