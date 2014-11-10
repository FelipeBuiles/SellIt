(function() {

  angular.module('sellit.directives', [])

  .directive('feedProfile', function() {
    return {
      restrict: 'E',
      templateUrl: 'partials/feed-profile.html'
    };
  })

  .directive('feedImage', function() {
    return {
      restrict: 'E',
      templateUrl: 'partials/feed-image.html'
    };
  })

  .directive('profileProducts', function() {
    return {
      restrict: 'E',
      templateUrl: 'partials/profile-products.html'
    };
  })

  .directive('profileNews', function() {
    return {
      restrict: 'E',
      templateUrl: 'partials/profile-news.html'
    };
  })

  .directive('preferenceProfile', function() {
    return {
      restrict: 'E',
      templateUrl: 'partials/preference-profile.hmtl'
    };
  })

  .directive('feedComments', ['feedService', function(feedService) {
    return {
      restrict: 'E',
      templateUrl: 'partials/feed-comments.html',
      scope: {
        name: '@name',
        profile: '@profile'
      },
      link: function(scope, element, attributes) {

        attributes.$observe('name', function(value) {
          if (value) {
            scope.name = value;
            scope.comments = feedService.getComments(value);
          }
        });
        attributes.$observe('profile', function(value) {
          if (value) {
            scope.profile = JSON.parse(value);
          }
        })
      },
      controller: function($scope) {
        $scope.comments = feedService.getComments($scope.name);
        $scope.comment = {};
        $scope.show = false;

        $scope.toggle = function() {
          $scope.show = !$scope.show;
        };


        $scope.addComment = function() {
          $scope.comment.date = Date.now();
          feedService.saveComment($scope.name, $scope.comment);
          $scope.comments = feedService.getComments($scope.name);
          $scope.comment = {};
        };

      }
    };
  }])

  .directive("appMap", function($window) {
      return {
        restrict: "E",
        replace: true,
        template: "<div></div>",
        scope: {
          center: "=", // Center point on the map (e.g. <code>{ latitude: 10, longitude: 10 }</code>).
          markers: "=", // Array of map markers (e.g. <code>[{ lat: 10, lon: 10, name: "hello" }]</code>).
          width: "@", // Map width in pixels.
          height: "@", // Map height in pixels.
          zoom: "@", // Zoom level (one is totally zoomed out, 25 is very much zoomed in).
          mapTypeId: "@", // Type of tile to show on the map (roadmap, satellite, hybrid, terrain).
          panControl: "@", // Whether to show a pan control on the map.
          zoomControl: "@", // Whether to show a zoom control on the map.
          scaleControl: "@" // Whether to show scale control on the map.
        },
        link: function(scope, element, attrs) {
            var toResize, toCenter;
            var map;
            var infowindow;
            var currentMarkers;
            var callbackName = 'InitMapCb';

            // callback when google maps is loaded
            $window[callbackName] = function() {
              console.log("map: init callback");
              createMap();
              updateMarkers();
            };

            if (!$window.google || !$window.google.maps) {
              console.log("map: not available - load now gmap js");
              loadGMaps();
            } else {
              console.log("map: IS available - create only map now");
              createMap();
            }

            function loadGMaps() {
              console.log("map: start loading js gmaps");
              var script = $window.document.createElement('script');
              script.type = 'text/javascript';
              script.src = 'http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&callback=InitMapCb';
              $window.document.body.appendChild(script);
            }

            function createMap() {
              console.log("map: create map start");
              var mapOptions = {
                zoom: 13,
                center: new google.maps.LatLng(47.55, 7.59),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: false,
                streetViewControl: false,
                navigationControl: true,
                disableDefaultUI: true,
                overviewMapControl: true
              };
              if (!(map instanceof google.maps.Map)) {
                console.log("map: create map now as not already available ");
                map = new google.maps.Map(element[0], mapOptions);
                // EDIT Added this and it works on android now
                // Stop the side bar from dragging when mousedown/tapdown on the map
                google.maps.event.addDomListener(element[0], 'mousedown', function(e) {
                  e.preventDefault();
                  return false;
                });
                infowindow = new google.maps.InfoWindow();
              }
            }

            scope.$watch('markers', function() {
              updateMarkers();
            });

            // Info window trigger function
            function onItemClick(pin, label, datum, url) {
              // Create content
              var contentString = "Name: " + label + "<br />Time: " + datum;
              // Replace our Info Window's content and position
              infowindow.setContent(contentString);
              infowindow.setPosition(pin.position);
              infowindow.open(map)
              google.maps.event.addListener(infowindow, 'closeclick', function() {
                //console.log("map: info windows close listener triggered ");
                infowindow.close();
              });
            }

            function markerCb(marker, member, location) {
              return function() {
                //console.log("map: marker listener for " + member.name);
                var href = "http://maps.apple.com/?q=" + member.lat + "," + member.lon;
                map.setCenter(location);
                onItemClick(marker, member.name, member.date, href);
              };
            }

          // update map markers to match scope marker collection
          function updateMarkers() {
            if (map && scope.markers) {
              // create new markers
              //console.log("map: make markers ");
              currentMarkers = [];
              var markers = scope.markers;
              if (angular.isString(markers)) markers = scope.$eval(scope.markers);
              for (var i = 0; i < markers.length; i++) {
                var m = markers[i];
                var loc = new google.maps.LatLng(m.lat, m.lon);
                var mm = new google.maps.Marker({ position: loc, map: map, title: m.name });
                //console.log("map: make marker for " + m.name);
                google.maps.event.addListener(mm, 'click', markerCb(mm, m, loc));
                currentMarkers.push(mm);
                map.setCenter(loc);
                }
              }
            }

            // convert current location to Google maps location
            function getLocation(loc) {
              if (loc == null) return new google.maps.LatLng(40, -73);
              if (angular.isString(loc)) loc = scope.$eval(loc);
              return new google.maps.LatLng(loc.lat, loc.lon);
            }

          } // end of link:
      }; // end of return
    })
    .directive('fancySelect', [
      '$ionicModal',
      function($ionicModal) {
        return {
          /* Only use as <fancy-select> tag */
          restrict: 'E',

          /* Our template */
          templateUrl: 'partials/fancy-select.html',

          /* Attributes to set */
          scope: {
            'items': '=',
            /* Items list is mandatory */
            'text': '=',
            /* Displayed text is mandatory */
            'value': '=',
            /* Selected value binding is mandatory */
            'callback': '&'
          },

          link: function(scope, element, attrs) {

            /* Default values */
            scope.multiSelect = attrs.multiSelect === 'true' ? true : false;
            scope.allowEmpty = attrs.allowEmpty === 'false' ? false : true;

            /* Header used in ion-header-bar */
            scope.headerText = attrs.headerText || '';

            /* Text displayed on label */
            // scope.text          = attrs.text || '';
            scope.defaultText = scope.text || '';

            /* Notes in the right side of the label */
            scope.noteText = attrs.noteText || '';
            scope.noteImg = attrs.noteImg || '';
            scope.noteImgClass = attrs.noteImgClass || '';

            /* Optionnal callback function */
            // scope.callback = attrs.callback || null;

            /* Instanciate ionic modal view and set params */

            /* Some additionnal notes here :
             *
             * In previous version of the directive,
             * we were using attrs.parentSelector
             * to open the modal box within a selector.
             *
             * This is handy in particular when opening
             * the "fancy select" from the right pane of
             * a side view.
             *
             * But the problem is that I had to edit ionic.bundle.js
             * and the modal component each time ionic team
             * make an update of the FW.
             *
             * Also, seems that animations do not work
             * anymore.
             *
             */
            $ionicModal.fromTemplateUrl(
              'partials/fancy-select-items.html', {
                'scope': scope
              }
            ).then(function(modal) {
              scope.modal = modal;
            });

            /* Validate selection from header bar */
            scope.validate = function(event) {
              // Construct selected values and selected text
              if (scope.multiSelect == true) {

                // Clear values
                scope.value = '';
                scope.text = '';

                // Loop on items
                jQuery.each(scope.items, function(index, item) {
                  if (item.checked) {
                    scope.value = scope.value + item.id + ';';
                    scope.text = scope.text + item.text + ', ';
                  }
                });

                // Remove trailing comma
                scope.value = scope.value.substr(0, scope.value.length - 1);
                scope.text = scope.text.substr(0, scope.text.length - 2);
              }

              // Select first value if not nullable
              if (typeof scope.value == 'undefined' || scope.value == '' || scope.value == null) {
                if (scope.allowEmpty == false) {
                  scope.value = scope.items[0].id;
                  scope.text = scope.items[0].text;

                  // Check for multi select
                  scope.items[0].checked = true;
                } else {
                  scope.text = scope.defaultText;
                }
              }

              // Hide modal
              scope.hideItems();

              // Execute callback function
              if (typeof scope.callback == 'function') {
                scope.callback(scope.value);
              }
            }

            /* Show list */
            scope.showItems = function(event) {
              event.preventDefault();
              scope.modal.show();
            }

            /* Hide list */
            scope.hideItems = function() {
              scope.modal.hide();
            }

            /* Destroy modal */
            scope.$on('$destroy', function() {
              scope.modal.remove();
            });

            /* Validate single with data */
            scope.validateSingle = function(item) {

              // Set selected text
              scope.text = item.text;

              // Set selected value
              scope.value = item.id;

              // Hide items
              scope.hideItems();

              // Execute callback function
              if (typeof scope.callback == 'function') {
                scope.callback(scope.value);
              }
            }
          }
        };
      }
    ]);

})();
