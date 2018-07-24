// Polyfill.
require('core-js/shim');

// Get list components.
import dispatcher from './dispatcher';

import {applyBoot, registerEvent, applySetUp, createMainVue} from './systems/PageModuleParser';

// Declare exists object.
declare var require;
declare var window;

//  Using jquery was predefined in base project.
declare var $;

// List components
let pageModulers = {};

for (let pageId in dispatcher) {
    let path = dispatcher[pageId];

    pageModulers[pageId] = require(`./${path}`).default;
}

// Each page has only a main component.
// Main component has class is mainComponent.
const moduleElement = $('.mainComponent');

if (moduleElement) {
    // Id of element main component is key to find vue com.
    const pageId: string = moduleElement.attr('id');

    window.viewData = moduleElement.data();

    if (pageId && (typeof pageModulers[pageId] !== undefined)) {

        let pageModule = new pageModulers[pageId];

        applyBoot(pageModule);

        let mainComponent = createMainVue(pageModule, `#${pageId}`);

        window.mainComponent = mainComponent;

        // Register custom events.
        registerEvent(pageModule, mainComponent);

        // Run setUp(on ready function)
        applySetUp(pageModule, mainComponent);
    }
}
