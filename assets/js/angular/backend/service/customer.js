/**
 * Created by Shah on 4/23/2016.
 */
kp_clothes.service('customer',['$http','settings','$log',function ($http,settings,$log) {
    var self = this;

        this.get = function (id,on_success,on_error,on_complete) {
            if(id!=null && id>0){
               $http.get(settings.base_url+'customer/view/'+id)
                            .then(function(response){
                                // success
                                if(on_success!=null && on_success!=false){
                                    on_success(response.data);
                                }else {
                                    $log.debug('returning data');
                                    return response.data;
                                }
                            }, function (response) {
                                // error
                                if(on_error!=null && on_error!=false){
                                    on_error(response);
                                }
                            }).then(function () {
                                // complete
                            if(on_complete!=null && on_complete!=false){
                                on_complete();
                            }
               });

            }else {
                return false;
            }
     };

    this.find = function () {
        $log.debug('Search Customer');
    };

    this.get_all = function () {
        $log.debug("GET All customers");
    };


    this.delete = function () {
        $log.debug('Delete Customer');
    };




}]);