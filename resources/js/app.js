
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Tree navigation
 */
import VueTreeNavigation from 'vue-tree-navigation';

Vue.use(VueTreeNavigation);

/**
 * Font Awesome Vue.js component
 */
import { library } from '@fortawesome/fontawesome-svg-core';
import { faCoffee } from '@fortawesome/free-solid-svg-icons';
import { faEdit } from '@fortawesome/free-solid-svg-icons';
import { faTrash } from '@fortawesome/free-solid-svg-icons';
import { faForward } from '@fortawesome/free-solid-svg-icons';
import { faBackward } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faCoffee);
library.add(faEdit);
library.add(faTrash);
library.add(faForward);
library.add(faBackward);

Vue.component('font-awesome-icon', FontAwesomeIcon);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('input-dialogue', require('./components/InputDialogue.vue'));
Vue.component('modal', { template: '#modal-template' });
Vue.component('organisation-list', require('./components/OrganisationList.vue'));
Vue.component('organisation-form', require('./components/OrganisationForm.vue'));
Vue.component('organisational-units-list', require('./components/OrganisationalUnitsList.vue'));
Vue.component('organisational-units-form', require('./components/OrganisationalUnitsForm.vue'));
Vue.component('employees-list', require('./components/EmployeesList.vue'));
Vue.component('employees-form', require('./components/EmployeesForm.vue'));
Vue.component('industries-list', require('./components/IndustriesList.vue'));
Vue.component('industries-form', require('./components/IndustriesForm.vue'));
Vue.component('sectors-list', require('./components/SectorsList.vue'));
Vue.component('sectors-form', require('./components/SectorsForm.vue'));
Vue.component('impacts-list', require('./components/ImpactsList.vue'));
Vue.component('impacts-form', require('./components/ImpactsForm.vue'));
Vue.component('outcomes-list', require('./components/OutcomesList.vue'));
Vue.component('outcomes-form', require('./components/OutcomesForm.vue'));
Vue.component('outputs-list', require('./components/OutputsList.vue'));
Vue.component('outputs-form', require('./components/OutputsForm.vue'));

const app = new Vue({
    el: '#app',
    data: {
        items: [
            { name: 'Dashboard', children: [
                { name: 'Assigned to me', path: 'dashboard' },
                { name: 'Assigned to my team', path: 'dashboard' }
            ]},
            { name: 'Implementation Framework', children: [
                { name: 'Impacts', path: 'impacts' },
                { name: 'Outcomes', path: 'outcomes' },
                { name: 'Outputs', path: 'outputs', children: [
                    { name: 'Perormance Indicators', element: 'outputs/indicators' },
                    { name: 'SWOT Analysis', element: 'outputs/swot' }
                ]},
                { name: 'Activities', path: 'activities' },
                { name: 'Tasks', path: 'tasks' }
            ]},
            { name: 'Implementing Agency', children: [
                { name: 'Organisation', path: 'organisation', children: [
                    { name: 'Organisational Units', path: 'organisational-units' },
                    { name: 'Employees', path: 'employees' },
                ]},
            { name: 'Industries', path: 'industries', children: [
                    { name: 'Sectors', path: 'sectors' }
                ]},
                { name: 'General Ledger', path: 'ledger' }
            ]},
            { name: 'Website', external: 'https://moralo.tech' },
        ],
    }
});
