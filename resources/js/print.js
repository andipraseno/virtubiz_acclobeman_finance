window.preview_a4 = function (url, title) {
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
};

window.preview_roll = function (url, title) {
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
};
