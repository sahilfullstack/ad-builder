<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label for="parent_id">AD <span class="text-danger">*</span></label>
            <select name="parent_id" id="template_id" class="form-control" v-model="form.parent_id">
                <option v-for="ad in ads" :key="ad.id" :value="ad.id">{{ ad.name }}</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
export default {
    props: {
        ads: {
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
                parent_id: this.unit.parent_id == null ? this.ads[0].id : this.unit.parent_id
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

            axios.put('/api/units/' + this.unit.id, this.form)
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

