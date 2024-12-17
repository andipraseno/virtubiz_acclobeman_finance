function msgFlash(message, icon) {
    return new Promise((resolve) => {
        Swal.fire({
            position: "top-end",
            title: message,
            icon: icon,
            showConfirmButton: false,
            timer: 1000,
        });

        setTimeout(() => {
            resolve(true);
        }, 1000);
    });
}

function msgInfo(message, icon) {
    return new Promise((resolve) => {
        Swal.fire({
            title: message,
            icon: icon,
            showCancelButton: false,
            confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
            cancelButtonClass: "btn btn-dark w-xs mt-2",
            confirmButtonText: "Ok",
            cancelButtonText: "Tidak",
            buttonsStyling: false,
            showCloseButton: true,
        }).then((result) => {
            resolve(result.isConfirmed);
        });
    });
}

function msgQuestion(message, icon) {
    return new Promise((resolve) => {
        Swal.fire({
            title: message,
            icon: icon,
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
            cancelButtonClass: "btn btn-dark w-xs mt-2",
            confirmButtonText: "Lanjutkan",
            cancelButtonText: "Tidak",
            buttonsStyling: false,
            showCloseButton: true,
        }).then((result) => {
            resolve(result.isConfirmed);
        });
    });
}

function preview_a4(url, title) {
    let height = 650;
    let width = 1050;
    let left = (screen.width - width) / 2;
    let top = (screen.height - height) / 4;

    let myWindow = window.open(
        url,
        title,
        `toolbar=no,
             location = no,
             directories = no,
             status = no,
             menubar = no,
             scrollbars = no,
             resizable = no,
             copyhistory = no,
             width = ` +
            width +
            `,
             height = ` +
            height +
            `,
             top = ` +
            top +
            `,
             left = ` +
            left
    );
}

function preview_roll(url, title) {
    let height = 650;
    let width = 400;
    let left = (screen.width - width) / 2;
    let top = (screen.height - height) / 4;

    let myWindow = window.open(
        url,
        title,
        `toolbar=no,
             location = no,
             directories = no,
             status = no,
             menubar = no,
             scrollbars = no,
             resizable = no,
             copyhistory = no,
             width = ` +
            width +
            `,
             height = ` +
            height +
            `,
             top = ` +
            top +
            `,
             left = ` +
            left
    );
}

const clvConfigNum = {
    numeral: true,
    numeralThousandsGroupStyle: "thousand",
    rawValueTrimPrefix: true,
    numeralDecimalMark: ",",
    delimiter: ".",
};

const clvConfigDec2 = {
    numeral: true,
    numeralThousandsGroupStyle: "thousand",
    rawValueTrimPrefix: true,
    numeralDecimalMark: ",",
    numeralDecimalScale: 2,
    delimiter: ".",
};

const clvConfigDec4 = {
    numeral: true,
    numeralThousandsGroupStyle: "thousand",
    rawValueTrimPrefix: true,
    numeralDecimalMark: ",",
    numeralDecimalScale: 4,
    delimiter: ".",
};

const clvConfigNPWP = {
    blocks: [2, 3, 3, 1, 3, 3],
    delimiters: [".", ".", ".", "-", "."],
};

const clvConfigKTP = {
    blocks: [4, 4, 4, 4],
    delimiters: [" ", " ", " ", " "],
};

function now_date() {
    let today = new Date();
    let formattedDate = formatDate(today);

    return formattedDate;
}

function formatDate(date) {
    let day = String(date.getDate()).padStart(2, "0");
    let month = String(date.getMonth() + 1).padStart(2, "0");
    let year = date.getFullYear();

    return day + "/" + month + "/" + year;
}
