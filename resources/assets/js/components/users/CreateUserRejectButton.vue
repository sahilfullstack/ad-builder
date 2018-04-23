<template>
  <a href @click.prevent="create" class="btn btn-sm btn-danger" :disabled="disable.rejecting">Reject</a>
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
                rejecting: false
            }
        }
    },

    methods: {
        create() {
            let thiz = this;
            Modal.show(ConfirmModal, {
                propsData: {
                        message:'Do you really want to reject the user?',
                        user: this.user
                    }
                })
                .then(function(url) {
                    thiz.disable.rejecting = true;
                    axios.put('/api/users/' + thiz.user.id + '/approve',  {action: 'reject'})
                    .then(function (response) {
                        thiz.disable.rejecting = false;

                        // reloading the page
                        location.reload();                        
                    })
                    .catch(function (error) {
                        thiz.disable.rejecting = false;
                        console.log(error);
                    });
                    
                });
        }
    }
}
</script>

