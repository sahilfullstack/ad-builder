<template>
    <form @submit.prevent="update">
    
        <div class="form-group">
            <a href class="pull-right" @click.prevent="upload()">Upload</a>
            <label for="hover_image">Hover Image<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="hover_image" placeholder="Example: http://something.png" v-model="form.hover_image">
             <span class="text-danger" :class="{'hidden': errors['hover_image'] == undefined}" style="margin-right:10px;">{{errors['hover_image']}}</span>
        </div>

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
        <br>

        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
import FileUpload from './../FileUpload';
export default {
    props: {
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
                hover_image: this.unit.hover_image,
                section: 'hoverimage'
            },
            errors: [],
            disable: {
                saving: false
            }
        }
    },

    methods: {
        update() {
            this.disable.saving = true;
            
            var self = this;
            
            this.errors = [];

            axios.put('/api/units/' + this.unit.id, this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    window.location = this.redirectTo;
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
        upload() {
            let thiz = this;
            Modal.show(FileUpload, {
                propsData: {
                        apiPath: '/api/upload'
                    }
                })
                .then(function(url) {
                   Vue.set(thiz.form, 'hover_image', url);
                });
        },
    }
}
</script>

