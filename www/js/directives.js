(function () {

  angular.module('sellit.directives', [])
    .directive('feedProfile', function () {
      return {
        restrict: 'E',
        templateUrl: 'partials/feed-profile.html'
      };
    })

    .directive('feedImage', function () {
      return {
        restrict: 'E',
        templateUrl: 'partials/feed-image.html'
      };
    })

})();
