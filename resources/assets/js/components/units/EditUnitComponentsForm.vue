<template>
    <form @submit.prevent="update">
        <p><strong>COMPONENTS <span class="text-danger">*</span></strong></p>
        <p v-if="components.length == 0"><em>No components in the selected template.</em></p>
        <div class="form-group" v-for="component in components" :key="component.id">
            <div v-if="component.type == 'images'">
                <div v-for="(formComponent, formComponentIndex) in form.components[component.id]" :key="component.id + '-' + formComponentIndex" class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <a href class="pull-right" @click.prevent="upload(component.id, formComponentIndex)">Upload</a>
                        <label :for="component.slug + '_' + formComponentIndex">
                            {{ component.name }} #{{ formComponentIndex + 1 }} <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" :id="component.slug + '_' + formComponentIndex" :placeholder="component.type" v-model="form.components[component.id][formComponentIndex]['_value']">
                        <a href @click.prevent="pushAnotherElementInComponent(component.id)"><span class="text-success">Add Another</span></a>
                        <a href @click.prevent="removeElementAtPositionFromComponent(component.id, formComponentIndex)" v-if="form.components[component.id].length > 1"><span class="text-danger">Remove</span></a>
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='text'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-6">
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                    <div class="col-md-2">
                        <label :for="component.slug + '_size'">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug + '_size'" :placeholder="component.type" v-model="form.components[component.id]['size']">
                    </div>
                    <div class="col-md-2">
                        <label :for="component.slug + '_background_color'">Background Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['background_color']" :color="form.components[component.id]['background_color']" />
                    </div>
                    <div class="col-md-2">
                        <label :for="component.slug + '_foreground_color'">Text Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['foreground_color']" :color="form.components[component.id]['foreground_color']" />
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='survey'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
             <div v-else-if="component.type =='color'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']" :color="form.components[component.id]['_value']"/>
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>                   
                </div>
            </div>
            <div v-else>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <a href class="pull-right" v-if="component.type == 'image' || component.type == 'video' || component.type == 'audio'" @click.prevent="upload(component.id)">Upload</a>
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
        </div>

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
        <br>

        <button class="btn btn-info" :disabled="disable.previewing" @click.prevent="reloadPreview">Reload preview</button>
        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
import FileUpload from './../FileUpload';
import ColorPicker from './../ColorPicker';

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
            required: false
        },
        movingFrom: {
            type: String,
            required: false
        },
        moveTo: {
            type: String,
            required: false
        }
    },

    components: {
        'color-picker': ColorPicker
    },

    data() {
        return {
            form: {
                template_id: this.unit.template_id,
                components: {}
            },
            errors: [],
            disable: {
                saving: false,
                previewing: false
            }
        }
    },

    mounted() {
        let components = {};
        _.forEach(this.components, (component) => {
            components[component.id] = this.unit.components[component.id]
                                            ? this.unit.components[component.id]
                                            : this.defaultValueForDataType(component.type);
        });
        Vue.set(this.form, 'components', components);
    },

    methods: {
        defaultValueForDataType(dataType = 'text') {
            let defaults = {
                text: {_value: '', background_color: '#ffffff', foreground_color: '#000000', size: 12},
                image: {_value: ''},
                video: {_value: ''},
                qr: {_value: ''},
                images: {_value: ['']},
                survey: {_value: '', _yes: 0, _no: 0},
                audio: {_value: ''},
            }

            return defaults[dataType];
        },
        pushAnotherElementInComponent(componentId) {
            this.form.components[componentId].push({_value: ''});
        },
        removeElementAtPositionFromComponent(componentId, index) {
            this.form.components[componentId].splice(index, 1);
        },
        reloadPreview() {
            this.disable.previewing = true;

            var self = this;
            var experimentalForm = _.cloneDeep(this.form);
            delete experimentalForm.components;
            experimentalForm.experimental_components = this.form.components;
            
            this.errors = [];
            axios.put('/api/units/' + this.unit.id, experimentalForm)
                .then(response => {
                    this.disable.previewing = false;

                    var frameElement = document.getElementById("renderer-iframe-" + this.unit.id);
                    if(frameElement) frameElement.contentWindow.location.href = frameElement.src + '&is_preview=y';
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.previewing = false;

                    _.forEach(error.response.data.errors, function(error, index) {
                        var errorIndex = _.startsWith(index, '_')
                                            ? _.trim(index, '_')
                                            : index;
                                            
                        self.errors[errorIndex] = error[0];
                    });
                });
        },
        update() {
            this.disable.saving = true;

            var self = this;
            
            this.errors = [];

            axios.put('/api/units/' + this.unit.id, this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    if(this.moveTo !== undefined) {
                        $('#' + this.movingFrom).collapse('hide');
                        $('#' + this.moveTo).collapse('show');
                    } else {
                        window.location = this.redirectTo;
                    }
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    _.forEach(error.response.data.errors, function(error, index) {
                        var errorIndex = _.startsWith(index, '_')
                                            ? _.trim(index, '_')
                                            : index;
                                            
                        self.errors[errorIndex] = error[0];
                    });
                });
        },

        upload(componentId, index = null) {
            let thiz = this;
            Modal.show(FileUpload, {
                propsData: {
                        apiPath: '/api/upload'
                    }
                })
                .then(function(url) {
                    if(index !== null)
                    {
                        // let currentArray = thiz.form.components[componentId];
                        // currentArray[index] = url;
                        Vue.set(thiz.form.components[componentId], index, {_value: url});
                    } else {
                        Vue.set(thiz.form.components, componentId, {_value: url});
                    }
                });
        },
    }
}
</script>

