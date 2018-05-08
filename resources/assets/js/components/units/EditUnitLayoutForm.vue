<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label >LAYOUT <span class="text-danger">*</span></label>
            <span v-if="layouts.length== 0">No Subscriptions Yet.</span>
            <select v-if="layouts.length > 0" name="layout_id" id="layout_id" class="form-control" v-model="form.layout_id">    
                <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
            </select>
            <span class="text-danger" :class="{'hidden': errors['layout_id'] == undefined}" style="margin-right:10px;">{{errors['layout_id']}}</span>
        </div>
        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
        <br>
        <button v-if="layouts.length > 0" type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
export default {
    props: {
        layouts: {
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
                layout_id: this.unit.layout_id == null ? (this.layouts.length > 0 ? this.layouts[0].id :0) : this.unit.layout_id
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
                        console.log(self.errors);
                    });
                });
        }
    }
}
</script>

