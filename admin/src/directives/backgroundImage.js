export default {
    name: 'bgsrc',
    config: {
        inserted: function(el, binding) {
            if (binding.value !== binding.oldValue && binding.value !== '') {
                el.style.backgroundImage = `url(${binding.value})`;
            }
        },
        update: function(el, binding) {
            if (binding.value !== binding.oldValue && binding.value !== '') {
                el.style.backgroundImage = `url(${binding.value})`;
            }
        }
    }
};
