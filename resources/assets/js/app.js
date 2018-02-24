require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);
const router = new VueRouter({
    routes
});

const app = new Vue({
    el: '#app',
    template: '<div><router-view></router-view></div>',
    router
});
