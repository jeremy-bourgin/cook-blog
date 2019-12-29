(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["script"],{

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');
// Need Bootstrap? Install it with "yarn add bootstrap", then uncomment to require it.
__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js"); // import your codes


__webpack_require__(/*! ./message.js */ "./assets/js/message.js");

/***/ }),

/***/ "./assets/js/message.js":
/*!******************************!*\
  !*** ./assets/js/message.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {window.display_prompt = function (text, link) {
  $("#prompt_message").css('display', 'flex');
  $("#prompt_message_text").text(text);
  $("#prompt_message_submit").attr("href", link);
};

window.cancel_prompt = function () {
  $("#prompt_message").hide();
};

$(document).ready(function () {
  $("#prompt_message_cancel").click(window.cancel_prompt);
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ })

},[["./assets/js/app.js","runtime","vendors~script"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9tZXNzYWdlLmpzIl0sIm5hbWVzIjpbInJlcXVpcmUiLCJ3aW5kb3ciLCJkaXNwbGF5X3Byb21wdCIsInRleHQiLCJsaW5rIiwiJCIsImNzcyIsImF0dHIiLCJjYW5jZWxfcHJvbXB0IiwiaGlkZSIsImRvY3VtZW50IiwicmVhZHkiLCJjbGljayJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7O0FBQUE7Ozs7OztBQU9BO0FBQ0E7QUFFQTtBQUNBQSxtQkFBTyxDQUFDLGdFQUFELENBQVAsQyxDQUVBOzs7QUFDQUEsbUJBQU8sQ0FBQyw0Q0FBRCxDQUFQLEM7Ozs7Ozs7Ozs7O0FDZEFDLCtDQUFNLENBQUNDLGNBQVAsR0FBd0IsVUFBVUMsSUFBVixFQUFnQkMsSUFBaEIsRUFBc0I7QUFDMUNDLEdBQUMsQ0FBQyxpQkFBRCxDQUFELENBQXFCQyxHQUFyQixDQUF5QixTQUF6QixFQUFvQyxNQUFwQztBQUNBRCxHQUFDLENBQUMsc0JBQUQsQ0FBRCxDQUEwQkYsSUFBMUIsQ0FBK0JBLElBQS9CO0FBQ0FFLEdBQUMsQ0FBQyx3QkFBRCxDQUFELENBQTRCRSxJQUE1QixDQUFpQyxNQUFqQyxFQUF5Q0gsSUFBekM7QUFDSCxDQUpEOztBQU1BSCxNQUFNLENBQUNPLGFBQVAsR0FBdUIsWUFBVztBQUM5QkgsR0FBQyxDQUFDLGlCQUFELENBQUQsQ0FBcUJJLElBQXJCO0FBQ0gsQ0FGRDs7QUFJQUosQ0FBQyxDQUFDSyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFXO0FBQ3pCTixHQUFDLENBQUMsd0JBQUQsQ0FBRCxDQUE0Qk8sS0FBNUIsQ0FBa0NYLE1BQU0sQ0FBQ08sYUFBekM7QUFDSCxDQUZELEUiLCJmaWxlIjoic2NyaXB0LmpzIiwic291cmNlc0NvbnRlbnQiOlsiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIE5lZWQgalF1ZXJ5PyBJbnN0YWxsIGl0IHdpdGggXCJ5YXJuIGFkZCBqcXVlcnlcIiwgdGhlbiB1bmNvbW1lbnQgdG8gcmVxdWlyZSBpdC5cbi8vIGNvbnN0ICQgPSByZXF1aXJlKCdqcXVlcnknKTtcblxuLy8gTmVlZCBCb290c3RyYXA/IEluc3RhbGwgaXQgd2l0aCBcInlhcm4gYWRkIGJvb3RzdHJhcFwiLCB0aGVuIHVuY29tbWVudCB0byByZXF1aXJlIGl0LlxucmVxdWlyZSgnYm9vdHN0cmFwJyk7XG5cbi8vIGltcG9ydCB5b3VyIGNvZGVzXG5yZXF1aXJlKFwiLi9tZXNzYWdlLmpzXCIpO1xuIiwid2luZG93LmRpc3BsYXlfcHJvbXB0ID0gZnVuY3Rpb24gKHRleHQsIGxpbmspIHtcclxuICAgICQoXCIjcHJvbXB0X21lc3NhZ2VcIikuY3NzKCdkaXNwbGF5JywgJ2ZsZXgnKTtcclxuICAgICQoXCIjcHJvbXB0X21lc3NhZ2VfdGV4dFwiKS50ZXh0KHRleHQpO1xyXG4gICAgJChcIiNwcm9tcHRfbWVzc2FnZV9zdWJtaXRcIikuYXR0cihcImhyZWZcIiwgbGluayk7XHJcbn1cclxuXHJcbndpbmRvdy5jYW5jZWxfcHJvbXB0ID0gZnVuY3Rpb24oKSB7XHJcbiAgICAkKFwiI3Byb21wdF9tZXNzYWdlXCIpLmhpZGUoKTtcclxufVxyXG5cclxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XHJcbiAgICAkKFwiI3Byb21wdF9tZXNzYWdlX2NhbmNlbFwiKS5jbGljayh3aW5kb3cuY2FuY2VsX3Byb21wdCk7XHJcbn0pO1xyXG4iXSwic291cmNlUm9vdCI6IiJ9