import * as $ from 'jquery';

const registeredComponentsMap = {};

function mountComponent(Component, selector, el) {
    const $el = $(el);
    const key = $el.data('component-key');
    const component = new Component(selector, key, $el);
    component.mounted && component.mounted();

    return component;
}

function mountAllRegisteredComponents() {
    const components = [];

    Object.keys(registeredComponentsMap).forEach((selector) => {
        const Component = registeredComponentsMap[selector];
        const $elements = $(selector);

        $elements.each((index, el) => {
            const component = mountComponent(Component, selector, el);
            components.push(component);
        });
    });

    return components;
}

export function register(selector, Component) {
    if (!registeredComponentsMap[selector]) {
        registeredComponentsMap[selector] = Component;
    }

    return Component;
}

export function init() {
    const components = mountAllRegisteredComponents();
    components.forEach(component => component.init());
}
