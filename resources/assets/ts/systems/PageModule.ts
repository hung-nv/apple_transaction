import {VNode, Component} from 'vue'

export default interface PageModule {
    // CUSTOMS
    // Hook function. It's will call in on ready document.
    setUp?: Function;

    // Resgister custom event.
    events?: { [key: string]: any };

    // OPTIONS: DATA

    // The data object for the Vue instance.
    // Restriction: Only accepts Function when used in a component definition.
    // Referen: https://vuejs.org/v2/api/#data
    data?: Object | Function;

    // A list/hash of attributes that are exposed to accept data from the parent component.
    // Referen: https://vuejs.org/v2/api/#props
    props?: Array<string> | Object;

    // Pass props to an instance during its creation.
    // Referen: https://vuejs.org/v2/api/#propsData
    propsData?: { [key: string]: any };

    // Computed properties to be mixed into the Vue instance.
    // Referen: https://vuejs.org/v2/guide/computed.html
    computed?: { [key: string]: Function | { get: Function, set: Function } };

    // Methods to be mixed into the Vue instance.
    // Referen: https://vuejs.org/v2/guide/events.html
    methods?: { [key: string]: Function };

    // An object where keys are expressions to watch and values are the corresponding callbacks.
    watch?: { [key: string]: string | Function | Object | Array<any>};

    // OPTIONS: DOM
    el?: string;

    // A string template to be used as the markup for the Vue instance.
    template?: string

    // An alternative to string templates allowing you to leverage the full programmatic power of JavaScript.
    render?: (createElement: () => VNode) => VNode;

    // Only works in development mode.
    // Provide an alternative render output when the default render function encounters an error.
    renderError?: (createElement: () => VNode, error: Error) => VNode;

    // OPTIONS: LIFECYCLE

    // Called synchronously immediately after the instance has been initialized,
    // before data observation and event/watcher setup.
    beforeCreate?: Function;

    // Called synchronously after the instance is created.
    created?: Function;

    // Called right before the mounting begins: the render function is about to be called for the first time.
    beforeMount?: Function;

    // Called after the instance has been mounted, where el is replaced by the newly created vm.$el
    mounted?: Function;

    // Called when data changes, before the DOM is patched.
    beforeUpdate?: Function;

    // Called after a data change causes the virtual DOM to be re-rendered and patched.
    updated?: Function;

    // Called when a kept-alive component is activated.
    activated?: Function;

    // Called when a kept-alive component is deactivated.
    deactivated?: Function;

    // Called right before a Vue instance is destroyed.
    beforeDestroy?: Function;

    // Called after a Vue instance has been destroyed.
    destroyed?: Function;

    // Called when an error from any descendent component is captured.
    errorCaptured?: (err: Error, vm: Component, info: string) => boolean;

    // OPTIONS: ASSETS

    // A hash of directives to be made available to the Vue instance.
    directives?: Object;

    // A hash of filters to be made available to the Vue instance.
    filters?: Object;

    // A hash of components to be made available to the Vue instance.
    components?: Object;

    // OPTIONS: COMPOSITION

    // A hash of components to be made available to the Vue instance.
    parent?: Object;

    // The mixins option accepts an array of mixin objects.
    mixins?: Array<Object>;

    // Allows declaratively extending another component (could be either a plain options object or
    // a constructor) without having to use Vue.extend
    extends?: Object | Function

    // provide and inject are primarily provided for advanced plugin / component library use cases.
    provide?: Object | (() => Object);
    inject?: Array<string> | { [key: string]: string | Object }

    // OPTIONS: MISC

    // Allow the component to recursively invoke itself in its template.
    // Note that when a component is registered globally with Vue.component(),
    // the global ID is automatically set as its name.
    name?: string;

    // Change the plain text interpolation delimiters.
    delimiters?: Array<string>;

    // Causes a component to be stateless (no data) and instanceless (no this context).
    functional?: boolean;

    // Allows a custom component to customize the prop and event used when it’s used with v-model.
    model?: { prop?: string, event?: string };

    // By default, parent scope attribute bindings that are not recognized as props will “fallthrough” and
    // be applied to the root element of the child component as normal HTML attributes.
    inheritAttrs?: boolean;

    // When set to true, will preserve and render HTML comments found in templates.
    comments?: boolean;

    // Extral custom properies and methods.
    [key: string]: any;
}
