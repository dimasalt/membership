var Login = new Vue({
    el: '#logs_panel',
    data: {
        logs : [],
        all_selected: false,
        start_date : '',
        end_date : '',
        message : '',
        page: 1,
        page_count: 1,
        page_size: 25,
        order_by: 'date',
        search_by: ''
    },
    created: function () {
        this.getLogs();
    },
    methods: {
        getLogs: function () {
            var self = this;

            var data = {page: self.page - 1, order_by: self.order_by, search_by : self.search_by, page_size: self.page_size};
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            var logs = $.post("/admin/system/getlogs", data);

            logs.done(function (data) {
                if (data.logs.length > 0) {
                    self.logs = data.logs;

                    for (var i = 0; i < self.logs.length; i++)
                        self.logs[i].selected = false;

                    if(data.logs_count > 25)
                        self.page_count = parseInt((data.logs_count / 25) + 1);
                    else self.page_count = 1;
                }
                else {
                    self.logs = [];
                    self.page_count = 1;
                }
            });

            logs.always(function () {
                // // Reenable the inputs
                // $('input').prop( "disabled", false );
            });
        },
        nextPage: function (num) {
            var self = this;

            self.page = num;
            self.getLogs();
        },
        OrderBy: function (order_param) {
            var self = this;

            self.order_by = order_param;
            
            self.getLogs();
        },
        searchBy: function () {
            var self = this;

            self.getLogs();
        },
        checkAll: function () {
            var self = this;

            for (var i = 0; i < self.logs.length; i++)
                self.logs[i].selected = self.all_selected;
        },
        removeSelectedModal: function () {
            $('#logs_selected_modal').modal('show');
        },
        removeSelected : function () {
            var self = this;
            var log_items = [];

            for(var i = 0; i < self.logs.length; i++)
            {
                if(self.logs[i].selected)
                    log_items.push({id: self.logs[i].id});
            }

            //send to
            var data = {log_items: log_items};
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            var logs = $.post("/admin/system/removeselectedlogs", data);

            logs.done(function (data) {
                if (data.result === true) {

                    //remove highlighted rows
                    $('tr.selected').removeClass('selected');

                    toastr.success('All selected logs have been successfully removed.');
                }
                else toastr.error('Ops, something went wrong and we were unable to remove selected logs.');
            });

            logs.always(function () {
                self.getLogs();
            });

        },
        removeAllModal: function () {
            $('#logs_modal').modal('show');
        },
        removeAll : function () {
            var self = this;

            var data = {};
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            var logs = $.post("/admin/system/removealllogs", data);

            logs.done(function (data) {
                if (data.result === true) {
                    self.logs = [];

                    toastr.success('All logs have been successfully removed.');
                }
                else toastr.error('Ops, something went wrong and we were unable to remove logs.');

            });

            logs.always(function () {});

            // Prevent default posting of form
            event.preventDefault();
        }
    }
});
