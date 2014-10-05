(function() {
  angular.module(
    'sellit',
  ['ionic', 'sellit.controllers', 'auth0'])

  .config(function (authProvider, $httpProvider) {
      authProvider
      .init({
        domain: 'sellit.auth0.com',
        clientID: 'JEEpuyCpk4TaG0iExkfOl7gUUa3TP1dH',
        callbackURL: location.href,
        loginState: 'login'
      });

      $httpProvider.interceptors.push('authInterceptor');
  })

  .config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
    .state('login', {
      url: '/',
      templateUrl: 'views/login.html',
      controller: 'LoginController',
    })
    .state('home', {
      url: "/home",
      abstract: true,
      templateUrl: 'views/home.html',
      controller: 'HomeController'
    })
    .state('home.feed', {
      url: "/feed",
      views: {
        'feed-tab': {
          templateUrl: 'views/feed.html',
          controller: 'FeedController',
          data: {
            requiresLogin: true
          }
        }
      }
    })
    .state('home.publish', {
      url: "/home/publish",
      views: {
        'publish-tab': {
          templateUrl: "views/publish.html",
          controller: 'PublishController',
          data: {
            requiresLogin: true
          }
        }
      }
    })
    .state('home.profile', {
      url: "/home/profile",
      views: {
        'profile-tab': {
          templateUrl: "views/profile.html",
          controller: 'ProfileController',
          data: {
            requiresLogin: true
          }
        }
      }
    })

    $urlRouterProvider.otherwise("/");
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
