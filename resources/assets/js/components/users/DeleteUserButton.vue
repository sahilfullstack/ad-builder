<template>
  <a href @click.prevent="create" class="btn btn-sm btn-danger" :disabled="disable.deleting">Delete</a>
</template>

<script>
import ConfirmModal from './../ConfirmModal';
export default {
    props: {    
       user: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            disable: {
                deleting: false
            }
        }
    },

    methods: {
        create() {
            let thiz = this;
            Modal.show(ConfirmModal, {
                propsData: {
                        message: 'Are you sure you want to delete the user? This action cannot be undone.'
                    }
                })
                .then(function(data) {
                    axios.delete('/api/users/' + thiz.user.id)
                        .then(function (response) {
                            thiz.disable.deleting = true;

                            location.href = '/users';
                    });
                });
        }
    }
}
</script>
