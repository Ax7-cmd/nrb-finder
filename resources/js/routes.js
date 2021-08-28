export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/nrb', component: require('./components/nrb/NrbList.vue').default },
    { path: '/rma', component: require('./components/rma/RmaList.vue').default },
    { path: '/trp', component: require('./components/trp/TrpList.vue').default },
    { path: '/whs', component: require('./components/whs/WhsList.vue').default },
    { path: '/acc', component: require('./components/acc/AccList.vue').default },
    { path: '/fin', component: require('./components/fin/FinList.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
