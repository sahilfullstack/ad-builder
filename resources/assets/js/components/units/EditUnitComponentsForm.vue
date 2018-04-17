<template>
    <form @submit.prevent="update">
        <p><strong>COMPONENTS <span class="text-danger">*</span></strong></p>
        <p v-if="components.length == 0"><em>No components in the selected template.</em></p>
        <div class="form-group" v-for="component in components" :key="component.id">
            <a href class="pull-right" v-if="component.type == 'image'" @click.prevent="upload(component.id)">Upload</a>
            <label :for="component.slug">{{ component.name }}</label>
            <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]">
        </div>

        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
import FileUpload from './../FileUpload';
export default {
    props: {
        components: {
            type: Array,
            required: true
        },
        unit: {
            type: Object,
            required: true
        },
        redirectTo: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            form: {
                template_id: this.unit.template_id,
                components: {}
            },
            errors: [],
            disable: {
                saving: false
            }
        }
    },

    mounted() {
        let components = {};
        _.forEach(this.components, (component) => {
            components[component.id] = this.unit.components[component.slug]
                                            ? this.unit.components[component.slug]
                                            : '';
        });

        Vue.set(this.form, 'components', components);
    },

    methods: {
        update() {
            this.disable.saving = true;

            axios.put('/api/units/' + this.unit.id, this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    window.location = this.redirectTo;
                })
                .catch(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    console.log(response);
                });
        },

        upload(componentId) {
            let thiz = this;
            Modal.show(FileUpload, {
                propsData: {
                        apiPath: '/api/upload'
                    }
                })
                .then(function(url) {
                    Vue.set(thiz.form.components, componentId, url);
                });
        },
    }
}
</script>

