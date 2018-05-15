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
            <span class="text-danger" :class="{'hidden': errors['layout_id'] == undefined}" style="margin-right:10px;">{{errors['layout_id']}}</span>
        </div>

        <div class="form-group">
            <label for="name">NAME <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Example: Half Page Ad Template" v-model="form.name">
            <span class="text-danger" :class="{'hidden': errors['name'] == undefined}" style="margin-right:10px;">{{errors['name']}}</span>
        </div>

        <div class="form-group">
            <label for="renderer">RENDERER <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="renderer" placeholder="Example: templates.renderer.half-page-ad-template" v-model="form.renderer">
            <span class="text-danger" :class="{'hidden': errors['renderer'] == undefined}" style="margin-right:10px;">{{errors['renderer']}}</span>
        </div>

        <div class="form-group">
            <label>COMPONENTS <span class="text-danger">*</span></label>                        
        </div>

        
        <div class="form-group" v-for="(component, index) in form.components" :key="index">
            <hr />
            <p><strong>COMPONENT #{{ index + 1 }} ({{ component.type }}) <span class="text-danger">*</span></strong></p>
            <span class="text-danger" :class="{'hidden': errors['components.'+index+'.type'] == undefined}" style="margin-right:10px;">{{errors['components.'+index+'.type']}}</span>

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-md-10">
                    <input type="text" class="form-control" id="components" placeholder="Example: Cover Image" v-model="form.components[index]['name']">
                     <span class="text-danger" :class="{'hidden': errors['components.'+index+'.name'] == undefined}" style="margin-right:10px;">{{errors['components.'+index+'.name']}}</span>
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
            <div class="row" v-if="form.components[index]['type'] == 'image' || form.components[index]['type'] == 'images'">
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

            <div class="row" v-if="form.components[index]['type'] == 'qr'">
                <div class="col-md-12">
                    <em>None available for QR Code.</em>
                </div>
            </div>
            <div class="row" v-if="form.components[index]['type'] == 'color'">
                <div class="col-md-12">
                    <em>None available for Color.</em>
                </div>
            </div>
            <div class="row" v-if="form.components[index]['type'] == 'survey'">
                <div class="col-md-12">
                    <em>None available for Survey.</em>
                </div>
            </div>
            <div class="row" v-if="form.components[index]['type'] == 'audio'">
                <div class="col-md-12">
                    <em>None available for Audio.</em>
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
                <li><a href @click.prevent="addComponentAfterIndex(form.components.length, 'qr')">QR Code</a></li>
                <li><a href @click.prevent="addComponentAfterIndex(form.components.length, 'images')">Series of Images</a></li>
                <li><a href @click.prevent="addComponentAfterIndex(form.components.length, 'color')">Color</a></li>
                <li><a href @click.prevent="addComponentAfterIndex(form.components.length, 'survey')">Survey</a></li>
                <li><a href @click.prevent="addComponentAfterIndex(form.components.length, 'audio')">Audio</a></li>
            </ul>
        </div>


        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>

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
                },
                qr: {

                },
                images: {
                    width: null,
                    height: null
                },
                color : {

                },
                survey : {

                },
                audio : {

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
            var self = this;

            this.errors = [];

            axios.post('/api/templates', this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;

                    window.location = this.afterCreatePath;
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.creating = false;
                   
                    _.forEach(error.response.data.errors, function(error, index) {
                        console.log(self.errors);
                        var errorIndex = _.startsWith(index, '_')
                                            ? _.trim(index, '_')
                                            : index;
                        
                        self.errors[errorIndex] = error[0];
                    });
                });
        },
    }
}
</script>

