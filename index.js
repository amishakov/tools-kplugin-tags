(function() {
  "use strict";
  const Tagsets_vue_vue_type_style_index_0_lang = "";
  function normalizeComponent(scriptExports, render, staticRenderFns, functionalTemplate, injectStyles, scopeId, moduleIdentifier, shadowMode) {
    var options = typeof scriptExports === "function" ? scriptExports.options : scriptExports;
    if (render) {
      options.render = render;
      options.staticRenderFns = staticRenderFns;
      options._compiled = true;
    }
    if (functionalTemplate) {
      options.functional = true;
    }
    if (scopeId) {
      options._scopeId = "data-v-" + scopeId;
    }
    var hook;
    if (moduleIdentifier) {
      hook = function(context) {
        context = context || // cached call
        this.$vnode && this.$vnode.ssrContext || // stateful
        this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext;
        if (!context && typeof __VUE_SSR_CONTEXT__ !== "undefined") {
          context = __VUE_SSR_CONTEXT__;
        }
        if (injectStyles) {
          injectStyles.call(this, context);
        }
        if (context && context._registeredComponents) {
          context._registeredComponents.add(moduleIdentifier);
        }
      };
      options._ssrRegister = hook;
    } else if (injectStyles) {
      hook = shadowMode ? function() {
        injectStyles.call(
          this,
          (options.functional ? this.parent : this).$root.$options.shadowRoot
        );
      } : injectStyles;
    }
    if (hook) {
      if (options.functional) {
        options._injectStyles = hook;
        var originalRender = options.render;
        options.render = function renderWithStyleInjection(h, context) {
          hook.call(context);
          return originalRender(h, context);
        };
      } else {
        var existing = options.beforeCreate;
        options.beforeCreate = existing ? [].concat(existing, hook) : [hook];
      }
    }
    return {
      exports: scriptExports,
      options
    };
  }
  const _sfc_main = {
    extends: "k-pages-field",
    props: {
      selected: {
        type: Array,
        default: () => []
      }
    },
    computed: {
      emptyProps() {
        return {
          icon: "tag",
          text: this.empty || this.$t("field.tagsets.empty")
        };
      }
    }
  };
  var _sfc_render = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("k-field", _vm._b({ staticClass: "k-pages-field", attrs: { "label": _vm.label, "help": _vm.help }, scopedSlots: _vm._u([{ key: "options", fn: function() {
      return [_c("k-button-group", { staticClass: "k-field-options" }, [_c("k-button", { staticClass: "k-field-options-button", attrs: { "icon": "add", "text": _vm.$t("select") }, on: { "click": _vm.open } })], 1)];
    }, proxy: true }]) }, "k-field", _vm.$props, false), [_c("k-collection", _vm._b({ on: { "empty": _vm.open, "sort": _vm.onInput, "sortChange": function($event) {
      return _vm.$emit("change", $event);
    } }, scopedSlots: _vm._u([{ key: "options", fn: function({ index }) {
      return [!_vm.disabled ? _c("k-button", { attrs: { "tooltip": _vm.$t("remove"), "icon": "remove" }, on: { "click": function($event) {
        return _vm.remove(index);
      } } }) : _vm._e()];
    } }]) }, "k-collection", {
      empty: this.emptyProps,
      items: this.selected,
      layout: "list",
      link: this.link,
      sortable: false
    }, false)), _c("k-pages-dialog", { ref: "selector", on: { "submit": _vm.select } })], 1);
  };
  var _sfc_staticRenderFns = [];
  _sfc_render._withStripped = true;
  var __component__ = /* @__PURE__ */ normalizeComponent(
    _sfc_main,
    _sfc_render,
    _sfc_staticRenderFns,
    false,
    null,
    null,
    null,
    null
  );
  __component__.options.__file = "/Users/aurianaubert/Desktop/NK+CO | WELTKERN/003 WK®2.0/DÉVELOPPEMENT/BACKEND/site/plugins/auaust-tags/src/fields/Tagsets.vue";
  const TagsetsField = __component__.exports;
  panel.plugin("auaust/tags", {
    fields: {
      tagsets: TagsetsField
    }
  });
})();
