/**
 * Created by Shah on 4/23/2016.
 */
//var base_url = ''
kp_clothes.config(function ($routeProvider) {
    $routeProvider.when('/categories',{
        templateUrl: 'template/view/manageCategory',
        controller:'categoryController'
    }).when('/',{
        templateUrl: 'template/view/dashboard',
        controller: 'mainController'
    }).when('/employees',{
        templateUrl: 'template/view/employeesList',
        controller:'employeeController'
    }).when('/employees/new',{
        templateUrl: 'template/view/newEmployee',
        controller:'employeeController'
    }).when('/employee/profile/:user_name',{
        templateUrl: 'template/view/userProfile',
        controller:'employeeController'
    }).when('/customers',{
        templateUrl: 'template/view/customersList',
        controller:'customerController'
    }).when('/customers/new',{
        templateUrl: 'template/view/newCustomer',
        controller:'customerController'
    });
});