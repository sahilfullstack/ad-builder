<template>
    <form @submit.prevent="create">
        <div class="form-group">
            <label for="type">TYPE <span class="text-danger">*</span></label>
            <select name="type" id="type" class="form-control" v-model="form.type">
                <option value="ad">Ad</option>
                <option value="page">Landing Page</option>
            </select>
        </div>
        
        <div class="form-group" v-if="form.type == 'ad'">
            <label for="layout_id">LAYOUT <span class="text-danger">*</span></label>
            <select name="layout_id" id="layout_id" class="form-control" v-model="form.layout_id">
                <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">NAME <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Example: Half Page Ad Template" v-model="form.name">
        </div>

        <div class="form-group">
            <label for="renderer">RENDERER <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="renderer" placeholder="Example: templates.renderer.half-page-ad-template" v-model="form.renderer">
        </div>

        <div class="form-group">
            <label>COMPONENTS <span class="text-danger">*</span></label>
            
            
        </div>

        
        <div class="form-group" v-for="(component, index) in form.components" :key="index">
            <hr />
            <p><strong>COMPONENT #{{ index + 1 }} ({{ component.type }}) <span class="text-danger">*</span></strong></p>
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-md-10">
                    <input type="text" class="form-control" id="components" placeholder="Example: Cover Image" v-model="form.components[index]['name']">
                </div>
                <div class="col-md-2">
                    <a href class="btn btn-danger" @click.prevent="removeComponentAtIndex(index)">Remove</a>
                </div>
            </div>
            <p><strong>CONSTRAINTS</strong></p>
            <div class="row" v-if="form.components[index]['type'] == 'text'">
                <div class="col-md-6">
                    <div class="form-group">
                        <label :for="index + 'min_length'">Minimum Length <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="index + 'min_length'" v-model="form.components[index]['rules']['min_length']">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label :for="index + 'max_length'">Maximum Length <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="index + 'max_length'" v-model="form.components[index]['rules']['max_length']">
                    </div>
                </div>
            </div>
            <div class="row" v-if="form.components[index]['type'] == 'image'">
                <div class="col-md-6">
                    <div class="form-group">
                        <label :for="index + 'width'">Width <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="index + 'width'" v-model="form.components[index]['rules']['width']">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label :for="index + 'height'">Height <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="index + 'height'" v-model="form.components[index]['rules']['height']">
                    </div>
                </div>
            </div>
            <div class="row" v-if="form.components[index]['type'] == 'video'">
                <div class="col-md-6">
                    <div class="form-group">
                        <label :for="index + 'width'">Width <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="index + 'width'" v-model="form.components[index]['rules']['width']">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label :for="index + 'height'">Height <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="index + 'height'" v-model="form.components[index]['rules']['height']">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label :for="index + 'min_duration'">Minimum Duration <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="index + 'min_duration'" v-model="form.components[index]['rules']['min_duration']">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label :for="index + 'max_duration'">Maximum Duration <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="index + 'max_duration'" v-model="form.components[index]['rules']['max_duration']">
                    </div>
                </div>
            </div>

        </div>
        
        <hr />
        <!-- Component Type Chooser -->
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                What type of another component to add? <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href @click.prevent="addComponentAfterIndex(form.components.length, 'text')">Text</a></li>
                <li><a href @click.prevent="addComponentAfterIndex(form.components.length, 'image')">Image</a></li>
                <li><a href @click.prevent="addComponentAfterIndex(form.components.length, 'video')">Video</a></li>
            </ul>
        </div>

        <button type="submit" class="btn btn-primary" :disabled="disable.creating">Create</button>
    </form>
</template>

<script>
export default {
    props: {
        layouts: {
            type: Array,
            required: true
        },
        afterCreatePath: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            form: {
                type: 'ad',
                layout_id: null,
                name: '',
                renderer: '',
                components: [
                ]
            },
            errors: [],
            disable: {
                creating: false
            }
        }
    },

    computed: {
        selectedType() {
            return this.form.type;
        }
    },

    watch: {
        // form: {
        //     handler(current, previous) {
        //         let components = [];
        //         _.forEach(current.components, (component) => {
        //             if(component.type == 'image') {
        //                 component.rules = {
        //                     width: 200,
        //                     height: 200
        //                 }
        //             }
        //             components.push(component);
        //         });
        //         Vue.set(this.form, 'components', components);
        //     },
        //     deep: true
        // },
        selectedType(current, previous) {
            Vue.set(this.form, 'layout_id', null);
        } 
    },

    methods: {
        defaultRulesFor(type = 'text') {
            let rules = {
                text: {
                    min_length: 0,
                    max_length: 100
                },
                image: {
                    width: null,
                    height: null
                },
                video: {
                    min_duration: 3,
                    max_duration: 60,
                    width: null,
                    height: null
                }
            }

            return rules[type];
        },
        addComponentAfterIndex(index, type = 'text') {
            this.form.components.push({
                type: type,
                name: '',
                rules: this.defaultRulesFor(type)
            });
        },
        removeComponentAtIndex(index) {
            this.form.components.splice(index, 1);
        },
        create() {
            this.disable.creating = true;

            axios.post('/api/templates', this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;

                    window.location = this.afterCreatePath;
                })
                .catch(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;

                    console.log(response);
                });
        },
    }
}
</script>

