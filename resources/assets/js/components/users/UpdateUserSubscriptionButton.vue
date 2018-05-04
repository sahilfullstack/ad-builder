<template>
  <a href @click.prevent="create" class="btn btn-sm btn-success" :disabled="disable.updating">Update</a>
</template>

<script>
import DatePickerModal from './../DatePickerModal';
export default {
    props: {    
       user: {
            type: Object,
            required: true
        },
        subscription: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            disable: {
                updating: false
            }
        }
    },

    methods: {
        create() {
            let thiz = this;
            Modal.show(DatePickerModal, {
                propsData: {
                        message:'Do you really want to update the subscription?',
                        user: this.user,
                        subscription: this.subscription,
                    }
                })
                .then(function(expiryDate) {
                    thiz.disable.updating = true;
                    console.log(thiz.user);
                    console.log(thiz.subscription);
                    axios.put('/api/users/' + thiz.user.id + '/subscriptions/'+ thiz.subscription.id,  {expiry_date: expiryDate})
                    .then(function (response) {
                        thiz.disable.updating = false;

                        // reloading the page
                        location.reload();                        
                    })
                    .catch(function (error) {
                        thiz.disable.updating = false;
                        console.log(error);
                    });                    
                });
        }
    }
}
</script>

