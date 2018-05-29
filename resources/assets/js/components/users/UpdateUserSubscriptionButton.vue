<template>
  <a href @click.prevent="create" class="btn btn-sm btn-success" :disabled="disable.updating">Update</a>
</template>

<script>
import UpdateSubscriptionModal from './UpdateSubscriptionModal';
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
                        userId: this.user.id,
                        layout: this.layout,
                        currentExpiringAt: this.subscription.expiring_at !== undefined ? this.subscription.expiring_at : null,
                        currentAllowedQuantity: this.subscription.allowed_quantity !== undefined ? this.subscription.allowed_quantity : null,
                        currentDays: this.subscription.days !== undefined ? this.subscription.days : null,
                        currentAllowVideos: this.subscription.allow_videos !== undefined ? this.subscription.allow_videos : null,
                        currentAllowHover: this.subscription.allow_hover !== undefined ? this.subscription.allow_hover : null,
                        currentAllowPopout: this.subscription.allow_popout !== undefined ? this.subscription.allow_popout : null,
                    }
                })
                .then(function(data) {
                    thiz.disable.updating = true;
                    
                    location.reload();

                });
        }
    }
}
</script>
