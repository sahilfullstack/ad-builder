<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label for="template_id">TEMPLATE <span class="text-danger">*</span></label>
            <span v-if="templates.length== 0">No Subscriptions Yet.</span>
            <select v-if="templates.length > 0" name="template_id" id="template_id" class="form-control" v-model="form.template_id">    
                <option v-for="template in templates" :key="template.id" :value="template.id">{{ template.name }}</option>
            </select>
            <span class="text-danger" :class="{'hidden': errors['template_id'] == undefined}" style="margin-right:10px;">{{errors['template_id']}}</span>
        </div>

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
        <br>
        <button v-if="templates.length > 0" type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
export default {
    props: {
        templates: {
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

    data() {
        return {
            form: {
                template_id: this.unit.template_id == null ? (this.templates.length > 0 ? this.templates[0].id :0) : this.unit.template_id
            },
            errors: [],
            disable: {
                saving: false
            }
        }
    },

    computed: {
        selectedTemplate() {
            return this.form.template_id;
        },
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
        }
    }
}
</script>

