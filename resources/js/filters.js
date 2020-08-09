const moment = require("moment");

module.exports = {
    filters: {
        now() {
            return moment();
        },
        date(value, format = "short") {
            const dt = moment(value);

            switch (format) {
                case "long":
                    return dt.format("LL");
                default:
                    return dt.format("DD/MM/YYYY");
            }
        },
        timestamp(value, format = "short") {
            const dt = moment(value);

            switch (format) {
                case "long":
                    return dt.format("LLLL");
                default:
                    return dt.format("llll");
            }
        },
        humanize(value, interval = "months") {
            return moment.duration(value, interval).humanize();
        },
        currency(value) {
            return "€" + (+value).toFixed(2);
        }
    }
};
