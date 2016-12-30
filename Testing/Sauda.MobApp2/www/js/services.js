angular.module('starter.services', ['ngResource'])
//.factory('Category', function($resource){
//return $resource('http://localhost:52238/api/Api/Category/2');
//});

//        .service('Category', function ($q, $http) {
//                
//                return {
//                    getAllCategory: function(storeID){
//                        }
//                        
//                    }
//                });
//angular.module('starter.services', ['ngResource'])
//
//.factory('Session', function ($resource) {
//    return $resource('http://localhost:5000/sessions/:sessionId');
//});


        .factory('ApiService', function ($http) {
            return{
                Store: function (callback) {
                    var List;
                    var apiUrl = 'http://localhost:52238/api/Api/Store';
                    $http.get(apiUrl).then(function (resp) {
                        List = resp.data['Data']['StoreList'];
                        callback(List);
                    });
                },
//                List: function (callback){
//                    var List = "";
//                    var apiUrl = 'http://localhost:52238/api/Api/Category/2';
//                    $http.get(apiUrl).then( function(resp){
//                        List = resp.data['Data'].CategoryList;
//                        callback(List);
//                    });
//                    
//                },
                getall: function (id, controller, callback) {
                    var List = "";
                    var apiUrl = 'http://localhost:52238/api/Api/' + controller + "/" + id;
                    $http.get(apiUrl).then(function (resp) {
                        List = resp.data['Data'][controller + "List"];
                        return callback(List);
                    });
                },
                additem: function (item, callback) {
                    return callback(item);
                }
            }
        })

        .filter('getById', function () {
            return function (input, id) {
                var i = 0, len = input.length;
                for (; i < len; i++) {
                    if (+input[i]['ItemID'] == +id) {
                        return i;
                    }
                }
                return null;
            }
        })
        
        

.factory('StorageService', function ($localStorage,$filter) {

    $localStorage = $localStorage.$default({
        items: []
    });

    var _getAll = function () {
        return $localStorage.items;
    };
    var _add = function (item) {
        $localStorage.items.push(item);
    }
    var _remove = function (x) {
        var itemID = $filter('getById')($localStorage.items, x);
//        var selected = JSON.stringify(itemID);
        $localStorage.items.splice(itemID,1);
//        console.log($localStorage.items[itemID]);
    }

    return {
        getAll: _getAll,
        add: _add,
        remove: _remove
    };
})
