(function() {
  angular.module(
    'sellit',
  ['ionic', 'sellit.controllers', 'auth0'])

  .config(function ($stateProvider, $urlRouterProvider, authProvider, $httpProvider) {
      authProvider
      .init({
        domain: 'sellit.auth0.com',
        clientID: 'JEEpuyCpk4TaG0iExkfOl7gUUa3TP1dH',
        callbackURL: location.href,
        loginState: 'login'
      });

      $stateProvider
      .state('login', {
        url: '/',
        templateUrl: 'views/login.html',
        controller: 'LoginController',
      })
      .state('home', {
        url: "/home",
        abstract: true,
        templateUrl: "views/home.html",
        controller: 'HomeController',
        data: {
          requiresLogin: true
        }
      .state('home.feed', {
        url: "/feed",
        views: {
          'home-tab': {
            templateUrl: "views/feed.html",
            controller: 'FeedController',
            data: {
              requiresLogin: true
            }
          }
        }
      })
      .state('home.publish', {
        url: "/publish",
        views: {
          'home-tab': {
            templateUrl: "views/publish.html",
            controller: 'PublishController',
            data: {
              requiresLogin: true
            }
          }
        }
      })
      .state('home.profile', {
        url: "/profile",
        views: {
          'home-tab': {
            templateUrl: "views/profile.html",
            controller: 'ProfileController',
            data: {
              requiresLogin: true
            }
          }
        }
      })
      });

      $urlRouterProvider.otherwise("/");

      $httpProvider.interceptors.push('authInterceptor');
  })

  .run(function($ionicPlatform) {
    $ionicPlatform.ready(function() {
      if(window.cordova && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      }
      if(window.StatusBar) {
        StatusBar.styleDefault();
      }
    });
  })
  .run(function(auth) {
    auth.hookEvents();
  });
})();
