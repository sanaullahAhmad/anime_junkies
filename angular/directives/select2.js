
angular.module('select2', [])
    .directive('select2', ['$log',
        function() {
            return {
                restrict: 'A',
                scope:{
                    select2:"="
                },
                link: function(scope, element, attrs) {
                    element.select2(scope.select2);

                }
            }
        }
    ]);

