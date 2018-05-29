
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.VueColor = require('vue-color');

import VueChartkick from 'vue-chartkick'
import Chart from 'chart.js'
Vue.use(VueChartkick, { adapter: Chart });
import DatePicker from 'vue2-datepicker'
Vue.component('date-picker', DatePicker);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('create-template-form', require('./components/templates/CreateTemplateForm.vue'));
Vue.component('create-unit-form', require('./components/units/CreateUnitForm.vue'));
Vue.component('create-unit-button', require('./components/units/CreateUnitButton.vue'));
Vue.component('create-unit-copy-button', require('./components/units/CreateUnitCopyButton.vue'));
Vue.component('edit-unit-ad-form', require('./components/units/EditUnitAdForm.vue'));
Vue.component('edit-unit-layout-form', require('./components/units/EditUnitLayoutForm.vue'));
Vue.component('edit-unit-template-form', require('./components/units/EditUnitTemplateForm.vue'));
Vue.component('edit-unit-components-form', require('./components/units/EditUnitComponentsForm.vue'));
Vue.component('edit-unit-basic-form', require('./components/units/EditUnitBasicForm.vue'));
Vue.component('edit-unit-submit-form', require('./components/units/EditUnitSubmitForApprovalForm.vue'));
Vue.component('edit-unit-landing-page-form', require('./components/units/EditUnitLandingPageForm.vue'));
Vue.component('create-approve-button', require('./components/units/CreateApproveButton.vue'));
Vue.component('create-reject-button', require('./components/units/CreateRejectButton.vue'));
Vue.component('create-user-approve-button', require('./components/users/CreateUserApproveButton.vue'));
Vue.component('create-user-reject-button', require('./components/users/CreateUserRejectButton.vue'));
Vue.component('personal-access-tokens', require('./components/passport/PersonalAccessToken.vue'));
Vue.component('update-user-subscription-button', require('./components/users/UpdateUserSubscriptionButton.vue'));
Vue.component('add-subscription-button', require('./components/users/AddSubscriptionButton.vue'));
Vue.component('filter-form', require('./components/stats/FilterForm.vue'));
Vue.component('update-user-profile-form', require('./components/users/UpdateUserProfileForm.vue'));
Vue.component('edit-unit-category-form', require('./components/units/EditUnitCategoryForm.vue'));
Vue.component('create-pinned-report-button', require('./components/reports/CreatePinnedReportButton.vue'));
Vue.component('create-unpinned-report-button', require('./components/reports/CreateUnPinnedReportButton.vue'));
Vue.component('create-user-form', require('./components/users/CreateUserForm.vue'));

Vue.component('edit-multiple-unit-template-form', require('./components/units/EditMultipleUnitTemplateForm.vue'));
Vue.component('update-user-password-form', require('./components/users/UpdateUserPasswordForm.vue'));

const app = new Vue({
    el: '#app'
});
