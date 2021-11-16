window.Vue = require('vue');
// richiamo il pacchetto axios, definendolo in app.js viene visto a livello globale
window.axios = require('axios');


import App from './views/App';
// renderizzami tutto il contenuto di App (.views/App.vue) nel div #app di api/home.blade.php
const app = new Vue({
    el: '#app',
    render: h =>h(App)
});