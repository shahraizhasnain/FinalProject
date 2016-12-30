/* global angular, document, window */
'use strict';

angular.module('starter.controllers', ['starter.services'])

        .controller('AppCtrl', function ($scope, $ionicModal, $ionicPopover, $timeout) {
            // Form data for the login modal
            $scope.loginData = {};
            $scope.isExpanded = false;
            $scope.hasHeaderFabLeft = false;
            $scope.hasHeaderFabRight = false;

            var navIcons = document.getElementsByClassName('ion-navicon');
            for (var i = 0; i < navIcons.length; i++) {
                navIcons.addEventListener('click', function () {
                    this.classList.toggle('active');
                });
            }

            ////////////////////////////////////////
            // Layout Methods
            ////////////////////////////////////////

            $scope.hideNavBar = function () {
                document.getElementsByTagName('ion-nav-bar')[0].style.display = 'none';
            };

            $scope.showNavBar = function () {
                document.getElementsByTagName('ion-nav-bar')[0].style.display = 'block';
            };

            $scope.noHeader = function () {
                var content = document.getElementsByTagName('ion-content');
                for (var i = 0; i < content.length; i++) {
                    if (content[i].classList.contains('has-header')) {
                        content[i].classList.toggle('has-header');
                    }
                }
            };

            $scope.setExpanded = function (bool) {
                $scope.isExpanded = bool;
            };

            $scope.setHeaderFab = function (location) {
                var hasHeaderFabLeft = false;
                var hasHeaderFabRight = false;

                switch (location) {
                    case 'left':
                        hasHeaderFabLeft = true;
                        break;
                    case 'right':
                        hasHeaderFabRight = true;
                        break;
                }

                $scope.hasHeaderFabLeft = hasHeaderFabLeft;
                $scope.hasHeaderFabRight = hasHeaderFabRight;
            };

            $scope.hasHeader = function () {
                var content = document.getElementsByTagName('ion-content');
                for (var i = 0; i < content.length; i++) {
                    if (!content[i].classList.contains('has-header')) {
                        content[i].classList.toggle('has-header');
                    }
                }

            };

            $scope.hideHeader = function () {
                $scope.hideNavBar();
                $scope.noHeader();
            };

            $scope.showHeader = function () {
                $scope.showNavBar();
                $scope.hasHeader();
            };

            $scope.clearFabs = function () {
                var fabs = document.getElementsByClassName('button-fab');
                if (fabs.length && fabs.length > 1) {
                    fabs[0].remove();
                }
            };
        })

        .controller('PopupCtrl', function ($scope, $ionicPopup, $timeout) {

            $scope.showConfirm = function () {
                $scope.data = {}

                var confirmPopup = $ionicPopup.confirm({
                    title: 'Consume Ice Cream',
                    cssClass: 'popupcustom',
                    template: 'Are you sure you want to eat this ice cream?',
                });

                confirmPopup.then(function (res) {
                    if (res) {
                        console.log('You are sure');
                    } else {
                        console.log('You are not sure');
                    }
                });
            }
        })

        // A confirm dialog
        // $scope.showConfirm = function() {
        //     var confirmPopup = $ionicPopup.confirm({
        //       title: 'Consume Ice Cream',
        //       template: 'Are you sure you want to eat this ice cream?'
        //     });
        //     confirmPopup.then(function(res) {
        //       if(res) {
        //         console.log('You are sure');
        //       } else {
        //         console.log('You are not sure');
        //       }
        //     });
        //   };



        .controller('LoginCtrl', function ($scope, $timeout, $stateParams, $rootScope, $location,ionicMaterialInk) {
            
            $scope.$parent.clearFabs();
            $timeout(function () {
                $scope.$parent.hideHeader();
            }, 0);
            ionicMaterialInk.displayEffect();
            
            $scope.login = function(Customer) {
                $rootScope.Customer = Customer;
                console.log($rootScope.Customer);
                 $location.path('app.profile');
                  console.log($rootScope.Customer);
            }
        })

        .controller('FriendsCtrl', function ($scope, $stateParams, $timeout, ionicMaterialInk, ionicMaterialMotion) {
            // Set Header
            $scope.$parent.showHeader();
            $scope.$parent.clearFabs();
            $scope.$parent.setHeaderFab('left');

            // Delay expansion
            $timeout(function () {
                $scope.isExpanded = true;
                $scope.$parent.setExpanded(true);
            }, 300);

            // Set Motion
            ionicMaterialMotion.fadeSlideInRight();

            // Set Ink
            ionicMaterialInk.displayEffect();
        })

        .controller('CategoryCtrl', function ($scope, $rootScope, ApiService) {
            var controller = 'Category';
             ApiService.getall($rootScope.sid, controller,function(callback){
            $scope.Category = callback;    
            });
            $scope.clicked = function (id) {
                $rootScope.cid = id;
                console.log($rootScope.cid + "Category");
            }


//            var URL = "http://localhost:52238/api/Api/Category/2";
//            $http.get(URL).then(function (resp) {
//                $scope.Category = resp.data['Data']['CategoryList'];
//                $scope.CategoryMessage = resp.data['Message'];
//                
////                console.log($scope.CategoryMessage);
//            }, function (err) {
////                console.error('ERR', err);
//            });
//            $scope.clicked = function (x) {
//                $scope.getSubcategories = function(x){
//                    console.log(x);
//                }
//                var postURL = "http://localhost:52238/api/Api/SubCategory";
//                $http.get(postURL + "/2011").then(function (resp) {
//                    console.log(resp);
//                });
//            }

//           Category.all();
//            
//             $scope.Category = Category.all();
//             console.log($scope.Category);
            //Set Header
//            $scope.$parent.showHeader();
//            $scope.$parent.clearFabs();
//            $scope.isExpanded = false;
//            $scope.$parent.setExpanded(false);
//            $scope.$parent.setHeaderFab(false);
//
////            // Set Motion
//            $timeout(function () {
//                ionicMaterialMotion.slideUp({
//                    selector: '.slide-up'
//                });
//            }, 300);
//
//            $timeout(function () {
//                ionicMaterialMotion.fadeSlideInRight({
//                    startVelocity: 3000
//                });
//            }, 700);
//
////            // Set Ink
//            ionicMaterialInk.displayEffect();
        })
        .controller('SubCategoryCtrl', function ($scope, $rootScope, ApiService) {
//            console.log($rootScope.cid + "SubCategory");
            var controller = 'SubCategory';
             ApiService.getall($rootScope.cid, controller,function(callback){
            $scope.SubCategory = callback;    
            });
            $scope.clicked = function (id) {
                $rootScope.scid = id;
            }
//                ApiService.getall(function($rootScope, controller, response){
//                    controller = "SubCategory";
//                    $scope.SubCategory = response;                
//            });
//            var URL = "http://localhost:52238/api/Api/Category/2";
//            $http.get(URL).then(function (resp) {
////                console.log('Success', resp.data['Data']['CategoryList']); // JSON object
//                $scope.SubCategory = resp.data['Data']['CategoryList'];
//                console.log($scope.SubCategory);
//            }, function (err) {
////                console.error('ERR', err);
//            });
//            $scope.clicked = function () {
//                var postURL = "http://localhost:52238/api/Api/Category";
//                $http.get(postURL + "/2").then(function (resp) {
//                    console.log(resp);
//                });
//            }

//           Category.all();
//            
//             $scope.Category = Category.all();
//             console.log($scope.Category);
            //Set Header
//            $scope.$parent.showHeader();
//            $scope.$parent.clearFabs();
//            $scope.isExpanded = false;
//            $scope.$parent.setExpanded(false);
//            $scope.$parent.setHeaderFab(false);
//
////            // Set Motion
//            $timeout(function () {
//                ionicMaterialMotion.slideUp({
//                    selector: '.slide-up'
//                });
//            }, 300);
//
//            $timeout(function () {
//                ionicMaterialMotion.fadeSlideInRight({
//                    startVelocity: 3000
//                });
//            }, 700);
//
////            // Set Ink
//            ionicMaterialInk.displayEffect();
        })

        .controller('ItemCtrl', function ($scope, $rootScope, $stateParams, $timeout, ionicMaterialMotion, ionicMaterialInk, ApiService, StorageService, $localStorage) {
            // Set Header
            $scope.$parent.showHeader();
            $scope.$parent.clearFabs();
            $scope.isExpanded = false;
            $scope.$parent.setExpanded(false);
            $scope.$parent.setHeaderFab(false);

            // Set Motion
            $timeout(function () {
                ionicMaterialMotion.slideUp({
                    selector: '.slide-up'
                });
            }, 300);

            $timeout(function () {
                ionicMaterialMotion.fadeSlideInRight({
                    startVelocity: 3000
                });
            }, 700);

            // Set Ink
            ionicMaterialInk.displayEffect();
            
            $scope.List = [];
            var controller = 'Item';
             ApiService.getall($rootScope.scid, controller,function(callback){
            $scope.Item = callback; 
            });
            $scope.add = function (x1,x2,x3,x4,x5) {
                var item = {
                    ItemID : x1,
                    ItemName : x2,
                    ItemPrice : x3,
                    ItemDiscountPercentage : x4,
                    StoreID :x5
                }
                StorageService.add(item);
                console.log($localStorage.items);
//                $scope.List.push(item);
//                console.log($scope.List);
//                ApiService.additem(item, function(callback){
//                    localStorage['List'] = JSON.stringify(callback);
//                });
            }
        })

        .controller('ListCtrl', function ($scope, $stateParams, $timeout, ionicMaterialMotion, ionicMaterialInk, $localStorage, StorageService) {
            // Set Header
            $scope.$parent.showHeader();
            $scope.$parent.clearFabs();
            $scope.isExpanded = false;
            $scope.$parent.setExpanded(false);
            $scope.$parent.setHeaderFab(false);

            // Set Motion
            $timeout(function () {
                ionicMaterialMotion.slideUp({
                    selector: '.slide-up'
                });
            }, 300);

            $timeout(function () {
                ionicMaterialMotion.fadeSlideInRight({
                    startVelocity: 3000
                });
            }, 700);

            // Set Ink
            ionicMaterialInk.displayEffect();
            var ItemList = $localStorage.items;
//            if(ItemList !== undefined){
                $scope.List = ItemList;
                $scope.remove = function (x) {
                StorageService.remove(x);
//                $scope.List.push(item);
//                console.log($scope.List);
//                ApiService.additem(item, function(callback){
//                    localStorage['List'] = JSON.stringify(callback);
//                });
            }
//
//            console.log(ItemList);
//        }
        })

        .controller('StoresCtrl', function ($scope, $stateParams, $timeout, ionicMaterialMotion, ionicMaterialInk, ApiService, $rootScope) {

            ApiService.Store(function (response) {
                $scope.Store = response;
            });
            $scope.clicked = function (x) {
                $rootScope.sid = x;
            }

            // Set Header
            $scope.$parent.showHeader();
            $scope.$parent.clearFabs();
            $scope.isExpanded = false;
            $scope.$parent.setExpanded(false);
            $scope.$parent.setHeaderFab(false);

            // Set Motion
            $timeout(function () {
                ionicMaterialMotion.slideUp({
                    selector: '.slide-up'
                });
            }, 300);

            $timeout(function () {
                ionicMaterialMotion.fadeSlideInRight({
                    startVelocity: 3000
                });
            }, 700);

            // Set Ink
            ionicMaterialInk.displayEffect();
        })

        .controller('ProfileCtrl', function ($scope, $stateParams, $rootScope, $timeout, ionicMaterialMotion, ionicMaterialInk) {
            // Set Header
            $scope.$parent.showHeader();
            $scope.$parent.clearFabs();
            $scope.isExpanded = false;
            $scope.$parent.setExpanded(false);
            $scope.$parent.setHeaderFab(false);

            // Set Motion
            $timeout(function () {
                ionicMaterialMotion.slideUp({
                    selector: '.slide-up'
                });
            }, 300);

            $timeout(function () {
                ionicMaterialMotion.fadeSlideInRight({
                    startVelocity: 3000
                });
            }, 700);

            // Set Ink
            ionicMaterialInk.displayEffect();
            console.log($rootScope.Customer);
        })

        .controller('ActivityCtrl', function ($scope, $stateParams, $timeout, ionicMaterialMotion, ionicMaterialInk) {
            $scope.$parent.showHeader();
            $scope.$parent.clearFabs();
            $scope.isExpanded = true;
            $scope.$parent.setExpanded(true);
            $scope.$parent.setHeaderFab('right');

            $timeout(function () {
                ionicMaterialMotion.fadeSlideIn({
                    selector: '.animate-fade-slide-in .item'
                });
            }, 200);

            // Activate ink for controller
            ionicMaterialInk.displayEffect();
        })

        .controller('GalleryCtrl', function ($scope, $stateParams, $timeout, ionicMaterialInk, ionicMaterialMotion) {
            $scope.$parent.showHeader();
            $scope.$parent.clearFabs();
            $scope.isExpanded = true;
            $scope.$parent.setExpanded(true);
            $scope.$parent.setHeaderFab(false);

            // Activate ink for controller
            ionicMaterialInk.displayEffect();

            ionicMaterialMotion.pushDown({
                selector: '.push-down'
            });
            ionicMaterialMotion.fadeSlideInRight({
                selector: '.animate-fade-slide-in .item'
            });

        })

        ;
