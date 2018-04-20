<template>
    <form @submit.prevent="update">
    
        <div class="form-group">
            <label for="name">NAME <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Example: Most amazing ad ever..." v-model="form.name">
             <span class="text-danger" :class="{'hidden': errors['name'] == undefined}" style="margin-right:10px;">{{errors['name']}}</span>
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
                name: this.unit.name,
                section: 'name'
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
        }
    }
}
</script>

