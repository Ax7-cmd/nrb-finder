export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/nrb', component: require('./components/nrb/NrbList.vue').default },
    { path: '/rma', component: require('./components/rma/RmaList.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
