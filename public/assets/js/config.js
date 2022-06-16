"use strict";

/* -------------------------------------------------------------------------- */

/*                              Config                                        */

/* -------------------------------------------------------------------------- */
const CONFIG = {
    isNavbarVerticalCollapsed: false,
    theme: 'light'
};

Object.keys(CONFIG).forEach(function (key) {
    if (localStorage.getItem(key) === null) {
        localStorage.setItem(key, CONFIG[key]);
    }
});

if (JSON.parse(localStorage.getItem('isNavbarVerticalCollapsed'))) {
    document.documentElement.classList.add('navbar-vertical-collapsed');
}

if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.classList.add('dark');
}
//# sourceMappingURL=config.js.map
