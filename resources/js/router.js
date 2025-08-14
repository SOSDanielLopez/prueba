import Vue from 'vue';
import VueRouter from 'vue-router';

import RegistrationForm from './components/RegistrationForm.vue';
import LeadsReport from './components/LeadsReport.vue';

Vue.use(VueRouter);

const routes = [
    { path: '/', component: RegistrationForm, name: 'register' },
    { path: '/reporte', component: LeadsReport, name: 'report' },
];

export default new VueRouter({
    mode: 'history', // Usa el modo historial para URLs limpias
    routes
});