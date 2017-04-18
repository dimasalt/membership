var Transactions = new Vue({
    el: '#transactions_panel',
    data: {
        transactions : [],
        today_transactions : [],
        transaction_stats : {},
        start_date : '',
        end_date : '',
        page: 1,
        page_count: 1,
        page_size: 25,
        order_by: 'date',
        search_by: ''
    },
    created: function () {
        var self = this;

        self.start_date = moment().subtract(29, 'days');
        self.end_date = moment();

        $('#daterange').text('(' + self.start_date.format('MMMM D, YYYY') + ' - ' + self.end_date.format('MMMM D, YYYY') + ')');

        self.getTransactions();
        self.getTodayTransactions();
    },
    methods: {
        getTodayTransactions: function () {
            var self = this;

            var data = {};
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            var trans = $.post("/admin/transactions/getTodayTransactions", data);

            trans.done(function (data) {
                if (data.today_transactions.length > 0) {
                    self.today_transactions = data.today_transactions;
                }
            });

            trans.always(function () {
                // // Reenable the inputs
                // $('input').prop( "disabled", false );
            });
        },
        getTransactions: function () {
            var self = this;

            var data = {page: self.page - 1, order_by: self.order_by, search_by : self.search_by, page_size: self.page_size, start_date: self.start_date, end_date: self.end_date};
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            var trans = $.post("/admin/transactions/getTransactions", data);

            trans.done(function (data) {
                if (data.transactions.length > 0) {
                    self.transactions = data.transactions;

                    for (var i = 0; i < self.transactions.length; i++)
                        self.transactions[i].selected = false;

                    if(data.transactions_count > 25)
                        self.page_count = parseInt((data.transactions_count / 25) + 1);
                    else self.page_count = 1;
                }
                else {
                    self.transactions = [];
                    self.page_count = 1;
                }
            });

            trans.always(function () {
                // // Reenable the inputs
                // $('input').prop( "disabled", false );
            });
        },
        getTransactionStats : function () {
            var self = this;

            var data = {start_date: self.start_date, end_date: self.end_date};
            data = JSON.stringify(data); // $.param({ 'id': ticket_id });

            var stats = $.post("/admin/transactions/getTransactionStats", data);

            stats.done(function (data) {
                if (data.transaction_stats.length > 0)
                    self.transaction_stats = data.transaction_stats;
            });

            stats.always(function () {
                // // Reenable the inputs
                // $('input').prop( "disabled", false );
            });
        },
        nextPage: function (num) {
            var self = this;

            self.page = num;
            self.getTransactions();
        },
        OrderBy: function (order_param) {
            var self = this;

            self.order_by = order_param;

            self.getTransactions();
        },
        searchBy: function () {
            var self = this;

            self.getTransactions();
        },
        openDateRange: function () {
            var self = this;

            $('#reportrange').daterangepicker({
                startDate: self.start_date,
                endDate: self.end_date,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '2016': [moment('2016-01-01'), moment('2016-12-31')],
                    '2017': [moment('2017-01-01'), moment('2017-12-31')]
                }
            }, function(start, end, label) {
                //formating date with moment JS
                //console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");

                // self.start_date = start._d.getDate() + '/' + start._d.getMonth() + '/' + start._d.getFullYear();
                // self.end_date =  end._d.getDate() + '/' + end._d.getMonth() + '/' + end._d.getFullYear();

                self.start_date = start.format('L');
                self.end_date =  end.format('L');

                //$('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
                $('#daterange').text('(' + start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY') + ')');

                self.getTransactions();
                self.getTransactionStats();
            });
        }
    }
});


// $(document).ready(function () {
//     var start = moment().subtract(29, 'days');
//     var end = moment();
//
//     function cb(start, end) {
//         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
//     }
//
//     $('#reportrange').daterangepicker({
//         startDate: start,
//         endDate: end,
//         ranges: {
//             'Today': [moment(), moment()],
//             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//             'This Month': [moment().startOf('month'), moment().endOf('month')],
//             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//         }
//     }, cb);
//
//     cb(start, end);
//
//     $('#reportrange span').change(function () {
//         Transactions.start_date = start.format('DD/MM/YYYY');
//         Transactions.end_date = end.format('DD/MM/YYYY');
//
//         Transactions.getTransactions();
//     });
//
//
// });

