/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/print.js ***!
  \*******************************/
window.preview_a4 = function (url, title) {
  var height = 650;
  var width = 1050;
  var left = (screen.width - width) / 2;
  var top = (screen.height - height) / 4;
  var myWindow = window.open(url, title, "toolbar=no,\n          location = no,\n          directories = no,\n          status = no,\n          menubar = no,\n          scrollbars = no,\n          resizable = no,\n          copyhistory = no,\n          width = " + width + ",\n          height = " + height + ",\n          top = " + top + ",\n          left = " + left);
};
window.preview_roll = function (url, title) {
  var height = 650;
  var width = 400;
  var left = (screen.width - width) / 2;
  var top = (screen.height - height) / 4;
  var myWindow = window.open(url, title, "toolbar=no,\n          location = no,\n          directories = no,\n          status = no,\n          menubar = no,\n          scrollbars = no,\n          resizable = no,\n          copyhistory = no,\n          width = " + width + ",\n          height = " + height + ",\n          top = " + top + ",\n          left = " + left);
};
/******/ })()
;