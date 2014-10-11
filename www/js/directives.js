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

    .directive('feedComments', ['feedService', function (feedService) {
      return {
        restrict: 'E',
        templateUrl: 'partials/feed-comments.html',
        scope: {
          name: '@name'
        },
        link: function (scope, element, attributes) {
          attributes.$observe('name', function (value) {
            if (value) {
              scope.name = value;
              scope.comments = feedService.getComments(value);
            }
          });
        },
        controller: function ($scope) {
          $scope.comments = feedService.getComments($scope.name);
          $scope.comment = {};
          $scope.show = false;

          $scope.toggle = function () {
            $scope.show = !$scope.show;
          };


          $scope.addComment = function () {
            $scope.comment.date = Date.now();
            feedService.saveComment($scope.name, $scope.comment);
            $scope.comments = feedService.getComments($scope.name);
            $scope.comment = {};
          };

        }
      };
    }]);

})();
