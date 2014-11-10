(function() {
  angular.module( 'sellit',
  ['ionic',
  'sellit.controllers',
  'sellit.services',
  'sellit.directives',
  'ngCordova',
  'auth0',
  'angular-storage',
  'angular-jwt'])

  .config(function (authProvider, $httpProvider, $stateProvider,
    $urlRouterProvider, jwtInterceptorProvider) {
      authProvider
      .init({
        domain: 'sellit.auth0.com',
        clientID: 'JEEpuyCpk4TaG0iExkfOl7gUUa3TP1dH',
        callbackURL: location.href,
        loginState: 'login',
        dict: {
          signin: {
            title: 'Login'
          }
        }
      });

      $stateProvider
      .state('login', {
        url: '/',
        templateUrl: 'templates/login.html',
        controller: 'LoginController',
      })
      .state('preferences',{
        url: '/preferences',
        templateUrl: 'templates/preferences.html',
        controller: 'PreferencesController',
        data: {
          requiresLogin: true
        }
      })
      .state('suggestions',{
        url: '/suggestions',
        templateUrl: 'templates/suggestions.html',
        controller: 'SuggestionsController',
      })
      .state('home', {
        url: "/home",
        abstract: true,
        templateUrl: 'templates/home.html',
        controller: 'HomeController',
        data: {
          requiresLogin: true
        }
      })
      .state('home.feed', {
        url: '/feed',
        views: {
          'feed-tab': {
            templateUrl: 'templates/feed.html',
            controller: 'FeedController'
          }
        }
      })
      .state('product', {
        url: '/product/:id',
        templateUrl: 'templates/product.html',
        controller: 'ProductController'
      })
      .state('home.publish', {
        url: "/publish",
        views: {
          'publish-tab': {
            templateUrl: "templates/publish.html",
            controller: 'PublishController'
          }
        }
      })
      .state('home.profile', {
        url: "/profile/:id",
        views: {
          'profile-tab': {
            templateUrl: "templates/profile.html",
            controller: 'ProfileController'
          }
        }
      })
      .state('followers', {
        url: '/profile/followers/:id',
        templateUrl: 'templates/followers.html',
        controller: 'FollowersController'
      })
      .state('following', {
        url: '/profile/following/:id',
        templateUrl: 'templates/following.html',
        controller: 'FollowingController'
      })

      $urlRouterProvider.otherwise("/");

      $httpProvider.interceptors.push('authInterceptor');
  })

  .run(function($rootScope, $ionicPlatform, auth, store, jwtHelper, $state) {
    $ionicPlatform.ready(function() {
      if(window.cordova && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      }
      if(window.StatusBar) {
        StatusBar.styleDefault();
      }
    });

    $rootScope.$on('$locationChangeStart', function() {
      if (!auth.isAuthenticated) {
        var token = store.get('token');
        if (token) {
          if (!jwtHelper.isTokenExpired(token)) {
            auth.authenticate(store.get('profile'), token);
          } else {
            // Either show Login page or use the refresh token to get a new idToken
            $state.go('login');
          }
        }
      }
    });

    auth.hookEvents();
  })

})();
