(function() {
  angular.module( 'sellit',
  ['ionic', 'sellit.controllers', 'auth0', 'ngCordova', 'sellit.services'])

  .config(function (authProvider, $httpProvider, $stateProvider, $urlRouterProvider) {
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
        url: "/profile",
        views: {
          'profile-tab': {
            templateUrl: "templates/profile.html",
            controller: 'ProfileController'
          }
        }
      })

      $urlRouterProvider.otherwise("/");

      $httpProvider.interceptors.push('authInterceptor');
  })

  .run(function($ionicPlatform, auth) {
    $ionicPlatform.ready(function() {
      if(window.cordova && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      }
      if(window.StatusBar) {
        StatusBar.styleDefault();
      }
    });

    auth.hookEvents();
  })

})();
