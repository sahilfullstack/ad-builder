<template>
    <div>    
        <a href @click.prevent="create" class="btn btn-sm btn-success" :disabled="disable.pinning">UnPin</a>
        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
    </div>
</template>

<script>
import ConfirmModal from './../ConfirmModal';
export default {
    props: {    
        filters: {
            type: Array,
            required: false,
        },
        report: {
            type: String,
            required: true,
        },
        pinned: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            disable: {
                pinning: false
            },
            errors: []
        }
    },

    methods: {
        create() {
            let thiz = this;
            this.errors = [];
            Modal.show(ConfirmModal, {
                propsData: {
                        message:'Do you really want to unpin this report?'
                    }
                })
                .then(function() {
                    console.log({filters: thiz.filters, report: thiz.report});
                    thiz.disable.pinning = true;
                    axios.delete('/api/reports/pin/'+ thiz.pinned.id,  {filters: thiz.filters, report: thiz.report})
                    .then(function (response) {
                        thiz.disable.pinning = false;

                        // reloading the page
                        location.reload();                        
                    })
                    .catch(function (error) {
                        thiz.disable.pinning = false;
                                                
                        _.forEach(error.response.data.errors, function(error, index) {
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

