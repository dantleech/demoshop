import * as $ from 'jquery';

interface IComponent {
    init(selector: string, element: any): void
    onMounted(): void
    onInitialized(): void
}

interface IComponentMap {
    [key: string]: IComponent;
}

const componentMap: IComponentMap = {};

function mountComponent(Component, selector, el) {
    const $el = $(el);
    const key = $el.data('component-key');
    const component = new Component(selector, $el);
    component.onMounted();

    return component;
}

function mountComponents() {
    const components = [];

    Object.keys(componentMap).forEach((selector) => {
        const Component = componentMap[selector];
        const elementList = document.querySelectorAll(selector);

        elementList.forEach((value, key) => {
            const component = mountComponent(Component, selector, el);
            components.push(component);
        });
    });

    return components;
}

export function register(selector: string, Component: IComponent) {
    if (!componentMap[selector]) {
        componentMap[selector] = Component;
    }

    return Component;
}

export function override(selector: string, Component: IComponent) {
    if (!!componentMap[selector]) {
        componentMap[selector] = Component;
    }

    return Component;
}

export function bootstrap() {
    const components = mountComponents();
    components.forEach(component => component.init());
    components.forEach(component => component.onInitialized());
}


