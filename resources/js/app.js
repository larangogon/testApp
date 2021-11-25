import Vue from 'vue'
import './bootstrap'
import FormComponent from "./components/FormComponent";

window.Vue = Vue

Vue.component('form-component', FormComponent)

new Vue({
    el: '#app'
})
