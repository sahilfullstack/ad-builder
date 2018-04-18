<template>
    <form @submit.prevent="update">
        <h4>SUBMIT FOR APPROVAL</h4>
        <p>Make sure that you've completed all the fields before submitting it for approval.</p>

        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
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
                
            },
            errors: [],
            disable: {
                saving: false
            }
        }
    },

    methods: {
        createLandingPage() {
            this.disable.saving = true;

            axios.post('/api/units', {type: 'page', parent_id: this.unit.id})
                .then(response => {
                    this.disable.saving = false;

                    window.location = '/units/' + response.data.id + '/edit?section=template';
                })
                .catch(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    console.log(response);
                });
        },

        update() {
            this.disable.saving = true;

            axios.put('/api/units/' + this.unit.id + '/publish', {})
                .then(response => {

                    if(this.unit.type == 'ad')

                    this.createLandingPage();
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

