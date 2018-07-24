// Import vendor.
import Vue from 'vue';

import PageModule from "systems/PageModule";

//  Using jquery was predefined in base project.
declare var $;

declare var document;

const defaultOptions: Array<string> = [
    'setUp',
    'events',
    'data',
    'props',
    'propsData',
    'computed',
    'methods',
    'watch',
    'el',
    'template',
    'render',
    'renderError',
    'beforeCreate',
    'created',
    'beforeMount',
    'mounted',
    'beforeUpdate',
    'updated',
    'activated',
    'deactivated',
    'beforeDestroy',
    'destroyed',
    'errorCaptured',
    'directives',
    'filters',
    'components',
    'parent',
    'mixins',
    'extends',
    'provide',
    'inject',
    'name',
    'delimiters',
    'functional',
    'model',
    'inheritAttrs',
    'comments',
];

export function registerEvent(pageModule: PageModule, mainComponent): void {
    // Events.
    if (typeof pageModule.events !== 'undefined') {
        for (let eventString in pageModule.events) {

            let event = pageModule.events[eventString];

            let [eventName, eventTargetString] = eventString.split(' ');

            let eventTargets = eventTargetString.split('::');

            let eventTargetParent = '';

            let eventTarget = '';

            if (eventTargets.length > 1) {
                eventTargetParent = eventTargets[0];
                eventTarget = eventTargets[1];

                if (eventTargetParent === 'document') {
                    eventTargetParent = document;
                }

                $(() => $(eventTargetParent).on(eventName, eventTarget, event.bind(mainComponent)));
            } else {
                eventTarget = eventTargets[0];

                $(() => $(eventTarget).on(eventName, event.bind(mainComponent)));
            }
        }
    }
}

export function applySetUp(pageModule: PageModule, mainComponent): void {
    if (typeof pageModule.setUp !== 'undefined') {
        // Run setup.
        $(() => {pageModule.setUp.call(mainComponent)});
    }
}

export function applyBoot(pageModule: PageModule): void {
    if (typeof pageModule.boot !== 'undefined') {
        // Run boot.
        window.addEventListener('load', function() {
            // Have service work trim caches
            pageModule.boot();
        });
    }
}

/**
 * Create main vue.
 * @param pageModule
 * @param el
 */
export function createMainVue (pageModule: PageModule, el: string): Vue {
    let vueOption = getVueOption(pageModule, el);

    return new Vue(vueOption);
}

/**
 * Convert pageModule to vue options.
 * @param pageModule
 * @param el
 */
function getVueOption (pageModule: PageModule, el: string): {[key: string]: any} {
    let vueOptions: {[key: string]: any} = {};

    vueOptions.el = el;

    vueOptions.methods = typeof pageModule.methods === 'object' ? pageModule.methods : {};

    vueOptions.data = typeof pageModule.data !== 'undefined' ? pageModule.data : {};

    let vueData = {};

    // Merge methods and data.
    for (let propertyName in pageModule) {
        let property = pageModule[propertyName];

        vueOptions[propertyName] = property;

        if (defaultOptions.indexOf(propertyName) === -1) {
            if (typeof property === 'function') {
                vueOptions.methods[propertyName] = property;
            } else {
                vueData[propertyName] = property;
            }
        }
    }

    // Merge data to property data.
    if (typeof vueOptions.data === 'function') {
        let dataFunc =  vueOptions.data;

        vueOptions.data = function () {
            return Object.assign(dataFunc(), vueData);
        }
    } else {
        Object.assign(vueOptions.data, vueData);
    }

    return vueOptions;
}
