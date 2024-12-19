/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/message.js ***!
  \*********************************/
window.msgFlash = function (title, message, icon) {
  return new Promise(function (resolve) {
    Swal.fire({
      position: "top-end",
      title: title,
      text: message,
      icon: icon,
      showConfirmButton: false,
      timer: 1000
    });
    setTimeout(function () {
      resolve(true);
    }, 1000);
  });
};
window.msgInfo = function (title, message, icon) {
  return new Promise(function (resolve) {
    Swal.fire({
      title: title,
      text: message,
      icon: icon,
      showCancelButton: false,
      confirmButtonClass: "btn btn-outline-dark btn-rounded w-xs me-2 mt-2",
      cancelButtonClass: "btn btn-dark w-xs mt-2",
      confirmButtonText: "Ok",
      cancelButtonText: "Tidak",
      buttonsStyling: false,
      showCloseButton: true
    }).then(function (result) {
      resolve(result.isConfirmed);
    });
  });
};
window.msgQuestion = function (title, message, icon) {
  return new Promise(function (resolve) {
    Swal.fire({
      title: title,
      text: message,
      icon: icon,
      showCancelButton: true,
      confirmButtonClass: "btn btn-dark w-xs me-2 mt-2",
      cancelButtonClass: "btn btn-dark w-xs mt-2",
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
      buttonsStyling: false,
      showCloseButton: true
    }).then(function (result) {
      resolve(result.isConfirmed);
    });
  });
};
/******/ })()
;