<template>
    <form @submit.prevent="create">
        <div class="form-group">
            <label for="template_id">TEMPLATE <span class="text-danger">*</span></label>
            <select name="template_id" id="template_id" class="form-control" v-model="form.template_id">    
                <option v-for="template in templates" :key="template.id" :value="template.id">{{ template.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">NAME <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Example: Most amazing ad ever...">
        </div>

        <p><strong>COMPONENTS <span class="text-danger">*</span></strong></p>
        <p v-if="components.length == 0"><em>No components in this template.</em></p>
        <div class="form-group" v-for="component in components" :key="component.id">
            <a href class="pull-right" v-if="component.type == 'image'" @click.prevent="upload(component.id)">Upload</a>
            <label :for="component.slug">{{ component.name }}</label>
            <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]">
        </div>

        <button type="submit" class="btn btn-primary" :disabled="disable.creating">Create</button>
    </form>
</template>

<script>
import FileUpload from './../FileUpload';
export default {
    props: {
        type: {
            type: String,
            required: true
        },
        templates: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            form: {
                template_id: this.templates[0].id,
                name: '',
                components: {}
            },
            errors: [],
            disable: {
                creating: false
            }
        }
    },

    mounted() {
        _.forEach(this.components, (component) => {
            this.form.components[component.id] = ''
        });
    },

    computed: {
        selectedTemplate() {
            return this.form.template_id;
        },
        components() {
            let template = _.find(this.templates, _.matchesProperty('id', this.selectedTemplate));
            return template.components;
        }
    },

    watch: {
        selectedTemplate(current, previous) {
            _.forEach(this.components, (component) => {
                this.form.components[component.id] = ''
            });
        } 
    },

    methods: {
        create() {
            this.disable.creating = true;

            axios.post('/api/units', this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;
                })
                .catch(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;

                    console.log(response);
                });
        },

        upload(componentId) {
            let thiz = this;
            Modal.show(FileUpload, {
                propsData: {
                        prefilled: {
                            name: 'profiles/' + _.kebabCase(this.profileType) + 's/' + this.form.name
                        },
                        apiPath: '/api/upload'
                    }
                })
                .then(function(url) {
                    thiz.form.components[componentId] = url;
                });
        },
    }
}
</script>

