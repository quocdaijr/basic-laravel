/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************************!*\
  !*** ./modules/Core/Resources/assets/js/forms/multiple-select.js ***!
  \*******************************************************************/
window.multipleSelect = function multipleSelect(idName) {
  return {
    options: [],
    selected: [],
    show: false,
    open: function open() {
      this.show = true;
    },
    close: function close() {
      this.show = false;
    },
    isOpen: function isOpen() {
      return this.show === true;
    },
    select: function select(index, event) {
      if (!this.options[index].selected) {
        this.options[index].selected = true;
        this.options[index].element = event.target;
        this.selected.push(index);
      } else {
        this.selected.splice(this.selected.lastIndexOf(index), 1);
        this.options[index].selected = false;
      }

      this.selectedOptions();
    },
    remove: function remove(index, option) {
      this.options[option].selected = false;
      this.selected.splice(index, 1);
      this.selectedOptions();
    },
    selectedValues: function selectedValues() {
      var _this = this;

      return this.selected.map(function (option) {
        return _this.options[option].value;
      });
    },
    initOptions: function initOptions(oldValues) {
      oldValues = oldValues.map(function (val) {
        return parseInt(val);
      });
      var options = document.getElementById(idName).options;

      for (var i = 0; i < options.length; i++) {
        var currentIndex = this.options.push({
          value: options[i].value,
          text: options[i].innerText,
          selected: oldValues.indexOf(parseInt(options[i].value)) !== -1
        }) - 1;

        if (oldValues.indexOf(parseInt(options[i].value)) !== -1) {
          this.selected.push(currentIndex);
        }
      }

      this.selectedOptions();
    },
    selectedOptions: function selectedOptions() {
      var values = this.selectedValues();
      document.getElementById(idName).value = null;
      var options = Array.from(document.querySelectorAll('#' + idName + ' option'));
      values.forEach(function (v) {
        options.find(function (c) {
          return c.value === v;
        }).selected = true;
      });
    }
  };
};
/******/ })()
;