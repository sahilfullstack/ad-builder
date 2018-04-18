
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('create-template-form', require('./components/templates/CreateTemplateForm.vue'));
Vue.component('create-unit-form', require('./components/units/CreateUnitForm.vue'));
Vue.component('create-unit-button', require('./components/units/CreateUnitButton.vue'));
Vue.component('edit-unit-ad-form', require('./components/units/EditUnitAdForm.vue'));
Vue.component('edit-unit-layout-form', require('./components/units/EditUnitLayoutForm.vue'));
Vue.component('edit-unit-template-form', require('./components/units/EditUnitTemplateForm.vue'));
Vue.component('edit-unit-components-form', require('./components/units/EditUnitComponentsForm.vue'));
Vue.component('edit-unit-basic-form', require('./components/units/EditUnitBasicForm.vue'));
Vue.component('edit-unit-submit-form', require('./components/units/EditUnitSubmitForApprovalForm.vue'));

const app = new Vue({
    el: '#app'
});
