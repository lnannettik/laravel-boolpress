// DIPENDENZE
import Vue from 'vue';
import VueRouter from 'vue-router';


// COMPONENTI PER ROTTA
import Home from './pages/Home';
import About from './pages/About';
import Blog from './pages/Blog';



// ATTIVAZIONE ROUTER IN VUE
Vue.use(VueRouter);

// DEFINIZIONE DELLE ROTTE
const router = new VueRouter ({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,

        },

        {
            path: '/about',
            name: 'about',
            component: About,

        },

        {
            path: '/blog',
            name: 'blog',
            component: Blog,
        },

    ]
});

//EXPORT DELLE ROTTE PER ESSERE USATO CON import IN ALTRI FILE
export default router;