const moment = require("moment");

module.exports = {
    filters: {
        now() {
            return moment();
        },
        date(value) {
            return moment(value).format("L");
        },
        currency(value) {
            return +value.toFixed(2) + " €";
        }
    }
};
