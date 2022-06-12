"use strict";

/* -------------------------------------------------------------------------- */

/*                              Config                                        */

/* -------------------------------------------------------------------------- */
const CONFIG = {
    theme: 'light'
};

Object.keys(CONFIG).forEach(function (key) {
    if (localStorage.getItem(key) === null) {
        localStorage.setItem(key, CONFIG[key]);
    }
});

if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.classList.add('dark');
}
//# sourceMappingURL=config.js.map
