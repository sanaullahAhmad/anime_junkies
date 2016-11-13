//kp_clothes.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
kp_clothes.config(['$stateProvider', '$locationProvider','$urlRouterProvider', function($stateProvider, $locationProvider,$urlRouterProvider){

    $locationProvider.html5Mode({ enabled: true });
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
                    templateUrl: "home/template/index"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'homeController',
                            // add UI select css / js for this state
                            files: [
                               $rootScope.base_url+'assets/js/angular/frontend/controllers/homeController.js'
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

        .state('videodetail', {
            url: "/videodetail/:slug",
            data: {pageTitle: 'Video Detail'},
            views: {
                "main": {
                    controller: "videodetailController",
                    templateUrl: "home/template/videodetail"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'videodetailController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/videodetailController.js'
                            ]
                        }]).then(function success(args) {
                            return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('category', {
            url: "/category/:slug",
            data: {pageTitle: 'Category'},
            views: {
                "main": {
                    controller: "categoryController",
                    templateUrl: "home/template/category"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'categoryController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/categoryController.js'
                            ]
                        }]).then(function success(args) {
                            return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('categoryhot', {
            url: "/categoryhot/:slug/hot",
            data: {pageTitle: 'Category Hot'},
            views: {
                "main": {
                    controller: "categoryhotController",
                    templateUrl: "home/template/category"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'categoryhotController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/categoryhotController.js'
                            ]
                        }]).then(function success(args) {
                        return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('forgot_password_change', {
            url: "/forgot_password_change/:slug/hot",
            data: {pageTitle: 'chage forgot password'},
            views: {
                "main": {
                    controller: "forgotPasswordChangeController",
                    templateUrl: "home/template/forgot_password_change"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'forgotPasswordChangeController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/forgotPasswordChangeController.js'
                            ]
                        }]).then(function success(args) {
                        return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })

        .state('video', {
            url: "/video/:slug",
            data: {pageTitle: 'Video'},
            views: {
                "main": {
                    controller: "videoController",
                    templateUrl: "home/template/video"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'videoController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/videoController.js'
                            ]
                        }]).then(function success(args) {
                             return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('register', {
            url: "/register",
            data: {pageTitle: 'Register'},
            views: {
                "main": {
                    controller: "registerController",
                    templateUrl: "home/template/register"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'registerController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/registerController.js'
                            ]
                        }]).then(function success(args) {
                          return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('welcome', {
            url: "/welcome",
            data: {pageTitle: 'Wel Come'},
            views: {
                "main": {
                    controller: "welcomeController",
                    templateUrl: "home/template/welcome"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'welcomeController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/welcomeController.js'
                            ]
                        }]).then(function success(args) {
                          return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('uploadvideos', {
            url: "/uploadvideos",
            data: {pageTitle: 'Upload Videos'},
            views: {
                "main": {
                    controller: "uploadvideosController",
                    templateUrl: "home/template/uploadvideos"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'uploadvideosController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/uploadvideosController.js'
                            ]
                        }]).then(function success(args) {
                          return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('settings', {
            url: "/settings",
            data: {pageTitle: 'Settings'},
            views: {
                "main": {
                    controller: "settingsController",
                    templateUrl: "home/template/settings"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'settingsController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/settingsController.js'
                            ]
                        }]).then(function success(args) {
                          return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('meinevideos', {
            url: "/meinevideos",
            data: {pageTitle: 'Meine Videos'},
            views: {
                "main": {
                    controller: "meinevideosController",
                    templateUrl: "home/template/meinevideos"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'meinevideosController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/meinevideosController.js'
                            ]
                        }]).then(function success(args) {
                        return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('anemitrend', {
            url: "/anemitrend",
            data: {pageTitle: 'Anemi Trend'},
            views: {
                "main": {
                    controller: "anemitrendController",
                    templateUrl: "home/template/anemitrend"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'anemitrendController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/anemitrendController.js'
                            ]
                        }]).then(function success(args) {
                        return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('do_logout', {
            url: "/do_logout",
            data: {pageTitle: 'Log Out'},
            views: {
                "main": {
                    controller: "do_logoutController",
                    templateUrl: "home/template/anemitrend"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'do_logoutController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/do_logoutController.js'
                            ]
                        }]).then(function success(args) {
                        return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('facebook_login', {
            url: "/facebook_login",
            data: {pageTitle: 'Facebook Login'},
            views: {
                "main": {
                    controller: "facebook_loginController",
                    templateUrl: "home/template/anemitrend"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'facebook_loginController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/facebook_loginController.js'
                            ]
                        }]).then(function success(args) {
                        return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })
        .state('search', {
            url: "/search",
            data: {pageTitle: 'Search Results'},
            views: {
                "main": {
                    controller: "searchController",
                    templateUrl: "home/template/search"
                }
            },
            resolve: {
                required: ['$ocLazyLoad','$rootScope', function ($ocLazyLoad,$rootScope) {
                    return $ocLazyLoad.load(
                        [{
                            name: 'searchController',
                            // add UI select css / js for this state
                            files: [
                                $rootScope.base_url+'assets/js/angular/frontend/controllers/searchController.js'
                            ]
                        }]).then(function success(args) {
                          return args;
                    }, function error(err) {
                        console.log(err);
                        return err;
                    });
                }]
            }

        })


}
]);