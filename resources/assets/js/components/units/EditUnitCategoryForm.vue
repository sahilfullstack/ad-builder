<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label for="category_id">CATEGORY <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-control" v-model="form.category_id">    
                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
            </select>
            <span class="text-danger" :class="{'hidden': errors['category_id'] == undefined}" style="margin-right:10px;">{{errors['category_id']}}</span>
        </div>

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
        <br>
        <button v-if="categories.length > 0" type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
export default {
    props: {
        categories: {
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
                category_id: this.unit.category_id == null ? (this.categories.length > 0 ? this.categories[0].id :0) : this.unit.category_id
            },
            errors: [],
            disable: {
                saving: false
            }
        }
    },

    computed: {
        selectedTemplate() {
            return this.form.category_id;
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

