(function () {

    'use strict';

    var IndexFactory = function ($http, $q) {
        var IndexFactoryObj = {};

        /*--------------------------------------------------
         Get applicant information
         --------------------------------------------------*/
        IndexFactoryObj.AddUser = function (email, fname, lname, password, inform)
        {
            var data = { email : email, fname : fname, lname : lname, password : password, inform : inform };
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            return $http.post('/admin/adduser', data);
        }

        return IndexFactoryObj;
    }


    angular.module('Membership')
        .factory('IndexFactory', ['$http', '$q', IndexFactory]);

})();
