
export default abstract class Component {
    selector: string
    $el: any

    constructor(selector: string, $el: any) {
        this.selector = selector;
        this.$el = $el;
    }

    mounted() { 
    }
    
    abstract init(): void
}
