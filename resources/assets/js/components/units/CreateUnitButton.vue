<template>
  <a href @click.prevent="create" class="btn btn-sm btn-primary" :disabled="disable.creating">Add New</a>
</template>

<script>
export default {
    data() {
        return {
            disable: {
                creating: false
            }
        }
    },

    methods: {
        create() {
            this.disable.creating = true;

            axios.post('/api/units', {})
                .then(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;

                    window.location = '/units/' + response.data.id + '/edit';
                })
                .catch(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;

                    console.log(response);
                });
        }
    }
}
</script>

