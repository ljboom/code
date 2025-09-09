import Vue from "vue";
import VueI18n from "vue-i18n";
import zh from "./zh.js";
import en from "./en.js";
import tw from "./tw.js";
import ja from "./ja.js";
import th from "./th.js";
import ko from "./ko.js";
import id from "./id.js";
import hi from "./hi.js";
import ms from "./ms.js";

Vue.use(VueI18n);

const DEFAULT_LANG = "en";
const LOCALE_KEY = "language";

const locales = {
  'zh-CN': {
    ...zh
  },
  en: {
    ...en
  },
  ja: {
    ...ja
  },
  th: {
    ...th
  },
  ms: {
    ...ms
  },
  id: {
    ...id
  },
  hi: {
    ...hi
  },
  ko: {
    ...ko
  },
  tww: {
    ...tw
  },
};
// en-us  zh-cn
//let langLocale = getCookie(LOCALE_KEY) || 'en';
if (!window.localStorage.getItem(LOCALE_KEY)) {
  window.localStorage.setItem(LOCALE_KEY, DEFAULT_LANG);
}
let langLocale = window.localStorage.getItem(LOCALE_KEY)
  ? window.localStorage.getItem(LOCALE_KEY)
  : "en";
const i18n = new VueI18n({
  locale: langLocale,
  messages: locales,
  silentTranslationWarn: true
});
const init = Vue.prototype._init;
Vue.prototype._init = function(options) {
  init.call(this, {
    i18n,
    ...options
  });
};

export const setup = lang => {
  if (lang === undefined) {
    // lang = window.localStorage.getItem(LOCALE_KEY);
    //const language = getCookie(LOCALE_KEY);
    const language = window.localStorage.getItem(LOCALE_KEY);
    if (language) {
      langLocale = language.replace("-", "_").toLowerCase();
    }
    if (undefined !== langLocale && langLocale !== "") {
      lang = langLocale;
    }
    if (locales[lang] === undefined) {
      lang = DEFAULT_LANG;
    }
    // console.log(`lang-${lang}`);
  }

  Vue.config.lang = lang;
  i18n.locale = lang;
};

setup();

export default i18n;
