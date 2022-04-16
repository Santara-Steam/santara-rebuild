/**
 * Minified by jsDelivr using Terser v5.3.5.
 * Original file: /npm/bootstrap-pincode-input@3.0.1/js/bootstrap-pincode-input.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
!(function (t, e, i, n) {
  "use strict";
  let s = "pincodeInput",
    o = {
      placeholders: n,
      inputs: 4,
      hidedigits: !0,
      pattern: "[0-9]*",
      inputtype: "number",
      inputmode: "numeric",
      inputclass: "",
      characterwidth: null,
      keydown: function (t) {},
      change: function (t, e, i) {},
      complete: function (t, e, i) {},
    };
  function a(e, i) {
    (this.element = e),
      (this.settings = t.extend({}, o, i)),
      (this._defaults = o),
      (this._name = s),
      this.init();
  }
  t.extend(a.prototype, {
    init: function () {
      this.buildInputBoxes();
    },
    updateOriginalInput: function () {
      let e = "";
      t(".pincode-input-text", this._container).each(function (i, n) {
        e += t(n).val().toString();
      }),
        t(this.element).val(e),
        e.length !== this.settings.inputs &&
          t(".pincode-input-text", this._container).removeClass("filled");
    },
    check: function () {
      let e = !0,
        i = "";
      return (
        t(".pincode-input-text", this._container).each(function (n, s) {
          (i += t(s).val().toString()), t(s).val() || (e = !1);
        }),
        this._isTouchDevice() ? i.length == this.settings.inputs || void 0 : e
      );
    },
    buildInputBoxes: function () {
      this._container = t("<div />").addClass("pincode-input-container");
      let e = [],
        i = [],
        s = "";
      if (
        (this.settings.placeholders &&
          ((i = this.settings.placeholders.split(" ")),
          (s = this.settings.placeholders.replace(/ /g, ""))),
        0 == this.settings.hidedigits &&
          "" != t(this.element).val() &&
          (e = t(this.element).val().split("")),
        this.settings.hidedigits &&
          ((this._pwcontainer = t("<div />")
            .css("display", "none")
            .appendTo(this._container)),
          (this._pwfield = t("<input>")
            .attr({
              type: this.settings.inputtype,
              pattern: this.settings.pattern,
              inputmode: this.settings.inputmode,
              id: "preventautofill",
              autocomplete: "off",
            })
            .addClass("pincode-input-text-masked")
            .appendTo(this._pwcontainer))),
        this._isTouchDevice())
      ) {
        t(this._container).addClass("touch");
        let e = t("<div />")
            .addClass("touchwrapper touch" + this.settings.inputs)
            .appendTo(this._container),
          i = t("<input>")
            .attr({
              type: this.settings.inputtype,
              pattern: this.settings.pattern,
              inputmode: this.settings.inputmode,
              placeholder: s,
              maxLength: this.settings.inputs,
              autocomplete: "off",
            })
            .addClass(
              this.settings.inputclass + " form-control pincode-input-text"
            )
            .appendTo(e),
          n = this.settings.inputs,
          o =
            this.settings.characterwidth ||
            (this.settings.hidedigits ? 0.4 : 0.54);
        setTimeout(function () {
          let e = parseFloat(getComputedStyle(i.get(0)).fontSize) * o,
            s = i.innerWidth() / n - e;
          t(i).css({
            "margin-left": s / 2 + "px",
            width: "110%",
            "letter-spacing": s + "px",
          });
        }, 0);
        let a = t("<div>").addClass("touch-flex").appendTo(e);
        for (let e = 0; e < this.settings.inputs; e++)
          e == this.settings.inputs - 1
            ? t("<div/>")
                .addClass("touch-flex-cell")
                .addClass("last")
                .appendTo(a)
            : t("<div/>").addClass("touch-flex-cell").appendTo(a);
        this.settings.hidedigits
          ? i.addClass("pincode-input-text-masked")
          : i.val(t(this.element).val()),
          this._addEventsToInput(i, 1);
      } else {
        let s = 100 / this.settings.inputs + "%";
        for (let o = 0; o < this.settings.inputs; o++) {
          let a = t("<input>")
            .attr({
              type: "text",
              maxlength: "1",
              autocomplete: "off",
              placeholder: i[o] ? i[o] : n,
            })
            .addClass(
              this.settings.inputclass + " form-control  pincode-input-text"
            )
            .appendTo(this._container);
          a.css({ width: s }),
            this.settings.hidedigits
              ? a.addClass("pincode-input-text-masked")
              : a.val(e[o]),
            0 == o
              ? a.addClass("first")
              : o == this.settings.inputs - 1
              ? a.addClass("last")
              : a.addClass("mid"),
            this._addEventsToInput(a, o + 1);
        }
      }
      t(this.element).css("display", "none"),
        this._container.insertBefore(this.element),
        (this._error = t("<div />")
          .addClass("text-danger pincode-input-error")
          .insertBefore(this.element));
    },
    enable: function () {
      t(".pincode-input-text", this._container).each(function (e, i) {
        t(i).prop("disabled", !1);
      });
    },
    disable: function () {
      t(".pincode-input-text", this._container).each(function (e, i) {
        t(i).prop("disabled", !0);
      });
    },
    focus: function () {
      t(".pincode-input-text", this._container).first().select().focus();
    },
    clear: function () {
      t(".pincode-input-text", this._container).each(function (e, i) {
        t(i).val("");
      }),
        this.updateOriginalInput();
    },
    _setValue: function (e, i) {
      let n = e.substring(0, this.settings.inputs);
      if (this._isTouchDevice())
        t(".pincode-input-text", this._container).each(function (e, i) {
          t(i).val(n);
        }),
          this.updateOriginalInput(),
          this.check() &&
            this.settings.complete(t(this.element).val(), i, this._error);
      else {
        let e = n.split("");
        t(".pincode-input-text", this._container).each(function (i, n) {
          t(n).val(e[i]);
        }),
          this.updateOriginalInput(),
          this.check() &&
            this.settings.complete(t(this.element).val(), i, this._error);
      }
    },
    _isTouchDevice: function () {
      return (
        !!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
          navigator.userAgent
        ) ||
        ("MacIntel" === navigator.platform && navigator.maxTouchPoints > 1) ||
        void 0
      );
    },
    _addEventsToInput: function (i, n) {
      i.on(
        "focus",
        t.proxy(function (t) {
          this._isTouchDevice() && this._setValue("", t), i.select();
        }, this)
      ),
        i.on(
          "paste",
          t.proxy(function (t) {
            t.preventDefault();
            let i = (
              (t.originalEvent || t).clipboardData || e.clipboardData
            ).getData("text/plain");
            this._setValue(i, t);
          }, this)
        ),
        i.on(
          "keydown",
          t.proxy(function (e) {
            this._pwfield &&
              (t(this._pwfield).attr({ type: "text" }),
              t(this._pwfield).val("")),
              this._isTouchDevice()
                ? 8 == e.keyCode ||
                  46 == e.keyCode ||
                  (t(this.element).val().length == this.settings.inputs
                    ? (e.preventDefault(), e.stopPropagation())
                    : t(this.element).val().length ==
                        this.settings.inputs - 1 &&
                      t(e.currentTarget).addClass("filled"))
                : 8 == e.keyCode ||
                  9 == e.keyCode ||
                  46 == e.keyCode ||
                  (e.keyCode >= 48 && e.keyCode <= 57) ||
                  (e.keyCode >= 96 && e.keyCode <= 105) ||
                  e.ctrlKey ||
                  e.metaKey ||
                  ("number" != this.settings.inputtype &&
                    "tel" != this.settings.inputtype &&
                    e.keyCode >= 65 &&
                    e.keyCode <= 90) ||
                  (e.preventDefault(), e.stopPropagation()),
              this.settings.keydown(e);
          }, this)
        ),
        i.on(
          "keyup",
          t.proxy(function (e) {
            this._isTouchDevice() ||
              (8 == e.keyCode || 46 == e.keyCode
                ? (t(e.currentTarget).prev().select(),
                  t(e.currentTarget).prev().focus())
                : "" != t(e.currentTarget).val() &&
                  (t(e.currentTarget).next().select(),
                  t(e.currentTarget).next().focus())),
              this.updateOriginalInput(),
              this.settings.change &&
                this.settings.change(
                  e.currentTarget,
                  t(e.currentTarget).val(),
                  n
                ),
              this._isTouchDevice() &&
                (8 == e.keyCode ||
                  46 == e.keyCode ||
                  (t(this.element).val().length == this.settings.inputs &&
                    t(e.currentTarget).blur())),
              this.check() &&
                (this._isTouchDevice()
                  ? setTimeout(
                      t.proxy(function () {
                        this.settings.complete(
                          t(this.element).val(),
                          e,
                          this._error
                        );
                      }, this),
                      100
                    )
                  : this.settings.complete(
                      t(this.element).val(),
                      e,
                      this._error
                    ));
          }, this)
        );
    },
  }),
    (t.fn[s] = function (e) {
      return this.each(function () {
        t.data(this, "plugin_" + s) ||
          t.data(this, "plugin_" + s, new a(this, e));
      });
    });
})(jQuery, window, document);
//# sourceMappingURL=/sm/0639c1a43ad81a4a81d3941e631b3e1ec5ec7e05a5bdeaa01de2160e6d804094.map
