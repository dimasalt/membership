var ForgotPassword = new Vue({
    el: '#password-change',
    data: {
        password1 : '',
        password2 : '',
        displayForm : true,
        displayButton : false,
        //crf : '',
        alert : {
            error : false,
            success: false,
            message: ''
        }
    },
    created: function () {
        $('#loader').hide();
        $('#modal').modal('show');
    },
    methods: {
        ChangePassword: function () {
            var self = this;

            // if passwords empty
            if(this.password1.length == 0 || this.password2.length == 0) {
                this.alert = {error: true, message: 'Password is required'};
                return;
            }

            //if passwords do not match
            if(this.password1 != this.password2) {
                this.alert = {error: true, message: 'Passwords do not match'};
                return;
            }

            $('#loader').show(); //show loader
            $('input').prop( "disabled", true );


            //prepare data
            var data = { password : self.password1, csrf: $('#csrf').val() };
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            var passwordChange = $.post( "/account/password_change", data);

            passwordChange.done(function( data ) {
                if (data.is_success == true) {
                    self.alert = { success: true, message: data.message };
                    self.displayForm = false;
                    self.displayButton = true;
                }
                else if (data.is_success == false) {
                    self.alert = { error: true, message: data.message };
                }
            });

            passwordChange.always(function () {
                $('input').prop( "disabled", false );
                $('#loader').hide();
            });


            // Prevent default posting of form
            event.preventDefault();
        }
    }
});