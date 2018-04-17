<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label for="template_id">TEMPLATE <span class="text-danger">*</span></label>
            <select name="template_id" id="template_id" class="form-control" v-model="form.template_id">    
                <option v-for="template in templates" :key="template.id" :value="template.id">{{ template.name }}</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
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
            required: true
        }
    },

    data() {
        return {
            form: {
                template_id: this.unit.template_id == 0 ? this.templates[0].id : this.unit.template_id
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

            axios.put('/api/units/' . this.unit.id, this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    window.location = this.redirectTo;
                })
                .catch(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    console.log(response);
                });
        }
    }
}
</script>

