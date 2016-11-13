/**
 * Created by Shah on 4/23/2016.
 */
kp_clothes.service('products',['$http','$log',function ($http,$log) {
    var self = this;
    this.products = {};
   this.get_categories = function (success) {
       $http.get('product/categories')
           .success(function (data) {
               if(data.categories!=null){
                   success(data.categories);
               }else {
                   success(false);
               }
           })
           .error(function (data,status,code) {
                $log.debug(data);
           });
   };

   this.get_category = function (category_id) {
       
   };

    this.get_products = function (success) {
        $http.get('product/get')
            .success(function (data) {
                if(data!=null){
                    success(data);
                }else {
                    success(false);
                }
            })
            .error(function (data,status,code) {
                $log.debug(data);
            });
    };

    this.get_product = function () {

    };


    
    
    
}]);