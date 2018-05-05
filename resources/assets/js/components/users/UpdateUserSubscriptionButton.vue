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
            console.log(this.defaultdate);
            Modal.show(DatePickerModal, {
                propsData: {
                        message:'Do you really want to update the subscription?',
                        defaultDate: this.subscription.expiring_at,
                        user: this.user,
                        subscription: this.subscription,
                    }
                })
                .then(function(data) {

                    thiz.disable.updating = true;
                    
                    axios.put('/api/users/' + thiz.user.id + '/subscriptions/'+ thiz.subscription.id,  {expiry_date: data.date, allowed_quantity: data.quantity})
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

