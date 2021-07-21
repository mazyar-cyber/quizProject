require('./bootstrap');
window.Vue = require('vue').default;

import showResult from "./components/showResult";


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('show-result', showResult);

const app = new Vue({
    el: '#app',
});

