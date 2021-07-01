require('./bootstrap');

import Vue from 'vue'

Vue.component('todo', require('./components/Todo').default);
new Vue({
    el: '#app'
})

