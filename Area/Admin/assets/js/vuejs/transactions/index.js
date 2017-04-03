var Login = new Vue({
    el: '#transactions_panel',
    data: {
        transactions : [],
        start_date : '',
        end_date : '',
        page: 1,
        page_count: 1,
        page_size: 25,
        order_by: 'date',
        search_by: ''
    },
    created: function () {
        this.getTransactions();
    },
    methods: {
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
        }
    }
});

