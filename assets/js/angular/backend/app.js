/**
 * Created by Shah on 4/23/2016.
 */

var kp_clothes = angular.module('kp_clothes',['ui.router','oc.lazyLoad','angular-loading-bar','ui.bootstrap'])
    .config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = false;
    }])
    .run([ '$rootScope', '$state','$location','$log',function($rootScope,$state,$location,$log) {
        $rootScope.$state = $state;

        $rootScope.base_url = "http://localhost/kpk_clothes/";

        $rootScope.this_year = new Date().getFullYear();
        $rootScope.preventRedirection = function ($event) {
            $event.preventDefault();
        };

        $rootScope.go = function(link){
            $location.path(link);
        };
        $rootScope.redirect = function(link){
            window.location = link;
        };
        $rootScope.to_int = function(str){
            return parseInt(str);
        };
        $rootScope.to_float = function(str){
            return parseFloat(str);
        };
        $rootScope.my_dialog = {
            data:'',
            callback:'',
            class:'vd_bg-green vd_white',
            call : function () {
                $rootScope.my_dialog.callback($rootScope.my_dialog.data);
                $rootScope.my_dialog.close();
            },
            open : function (prams,callback) {
                if (prams.class) {
                    $rootScope.my_dialog.class = prams.class;
                }
                var $element = angular.element("[data-dialog]");
                $($element).modal('show');
                $($element).find(".modal-title").html(prams.title);
                $($element).find(".modal-body").html(prams.message);
                $rootScope.my_dialog.data = prams.data;
                $rootScope.my_dialog.callback = callback;
            },
            close: function () {
                $("[data-dialog]").modal('hide');
            }
        };






    }]);




