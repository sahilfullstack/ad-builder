<template>
  <a href @click.prevent="create" class="btn btn-sm btn-success" :disabled="disable.approving">Approve</a>
</template>

<script>
import ConfirmModal from './../ConfirmModal';
export default {
    props: {    
       unit: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            disable: {
                approving: false
            }
        }
    },

    methods: {
        create() {
            let thiz = this;
            Modal.show(ConfirmModal, {
                propsData: {
                        message:'Do you really want to approve the ad?',
                        unit: this.unit
                    }
                })
                .then(function(url) {
                    thiz.disable.approving = true;
                    axios.put('/api/units/' + thiz.unit.id + '/approve',  {action: 'approve'})
                    .then(function (response) {
                        thiz.disable.approving = false;

                        // reloading the page
                        location.reload();                        
                    })
                    .catch(function (error) {
                        thiz.disable.approving = false;
                        console.log(error);
                    });
                    
                });
        }
    }
}
</script>

