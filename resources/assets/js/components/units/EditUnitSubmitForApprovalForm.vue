<template>
    <form @submit.prevent="update">
        <h4>SUBMIT FOR APPROVAL</h4>
        <p>Make sure that you've completed all the fields before submitting it for approval.</p>

        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Submit</button>
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
        update() {
            this.disable.saving = true;

            axios.put('/api/units/' + this.unit.parent_id + '/publish', {})
                .then(response => {

                    
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    _.forEach(error.response.data.errors, function(error, index) {
                        console.log(error);
                        console.log(index);
                    });
                });
        }
    }
}
</script>

