<template>
  <a href @click.prevent="create" class="btn btn-sm btn-success" :disabled="disable.adding">Add Another Subscription</a>
</template>

<script>
import AddSubscriptionModal from './AddSubscriptionModal';
export default {
    props: {    
       user: {
            type: Object,
            required: true
        },
        layouts: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            disable: {
                adding: false
            }
        }
    },

    methods: {
        create() {
            let thiz = this;
            Modal.show(AddSubscriptionModal, {
                propsData: {
                        userId: this.user.id,
                        layouts: this.layouts
                    }
                })
                .then(function() {

                    thiz.disable.adding = true;

                    location.reload();

                });
        }
    }
}
</script>

