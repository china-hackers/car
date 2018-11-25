import backgroundImageDirective from './backgroundImage';

export default {
    install (Vue) {
        let directives = [backgroundImageDirective];
        directives.forEach(directive => {
            Vue.directive(directive.name, directive.config);
        });
    }
};
