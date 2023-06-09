/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./../../../../../resources/assets/js/bootstrap');

import Vue from 'vue';

import Global from './../../../../../resources/assets/js/mixins/global';
import Form from './../../../../../resources/assets/js/plugins/form';
import DashboardPlugin from './../../../../../resources/assets/js/plugins/dashboard-plugin';

// plugin setup
Vue.use(DashboardPlugin);

const app = new Vue({
    el: '#app',

    mixins: [
        Global
    ],

    data() {
        return {
            form: new Form('offline-payment'),
            update_code: null,
            form_loading: '',
        }
    },

    methods:{
        onEdit(event) {
            axios.post(url + '/offline-payments/settings/get', {
                code: event
            })
            .then(response => {
                this.form.name = response.data.data.name;
                this.form.code = response.data.data.code;
                this.form.customer = response.data.data.customer;
                this.form.order = response.data.data.order;
                this.form.description = response.data.data.description;
                this.form.update_code = response.data.data.update_code;
                this.update_code = response.data.data.update_code;
                this.form.loading = false;
                this.form_loading = '';
            })
            .catch(error => {
                this.form.loading = false;
                this.form_loading = '';
            });
        },

        // Actions > Delete
        confirmDelete(code, title, message, button_cancel, button_delete) {
            let confirm = {
                code: code,
                url: url,
                title: title,
                message: message,
                button_cancel: button_cancel,
                button_delete: button_delete,
                show: true
            };

            this.component = Vue.component('add-new-component', (resolve, reject) => {
                resolve({
                    template : '<div id="dynamic-delete-component"><akaunting-modal v-if="confirm.show" :show="confirm.show" :title="confirm.title" :message="confirm.message" :button_cancel="confirm.button_cancel" :button_delete="confirm.button_delete" @confirm="onDelete" @cancel="cancelDelete"></akaunting-modal></div>',

                    mixins: [
                        Global
                    ],

                    data: function () {
                        return {
                            confirm: confirm,
                        }
                    },

                    methods: {
                        // Delete action post
                       async onDelete() {
                            Promise.resolve(axios({
                                method: 'DELETE',
                                url: url + '/offline-payments/settings/delete',
                                data: {
                                    code: this.confirm.code
                                }
                            })).then(response => {
                                var type = (response.data.success) ? 'success' : 'warning';

                                if (response.data.success) {
                                    document.getElementById('method-' + this.confirm.code).remove();
                                }

                                this.confirm.show = false;

                                this.$notify({
                                    message: response.data.message,
                                    timeout: 5000,
                                    icon: 'info',
                                    type
                                });
                            })
                            .catch(error => {
                                this.success = false;
                            });
                        },

                        // Close modal empty default value
                        cancelDelete() {
                            this.confirm.show = false;
                        },
                    }
                })
            });
        }
    }
});
