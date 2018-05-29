<template>
  <a href @click.prevent="create" class="btn btn-sm btn-success" :disabled="disable.updating">Update</a>
</template>

<script>
import DatePickerModal from './../DatePickerModal';
import UpdateSubscriptionModal from './../UpdateSubscriptionModal';
export default {
    props: {    
       user: {
            type: Object,
            required: true
        },
        layout: {
            type: Object,
            required: true,
        },
        subscription: {
            type: Object,
            required: false
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
            Modal.show(UpdateSubscriptionModal, {
                propsData: {
                        layout: this.layout,
                        expiring_at: this.subscription.expiring_at !== undefined ? this.subscription.expiring_at : null,
                        allowed_quantity: this.subscription.allowed_quantity !== undefined ? this.subscription.allowed_quantity : null,
                        days: this.subscription.days !== undefined ? this.subscription.days : null,
                        allow_videos: this.subscription.allow_videos !== undefined ? this.subscription.allow_videos : null,
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

