// console.log('FRONT OFFICE');

// IMPORT dependencies
import Vue from 'vue';
import App from './views/App';

// aPP ROUTER (ROTTE PER L'APP)
import router from './routes';







// INIT VUE ISTANCE
const root = new Vue ({
    el: '#root',
    router,
    render: h => h(App),
});

