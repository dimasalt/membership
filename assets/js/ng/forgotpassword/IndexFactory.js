(function () {

    'use strict';

    var IndexFactory = function ($http, $q) {
        var IndexFactoryObj = {};

        /*--------------------------------------------------
         Get applicant information
         --------------------------------------------------*/
        IndexFactoryObj.GetPassword = function (useremail, csrf)
        {
            var data = { useremail : useremail, csrf: csrf };
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            return $http.post('/account/getpassword', data);
        }

        return IndexFactoryObj;
    }


    angular.module('Membership')
        .factory('IndexFactory', ['$http', '$q', IndexFactory]);

})();
