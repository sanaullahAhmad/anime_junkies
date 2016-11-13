kp_clothes.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
    // For any unmatched url, redirect to /state1
    $urlRouterProvider.otherwise("/");
    //
    // Now set up the states
    $stateProvider

        .state('home', {
            url: "/",
            data: {pageTitle: 'Home Page'},
            views: {
                "main": {
                    controller: "homeController",
                    templateUrl: "home/template/home-layout1"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'homeController',
                            // add UI select css / js for this state
                            files: [
                               $rootScope.base_url+'angular/directives/owlcarousel.js',
                               $rootScope.base_url+'angular/frontend/controllers/homeController.js',
                            ]
                        }]).then(function success(args) {

                        console.log('success');
                        return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })

       /* .state('categories_horizontal', {
            url: "/categories/:display",
            data: {pageTitle: 'All Categories'},
            views: {
                "main": {
                    controller: "categoryController",
                    templateUrl:function ($stateParams) {
                        console.log($stateParams.display);
                        return 'home/template/' + ($stateParams.display==null?'category':'category-horizontal');
                    }
                    //templateUrl: "home/template/category-horizontal"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'categoryController',
                            files: [
                                'angular/frontend/controllers/productController.js'
                            ]
                        }
                        ]);
                }]
            }
        })*/
        .state('products', {
            url: "/products",
            data: {pageTitle: 'Products'},
            views: {
                "main": {
                    controller: "productController",
                    templateUrl: "home/template/products"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'productController',
                            files: [
                                'angular/frontend/controllers/productController.js'
                            ]
                         }
                        ]);
                }]
            }
        })

        
}
]);