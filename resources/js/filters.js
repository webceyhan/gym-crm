const moment = require("moment");

module.exports = {
    filters: {
        now() {
            return moment();
        },
        date(value) {
            return moment(value).format("L");
        },
        timestamp(value) {
            return moment(value).format("LLL");
        },
        currency(value) {
            return +value.toFixed(2) + " €";
        }
    }
};
