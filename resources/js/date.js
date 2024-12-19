window.now_date = function () {
    let today = new Date();
    let formattedDate = formatDate(today);

    return formattedDate;
};

window.formatDate = function (date) {
    let day = String(date.getDate()).padStart(2, "0");
    let month = String(date.getMonth() + 1).padStart(2, "0");
    let year = date.getFullYear();

    return day + "/" + month + "/" + year;
};
