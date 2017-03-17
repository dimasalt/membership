(function () {

    'use strict';

    var IndexFactory = function ($http, $q) {
        var IndexFactoryObj = {};

        /*--------------------------------------------------
         Get applicant information
         --------------------------------------------------*/
        IndexFactoryObj.DoLogin = function (useremail, userpassword)
        {
            var data = { useremail : useremail, userpassword : userpassword };
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            return $http.post('/account/dologin', data);
        }

        return IndexFactoryObj;
    }


    angular.module('Membership')
        .factory('IndexFactory', ['$http', '$q', IndexFactory]);

})();
