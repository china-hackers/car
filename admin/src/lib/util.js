export const formatDate = (d) => {
    let currDate = d.getDate();
    let currMonth = d.getMonth() + 1;
    let currYear = d.getFullYear();
    /* eslint-disable */
    String(currMonth).length < 2 ? (currMonth = '0' + currMonth) : currMonth;
    String(currDate).length < 2 ? (currDate = '0' + currDate) : currDate;
    var yyyyMMdd = currYear + '-' + currMonth + '-' + currDate;
    return yyyyMMdd;
};
