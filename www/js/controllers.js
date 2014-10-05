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

  .controller('PublishController', function($scope, $state) {

  })

  .controller('ProfileController', function($scope, $state, auth) {
    $scope.profile = auth.profile;
  })

})();
