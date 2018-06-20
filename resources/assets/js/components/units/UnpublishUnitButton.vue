<template>
      <a href @click.prevent="unpublish" class="btn btn-sm btn-danger" :disabled="disable.unpublish">Unpublish</a>       
</template>

<script>
import ConfirmModal from './../ConfirmModal';
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
           errors: [],
            disable: {
                unpublish: false
            }
        }
    },

    methods: {
        unpublish() {
            let thiz = this;
            this.errors = [];
            Modal.show(ConfirmModal, {
                propsData: {
                        message:'Do you really want to unpublish this ad?',
                        unit: this.unit
                    }
                })
                .then(function(url) {
                    thiz.disable.unpublish = true;
                    axios.delete('/api/units/' + thiz.unit.id,  {})
                    .then(function (response) {
                        thiz.disable.unpublish = false;
                        // go to edit unit
                        window.location =  thiz.redirectTo;
                    })
                    .catch(function (error) {
                        thiz.disable.unpublish = false;
                        _.forEach(error.response.data.errors, function(error, index) {
                            console.log(thiz.errors);
                            var errorIndex = _.startsWith(index, '_')
                                                ? _.trim(index, '_')
                                                : index;
                            
                            thiz.errors[errorIndex] = error[0];
                        });
                    });                    
                });
        }
    }
}
</script>

