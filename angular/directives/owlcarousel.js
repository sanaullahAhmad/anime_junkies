kp_clothes.directive('owlcarousel',function(){

    var linker = function(scope,element,attr){
        var next = (attr.owlNext!=null?attr.owlNext:'');
        var prev = (attr.owlPrev!=null?attr.owlPrev:'');
        var play = (attr.owlPlay!=null?attr.owlPlay:'');
        var stop = (attr.owlStop!=null?attr.owlStop:'');
        //carrega o carrosel
       /* {
            /!*items : 10, //10 items above 1000px browser width
             itemsDesktop : [1000,5], //5 items between 1000px and 901px
             itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
             itemsTablet: [600,2], //2 items between 600 and 0;
             itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option*!/

            slideSpeed: 300,
                paginationSpeed: 400,
            // pagination: owlSliderPagination,
            singleItem: true,
            navigation: true,
            navigationText: ['', ''],
            transitionStyle: 'goDown',
            autoPlay: 4500
        }*/
        var loadCarousel = function(){
            element.owlCarousel(scope.owlConfig);
        };

        //aplica as ações para o carrosel
        var loadCarouselActions = function(){
            if(next.length>0){
                angular.element(next).click(function(){
                    element.trigger('owl.next');
                });
            }
            if(prev.length>0){
                angular.element(prev).click(function(){
                    element.trigger('owl.prev');
                });
            }
            if(play.length>0){
                angular.element(play).click(function(){
                    element.trigger('owl.play',1000);
                });
            }
            if(stop.length>0){
                angular.element(stop).click(function(){
                    element.trigger('owl.stop');
                });
            }

        };

        //toda vez que adicionar ou remover um item da lista ele carrega o carrosel novamente
        scope.$watch("itens", function(value) {
            loadCarousel(element);
        });

        //inicia o carrosel
        loadCarouselActions();
    }

    return{
        restrict : "A",
        scope: {
            owlConfig: '=owlcarousel'
        },
        link: linker
    }

});