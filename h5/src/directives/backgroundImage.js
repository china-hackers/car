export default {
    name: 'background-image',
    config: {
        update: function (el, binding) {
            if (binding.value !== binding.oldValue && binding.value !== '') {
                el.style.backgroundImage = `url(${binding.value})`;
            }
        },
        bind: function (el, binding) {
            if (binding.value !== binding.oldValue && binding.value !== '') {
                el.style.backgroundImage = `url(${binding.value})`;
            }
        }
    }
};
