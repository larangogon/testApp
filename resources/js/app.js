import Vue from 'vue'
import './bootstrap'
import FormCompanyCreateComponent from "./components/FormCompanyCreateComponent";
import FormCompanyUpdateComponent from "./components/FormCompanyUpdateComponent";
import FormCompanyShowComponent from "./components/FormCompanyShowComponent";
import FormEmployeeCreateComponent from "./components/FormEmployeeCreateComponent";
import FormEmployeeUpdateComponent from "./components/FormEmployeeUpdateComponent";
import FormEmployeeShowComponent from "./components/FormEmployeeShowComponent";


window.Vue = Vue

Vue.component('form-company-create-component', FormCompanyCreateComponent)

new Vue({
    el: '#app'
})
