<template>
    <form @submit.prevent="update">
    
        <div class="form-group">
            <label for="name">NAME <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Example: Most amazing ad ever..." v-model="form.name">
             <span class="text-danger" :class="{'hidden': errors['name'] == undefined}" style="margin-right:10px;">{{errors['name']}}</span>
        </div>
        <div v-if="unit.type == 'ad'" class="form-group">
            <a href class="pull-right" @click.prevent="upload('hover_image')">Upload</a>
            <label for="hover_image">Scroll Over Image</label>
            <input type="text" class="form-control" id="hover_image" placeholder="Example: http://something.png" v-model="form.hover_image">
             <span class="text-danger" :class="{'hidden': errors['hover_image'] == undefined}" style="margin-right:10px;">{{errors['hover_image']}}</span>
        </div>
        <div v-if="unit.type == 'ad'" class="form-group">
            <input id="is_popup" class="form-check-input" type="checkbox" v-model="form.is_popup" >
            <label for="is_popup">Is Popup?</label>
            <span class="text-danger" :class="{'hidden': errors['is_popup'] == undefined}" style="margin-right:10px;">{{errors['is_popup']}}</span>
        </div>
        <div  v-if="unit.type == 'ad'" class="form-group">
            <a href class="pull-right" @click.prevent="upload('thumbnail')">Upload</a>
            <label for="thumbnail">Thumbnail<span class="text-danger">*</span><em>(350px x 245px)</em></label>
            <input type="text" class="form-control" id="thumbnail" placeholder="Example: http://something.png" v-model="form.thumbnail">
            <span class="text-danger" :class="{'hidden': errors['thumbnail'] == undefined}" style="margin-right:10px;">{{errors['thumbnail']}}</span>
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

    data() {
        return {
            form: {
                name: this.unit.name,
                hover_image: this.unit.hover_image,
                is_popup: this.unit.is_popup,
                thumbnail: this.unit.thumbnail,
                section: 'name',
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
        upload(attr) {
            let thiz = this;
            Modal.show(FileUpload, {
                propsData: {
                        apiPath: '/api/upload'
                    }
                })
                .then(function(url) {
                   Vue.set(thiz.form, attr, url);
                });
        },
    }
}
</script>

